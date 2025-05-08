<?php
/**
 * Configuration de base pour WordPress
 *
 * Ce fichier est utilisé lors de la création du fichier wp-config.php.
 * Tu peux copier ce fichier en wp-config.php et remplir les valeurs ci-dessous.
 *
 * Il contient les réglages suivants :
 *
 * - Paramètres de la base de données
 * - Clés secrètes
 * - Préfixe des tables
 * - Chemin absolu
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Paramètres de la base de données - à obtenir auprès de ton hébergeur ou dans docker-compose.yml ** //
/** Nom de la base de données */
define( 'DB_NAME', 'wordpress' );

/** Nom d'utilisateur MySQL */
define( 'DB_USER', 'username' ); // Remplace "username" par le nom d'utilisateur approprié (par exemple, 'root' si nécessaire)

/** Mot de passe MySQL */
define( 'DB_PASSWORD', 'password' ); // Remplace "password" par le mot de passe approprié

/** Adresse de l’hôte MySQL */
define( 'DB_HOST', 'mariadb:3306' ); // Change 'mysql' en 'mariadb' si tu utilises MariaDB dans Docker

/** Jeu de caractères à utiliser par la base de données */
define( 'DB_CHARSET', 'utf8' );

/** Type de collation de la base de données. Ne pas modifier si tu n’es pas sûr. */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés et salages uniques pour l’authentification.
 *
 * Tu peux générer de nouvelles phrases uniques via ce service :
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * Modifier ces valeurs révoquera tous les cookies existants. Tous les utilisateurs devront se reconnecter.
 */
define( 'AUTH_KEY',         'mets ici ta phrase unique' );
define( 'SECURE_AUTH_KEY',  'mets ici ta phrase unique' );
define( 'LOGGED_IN_KEY',    'mets ici ta phrase unique' );
define( 'NONCE_KEY',        'mets ici ta phrase unique' );
define( 'AUTH_SALT',        'mets ici ta phrase unique' );
define( 'SECURE_AUTH_SALT', 'mets ici ta phrase unique' );
define( 'LOGGED_IN_SALT',   'mets ici ta phrase unique' );
define( 'NONCE_SALT',       'mets ici ta phrase unique' );

/**#@-*/

/**
 * Préfixe des tables WordPress.
 *
 * Tu peux avoir plusieurs installations de WordPress dans une même base de données si tu leur donnes des préfixes uniques.
 * Par exemple : 'wp_' (par défaut).
 */
$table_prefix  = 'wp_';

/**
 * Pour le débogage WordPress.
 *
 * Change cette valeur à TRUE pour activer le mode débogage dans WordPress.
 * Il est fortement conseillé de le laisser à FALSE lors de l'utilisation en production.
 */
define( 'WP_DEBUG', false );

/** Chemin absolu vers le répertoire WordPress. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Réglages des variables WordPress et inclusion des fichiers. */
require_once(ABSPATH . 'wp-settings.php');
