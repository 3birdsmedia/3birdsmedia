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
define('DB_NAME', 'cjt_db');

/** MySQL database username */
define('DB_USER', 'cjtAdmin');

/** MySQL database password */
define('DB_PASSWORD', 'Asdf7777');

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
define('AUTH_KEY',         '}Gg*7yd4M5*=R{*HjEDS^Y-.J$^*su+)4u:,#WNO*U</Og^3WfVNTvnx(OB%nF+$');
define('SECURE_AUTH_KEY',  'XixE@TGBGG;|nX*<2}jp!98XO9i^9`3_B^V#KXvD>C}V9H;^bEb(p/#R7owWFh,s');
define('LOGGED_IN_KEY',    '&MXkmL1o3#Cs-E[u5y2@6^zwj?nwRs=0l6#A~BeG*^]!$#4~M[iw# ?FQOA2dr3u');
define('NONCE_KEY',        'g[cn<kCK@yc;gN_?hHR>2c=v;;73@c^EWw[ZPVT3v+*h>A~^aA?(C/pShS>3Q+&e');
define('AUTH_SALT',        '~@K}^m_}# Z;?rd9{n8;bJ)oG{-t2n>U0OXc7_37aW5=M/uvG_Jx0zBWD?fIy<dy');
define('SECURE_AUTH_SALT', 'lcY;Wik?;EK0Tzle*G4L>hzqq|Pqh$/2;tEh4rl{8*K3N>_:B+ZcHU6U^CZYUx5Z');
define('LOGGED_IN_SALT',   '2p{fav26X;>Y4<CX*~XiRrwlD=O-!W?J3(3vKHL2^_Ww^z9P=tNcXU8`dWnoj7~j');
define('NONCE_SALT',       'al@yCz-KLZgtBl>$(]:73NuHE226 >aPS?_<A[H}PJlt0ndX#ZEWC9mSFxjW&YwA');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
