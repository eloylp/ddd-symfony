#!/usr/bin/env bash

### VARS

pub_if="eth0"
loopback_if="lo"

### CLEANING

iptables -F
iptables -X
iptables -t nat -F
iptables -t nat -X
iptables -t mangle -F
iptables -t mangle -X

### DEFAULT

iptables -P INPUT DROP
iptables -P FORWARD DROP
iptables -P OUTPUT DROP

########## LOOP-BACK ##########

iptables -A INPUT  -i $loopback_if 	-j ACCEPT
iptables -A OUTPUT -o $loopback_if 	-j ACCEPT

######### MINIMAL NET SERVICES ######

iptables -A INPUT -i $pub_if -p udp --dport 53 -j ACCEPT
iptables -A INPUT -i $pub_if -p udp --sport 53 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p udp --sport 53 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p udp --dport 53 -j ACCEPT

iptables -A INPUT -i $pub_if -p icmp --icmp-type echo-reply -j ACCEPT
iptables -A INPUT -i $pub_if -p icmp --icmp-type echo-request -j ACCEPT

iptables -A OUTPUT -o $pub_if -p icmp --icmp-type echo-reply -j ACCEPT
iptables -A OUTPUT -o $pub_if -p icmp --icmp-type echo-request -j ACCEPT

echo "APPLYING MINIMAL NET SERVICES...."
sleep 1s

####### SSH

iptables -A INPUT -i $pub_if -p tcp --dport 22 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p tcp --sport 22 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p tcp --dport 22 -j ACCEPT

##### HTTPS

iptables -A INPUT -i $pub_if -p tcp --dport 443 -j ACCEPT
iptables -A INPUT -i $pub_if -p tcp --sport 443 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p tcp --sport 443 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p tcp --dport 443 -j ACCEPT

#### HTTP

iptables -A INPUT -i $pub_if -p tcp -m multiport --dports 80,8080 -j ACCEPT
iptables -A INPUT -i $pub_if -p tcp --sport 80 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p tcp -m multiport --sports 80,8080 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p tcp --dport 80 -j ACCEPT

#### DNS
iptables -A INPUT -i $pub_if -p udp --dport 53 -j ACCEPT
iptables -A OUTPUT -o $pub_if -p udp --sport 53 -j ACCEPT


#################################
sysctl -w net.ipv4.ip_forward=1 ##  FORWARDING
#################################

######### LOGGING_V4

iptables -N LOGGING_V4
iptables -A INPUT 	-j LOGGING_V4
iptables -A FORWARD	-j LOGGING_V4
iptables -A OUTPUT	-j LOGGING_V4
#iptables -A LOGGING_V4 -m limit --limit 25/minute -j LOG --log-prefix "IPTABLES LOGGED_V4 PACKETS:" --log-level 7
iptables -A LOGGING_V4	-j DROP

### CLEANING

ip6tables -F
ip6tables -X
ip6tables -t mangle -F
ip6tables -t mangle -X

### DEFAULT

ip6tables -P INPUT DROP
ip6tables -P FORWARD DROP
ip6tables -P OUTPUT DROP

ip6tables -A INPUT -i $pub_if -p tcp --sport 80 -j ACCEPT
ip6tables -A INPUT -i $pub_if -p tcp -m multiport --dports 80,8080 -j ACCEPT
ip6tables -A OUTPUT -o $pub_if -p tcp -m multiport --sports 80,8080 -j ACCEPT
ip6tables -A OUTPUT -o $pub_if -p tcp --dport 80 -j ACCEPT

ip6tables -A INPUT -i $pub_if -p tcp --sport 443 -j ACCEPT
ip6tables -A INPUT -i $pub_if -p tcp --dport 443 -j ACCEPT
ip6tables -A OUTPUT -o $pub_if -p tcp --sport 443 -j ACCEPT
ip6tables -A OUTPUT -o $pub_if -p tcp --dport 443 -j ACCEPT


ip6tables -A INPUT -i $pub_if -p tcp --dport 22 -j ACCEPT
ip6tables -A OUTPUT -o $pub_if -p tcp --sport 22 -j ACCEPT

service docker restart

#iptables -I DOCKER -i $pub_if ! -s 149.202.54.201 -j DROP
