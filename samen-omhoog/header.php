<?php
/**
 * Header template.
 *
 * @package SamenOmhoog
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar">
	<?php esc_html_e( 'Dé ontwikkelplek voor jongeren in Zwolle — inloop, werkplaatsen en begeleiding.', 'samen-omhoog' ); ?>
	<a href="<?php echo esc_url( 'https://wa.me/' . samen_omhoog_opt( 'whatsapp', '31628859553' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'WhatsApp ons', 'samen-omhoog' ); ?></a>
</div>

<div class="access-tools" aria-hidden="true">
	<button type="button"><?php esc_html_e( 'Lees voor', 'samen-omhoog' ); ?></button>
	<button type="button"><?php esc_html_e( 'Simpele tekst', 'samen-omhoog' ); ?></button>
	<button type="button"><?php esc_html_e( 'Vertalen', 'samen-omhoog' ); ?></button>
</div>

<nav class="site-nav" id="mainNav">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
		<?php if ( has_custom_logo() ) : ?>
			<div class="nav-logo-mark"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<span class="nav-logo-text">Samen<span>Omhoog</span></span>
		<?php endif; ?>
	</a>

	<?php
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'nav-links',
				'depth'          => 1,
			)
		);
	} else {
		samen_omhoog_default_menu();
	}
	?>

	<a href="<?php echo esc_url( 'https://wa.me/' . samen_omhoog_opt( 'whatsapp', '31628859553' ) ); ?>" target="_blank" rel="noopener" class="nav-cta"><?php esc_html_e( 'WhatsApp ons →', 'samen-omhoog' ); ?></a>
</nav>
