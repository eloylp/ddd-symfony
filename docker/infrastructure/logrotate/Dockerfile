FROM alpine:latest

RUN apk --update add logrotate
RUN echo "*/5 *	* * *	/usr/sbin/logrotate /etc/logrotate.conf" >> /etc/crontabs/root
COPY config/logrotate.conf /etc/logrotate.conf

CMD ["crond", "-f"]