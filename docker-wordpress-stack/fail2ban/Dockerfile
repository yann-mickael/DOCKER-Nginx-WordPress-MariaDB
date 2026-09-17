FROM python:3.9-slim

RUN apt-get update \
 && apt-get install -y --no-install-recommends fail2ban \
 && rm -rf /var/lib/apt/lists/*

COPY jail.local /etc/fail2ban/jail.local

CMD ["fail2ban-server", "-f", "-v", "-x", "start"]
