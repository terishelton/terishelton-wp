<?php
/**
 * The template for displaying the portfolio page
 *
 * Template Name: Portfolio
 * @package Teri_Shelton
 */

get_header(); ?>

	<div id="primary" class="content-area full-width">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'portfolio' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
