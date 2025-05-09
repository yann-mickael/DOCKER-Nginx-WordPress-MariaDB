FROM nginx:latest

# Supprime les fichiers de configuration par défaut
RUN rm /etc/nginx/conf.d/default.conf; exit 0

# Copier nos fichiers de configuration personnalisés dans le conteneur Nginx
COPY conf/nginx.conf /etc/nginx
COPY conf/conf.d /etc/nginx/conf.d
