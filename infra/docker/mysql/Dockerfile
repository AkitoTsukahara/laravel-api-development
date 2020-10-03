FROM mysql:8.0
LABEL maintainer="ucan-lab <yes@u-can.pro>"

ENV TZ=UTC \
  MYSQL_DATABASE=laravel \
  MYSQL_USER=laravel \
  MYSQL_PASSWORD=password \
  MYSQL_ROOT_PASSWORD=password

COPY ./my.cnf /etc/my.cnf
