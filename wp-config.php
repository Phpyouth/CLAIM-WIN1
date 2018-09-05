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
define('DB_NAME', 'dpws_claimwin');

/** MySQL database username */
define('DB_USER', 'dpws_claimuser');

/** MySQL database password */
define('DB_PASSWORD', 'claimwin@123');

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
define('AUTH_KEY',         '-SY|}zenn24&fgNWI6,8RaBg~9YHjSb%)L#T2/^J j%O;*q^&6Y:,d}mEky$[fAW');
define('SECURE_AUTH_KEY',  '!%@^3o+E(R7kfw4Sxc/^z{@uGUo(LZ{{d#vaM( } Max7(QQ1+`2aMmDCbRLFFQD');
define('LOGGED_IN_KEY',    'kD3[Lt*Uqc=.2Ms_i`0oVvvUdI@})1XJaCeEaLWQcChM!7w?-)dPU(*&Far1_nIm');
define('NONCE_KEY',        'RmsB1!1z|7l]Z2<iYPs(}4n0.q`*.nIT<GZvL{~+/HT(.b`P]PsWtyxO98Yno_2E');
define('AUTH_SALT',        '8<mdaS=/<SQn+!kf%>W2yN4@LpAc?sf.;EssX(*cek1/G ?8x8K z(OyB0#}esd{');
define('SECURE_AUTH_SALT', '>:9; zP&k<Ql*lNy2:X!3FrqfC91J*.,dX&TbCw(%d9%JF!A})fSxxX+H%}fLW;p');
define('LOGGED_IN_SALT',   'HJt:zVn,ftVmq*pM{v`<Q~72,IYRWr*yF$UthA@#MaQ1VV;ft3GW$`1LNCN?gAvQ');
define('NONCE_SALT',       'D8?0:k&^kcuZW[Xt9A@[>V<I+W=|YY~nw4I|tPhRMmD=L!F5]2?iH%Lxb5Y)%w]|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = '_cu_';

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
