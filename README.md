# DOCKER Nginx - WordPress MariaDb


✅  Objectif :
```bash
Utiliser les images officielles : nginx, mariadb, php (via php:fpm).
Télécharger la dernière version de WordPress.
Mettre en place un volume partagé pour /var/www/html entre NGINX, PHP et WordPress.
Configuration manuelle du serveur.
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
projet-docker/
│
├── docker-compose.yml
├── nginx/
│   └── nginx.conf
├── mariadb/
│   └── data/
├── phpmyadmin/
└── wordpress/
```


📄Docker-compose.yml
```
version: '3.8'

services:
  nginx:
    image: nginx:latest
    ports:
      - "80:80"
    volumes:
      - ./nginx/nginx.conf:/etc/nginx/nginx.conf
    depends_on:
      - wordpress
      - phpmyadmin

  mariadb:
    image: mariadb:latest
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_DATABASE: ${DB_NAME}
      MYSQL_USER: ${DB_USER}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    volumes:
      - ./mariadb/data:/var/lib/mysql
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      interval: 10s
      timeout: 5s
      retries: 5

  wordpress:
    image: wordpress:latest
    ports:
      - "9000:80"
    environment:
      WORDPRESS_DB_HOST: mariadb
      WORDPRESS_DB_USER: ${DB_USER}
      WORDPRESS_DB_PASSWORD: ${DB_PASSWORD}
      WORDPRESS_DB_NAME: ${DB_NAME}
    volumes:
      - ./wordpress:/var/www/html
    depends_on:
      mariadb:
        condition: service_healthy

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - "8080:80"
    environment:
      PMA_HOST: mariadb
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
    depends_on:
      mariadb:
        condition: service_healthy

```

📄 nginx/default.conf
```

events {
    worker_connections 1024;
}

http {
    server {
        listen 80;
        server_name localhost;

        location / {
            proxy_pass http://wordpress:80;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
        }

        location /phpmyadmin {
            proxy_pass http://phpmyadmin:80;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
        }
    }
}

```
📎 [Fichiers sur Drive](https://drive.google.com/drive/folders/1tUA7FBDm_EbGoeDOvavVqVDkVb-SsP-O?usp=drive_link)
![Image](https://github.com/user-attachments/assets/2bd41256-00e8-4afe-aa94-b5be091934aa)
![Image](https://github.com/user-attachments/assets/fa352e3e-d077-48c5-bff3-3fc2f0ba14ca)


