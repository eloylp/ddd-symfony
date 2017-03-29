<?php


namespace DDD\Infrastructure\Message\Amqp;

use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;

abstract class DefaultConsumerAbstract
{
    protected $connection;
    protected $channel;
    protected $exchange;
    protected $exchangeType;
    protected $routingKey;
    protected $queue;
    protected $consumerLogic;
    protected $consumerTag;

    function __construct(AmqpConnectionFactory $amqpConnectionFactory,
                         string $exchange,
                         string $queue,
                         ConsumerLogicInterface $consumerLogic,
                         string $consumerTag,
                         string $routingKey,
                         string $exchangeType = "direct")
    {
        $this->checkSignals();
        $this->consumerTag = $consumerTag;
        $this->consumerLogic = $consumerLogic;
        $this->exchange = $exchange;
        $this->exchangeType = $exchangeType;
        $this->queue = $queue;
        $this->connection = $amqpConnectionFactory->getAmqpConnection();

        register_shutdown_function([$this, "terminate"]);
    }

    public function start()
    {
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queue, false, true, false, false);
        $this->channel->exchange_declare($this->exchange, $this->exchangeType, false, true, false);
        $this->channel->queue_bind($this->queue, $this->exchange, $this->routingKey);
        $this->channel->basic_consume($this->queue,
            $this->consumerTag,
            false,
            false,
            false,
            false,
            [$this->consumerLogic, 'processMessage']);

        while (count($this->channel->callbacks)) {
            gc_collect_cycles();
            $this->channel->wait();
        }
    }

    public function terminate()
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function checkSignals()
    {
        if (extension_loaded('pcntl')) {

            define('AMQP_WITHOUT_SIGNALS', false);
            pcntl_signal(SIGTERM, [$this, 'signalHandler']);
            pcntl_signal(SIGHUP, [$this, 'signalHandler']);
            pcntl_signal(SIGINT, [$this, 'signalHandler']);
            pcntl_signal(SIGQUIT, [$this, 'signalHandler']);
            pcntl_signal(SIGUSR1, [$this, 'signalHandler']);
            pcntl_signal(SIGUSR2, [$this, 'signalHandler']);
            pcntl_signal(SIGALRM, [$this, 'alarmHandler']);

        } else {
            echo 'Unable to process signals.' . PHP_EOL;
            exit(1);
        }
    }

    public function signalHandler($signalNumber)
    {
        echo 'Handling signal: #' . $signalNumber . PHP_EOL;
        switch ($signalNumber) {
            case SIGTERM:  // 15 : supervisor default stop
            case SIGQUIT:  // 3  : kill -s QUIT
                $this->stopHard();
                break;
            case SIGINT:   // 2  : ctrl+c
                $this->terminate();
                break;
            case SIGHUP:   // 1  : kill -s HUP
                $this->restart();
                break;
            case SIGUSR1:  // 10 : kill -s USR1
                // send an alarm in 1 second
                pcntl_alarm(1);
                break;
            case SIGUSR2:  // 12 : kill -s USR2
                // send an alarm in 10 seconds
                pcntl_alarm(10);
                break;
            default:
                break;
        }
        return;
    }

    public function stop()
    {
        echo 'Stopping consumer by cancel command.' . PHP_EOL;
        $this->channel->basic_cancel($this->consumerTag, false, true);
    }

    public function restart()
    {
        echo 'Restarting consumer.' . PHP_EOL;
        $this->stopSoft();
        $this->start();
    }

    public function stopSoft()
    {
        echo 'Stopping consumer by closing channel.' . PHP_EOL;
        $this->channel->close();
    }

    public function stopHard()
    {
        echo 'Stopping consumer by closing connection.' . PHP_EOL;
        $this->connection->close();
    }

}