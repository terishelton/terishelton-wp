<?php
/**
 * Template part for displaying portfolio content in page-portfolio.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Teri_Shelton
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php //terishelton_post_thumbnail(); ?>

	<?php if(!is_single()) { ?>
	
	<div class="entry-content">
		<ul id="filters">
			<?php
				// get tags for portfolio sort
				$terms = get_terms(array(
    				'taxonomy' => 'tags',
    				'hide_empty' => false));
				$count = count($terms);
				
				// display tags plus 'All'
				echo '<li><button class="filter-btn" data-filter="all" class="active">All</button></li>';
				
				if ($count > 0) {
					foreach ($terms as $term) {
						$termname = strtolower($term->name);
						$termname = str_replace(' ', '-', $termname);
						
						echo '<li><button class="filter-btn '.$termname.'" data-filter="'.$termname.'">'. $term->name .'</button></li>';
					}
				}
			?>
		</ul>
		
		<div id="portfolio">
			<?php 
			// Query the post / do the loop
			$args = array( 'post_type' => "portfolio", 'posts_per_page' => -1 );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
	
				// get tags for each portfolio post
				$terms = get_the_terms( $post->ID, 'tags');
				if ( $terms && ! is_wp_error($terms) ) {
					$links = array();
					
					foreach ($terms as $term  ) {
						$links[] = $term->name;
					}
				
					$tag_links = join( " ", str_replace(' ','-', $links) );
					$tag = strtolower($tag_links);
				} else {
					$tag = '';
				}
	
				
				// add tag name into portfolio-item class
				?>
				<div class="all portfolio-item scale-anm <?php echo $tag ?>">
					<a href="<?php echo get_permalink() ?>" class="portfolio-item-link">
						<?php terishelton_post_thumbnail() ?>
					</a>
					<h2><a href="<?php echo get_permalink() ?>"><?php echo the_title() ?></a></h2>
				</div>
				
	
			
			<?php endwhile; ?>
		</div>
		
	</div><!-- .entry-content -->
	
	<?php } // end portfolio landing page
		else { // portfolio main page
		
		terishelton_post_thumbnail();
		?>
		
		<div class="entry-content">
			
			<?php the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'terishelton' ),
				'after'  => '</div>',
			) ); ?>
			
		</div><!-- .entry-content -->
	<?php } ?>
		

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'terishelton' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
