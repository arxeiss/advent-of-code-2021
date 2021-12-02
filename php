#!/bin/bash

docker run --rm -it -w /app --user "$(id -u):$(id -g)" -v ${PWD}:/app php:8.1.0-cli-alpine php "$@"
