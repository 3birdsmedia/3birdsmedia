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

define('DB_NAME', 'arrow_blog');



/** MySQL database username */

define('DB_USER', 'arrow_blog');



/** MySQL database password */

define('DB_PASSWORD', 'Q&^u(4VccaK9O0G~#p&42&*8');



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

define('AUTH_KEY',         'rKbsmjsNSDavkcVoJ3sbOXeZKpF3M8KTViT4x3pLjzOvXIw7Oxa56Z0QViuf2NCM');

define('SECURE_AUTH_KEY',  'NESvWclLuwzMfzZvMXth114GgKIZQM5FPDKoD2mQTx5vERT0bCEtiJlcku68cHka');

define('LOGGED_IN_KEY',    '4vvTlOTgmyOLl4vS0CRKGXxtkApGKv9g1Sqyl8C2jYFwMO2wgqGX8xSNFKXbO54Z');

define('NONCE_KEY',        '5sxcR0oMT8ppa5WE4h2tW8HK4L9EDS2nx4A8UcocBXrG1OqKiijok6TVVr6y5KR0');

define('AUTH_SALT',        'sGxZBD4KsgfUmT2lTxYeb6tXusmUvgKjGsRXemTOShn1RZh2Gx14UPN9p7rAIsXM');

define('SECURE_AUTH_SALT', 'kALNFVfsMR02sqG3Xp32ujMrX8aEuEhdhoVlKmwABmodKJUlHFIS4TtyPiEXmxme');

define('LOGGED_IN_SALT',   '0UhIR7TpbJCNZZAPNV7r7drQAu8VF3BYZdUHD1ZVXAzCqIpeUGUJAICCbIC0uztk');

define('NONCE_SALT',       'JIFz9iLLGBS1QpyAbAx0qjFagSxiQ586gNsH2qw50L26cWiKjd10NqqXzlfyXvSE');



/**

 * Other customizations.

 */

define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');



/**

 * Turn off automatic updates since these are managed upstream.

 */

define('AUTOMATIC_UPDATER_DISABLED', true);





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

