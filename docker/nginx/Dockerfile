ARG NGINX_VERSION=1.19.6

FROM nginx:${NGINX_VERSION}

COPY  docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

CMD ["nginx"]

EXPOSE 80 443