<?php
/**
 * Standalone preview generator.
 *
 * Stubs the handful of WordPress functions the templates use, then renders
 * header.php + front-page.php + footer.php to a single static HTML file with
 * the theme CSS and JS inlined. This keeps preview/index.html exactly in sync
 * with the actual theme output — no duplicated markup.
 *
 * Usage: php tools/build-preview.php
 */

$theme = __DIR__ . '/../samen-omhoog';
$out   = __DIR__ . '/../preview/index.html';

/* --- Minimal WordPress shims --------------------------------------------- */
function language_attributes() { echo 'lang="nl"'; }
function bloginfo( $k = '' ) { echo get_bloginfo( $k ); }
function get_bloginfo( $k = '' ) { return 'charset' === $k ? 'UTF-8' : 'Stichting Samen Omhoog'; }
function body_class( $c = '' ) { echo 'class="home preview"'; }
function wp_body_open() {}
function __( $t, $d = '' ) { return $t; }
function esc_html__( $t, $d = '' ) { return $t; }
function esc_attr__( $t, $d = '' ) { return $t; }
function esc_html_e( $t, $d = '' ) { echo $t; }
function esc_attr_e( $t, $d = '' ) { echo $t; }
function esc_html( $t ) { return $t; }
function esc_attr( $t ) { return $t; }
function esc_url( $u ) { return $u; }
function samen_omhoog_opt( $key, $default = '' ) { return $default; }
function has_custom_logo() { return false; }
function the_custom_logo() {}
function home_url( $p = '' ) { return '#home'; }
function admin_url( $p = '' ) { return '#'; }
function has_nav_menu( $l ) { return false; }
function wp_nav_menu( $a ) {}
function wp_nonce_field() { echo '<input type="hidden" name="_wpnonce" value="preview">'; }
function sanitize_key( $k ) { return preg_replace( '/[^a-z0-9_]/', '', strtolower( (string) $k ) ); }
function wp_unslash( $v ) { return $v; }

function samen_omhoog_default_menu() {
	$items = array(
		'#aanbod'      => 'Wat we bieden',
		'#werkplaats'  => 'Werkplaatsen',
		'#doelgroepen' => 'Voor wie',
		'#team'        => 'Wie wij zijn',
		'#contact'     => 'Contact',
	);
	echo '<ul id="primary-menu" class="nav-links">';
	foreach ( $items as $href => $label ) {
		printf( '<li><a href="%s">%s</a></li>', $href, $label );
	}
	echo '</ul>';
}

function wp_head() {
	global $theme;
	$css = file_get_contents( $theme . '/style.css' );
	// Strip the leading /* ... */ theme header so the browser doesn't render it.
	$css = preg_replace( '#^\s*/\*.*?\*/#s', '', $css, 1 );
	echo "<title>Stichting Samen Omhoog — Zwolle</title>\n";
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">' . "\n";
	echo "<style>\n" . $css . "\n</style>\n";
}

function wp_footer() {
	global $theme;
	echo "<script>\n" . file_get_contents( $theme . '/assets/js/main.js' ) . "\n</script>\n";
}

function get_header() { global $theme; include $theme . '/header.php'; }
function get_footer() { global $theme; include $theme . '/footer.php'; }

/* --- Render -------------------------------------------------------------- */
ob_start();
include $theme . '/front-page.php';
$html = ob_get_clean();

if ( ! is_dir( dirname( $out ) ) ) {
	mkdir( dirname( $out ), 0777, true );
}
file_put_contents( $out, $html );
echo 'Preview written to ' . realpath( $out ) . ' (' . strlen( $html ) . " bytes)\n";
