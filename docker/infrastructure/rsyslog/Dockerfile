FROM alpine:3.5
RUN apk add --no-cache rsyslog

COPY config/rsyslog.conf /etc
COPY config/docker.conf /etc/rsyslog.d/10-docker.conf

ENTRYPOINT [ "rsyslogd", "-n" ]

