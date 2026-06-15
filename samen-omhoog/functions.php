<?php
/**
 * Samen Omhoog theme functions.
 *
 * @package SamenOmhoog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'SAMEN_OMHOOG_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function samen_omhoog_setup() {
	load_theme_textdomain( 'samen-omhoog', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 200,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hoofdmenu', 'samen-omhoog' ),
			'footer'  => __( 'Footer menu', 'samen-omhoog' ),
		)
	);
}
add_action( 'after_setup_theme', 'samen_omhoog_setup' );

/**
 * Enqueue styles and scripts.
 */
function samen_omhoog_assets() {
	wp_enqueue_style(
		'samen-omhoog-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Inter:wght@300;400;500;600&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'samen-omhoog-style',
		get_stylesheet_uri(),
		array( 'samen-omhoog-fonts' ),
		SAMEN_OMHOOG_VERSION
	);

	wp_enqueue_script(
		'samen-omhoog-script',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		SAMEN_OMHOOG_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'samen_omhoog_assets' );

/**
 * Preconnect to Google Fonts for performance.
 */
function samen_omhoog_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'samen_omhoog_resource_hints', 10, 2 );

/**
 * Helper: get a theme option with a sensible default.
 *
 * @param string $key     Option key (without prefix).
 * @param string $default Default value.
 * @return string
 */
function samen_omhoog_opt( $key, $default = '' ) {
	return get_theme_mod( 'samen_omhoog_' . $key, $default );
}

/**
 * Customizer settings — lets the client edit contact info without touching code.
 */
function samen_omhoog_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'samen_omhoog_contact',
		array(
			'title'    => __( 'Samen Omhoog — Contactgegevens', 'samen-omhoog' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'whatsapp'      => array( __( 'WhatsApp-nummer (internationaal, bijv. 31628859553)', 'samen-omhoog' ), '31628859553' ),
		'phone'         => array( __( 'Telefoonnummer (weergave)', 'samen-omhoog' ), '06-28859553' ),
		'email'         => array( __( 'E-mailadres', 'samen-omhoog' ), 'info@samenomhoog.nl' ),
		'address'       => array( __( 'Adres', 'samen-omhoog' ), 'Floresstraat 7, 8022 AD Zwolle' ),
		'hours_week'    => array( __( 'Openingstijden ma–vr', 'samen-omhoog' ), '09:00–17:00' ),
		'hours_evening' => array( __( 'Avondinloop (di & do)', 'samen-omhoog' ), '19:00–23:00' ),
		'kvk'           => array( __( 'KvK-nummer', 'samen-omhoog' ), '89792807' ),
		'rsin'          => array( __( 'RSIN', 'samen-omhoog' ), '865111339' ),
		'agb'           => array( __( 'AGB-code', 'samen-omhoog' ), '98108329' ),
		'form_to'       => array( __( 'Ontvanger contactformulier (e-mail)', 'samen-omhoog' ), get_option( 'admin_email' ) ),
	);

	foreach ( $fields as $key => $data ) {
		$wp_customize->add_setting(
			'samen_omhoog_' . $key,
			array(
				'default'           => $data[1],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'samen_omhoog_' . $key,
			array(
				'label'   => $data[0],
				'section' => 'samen_omhoog_contact',
				'type'    => ( 'address' === $key ) ? 'textarea' : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'samen_omhoog_customize_register' );

/**
 * Handle the front-end contact form submission.
 */
function samen_omhoog_handle_contact() {
	$redirect = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	if ( ! isset( $_POST['samen_omhoog_contact_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['samen_omhoog_contact_nonce'] ), 'samen_omhoog_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'so_contact', 'error', $redirect ) . '#contact' );
		exit;
	}

	// Honeypot: real users leave this empty.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'so_contact', 'success', $redirect ) . '#contact' );
		exit;
	}

	$name    = isset( $_POST['so_name'] ) ? sanitize_text_field( wp_unslash( $_POST['so_name'] ) ) : '';
	$email   = isset( $_POST['so_email'] ) ? sanitize_email( wp_unslash( $_POST['so_email'] ) ) : '';
	$phone   = isset( $_POST['so_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['so_phone'] ) ) : '';
	$subject = isset( $_POST['so_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['so_subject'] ) ) : '';
	$message = isset( $_POST['so_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['so_message'] ) ) : '';

	if ( empty( $name ) || empty( $email ) || ! is_email( $email ) || empty( $message ) ) {
		wp_safe_redirect( add_query_arg( 'so_contact', 'error', $redirect ) . '#contact' );
		exit;
	}

	$to      = samen_omhoog_opt( 'form_to', get_option( 'admin_email' ) );
	$mail_subject = sprintf( '[%s] Contactformulier: %s', get_bloginfo( 'name' ), $subject ? $subject : __( 'Nieuw bericht', 'samen-omhoog' ) );
	$body    = sprintf(
		"Naam: %s\nE-mail: %s\nTelefoon: %s\nOnderwerp: %s\n\nBericht:\n%s\n",
		$name,
		$email,
		$phone,
		$subject,
		$message
	);
	$headers = array(
		'Reply-To: ' . $name . ' <' . $email . '>',
		'Content-Type: text/plain; charset=UTF-8',
	);

	$sent = wp_mail( $to, $mail_subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'so_contact', $sent ? 'success' : 'error', $redirect ) . '#contact' );
	exit;
}
add_action( 'admin_post_nopriv_samen_omhoog_contact', 'samen_omhoog_handle_contact' );
add_action( 'admin_post_samen_omhoog_contact', 'samen_omhoog_handle_contact' );

/**
 * Fallback primary menu when the client has not assigned one yet.
 */
function samen_omhoog_default_menu() {
	$items = array(
		'#aanbod'      => __( 'Wat we bieden', 'samen-omhoog' ),
		'#werkplaats'  => __( 'Werkplaatsen', 'samen-omhoog' ),
		'#doelgroepen' => __( 'Voor wie', 'samen-omhoog' ),
		'#team'        => __( 'Wie wij zijn', 'samen-omhoog' ),
		'#contact'     => __( 'Contact', 'samen-omhoog' ),
	);
	echo '<ul id="primary-menu" class="nav-links">';
	foreach ( $items as $href => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_attr( $href ), esc_html( $label ) );
	}
	echo '</ul>';
}
