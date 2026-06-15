<?php
/**
 * Fallback template for blog/archive/page views.
 *
 * The homepage uses front-page.php. This template renders any other
 * content (posts, pages, archives) within the same shell.
 *
 * @package SamenOmhoog
 */

get_header();
?>

<main class="site-section" style="padding-top:160px; max-width:840px; margin:0 auto;">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?> style="margin-bottom:56px;">
				<h1 class="section-title" style="font-size:clamp(30px,4vw,48px);"><?php the_title(); ?></h1>
				<div class="mission-text" style="margin-top:24px;">
					<?php
					if ( is_singular() ) {
						the_content();
					} else {
						the_excerpt();
					}
					?>
				</div>
			</article>
			<?php
		endwhile;

		the_posts_pagination();
	else :
		?>
		<h1 class="section-title"><?php esc_html_e( 'Niets gevonden', 'samen-omhoog' ); ?></h1>
		<p class="mission-text"><?php esc_html_e( 'Er is geen inhoud om weer te geven.', 'samen-omhoog' ); ?></p>
		<?php
	endif;
	?>
</main>

<?php
get_footer();
