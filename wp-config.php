<?php

/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', "landingpage");

/** Database username */
define('DB_USER', "root");

/** Database password */
define('DB_PASSWORD', "");

/** Database hostname */
define('DB_HOST', "localhost");

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Vb:ij)ZlK&MsPV@RV|/+E}!&zJ 2xos>F,@m`j8-0eNZT!9k%r?WyHApQsYYAH]w');
define('SECURE_AUTH_KEY',  'd@ZIgQ=*a:2C;b,n-Tr=qHftVOR/9Ie4>#-|NXZn<*Sj$Anj9Wy&?B=/?tdthIAf');
define('LOGGED_IN_KEY',    'C.93-y;o@f:mlYAL;v<u{V7cu_QildQuwg.]U%)vFC,B?aFjb^>XX+i6?kyA!e g');
define('NONCE_KEY',        'B4*^,gGhuI$@=9^kr9$~!>u*!)Br|bO*^nYS`2M|^3LRE@uK_sb5hH+syF8A7ciT');
define('AUTH_SALT',        'U;0(oDms4|S:`{,`5%dN A,N=S`WKVd=jOBO! 5c`1[gMjVZ*=[]|l+IpNG!.]g0');
define('SECURE_AUTH_SALT', '0CQiiKExMV2{1xO4j%bb&cMf8`o;ijI~T79GR_G5#@j8ljs[tWBqa9hmI~w:`N^^');
define('LOGGED_IN_SALT',   '&3EF+R%@!xycr*e)bAbxs!!m(mr63v@E@5kww$~ntE,yY-7=&yg}<;dZ:#M`Pb8%');
define('NONCE_SALT',       'Tz&Q3JHV=XfB>IdgV${:A%F>,[tfZ/d~bPMjpCG+A!(%7 h4h$V:dYdcK5TlFw41');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'lpb_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
