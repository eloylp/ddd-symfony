#!/usr/bin/env bash

docker network create infrastructure_http_traffic
docker network create infrastructure_sql_traffic
docker network create infrastructure_nosql_traffic
docker network create infrastructure_amqp_traffic
docker network create infrastructure_redis_traffic
