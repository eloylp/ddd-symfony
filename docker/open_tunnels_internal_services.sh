#!/usr/bin/env bash

ssh -f -N -L 27017:mongodb:27017 root@localhost -p2222
ssh -f -N -L 3306:mariadb:3306 root@localhost -p2222
ssh -f -N -L 15672:rabbitmq:15672 root@localhost -p2222
