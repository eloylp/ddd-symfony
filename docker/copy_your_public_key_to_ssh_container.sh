#!/usr/bin/env bash

pushd .

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
cp ~/.ssh/id_rsa.pub ./infrastructure/ssh/config/id_rsa.pub
popd


