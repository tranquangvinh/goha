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
define('DB_NAME', 'goha');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'K$Dq%V-Sz]V_0[-XrPz^b%x,F:ZxIZ}KO:;XLgWFY^T7^({x#_dY1[Zab]hKq5V%');
define('SECURE_AUTH_KEY',  'jCV?A>x780i2fpliJGnAZG*6Q}KxISjWYWZ{f_$GTp}~4f0}y]9xlhn|l&y i4(w');
define('LOGGED_IN_KEY',    '4S:Jd6gtu)$LGio iLzL]dZz|;VT$?O(m2+h&C$p%VM%;kRbf[Cb(MVN_yIUwF!I');
define('NONCE_KEY',        '@z6D;5nMg`VWe5?uH;EkhAOc)CaHbG;{rAI{i`,~dBjq7tF.WYp!g841o;O.L[^j');
define('AUTH_SALT',        '~_4_/mYK_UoWN1 t[r&hGNqhR7N(w{*>!/aZ^Ob@m- X2X[;.>px1HFS8VU0W=g~');
define('SECURE_AUTH_SALT', 'rP+E?9Oc.pSiJon)PP1Mzo61./R^-)(]Og^`t%if#JoH+!zY|$SQDrkQ:3wSgB5R');
define('LOGGED_IN_SALT',   '=ApL/nqMR=C$f0eI$T0V3L?LF;iAgzE[B:x;A3P,A~Ii(5OK!tNdjWBJ><JQjD3^');
define('NONCE_SALT',       '9]@AUhIK1M.O-mJU2~gf<G0b;-U$]`:$W.[*3{x7PiomX33AB$O^k;A<Y(ck`ZL-');

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
