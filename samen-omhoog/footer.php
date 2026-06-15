<?php
/**
 * Footer template.
 *
 * @package SamenOmhoog
 */

$so_whatsapp = samen_omhoog_opt( 'whatsapp', '31684613589' );
$so_email    = samen_omhoog_opt( 'email', 'info@samenomhoog.nl' );
$so_phone    = samen_omhoog_opt( 'phone', '06 846 13 589' );
$so_address  = samen_omhoog_opt( 'address', 'Floresstraat 7, 8022 AD Zwolle' );
?>

<footer class="site-footer">
	<div class="footer-top">
		<div class="footer-brand">
			<div class="footer-logo">Samen<span>Omhoog</span></div>
			<p class="footer-desc"><?php esc_html_e( 'Een veilige, creatieve ontwikkelplek voor jongeren en volwassenen in Zwolle. School of Life — leren door te doen.', 'samen-omhoog' ); ?></p>
			<div class="footer-contact-chips">
				<span class="footer-chip"><?php echo esc_html( $so_email ); ?></span>
				<span class="footer-chip"><?php echo esc_html( $so_phone ); ?></span>
				<span class="footer-chip"><?php echo esc_html( $so_address ); ?></span>
			</div>
		</div>
		<div>
			<div class="footer-col-title"><?php esc_html_e( 'Navigatie', 'samen-omhoog' ); ?></div>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-links',
						'depth'          => 1,
					)
				);
			} else {
				?>
				<ul class="footer-links">
					<li><a href="#home"><?php esc_html_e( 'Home', 'samen-omhoog' ); ?></a></li>
					<li><a href="#missie"><?php esc_html_e( 'Over Ons', 'samen-omhoog' ); ?></a></li>
					<li><a href="#programmas"><?php esc_html_e( 'Aanbod', 'samen-omhoog' ); ?></a></li>
					<li><a href="#contact"><?php esc_html_e( 'Contact', 'samen-omhoog' ); ?></a></li>
					<li><a href="#documenten"><?php esc_html_e( 'Documenten', 'samen-omhoog' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</div>
		<div>
			<div class="footer-col-title"><?php esc_html_e( "Programma's", 'samen-omhoog' ); ?></div>
			<ul class="footer-links">
				<li><a href="#programmas"><?php esc_html_e( "Alle programma's", 'samen-omhoog' ); ?></a></li>
				<li><a href="#programmas"><?php esc_html_e( 'Ontwikkeling & Werkervaring', 'samen-omhoog' ); ?></a></li>
				<li><a href="#programmas"><?php esc_html_e( 'Ontmoeting & Welzijn', 'samen-omhoog' ); ?></a></li>
				<li><a href="#programmas"><?php esc_html_e( 'Zorg & Begeleiding', 'samen-omhoog' ); ?></a></li>
				<li><a href="#programmas"><?php esc_html_e( 'Ondernemerswerkplaats', 'samen-omhoog' ); ?></a></li>
			</ul>
		</div>
		<div>
			<div class="footer-col-title"><?php esc_html_e( 'Openingstijden', 'samen-omhoog' ); ?></div>
			<div class="footer-hours">
				<div class="footer-hour"><span class="day"><?php esc_html_e( 'Maandag – Donderdag', 'samen-omhoog' ); ?></span><span class="time"><?php echo esc_html( samen_omhoog_opt( 'hours_week', '09:00–17:00' ) ); ?></span></div>
				<div class="footer-hour"><span class="day"><?php esc_html_e( 'Vrijdag', 'samen-omhoog' ); ?></span><span class="time"><?php echo esc_html( samen_omhoog_opt( 'hours_friday', '09:00–15:00' ) ); ?></span></div>
				<div class="footer-hour"><span class="day"><?php esc_html_e( 'Za & Zo', 'samen-omhoog' ); ?></span><span class="time"><?php esc_html_e( 'Gesloten', 'samen-omhoog' ); ?></span></div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'Stichting Samen Omhoog · Zwolle', 'samen-omhoog' ); ?></span>
		<span><?php echo esc_html( $so_email ); ?> · <?php echo esc_html( $so_phone ); ?></span>
	</div>
</footer>

<a class="whatsapp-float" href="<?php echo esc_url( 'https://wa.me/' . $so_whatsapp ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'WhatsApp Samen Omhoog', 'samen-omhoog' ); ?>">
	<svg viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M16.04 3C9.44 3 4.07 8.36 4.07 14.96c0 2.11.55 4.17 1.6 5.98L4 29l8.27-1.63a11.9 11.9 0 0 0 5.77 1.47H18.05C24.64 28.84 30 23.48 30 16.88 30 10.3 22.64 3 16.04 3Zm7.04 17.16c-.3.85-1.74 1.63-2.4 1.73-.62.1-1.4.14-2.26-.14-.52-.17-1.2-.39-2.06-.77-3.62-1.56-5.98-5.2-6.16-5.44-.18-.24-1.47-1.96-1.47-3.74s.93-2.65 1.26-3.01c.33-.36.72-.45.96-.45h.69c.22.01.52-.08.81.62.3.72 1.02 2.5 1.11 2.68.09.18.15.39.03.63-.12.24-.18.39-.36.6-.18.21-.38.47-.54.63-.18.18-.37.38-.16.74.21.36.93 1.54 2 2.5 1.37 1.22 2.53 1.6 2.9 1.78.36.18.57.15.78-.09.21-.24.9-1.05 1.14-1.41.24-.36.48-.3.81-.18.33.12 2.1.99 2.46 1.17.36.18.6.27.69.42.09.15.09.87-.21 1.72Z"/></svg>
	<span>WhatsApp</span>
</a>

<?php wp_footer(); ?>
</body>
</html>
