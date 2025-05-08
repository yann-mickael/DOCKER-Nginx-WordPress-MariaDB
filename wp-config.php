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
define( 'DB_USER', 'username' );

/** Mot de passe MySQL */
define( 'DB_PASSWORD', 'password' ); // Remplacer "password" par le mot de passe approprié

/** Adresse de l’hôte MySQL */
define( 'DB_HOST', 'mariadb:3306' ); // Changer 'mysql' en 'mariadb' -  MariaDB dans Docker

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

define( 'AUTH_KEY',            '' );
define( 'SECURE_AUTH_KEY',     '' );
define( 'LOGGED_IN_KEY',       '' );
define( 'NONCE_KEY',           '' );
define( 'AUTH_SALT',           '' );
define( 'SECURE_AUTH_SALT',    '' );
define( 'LOGGED_IN_SALT',      '' );
define( 'NONCE_SALT',          '' );


/**#@-*/

/**
 * Préfixe des tables WordPress..
 * Par exemple : 'wp_' (par défaut).
 */
$table_prefix  = 'wp_';

/**
 * Pour le débogage WordPress.
 *
 * Change cette valeur à TRUE pour activer le mode débogage dans WordPress.
 * Conseillé de le laisser à FALSE lors de l'utilisation en production.
 */
define( 'WP_DEBUG', false );

/** Chemin absolu vers le répertoire WordPress. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Réglages des variables WordPress et inclusion des fichiers. */
require_once(ABSPATH . 'wp-settings.php');
