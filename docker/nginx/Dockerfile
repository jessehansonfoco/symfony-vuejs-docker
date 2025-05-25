FROM nginx

ARG APP_ID=1000

RUN groupadd -g "$APP_ID" webapp \
  && useradd -g "$APP_ID" -u "$APP_ID" -d /var/www -s /bin/bash webapp

# Nginx - configure
ADD conf/nginx.conf /etc/nginx/nginx.conf
ADD conf/dev.webapp.txt /etc/nginx/sites-enabled/dev.webapp.local

# Nginx starts as root, then runs as user webapp
RUN mkdir -p /var/www/webapp /sock && chown -R webapp:webapp /var/www /sock

CMD ["nginx", "-g", "daemon off;"]
