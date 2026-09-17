ARG NGINX_VERSION=latest
FROM nginx:${NGINX_VERSION}

# Supprime la conf par défaut
RUN rm -f /etc/nginx/conf.d/default.conf

# Copie la conf principale
COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d/default.conf /etc/nginx/conf.d/default.conf
