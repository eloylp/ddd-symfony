#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source $DIR/common.sh
cd $DIR
cd ..
pushd

print_message "Initializing rolling update .."

## FIRST NODE

print_message "Disabling node 1 ..."
docker-compose exec haproxy disable_web 1
print_message "Updating node 1 ..."
docker-compose -f ./../../docker-compose-production.yml up --build -d web1
print_message "Enabling node 1 ..."
docker-compose exec haproxy enable_web 1

## SECOND NODE

print_message "Disabling node 2 ..."
docker-compose exec haproxy disable_web 2
print_message "Updating node 2 ..."
docker-compose -f ./../../docker-compose-production.yml up --build -d web2
print_message "Enabling node 2 ..."
docker-compose exec haproxy enable_web 2







