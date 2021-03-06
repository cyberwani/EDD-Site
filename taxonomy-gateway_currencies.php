<?php
/**
 * The template for displaying the download gateway countries archives.
 */

global $wp_query;
get_header();
$gateway_currency_term = $wp_query->get_queried_object();
?>

	<div class="extensions-header-area page-section-blue full-width">
		<div class="inner">
			<div class="extensions-header clearfix">
				<div class="section-header">
					<h2 class="section-title">Gateway Currency: <strong><?php echo $gateway_currency_term->name; ?></strong></h2>
					<?php if ( ! empty( $gateway_currency_term->description ) ) : ?>
						<p class="section-subtitle"><?php echo $gateway_currency_term->description; ?></p>
					<?php endif; ?>
					<div class="extensions-search-form">
						<form id="extensions-searchform" class="clearfix" action="<?php echo home_url( 'downloads' ); ?>" method="get">
							<input class="extensions-search-text" type="search" name="download_s" placeholder="Ex. Payment Gateway" />
							<input class="extensions-search-submit edd-submit button darkblue" type="submit" value="Search" />
							<input type="hidden" name="action" value="download_search" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="edd-downloads-area page-section-white full-width">
		<div class="inner">
			<div class="edd-downloads">
				<div class="section-header extensions-filter">
					<div class="filter-label">
						Categories:
					</div>
					<?php
					$cat_args = array(
						'exclude'  => array(
							1592 /* extensions */,
							1617 /* themes */,
							1571 /* featured theme */,
							1536 /* 3rd party */,
						),
					);
					$cats = get_terms( 'download_category', $cat_args );

					if ( $cats ) :
						$cat_list = '<div class="filter clearfix">';
						$cat_list .= '<ul class="download-categories clearfix">';
						$cat_list .= '<li><a href="' . home_url('/downloads') . '">All</a></li>';
						$cat_list .= '<li><a href="' . home_url('/downloads/?display=newest') . '">Newest</a></li>';

						foreach( $cats as $cat ) :
							$cat_list .= '<li><a href="' . get_term_link( $cat->slug, 'download_category' ) . '">' . $cat->name . '</a></li>';
						endforeach;

						$cat_list .= '</ul>';
						$cat_list .= '</div>';

						echo $cat_list;
					endif;
					?>
				</div>
				<?php
				include( 'edd_templates/download-grid.php' );
				eddwp_paginate_links();
				?>
				<div class="third-party-extensions-section">
					<p>View more payment gateway extensions built by talented developers from the EDD community.</p>
					<a class="edd-submit button blue" href="<?php echo home_url( '3rd-party-extensions#gateways' ); ?>"><i class="fa fa-plug"></i>3rd Party Payment Gateways</a>
				</div>
			</div>
		</div>
	</div>
<?php

get_footer();
