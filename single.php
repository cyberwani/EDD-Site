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
						<span class="entry-date"><i class="fa fa-calendar"></i> <span class="post-date updated"><?php echo get_the_date(); ?></span></span>
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
					<div class="entry-content">
						<?php
							if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'full', array( 'class' => 'featured-img' ) );
							endif;
							the_content();
						?>
					</div>
					<div class="entry-footer">
						<?php eddwp_post_meta(); ?>
						<div class="edd-post-footer clearfix">
							<div class="newsletter-wrap">
								<?php eddwp_newsletter_form(); ?>
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