<?php


namespace DDD\Infrastructure\Message\Amqp;

use DDD\Infrastructure\Message\Amqp\Configuration\AmqpConnectionFactory;
use Exception;
use PhpAmqpLib\Exception\AMQPRuntimeException;

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
                         string $exchangeType = ExchangeTypes::AMQP_DIRECT)
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
        try {

            $this->writeOut("Starting consumer " . $this->consumerTag);
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

        } catch (AMQPRuntimeException $e) {
            $this->writeOut("Finished consumer");
        } catch (Exception $e) {

            $this->writeOut("Non identified exception:");
            $this->writeOut($e->getMessage());
            if ($e->getPrevious()) {
                $this->writeOut($e->getPrevious()->getMessage());
            }
        }
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
            $this->writeOut("Unable to process signals.");
            exit(1);
        }
    }

    public function alarmHandler($signalNumber)
    {
        $this->writeOut("Handling alarm: #' . $signalNumber");
        $this->writeOut(memory_get_usage(true));
        return;
    }

    public function signalHandler($signalNumber)
    {
        $this->writeOut("Handling signal: #' . $signalNumber .");
        switch ($signalNumber) {
            case SIGTERM:  // 15 : supervisor default stop
            case SIGQUIT:  // 3  : kill -s QUIT
                $this->terminate();
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
        $this->writeOut("Stopping consumer by cancel command.");
        $this->channel->basic_cancel($this->consumerTag, false, true);
    }

    public function restart()
    {
        $this->writeOut('Restarting consumer.');
        $this->stopSoft();
        $this->start();
    }

    public function stopSoft()
    {
        echo 'Stopping consumer by closing channel.' . PHP_EOL;
        $this->channel->close();
    }

    public function terminate()
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function writeOut($message)
    {
        $out = fopen('php://output', 'w'); //output handler
        fputs($out, "$message\n"); //writing output operation
        fclose($out); //closing handler
    }

}