#!/usr/bin/env bash

####### HARD RESET IPV4

# RESET DEFAULT POLICIES
iptables -P INPUT ACCEPT
iptables -P FORWARD ACCEPT
iptables -P OUTPUT ACCEPT
iptables -t nat -P PREROUTING ACCEPT
iptables -t nat -P POSTROUTING ACCEPT
iptables -t nat -P OUTPUT ACCEPT
iptables -t mangle -P PREROUTING ACCEPT
iptables -t mangle -P OUTPUT ACCEPT
# FLUSH ALL RULES, ERASE NON-DEFAULT CHAINS

iptables -F
iptables -X
iptables -t nat -F
iptables -t nat -X
iptables -t mangle -F

####### HARD RESET IPV6

# RESET DEFAULT POLICIES
ip6tables -P INPUT ACCEPT
ip6tables -P FORWARD ACCEPT
ip6tables -P OUTPUT ACCEPT
#ip6tables -t nat -P PREROUTING ACCEPT	###NOT SUPPORTED
#ip6tables -t nat -P POSTROUTING ACCEPT ###NOT SUPPORTED
#ip6tables -t nat -P OUTPUT ACCEPT	###NOT SUPPORTED
ip6tables -t mangle -P PREROUTING ACCEPT
ip6tables -t mangle -P OUTPUT ACCEPT
# FLUSH ALL RULES, ERASE NON-DEFAULT CHAINS

ip6tables -F
ip6tables -X
#ip6tables -t nat -F		##NOT SUPPORTED
#ip6tables -t nat -X		##NOT SUPPORTED
ip6tables -t mangle -F
