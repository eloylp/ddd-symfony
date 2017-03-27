#!/usr/bin/env bash

pushd

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR

cp ./infrastructure/haproxy/volumes/config/haproxy.cfg.dist ./infrastructure/haproxy/volumes/config/haproxy.cfg

cp ./infrastructure/logrotate/config/logrotate.conf.dist ./infrastructure/logrotate/config/logrotate.conf

cp ./infrastructure/rsyslog/config/docker.conf.dist ./infrastructure/rsyslog/config/docker.conf
cp ./infrastructure/rsyslog/config/rsyslog.conf.dist ./infrastructure/rsyslog/config/rsyslog.conf

cp ./services/http/symfony.conf.dist ./services/http/symfony.conf

cp ./services/httpdev/symfony.conf.dist ./services/httpdev/symfony.conf

popd


