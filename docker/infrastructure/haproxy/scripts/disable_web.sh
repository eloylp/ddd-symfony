#!/usr/bin/env bash

echo "disable server mainbackend/web$1" | socat stdio /var/run/haproxy.sock