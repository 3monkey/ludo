<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'ludo');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '7jM)~,k4lG[G8uGW(ymRG.bNg>qOb$MZ1&~frCE~j`B8$alsQ&LuU_ |Q0z~#ERG');
define('SECURE_AUTH_KEY', 'L2SZM} [RM1kIuw&WdM/ OWPq`~~It:3eTi_8W}4FdhD:$+Isstobw*67yt:l3Vn');
define('LOGGED_IN_KEY', 'bRm87kx4)^RdlE!+t!{F#,&.0@FmF}]fy| UZmlW7s.08uL:{MUQ_-JJ_-LY3Ea*');
define('NONCE_KEY', '[M(7m [UVmO#]vA!=,oDYE7Vn~khBziuI7)BYN;+CgfmQS]&3#@AQQ*j0FR9Lg^+');
define('AUTH_SALT', '7r<FXb!n~GqO2y*KN#]/$n0Y@@wDL(}A`sux2 DPTZJ2BK)[c;8.gN@?/i=bhT]u');
define('SECURE_AUTH_SALT', 'qC&ZoV5G4jwLiG}F),GtaoP?Czt<n)Du(3V:AVwA>lTS_Qy@):CBp=;5I&:A]`@X');
define('LOGGED_IN_SALT', '=,_jQN&BV*3yAX_`}U#b|DnPR-Pq=bnY5kMdjo+q/|JG0rAf0F5#3=lwAOC9iDgV');
define('NONCE_SALT', 'x/T$u$sPah2qNy1B30-#zd%)Txgn3f9;VT3M(wI0c(3:#{[/>1KZBj:S$zXh&oAr');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

