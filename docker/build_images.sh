#!/bin/bash
docker build -t webapp-nginx:latest ./nginx
docker build -t webapp-php:latest ./webapp
