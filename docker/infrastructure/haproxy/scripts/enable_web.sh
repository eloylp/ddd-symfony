#!/usr/bin/env bash

echo "enable server mainbackend/web$1" | socat stdio /var/run/haproxy.sock