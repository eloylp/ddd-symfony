FROM debian:stable

RUN apt-get update -y && apt-get upgrade -y && apt-get dist-upgrade -y \
&& apt-get install -y rsyslog

COPY config/rsyslog.conf /etc
COPY config/docker.conf /etc/rsyslog.d/10-docker.conf

ENTRYPOINT [ "rsyslogd", "-n" ]

