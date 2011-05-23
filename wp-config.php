<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jmobilew');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'hA9[$CXMS(`>f%XckXLkRY%>.(|lL1mj3Hr.lPFy:tEG;:gm}DZL|2u: BR,B1Q%');
define('SECURE_AUTH_KEY',  'm]N~61/JX|0OLkLvrvK{Mv32Z2qeM^OAL9/cw39u276&fcn*40&Nib(-(FIMKi f');
define('LOGGED_IN_KEY',    'c~4hM+xqnps26[M_G2lM~9bCI!C.epX[NR!sWU}8?2<%ch)e1z#O=y14VY|Q%K,m');
define('NONCE_KEY',        'PU9D.Y,mVYru48:$hvh!2HaPPWGD3(SB_Lu9[TpF$|B9q/<(a~<F.cH33JH@9s<Y');
define('AUTH_SALT',        '4vlVi9h<ziFo ~6Qfh*8Kr U1nIoYfiVt8J#CygIOBCQrKionlh(j/~{r*rT`wmQ');
define('SECURE_AUTH_SALT', ']cHfU9aL<0$&=U8t{51G;P8a9aL3Ya.Jt*Cuc&x?SD7W3ET%f))[z|g=O5%0*Ez:');
define('LOGGED_IN_SALT',   'yjZK{e:.`_Ny[ouOs558qams-v<~j#dKwI)o[dJxyi$|Q X]4Y-_&~S|*(R$%kSb');
define('NONCE_SALT',       'J$<3uE,W+k; TEm&eRbA83&*:dYJ(:}E7vbb03O(l4D}k4j`0d7?-LJq3AP*!pA#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
