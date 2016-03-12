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
?>

	<aside class="sidebar download-sidebar">
		<div class="box">
			<?php if ( ! eddwp_is_external_extension() ) {
				$license = home_url( '/docs/extensions-terms-conditions/' );
				?>
				<div class="download-access download-info-section">
					<div class="pricing">
						<h3 class="widget-title">Pricing</h3>
						<?php echo edd_get_purchase_link( array( 'id' => get_the_ID() ) ); ?>
					</div>
					<?php if ( ! $is_theme && ! edd_is_free_download( get_the_ID() ) ) { ?>
						<div class="terms clearfix">
							<p><?php echo ucfirst( $download_type ) . 's'; ?> subject to yearly license for support and updates. <a href="<?php echo $license; ?>" target="_blank">View license terms</a>.</p>
						</div>
					<?php } ?>
				</div>
			<?php } // end if ?>
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
				<?php if( $has_license && ! $is_3rd_party && ! $is_bundle ) { ?>
					<div class="version clearfix">
						<?php $version = get_post_meta( get_the_ID(), '_edd_sl_version', true ); ?>
						<p><span class="edd-download-detail-label">Version:</span> <span class="edd-download-detail"><?php echo $version; ?></span></p>
					</div>
				<?php } // end if  ?>
				<?php if ( eddwp_is_external_extension() ) { ?>
					<div class="view-download">
						<a href="<?php echo esc_url( eddwp_get_external_extension_url() ); ?>" title="View Details" class="edd-submit button blue">View <?php echo ucfirst( $download_type ); ?></a>
					</div>
				<?php } ?>
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