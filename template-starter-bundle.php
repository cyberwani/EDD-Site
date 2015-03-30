<?php
/**
 * Template Name: Starter Bundle
 *
 * The template for displaying the Starter Bundle form (Gravity Forms).
 */
get_header();
the_post();
	?>	
	<section id="starter-bundle" class="main clearfix">
		<article class="content clearfix">
			<div class="the-content clearfix">
				<div class="entry-header">
					<h1 class="entry-title">Jump start your store with the <strong>EDD <?php the_title(); ?></strong></h1>
					<span class="entry-headline">Let's not make this complicated...</span>
					<div class="bundle-details clearfix">
						<p class="bundle-description">Easy Digital Downloads has over 250 extensions to choose from. Finding the ones you need for your store can be a difficult task. Use the form below to build a Starter Bundle from some of our most popular extensions.</p>
						<p class="bundle-discount">Purchase through this form and receive an automatic<span>30% Discount</span></p>
					</div>
				</div>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article><!-- /.content -->
	</section><!-- /.main -->	
	<?php		
get_footer();