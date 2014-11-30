############################################################
# Dockerfile to build Nginx Installed Containers
# Based on Ubuntu
############################################################

# Set the base image to Ubuntu
###################################

FROM ubuntu:14.04.1

# File Author / Maintainer
###################################
MAINTAINER Christian Calloway callowaylc@gmail.com

# Install Services
RUN apt-get install -y nginx nginx-extras monit php5-gd libssh2-php php5-fpm php5-mysql

# Service configuration
ADD scm/etc/nginx/sites-available/default /etc/nginx/sites-available/default
ADD scm/etc/monit/conf.d/nginx            /etc/monit/conf.d/nginx

# Application
ADD . /app/cms

# INIT 
CMD monit -I