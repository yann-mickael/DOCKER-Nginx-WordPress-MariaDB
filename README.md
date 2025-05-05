# DOCKER-COMPOSE_PLATEFORME
Exercice  
```bash
✅ Objectif :
Utiliser les images officielles : nginx, mariadb, php (via php:fpm).

Télécharger la dernière version de WordPress.

Mettre en place un volume partagé pour /var/www/html entre NGINX, PHP et WordPress.

Configuration manuelle du serveur (pas d'image wordpress clé-en-main).

🧩 Arborescence recommandée :
arduino
Copier
Modifier
project-root/
├── docker-compose.yml
├── nginx/
│   └── default.conf
├── html/            ← (le volume commun WordPress + config PHP)
📄 docker-compose.yml
yaml
Copier
Modifier
version: '3.8'

services:
  db:
    image: mariadb:latest
    container_name: mariadb
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: rootpass
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wpuser
      MYSQL_PASSWORD: wppass
    volumes:
      - db_data:/var/lib/mysql

  php:
    image: php:8.2-fpm
    container_name: php-fpm
    restart: always
    volumes:
      - ./html:/var/www/html
    depends_on:
      - db

  nginx:
    image: nginx:latest
    container_name: nginx
    restart: always
    ports:
      - "80:80"
    volumes:
      - ./html:/var/www/html
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - php

  wordpress-setup:
    image: wordpress:cli
    container_name: wp-cli
    depends_on:
      - db
    volumes:
      - ./html:/var/www/html
    entrypoint: >
      sh -c "
        if [ ! -f /var/www/html/wp-config.php ]; then
          wp core download --path=/var/www/html --allow-root &&
          wp config create --path=/var/www/html --dbname=wordpress --dbuser=wpuser --dbpass=wppass --dbhost=db --allow-root &&
          wp core install --url=localhost --title='Mon Site' --admin_user=admin --admin_password=admin --admin_email=test@example.com --allow-root
        fi
      "
    restart: "no"

volumes:
  db_data:
📄 nginx/default.conf (fichier indispensable)
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
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
🛠️ Instructions
Créer l’arborescence décrite plus haut.

Lancer :

bash
Copier
Modifier
docker-compose up --build
Attendre l’installation automatique de WordPress (par wp-cli).

Accéder au site : http://localhost

Souhaitez-vous que je vous fournisse un .zip prêt à l’emploi avec tous les fichiers ?







Vous avez dit :
fait moi un fichier readme.me


ChatGPT a dit :
Voici un fichier README.md que tu peux placer à la racine de ton projet Docker WordPress. Il décrit clairement le but du projet, les prérequis, l'installation, et l'utilisation :

📄 README.md
markdown
Copier
Modifier
# 🐳 Environnement WordPress avec Docker (NGINX + PHP-FPM + MariaDB)

Ce projet permet de lancer un site WordPress en local à l’aide de **Docker Compose** avec les images officielles de **NGINX**, **PHP-FPM**, **MariaDB** et **WP-CLI**.  
La dernière version de WordPress est installée automatiquement au démarrage grâce à un conteneur `wp-cli`.

---

## 📁 Structure du projet

project-root/
├── docker-compose.yml # Fichier principal Docker Compose
├── nginx/
│ └── default.conf # Configuration NGINX
├── html/ # Volume partagé : WordPress + fichiers PHP
├── README.md

yaml
Copier
Modifier

---

## ⚙️ Prérequis

- [Docker](https://www.docker.com/) installé
- [Docker Compose](https://docs.docker.com/compose/) installé

---

## 🚀 Installation



```bash
docker-compose up --build
Le site WordPress sera accessible à l’adresse suivante :
👉 http://localhost

🧠 Détails techniques
MariaDB gère la base de données wordpress avec l’utilisateur wpuser.

PHP-FPM (via php:8.2-fpm) exécute les scripts PHP dans /var/www/html.

NGINX sert les pages Web et interagit avec PHP-FPM.

WP-CLI télécharge et installe WordPress automatiquement si besoin.

🔒 Identifiants WordPress (par défaut)
Utilisateur : admin

Mot de passe : admin

Email : test@example.com

Tu peux modifier ces valeurs dans la section wordpress-setup du docker-compose.yml.

🧹 Nettoyage
Pour arrêter et supprimer les conteneurs :

'''
Copier
Modifier
docker-compose down
Pour tout supprimer (y compris la base de données) :
'''
bash
Copier
Modifier
docker-compose down -v
📦 Volumes
./html : partagé entre NGINX, PHP-FPM et WP-CLI.

db_data : volume Docker persistant pour MariaDB.

📝 Remarques
La configuration NGINX est dans nginx/default.conf.

WordPress est installé dans html/, ce dossier doit être conservé (ou versionné si besoin).
