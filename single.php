<?php
/**
 * single blog posts and generic custom post type display fallback
 */

get_header(); ?>

	<div class="site-container">
		<section class="content">

			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
					<div class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
					<div class="entry-content">
						<?php
							if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
							endif;
							eddwp_post_byline();
							the_content();
						?>
					</div>
					<div class="entry-footer">
						<?php eddwp_post_terms(); ?>
						<div class="edd-post-footer clearfix">
							<div class="newsletter-wrap">
								<?php
									$args = array(
										'heading_content'     => '<span>Easy Digital Downloads </span>Email Newsletter',
										'description_content' => 'If you enjoyed that content or found it useful for your business, consider entering your name and email address to join <strong>70,000+</strong> subscribers in receiving Easy Digital Downloads news and updates!',
										'tabindex'            => 20
									);
									eddwp_newsletter_form( $args );
								?>
							</div>
						</div>
					</div>
				</article>
			<?php endwhile; ?>

			<?php
				if ( comments_open() || 0 != get_comments_number() ) :
					comments_template();
				endif;
			?>

		</section>
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>