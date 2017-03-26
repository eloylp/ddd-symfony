FROM haproxy:1.7

COPY scripts/enable_web.sh /usr/local/sbin/enable_web
COPY scripts/disable_web.sh /usr/local/sbin/disable_web

RUN useradd -r -s /bin/nologin haproxy \
&& apt-get update -y && apt-get install -y socat \
&& chmod 750 /usr/local/sbin/enable_web \
&& chmod 750 /usr/local/sbin/disable_web

