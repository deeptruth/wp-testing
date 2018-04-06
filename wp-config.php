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
define('DB_NAME', 'wp-testing');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'NWP@ssw0rd');

/** MySQL hostname */
define('DB_HOST', '172.17.42.1');

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
define('AUTH_KEY',         'TS5dwZEmdH1,6+-)^cDhQ}L4_orcAFS>N`$zW.u2N!Uu03k?FxR/<,rU>cm6qt?_');
define('SECURE_AUTH_KEY',  '_5p8B/|Aya8qa9PnMs_i(ma)a!k~J~YBNFtV$h6>:{<)ds;s5&tj__k2bj,SPgXB');
define('LOGGED_IN_KEY',    'AjgzyN*u9h*|nSN90Gc4Jskih,/C>)M6r9$GqYivo!IM);d]B!JU>tw {,hduV?r');
define('NONCE_KEY',        'C[=PSeHNVjq:Hm/gZx8% Q&VJ3vJlzv<9Be{z*UN~_5U|:H:47#p]p/|7Jx1J},Q');
define('AUTH_SALT',        'p&fgEO){{+EXRC`N{L>+I49yLS3e8X*-9d@-Txag!h2K1H/wa8Fp=;uOwGLr*ZU1');
define('SECURE_AUTH_SALT', ',3@u-H^1Ncp8RVmux_JoBdYEzfE*9+^59&2/.xHaD[!y3YCfO6|6t]~lM0/XKH?q');
define('LOGGED_IN_SALT',   'vKA{~~NNx}zj sfGd4UCk0/,V,sW{nQf_#5w8_H!uJQ`rsp7 o7RcKhS{m1}]Xqv');
define('NONCE_SALT',       'IV?oQgmVp>& c|SO_~=.KxM2HSk6B$1*.%c>*arsEE~eOLz7@Sl6e8A-4Qvv>Cde');

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
