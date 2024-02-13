FROM php:8.2-fpm-alpine
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apk add --no-cache bash

# FROM golang:1.18-alpine as builder

# # Install MailHog:
# RUN apk --no-cache add --virtual build-dependencies \
#     git \
#   && mkdir -p /root/gocode \
#   && export GOPATH=/root/gocode \
#   && go install github.com/mailhog/MailHog@latest

# FROM alpine:3
# # Add mailhog user/group with uid/gid 1000.
# # This is a workaround for boot2docker issue #581, see
# # https://github.com/boot2docker/boot2docker/issues/581
# RUN adduser -D -u 1000 mailhog

# COPY --from=builder /root/gocode/bin/MailHog /usr/local/bin/

# USER mailhog

# WORKDIR /home/mailhog

# ENTRYPOINT ["MailHog"]

# # Expose the SMTP and HTTP ports:
# EXPOSE 1025 8025



# # NGINX
# FROM nginx
# COPY static-html-directory /usr/share/nginx/html


