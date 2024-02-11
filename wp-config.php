<?php




//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni MySQL
 * * Chiavi Segrete
 * * Prefisso Tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //

define('FS_METHOD', 'direct');
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', true );
define( 'FTP_USER', 'sergio' );
define( 'FTP_PASS', 'mercatello' );
define( 'FTP_HOST', 'sersebasti.ddns.net' );
define( 'FTP_SSL', true );



/** Il nome del database di WordPress */
define( 'DB_NAME', "wp" );

/** Nome utente del database MySQL */
define( 'DB_USER', "root" );

/** Password del database MySQL */
define( 'DB_PASSWORD', "somewordpress" );

/** Hostname MySQL  */
define( 'DB_HOST', "192.168.16.3" );

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di Collazione del Database. Da non modificare se non si ha idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ciò forzerà tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'o:AC!]>SfUB~d([|*Ah&XW{DZov)%AQ4o+k]0k2lNJ&U5H+8.6wH[z9UVg2[FF)H' );
define( 'SECURE_AUTH_KEY',  'iZEayWT?,ww69pI,go~q2 `AJy%*1NS;0aP-XcuGd2.53{If1#A^:SlHos_ftQ=e' );
define( 'LOGGED_IN_KEY',    '$ck(|?9Ttw9TKDvKnD?rZqBnb,vfL)zkw1vzSiz@_f!,n;[Z:]#@%/#Ox3[]3t-A' );
define( 'NONCE_KEY',        'm~Zr7Gsf*<+gw{0$<uw/6>b@%cB X>py];P>aZ.ntf>kj6n!qJ8,_.)|Ko$0!nK~' );
define( 'AUTH_SALT',        'ZGkb[hy4jmEQXkH01%RnK^MIu[gYz(0mS7NTe|&uCXP^i!jWt-dZ$(`e4htB:a-v' );
define( 'SECURE_AUTH_SALT', 'O]CiiHnRr&5:Fdb}J,l/hqKuL:LES:tpuL0E>Yf?hWJ_p_|>a{8<DlbSjiuUm7Qx' );
define( 'LOGGED_IN_SALT',   '{!_s. B}ls;sRuF|69UGb#hTf[3KU<m=it,SsVCeCucM ,zF)[{[;UJ[4T~6j[OS' );
define( 'NONCE_SALT',       'UZ--VYdH%NFUn|Y4$|/tg:VRw+oN[f?jZP0d6i;/B9_AMVSzz~)0%bY>wXl}[sTC' );

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta le variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');
