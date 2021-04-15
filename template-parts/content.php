<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Teri_Shelton
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
				//terishelton_posted_on();
				//terishelton_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="blog-entry">
	<?php
		if ( is_single() ) :
			// do not show on single posts
			// terishelton_post_thumbnail(); 
		else :
			// don't show on blog feed view either - for now
			// terishelton_post_thumbnail();
		endif;
	?>

	<div class="entry-content">
		<?php
			if ( is_single() ) :
				the_content();
			
			else :
				the_excerpt(); ?>
				<a class="read-more button" href="<?php echo get_permalink(); ?>">Continue Reading</a>
			
			<?php endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'terishelton' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	</div><!-- .blog-entry -->

	<footer class="entry-footer">
		<?php //terishelton_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
