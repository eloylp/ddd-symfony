#!/usr/bin/env bash


rabbitmqctl add_user ddd_user ddd
rabbitmqctl set_user_tags ddd_user administrator
rabbitmqctl add_vhost ddd_vhost
rabbitmqctl set_permissions -p ddd_vhost ddd_user ".*" ".*" ".*"
