<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_wwwhagertydigitaltest_db' );

/** Database username */
define( 'DB_USER', 'wp_wwwhagertydigitaltest_user' );

/** Database password */
define( 'DB_PASSWORD', 'wp_wwwhagertydigitaltest_pw' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'z@B=%N0#%J8yCc8B7JoF2F+kGj*~Di3VXa^h(hT9G=^r!8BG<@T_i %J;#x(^_dN' );
define( 'SECURE_AUTH_KEY',   'Q{gDjbL aaZr ;VjvA0z{vLj:@Fxem}^?XO4H=_GYp*Yqt<(Zo(5;=Ij370pfj&S' );
define( 'LOGGED_IN_KEY',     '- g8U8jfN6[PEC{<S_nJ+Y_OuNF=~.$2DOJ5CE:a-/}/Tw`b3-c&u/,,].=G}hvm' );
define( 'NONCE_KEY',         '=8Wf](#wKveu7[hHFw]XgL_[y?yIQLXy,Aw_Q D-2T-p75*_m20ndCw~Ur4E4Q?*' );
define( 'AUTH_SALT',         'QKZXd-noQ^Dih.)`/lqfJLuwhd6y,4~S1V8J0no?Raq)6]5e Vab/b5(MBQW4]p|' );
define( 'SECURE_AUTH_SALT',  '+x}<oCntrRwMz1 (nIFsOkr.f|co4{oLnFx{JVkdlb %R xSaylFBb@?4v8=+%it' );
define( 'LOGGED_IN_SALT',    '6sPsmgDRce>L2{.J0Yp`HdosSUWn^sw?C@BxCm^{ j&H,lxX:E+D9oc9>4F+[@{;' );
define( 'NONCE_SALT',        'G!&L73rICvCaj7C5XCt!-B/h*c?S,JZa4e2,Tehpm+sCq}%1B>1hi0?wyHFn-9O=' );
define( 'WP_CACHE_KEY_SALT', 'anaIs-)(8|ji]g?km$B1xgU;4:Gf#gB;SD8 @e4fg^ [}]W,7W}:1gw0$pw{9:r=' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
