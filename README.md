# DOCKER-COMPOSE_PLATEFORME


✅  Objectif :
```bash
#### Utiliser les images officielles : nginx, mariadb, php (via php:fpm).
#### Télécharger la dernière version de WordPress.
#### Mettre en place un volume partagé pour /var/www/html entre NGINX, PHP et WordPress.
#### Configuration manuelle du serveur (pas d'image wordpress clé-en-main).
```
🧩 Arborescence recommandée :
📁 Structure du projet
```
/Projet Docker 
│
├── docker-compose.yml
├── .env
│
├── nginx
│   ├── Dockerfile
│   ├── nginx.conf
│   └── conf.d
│       └── default.conf
│
├── certbot
│   ├── webroot
│   └── letsencrypt
│
├── fail2ban
│   ├── Dockerfile
│   └── jail.local
│
└── data
    ├── mariadb
    └── wordpress
```


📄Docker-compose.yml
```
services:
  mariadb:
    image: mariadb:10.5  # Image de la base de données MariaDB
    container_name: mariadb
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: wordpress
      MYSQL_USER: username
      MYSQL_PASSWORD: password
    volumes:
      - db_data:/var/lib/mysql  # persistance des données

  php:
    build: ./php                        # Dockerfile dans le dossier ./php
    container_name: php
    restart: always
    volumes:
      - ./www:/var/www/html             # ton WordPress est monté ici
    depends_on:
      - mariadb                         # dépend de MariaDB

  nginx:
    image: nginx:latest
    container_name: nginx
    ports:
      - "80:80"                       # exposer sur http://localhost:8000
    volumes:
      - ./www:/var/www/html             # même dossier WordPress
      - ./nginx/nginx.conf:/etc/nginx/nginx.conf  # chemin modifié vers nginx.conf
    depends_on:
      - php                             # dépend de php

  phpmyadmin:
    image: phpmyadmin
    container_name: phpmyadmin
    restart: always
    ports:
      - "8080:80"                       # accessible sur http://localhost:8080
    environment:
      PMA_HOST: mariadb                # phpMyAdmin pointe sur le conteneur mariadb
      PMA_PORT: 3306

volumes:
  db_data:                              # volume pour la base de données
```

📄 nginx/default.conf (fichier indispensable)
```
nginx
Copier
Modifier
server {
    listen 80;
    server_name localhost;
    root /var/www/html;

    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        fastcgi_par
```




