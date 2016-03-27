<?php
/**
 * download sidebar (NOT widgetized... for now)
 */

$is_extension = has_term( 'extensions', 'download_category', get_the_ID() );
$is_theme     = has_term( 'themes', 'download_category', get_the_ID() );
$is_bundle    = has_term( 'bundles', 'download_category', get_the_ID() );
$is_3rd_party = has_term( '3rd-party', 'download_category', get_the_ID() );
$has_license  = get_post_meta( get_the_ID(), '_edd_sl_enabled', true );

if ( $is_extension && ! $is_bundle ) :
	$download_type = 'extension';
elseif ( $is_theme ) :
	$download_type = 'theme';
elseif ( $is_bundle ) :
	$download_type = 'bundle';
endif;
$license = home_url( '/docs/extensions-terms-conditions/' );

$single_recurring = EDD_Recurring()->is_recurring( get_the_ID() );
$variable_pricing = edd_has_variable_prices( get_the_ID() );
$recurring = false;
if ( $variable_pricing ) {

	$get_prices = edd_get_variable_prices( get_the_ID() );
	foreach ( $get_prices as $option ) {
		if ( isset( $option['recurring'] ) && 'yes' === $option['recurring'] ) {
			$recurring = true;
		}
	}
} elseif ( ! $variable_pricing && $single_recurring ) {
	$recurring = true;
}
?>

	<aside class="sidebar download-sidebar">
		<div class="box">
			<div class="download-access download-info-section">
				<div class="pricing-header">
					<h3 class="widget-title"><?php echo ucfirst( $download_type ); ?> Pricing</h3>
				</div>
				<div class="pricing-info">
					<div class="pricing">
						<?php if ( class_exists( 'EDD_Recurring' ) && $recurring ) { ?>
							<p>All price options are billed yearly. You may cancel your subscription at any time.</p>
						<?php } ?>
						<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
					</div>
					<div class="terms clearfix">
						<p>
							<i class="fa fa-info-circle"></i>
							<?php if ( ! $is_theme && ! edd_is_free_download( get_the_ID() ) ) { ?>
								<?php echo ucfirst( $download_type ) . 's'; ?> subject to yearly license for support and updates. <a href="<?php echo $license; ?>" target="_blank">View terms</a>.
							<?php } elseif ( $is_theme && ! $is_3rd_party ) { ?>
								Downloading this theme grants you a lifetime license for support and updates.
							<?php } elseif ( $is_theme && $is_3rd_party ) { ?>
								This recommended theme is created and supported by a 3rd party developer.
							<?php } ?>
						</p>
					</div>
				</div>
			</div>
			<div class="download-details download-info-section">
				<h3 class="widget-title"><?php echo ucfirst( $download_type ); ?> Details</h3>
				<div class="author clearfix">
					<p><span class="edd-download-detail-label">Developer:</span>&nbsp;
						<?php if ( get_post_meta( get_the_ID(), 'ecpt_developer', true ) ) : ?>
							<span class="edd-download-detail"><?php echo get_post_meta( get_the_ID(), 'ecpt_developer', true ); ?></span>
						<?php else : ?>
							<span class="edd-download-detail"><?php echo get_the_author(); ?></span>
						<?php endif; ?>
					</p>
				</div>
				<?php
				if ( $has_license && ! $is_3rd_party && ! $is_bundle ) { ?>
					<div class="version clearfix">
						<?php $version = get_post_meta( get_the_ID(), '_edd_sl_version', true ); ?>
						<p><span class="edd-download-detail-label">Version:</span> <span class="edd-download-detail"><?php echo $version; ?><a href="#" class="changelog-link" title="View Changelog" data-toggle="modal" data-target="#show-changelog"><i class="fa fa-file-text-o"></i></a></span></p>
					</div>
					<?php
						// get the changelog data
						$changelog = get_post_meta( get_the_ID(), '_edd_sl_changelog', true );

						// if it exists, append the changelog (from either source) to the relevent content output
						if ( ! empty( $changelog ) ) {
							?>
							<!-- Changelog Modal -->
							<div class="changelog-modal modal fade" id="show-changelog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h5 class="modal-title" id="myModalLabel"><?php the_title(); ?> Changelog</h5>
										</div>
										<div class="modal-body">
											<?php echo $changelog; ?>
										</div>
										<div class="modal-footer">
											<a href="#" data-dismiss="modal">Close</a>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					?>
				<?php } // end if ?>
			</div>
			<?php if ( ! $is_bundle ) {
				$core_extensions = home_url( '/downloads/core-extensions-bundle/' );
				?>
				<div class="core-extensions download-info-section">
					<h3 class="widget-title">Core Extensions</h3>
					<p>Receive the best discount EDD has to offer when you purchase our Core Extensions Bundle. <a href="<?php echo $core_extensions; ?>">Learn more</a>.</p>
				</div>
			<?php } ?>
			<?php
				if ( get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) ||
					 get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) ||
					 get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) ) {
				?>
				<div class="download-requirements download-info-section">
					<h3 class="widget-title">Requirements</h3>
					<?php if ( get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) ) { ?>
						<div class="wordpress-ver clearfix">
							<p>
								<span class="edd-download-detail-label">WordPress:</span>&nbsp;
								<span class="edd-download-detail">
									<?php
										if ( get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) ) {
											echo get_post_meta( get_the_ID(), 'ecpt_minimumwp', true ) . ' or higher';
										}
									?>
								</span>
							</p>
						</div>
					<?php } ?>
					<?php if ( get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) ) { ?>
						<div class="edd-ver clearfix">
							<p>
								<span class="edd-download-detail-label">EDD:</span>&nbsp;
								<span class="edd-download-detail">
									<?php
										if ( get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) ) {
											echo get_post_meta( get_the_ID(), 'ecpt_minimumedd', true ) . ' or higher';												}
									?>
								</span>
							</p>
						</div>
					<?php } ?>
					<?php if ( get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) ) { ?>
						<div class="php-ver clearfix">
							<p>
								<span class="edd-download-detail-label">PHP:</span>&nbsp;
								<span class="edd-download-detail">
									<?php
										if ( get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) ) {
											echo get_post_meta( get_the_ID(), 'ecpt_minimumphp', true ) . ' or higher';
										}
									?>
								</span>
							</p>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<?php
				if ( function_exists('p2p_register_connection_type') ) :

					$external_doc = get_post_meta( get_the_ID(), 'ecpt_documentationlink', true );

					// Find connected docs
					$docs = new WP_Query( array(
					  'connected_type' => 'downloads_to_docs',
					  'connected_items' => get_queried_object(),
					  'nopaging' => true,
					  'post_status' => 'publish'
					) );

					if ( $docs->have_posts() || $external_doc ) {
						echo '<div class="related-items download-info-section">';
							// Display connected posts
							if ( $external_doc || $docs->have_posts() ) :
								echo '<h3 class="widget-title">Documentation</h3>';
								echo '<ul class="related-links">';
								if( empty( $external_doc ) ) :
									while ( $docs->have_posts() ) : $docs->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										<?php
									endwhile;
								else :
									echo '<li><a href="' . esc_url( $external_doc ) . '">View Setup Documentation</a></li>';
								endif;
								echo '</ul>';
								wp_reset_postdata();
							endif;
						echo '</div>';
					}
				endif;
				$support_form = home_url( '/support/' );
			?>
			<div class="support-ticket download-info-section">
				<h3 class="widget-title">Support</h3>
				<div>Need help? Feel free to submit a <a href="<?php echo $support_form; ?>">support ticket</a>.</div>
			</div>
		</div>
	</aside>