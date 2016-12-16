<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Le script de création wp-config.php utilise ce fichier lors de l'installation.
 * Vous n'avez pas à utiliser l'interface web, vous pouvez directement
 * renommer ce fichier en "wp-config.php" et remplir les variables à la main.
 * 
 * Ce fichier contient les configurations suivantes :
 * 
 * * réglages MySQL ;
 * * clefs secrètes ;
 * * préfixe de tables de la base de données ;
 * * ABSPATH.
 * 
 * @link https://codex.wordpress.org/Editing_wp-config.php 
 * 
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'db602082302');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'dbo602082302');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '/*-Observatoire-Immateriel-2016-*/');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'db602082302.db.1and1.com');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_B.V+FXJ$TBQSMY+Q6/+2KkNP)pn1)OqB1{)2(][2|nTV1[b+D@{[p3o6&DOcCD ');
define('SECURE_AUTH_KEY',  ',nMcOH|]M3;<T,P0K7mtu&V$=0s|v]dmMye<W8>2BS!O+}J,V/g[p9&}(O+6|>j ');
define('LOGGED_IN_KEY',    'V[%2SB_qN-D?BHWzrW}p/Gw~%7{}^thGW+FU|$%_>>U67Xge.amxCm{j;?1u=%I)');
define('NONCE_KEY',        'BCp5&~2[|zwW^rsyh_Y$@Fb!A_mB6|6d^NLj=k2X:qK@rG;P-Y+wq_=RE+|7c~Fd');
define('AUTH_SALT',        ';DF{MA)oOe9L9etv~[(^GD#Zdn`D%C53Wu<-0?;<hnyP-d++P%yO6m54T 9sks<A');
define('SECURE_AUTH_SALT', ')j;FaM{deN+J|tR#3^|;4IPXU.ocBM8dw|PvKt7L-$P!-zGhSA#o[60I%7#F@KDI');
define('LOGGED_IN_SALT',   ' ZlKSLah+qM&1:P2<Dh/^|g|mW/Rm|Yy&?vF1cnbn?EGvp@K1mjm3Y>UR)8{Xn!s');
define('NONCE_SALT',       'Ty9/Qxz[sLm/yt0U_OukJU2+$KM{hz-}IWIG+MI|rS/<&m*Kr-|f|o AQoC=6au.');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode déboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 * 
 * Pour obtenir plus d'information sur les constantes 
 * qui peuvent être utilisée pour le déboguage, consultez le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */ 
define('WP_DEBUG', false); 

define('WP_LANG', 'fr_FR'); 

define('DISABLE_CACHE', true);

define('WP_HOME','http://observatoire-immateriel.com/');
define('WP_SITEURL','http://observatoire-immateriel.com/');


/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

