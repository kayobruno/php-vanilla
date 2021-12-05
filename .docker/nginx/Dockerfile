FROM nginx:1.19.5-alpine@sha256:6ceeeab513f7d15cea38c1f8dfe5455323b5a1bfd568516b3b0ee70406f75247

RUN apk update && apk add bash

RUN rm /etc/nginx/conf.d/default.conf
COPY ./default.conf /etc/nginx/conf.d