<?php
/**
 * The template for displaying the extension category archives.
 *
 * @package   EDD
 * @version   1.0
 * @since     1.0
 * @author	  Sunny Ratilal
 * @copyright Copyright (c) 2013, Sunny Ratilal.
 */
global $wp_query;
get_header();
?>
	<section class="main clearfix">
		<section class="content clearfix">
			<h1><?php single_term_title(); ?></h1>
			<form id="extensions_searchform" class="clearfix" action="<?php echo home_url( 'extensions' ); ?>" method="get">
				<fieldset>
					<input type="search" name="extension_s" value="" />
					<input type="submit" value="Search" />
					<input type="hidden" name="action" value="extension_search" />
				</fieldset>
			</form><!-- /#extensions_searchform -->
			<div class="clearfix"></div>
			<?php echo eddwp_extenstion_cats_shortcode(); ?>
		</section><!-- /.content -->

		<section class="extensions-container">
			<div class="extensions clearfix">
				<?php $c = 0; while ( have_posts() ) { the_post(); $c++; ?>
					<div class="extension <?php if ( 0 == $c%3 ) echo ' extension-clear'; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>">
							<div class="thumbnail-holder"><?php the_post_thumbnail( 'showcase' ); ?></div>
							<h2><?php the_title(); ?></h2>
							<?php echo get_post_meta( get_the_ID(), 'ecpt_shortdescription', true ); ?>
						</a>
						<div class="overlay">
							<a href="<?php the_permalink(); ?>" class="overlay-view-details button">View Details</a>
							<?php if( ! eddwp_is_external_extension() ) : ?>
								<a href="<?php echo home_url( '/edd-add/' . get_post_meta( get_the_ID(), 'ecpt_downloadid', true ) ); ?>" class="overlay-add-to-cart button">Add to Cart</a>
							<?php endif; ?>
						</div>
						<?php
						if ( has_term( '3rd Party', 'extension_category', get_the_ID() ) ) {
							echo '<i class="third-party"></i>';
						}
						?>
					</div>
					<?php
				}

				$big = 999999999;

				$links = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages
				));
				?>
				<div class="clear"></div>
				<div class="pagination">
					<?php echo $links; ?>
				</div>
			</div>
		</section><!-- /.extensions-container -->
	</section><!-- /.main -->
<?php get_footer(); ?>