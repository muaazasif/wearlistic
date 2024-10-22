<?php
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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '|W{w^%9]FxEa|Iz`$F?y;kg>I0EH@+lL^3SM{j3faJYi)h{habr(G~F[3udo&$ON' );
define( 'SECURE_AUTH_KEY',  'gVhn =]8TK6/H/<7`:AlrIa~pZcM5U6jaBIO3 h!:Iivv|ySh$qf;Q;L_[nFn@8^' );
define( 'LOGGED_IN_KEY',    'KQMO?eUBGi=3YiFI&9nn9e%i]o^vrTf9!L~T+e2UU5_.Qz(W:%Xco!m4[8%=2!HG' );
define( 'NONCE_KEY',        'As5$Cq4dI!ODE{!8H{UEP^VVd(Zc2s`TYmosW9A_sn7H~tv<{eF`Q_X|]m/<aTA/' );
define( 'AUTH_SALT',        '8pV<,2)H==>NYCa@g13<W>tFT|S}TEW]IUCRqGntF+uxubgYweS ft=.{X/[ltR|' );
define( 'SECURE_AUTH_SALT', '!4K9#U:bt4^a(,:4^K.!5my:`&RGo(<#1-v)29uuZHn6dQk.S#j+BM@ISfN@0H{V' );
define( 'LOGGED_IN_SALT',   'n[oFt,GuloOib32w ]`JS.iq(d]ME#RQfv_z(8Kz#%Q)YVP&~rW-3mvuf~6a<|jo' );
define( 'NONCE_SALT',       '&c:vJks)H=/i 2hnAg{+CcgC4^f@FAg sTt,bcp87|dUW0?@hxLrcL7utAkbQ2OY' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
