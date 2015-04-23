<?php
/**
 * Template Name: Full-width Page
 *
 * The template for displaying single-column, full-width pages.
 */
get_header();
the_post();
	?>	
	<section id="full-width-page" class="full-width-page main clearfix">
		<article class="content clearfix">
			<div class="the-content clearfix">
				<div class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article><!-- /.content -->
	</section><!-- /.main -->	
	<?php		
get_footer();