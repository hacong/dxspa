<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tecbab2a_newdata');

/** MySQL database username */
define('DB_USER', 'tecbab2a_datausr');

/** MySQL database password */
define('DB_PASSWORD', 'XfHM@3fxa5A)');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6UAQTya.;X=#X60@OSZ9NO&Cd;TY`(C06b3~UG7@edCtFD`BP+#>():qd} #lb|z');
define('SECURE_AUTH_KEY',  'm!ASZ7!u26G|3x12Y?oOIb_+)CF!dW6wh~JGV=<S37A9xBMM@].%D(|It4,;#wy*');
define('LOGGED_IN_KEY',    'G6@9<@!hhj7q PTWV~Qrc1L2#v6oyD*U]i7r 4Ry|F^<T$~(s^F{I<gm3~p[a%Pg');
define('NONCE_KEY',        '-R6=(=:zo|SpG@^3!<L)9X!v1P^h4MwAhEs72/KwD~Nx=U79F>O`huEZkd`Jip.p');
define('AUTH_SALT',        'vq.N EHcO|,-`iRp_1>P-3qqOUrI?UrxLft 7oHd<Ec`)#%.!pFtd%ibm ?a3<^p');
define('SECURE_AUTH_SALT', '?`zovs}-ytMCN`[soU`AP2N)K2W;sSH7`#2Lh u~DW!o&>-yxPL~t/Oh8@iU@?r`');
define('LOGGED_IN_SALT',   'tOy/DiJnQTkwUsmI>Ir84-EI!-!UJ4FTj|CmsRv]tsSXY;8QR<1BFBvbHv*AQrl)');
define('NONCE_SALT',       '_]Q>jTJ,U-Mo*qmviCJX+kir-g*D YwoeiAK%0P,:jj,H1o[r]5NU+Fap=U$)lD]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
