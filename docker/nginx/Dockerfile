FROM nginx:1.23.2-alpine

COPY ./app/public/ /var/www/html/public/
COPY ./docker/nginx/nginx-server.conf /etc/nginx/templates/default.conf.template
