#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
pushd .
cd $DIR

## Setting acl permissions where containers and you needs write permissions.
USER=$(whoami)
SYMFONY_VAR_DIR="./../src/Infrastructure/Web/Symfony/var"

sudo setfacl -Rb $SYMFONY_VAR_DIR
sudo setfacl --no-mask -d -R -m m::rwx,u:$USER:rwx $SYMFONY_VAR_DIR
sudo setfacl --no-mask -R -m m::rwx,u:$USER:rwx $SYMFONY_VAR_DIR

popd