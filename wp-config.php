<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
//Begin Really Simple SSL Load balancing fix
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/html/ykaki.or.id/wp-content/plugins/wp-super-cache/' );
if ((isset($_ENV["HTTPS"]) && ("on" == $_ENV["HTTPS"]))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "1") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "on") !== false))
|| (isset($_SERVER["HTTP_CF_VISITOR"]) && (strpos($_SERVER["HTTP_CF_VISITOR"], "https") !== false))
|| (isset($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_X_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_PROTO"]) && (strpos($_SERVER["HTTP_X_PROTO"], "SSL") !== false))
) {
$_SERVER["HTTPS"] = "on";
}
//END Really Simple SSL
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
define('DB_NAME', 'db_ykakiorid');
/** MySQL database username */
define('DB_USER', 'u_ykakiorid');
/** MySQL database password */
define('DB_PASSWORD', 'zyPQYhBQtzn3');
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ';cb6h(tt-v/I~=U}lK(E![OnteM?buS%H@,6;fM1]NDt0]QfLH?w.#:d<k,<n=`2' );
define( 'SECURE_AUTH_KEY',   'qKoR9L1fzR`kiNO;6f9h9T0_ejluX2msqjpAz/`[&#upHiJgDS[s@+{DR[MFfV!j' );
define( 'LOGGED_IN_KEY',     'T+:A*%![@WN{#g8.P+4Tu77R!<LqqO:Mtq<5(V^[%o4A.S66,OC@~KI>o}[)s%H6' );
define( 'NONCE_KEY',         'WjEd-ZSgG{.WzTn!Xme 6+Rg|@n>NM?0,!Pa~C-,^1M*^GGLHJyjIjq3P@.82,i;' );
define( 'AUTH_SALT',         ' {?qf!7>RAPM~V7u}8?)!ofsX)8v*8N}@3ukiZ|Z!Q01+%&^ehxV22p)Wnv?$&]=' );
define( 'SECURE_AUTH_SALT',  '=2-qTLQa=eq[K)-xcQ.IK!M1i%fr$!Np=mK0lo<mZLDpBmt%0=C,S2je-}RV7n;@' );
define( 'LOGGED_IN_SALT',    '5`+ENY(OW@k~48,e*hn#(#+,Ciq*b?Ne[ys6B-J JP<`0BGh2tom2*w*}{K{[W:B' );
define( 'NONCE_SALT',        'PkuqiGxJ*pF[G(H;S$g<LZb(<3G 7).&%Y,+ZvxZh*zTu <%R)KB+{fr9}Cq2p}a' );
define( 'WP_CACHE_KEY_SALT', ')C/t19W*P=cxw[]9.jK6L{t^i{pIYi;BQ< ?1Oodk-Ab/G5LMLFn[kyul2ucQLKF' );
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';