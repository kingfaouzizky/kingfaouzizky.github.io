<?php
/**
 * Template part for displaying hero section.
 *
 * @package Squaretype
 */

$hero_object_id = null;

// Get ids of general settings.
$general_ids = csco_get_general_posts_ids();

// Get posts of general settings.
if ( $general_ids ) {
	$args = array(
		'ignore_sticky_posts' => true,
		'post__in'            => $general_ids,
		'posts_per_page'      => 1,
		'orderby'             => 'post__in',
		'post_type'           => array( 'post', 'page' ),
	);

	$general_query = new WP_Query( $args );
}

$layout = get_theme_mod( 'general_hero_layout', 'fullwidth' );

// Set class for hero section.
$class = sprintf( 'cs-hero-layout cs-hero-layout-%s', $layout );

if ( get_theme_mod( 'column_hero', false ) ) {
	$class .= ' cs-hero-right-column';
}

if ( 'fullwidth' === $layout ) {
	$class .= ' cs-overlay-ratio cs-ratio-wide';
}

if ( 'boxed' === $layout ) {
	$class .= ' cs-overlay-ratio cs-ratio-16by9';
}

// Determines whether there are more posts available in the loop.
if ( $general_ids && $general_query->have_posts() ) {

	$general_query->the_post();

	$hero_object_id = get_the_ID();

	do_action( 'csco_hero_before' );
	?>

	<div class="section-hero">
		<div class="section-hero-wrap <?php echo esc_attr( $class ); ?> cs-video-wrap">

			<?php
			$background_type = get_theme_mod( 'general_hero_bg_type', 'color' );
			if ( 'image' === $background_type ) {
				?>
					<div class="hero-overlay cs-overlay-background">
						<?php
							the_post_thumbnail(
								'csco-extra-large', array(
									'class' => 'pk-lazyload-disabled',
								)
							);
						?>
						<?php csco_get_video_background( 'hero', null, false ); ?>
						<span class="cs-overlay-blank"></span>
					</div>
				<?php
			}
			?>

			<div class="cs-hero-container">
				<div class="cs-hero">
					<!-- Full Post Layout -->
					<?php
					// Scheme variants.
					$scheme_current = 'default';
					$scheme_dark    = 'default';
					$scheme_light   = 'default';

					// All schemes.
					$schemes = array( 'default', 'dark' );

					$data = csco_site_scheme_data();

					foreach ( $schemes as $scheme ) {

						$scheme_field = ( 'dark' === $scheme ) ? '_' . $scheme : '';

						$mode = 'default';

						switch ( get_theme_mod( "general_hero_font_color{$scheme_field}", 'auto' ) ) {
							case 'auto':
								if ( 'color' === $background_type ) {
									$mode = csco_light_or_dark( get_theme_mod( "general_hero_color{$scheme_field}", 'dark' === $scheme ? '#333333' : '#F9F9FB' ), 'default', 'inverse' );
								}

								// Post Category Background Color.
								if ( 'category_color' === $background_type ) {
									$category = csco_get_top_category( get_the_ID() );
									if ( $category ) {
										$background_color = get_term_meta( $category->term_id, "csco_background_color{$scheme_field}", true );

										// Set background default.
										if ( 'dark' === $scheme ) {
											$background_color = $background_color ? $background_color : '#333333';
										}

										if ( $background_color ) {
											$mode = csco_light_or_dark( $background_color, 'default', 'inverse' );
										}
									}
								}

								// Custom Gradient Color.
								if ( 'gradient' === $background_type ) {
									$start_color = get_theme_mod( "general_hero_start_color{$scheme_field}", 'dark' === $scheme ? '#333333' : '' );
									$end_color   = get_theme_mod( "general_hero_end_color{$scheme_field}", 'dark' === $scheme ? '#333333' : '' );

									$start_mode = $start_color ? csco_light_or_dark( $start_color, 'default', 'inverse' ) : 'default';
									$end_mode   = $end_color ? csco_light_or_dark( $end_color, 'default', 'inverse' ) : 'default';

									if ( 'inverse' === $start_mode || 'inverse' === $end_mode ) {
										$mode = 'inverse';
									}
								}

								// Post Category Background Gradient.
								if ( 'category_gradient' === $background_type ) {
									$category = csco_get_top_category( get_the_ID() );
									if ( $category ) {
										$start_color = get_term_meta( $category->term_id, "csco_gradient_start_color{$scheme_field}", true );
										$end_color   = get_term_meta( $category->term_id, "csco_gradient_end_color{$scheme_field}", true );

										// Set gradient default.
										if ( 'dark' === $scheme ) {
											$start_color = $start_color ? $start_color : '#333333';
											$end_color   = $end_color ? $end_color : '#333333';
										}

										$start_mode = $start_color ? csco_light_or_dark( $start_color, 'default', 'inverse' ) : 'default';
										$end_mode   = $end_color ? csco_light_or_dark( $end_color, 'default', 'inverse' ) : 'default';

										if ( 'inverse' === $start_mode || 'inverse' === $end_mode ) {
											$mode = 'inverse';
										}
									}
								}

								// If the image for the whole block.
								if ( 'image' === $background_type ) {
									$mode = 'inverse';
								}
								break;
							case 'light':
								$mode = 'inverse';
								break;
							case 'dark':
								$mode = 'default';
								break;
						}

						if ( $scheme === $data['site_scheme'] ) {
							$scheme_current = $mode;
						}

						if ( 'dark' === $scheme ) {
							$scheme_dark  = $mode;
						} else {
							$scheme_light = $mode;
						}
					}
					?>
					<div class="hero-full" data-scheme="<?php echo esc_attr( $scheme_current ); ?>" data-scheme-light="<?php echo esc_attr( $scheme_light ); ?>" data-scheme-dark="<?php echo esc_attr( $scheme_dark ); ?>">
						<?php
							$meta_setting = 'general_hero_meta';

							$heading_size = get_theme_mod( 'general_hero_heading_size', 'medium' );

							$class = sprintf( 'heading-%s', $heading_size );
						?>
						<article <?php post_class( $class ); ?>>
							<?php
							if ( 'post' === get_post_type() ) {
								$category = csco_get_post_meta( 'category', false, false, $meta_setting );

								if ( in_array( 'hero', (array) get_post_meta( get_the_ID(), 'csco_post_video_location', true ), true ) ) {
									$video_url = get_post_meta( get_the_ID(), 'csco_post_video_url', true );
								}
							}

							if ( ( isset( $video_url ) && $video_url ) || ( isset( $category ) && $category ) ) {
								?>
								<div class="hero-details">
									<?php
									if ( isset( $video_url ) && $video_url ) {
										?>
										<div class="hero-tools cs-video-tools-large">
											<a class="cs-player-control cs-player-link cs-player-stop" target="_blank" href="<?php echo esc_url( $video_url ); ?>">
												<span class="cs-tooltip"><span><?php esc_html_e( 'View on YouTube', 'squaretype' ); ?></span></span>
											</a>
											<span class="cs-player-control cs-player-volume cs-player-mute"></span>
											<span class="cs-player-control cs-player-state cs-player-pause"></span>
										</div>
									<?php } ?>

									<?php echo (string) $category; // XSS. ?>
								</div>
							<?php } ?>

							<?php the_title( '<h2 class="hero-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

							<?php
							if ( get_theme_mod( 'general_hero_preview_image', false ) ) {
								csco_post_media();
							}
							?>

							<?php
							if ( 'post' === get_post_type() ) {
								csco_get_post_meta( array( 'author', 'date', 'views', 'shares', 'comments', 'reading_time' ), false, true, $meta_setting );
							}
							?>

							<?php if ( get_the_excerpt() ) { ?>
								<div class="hero-excerpt">
									<?php the_excerpt(); ?>
								</div>
							<?php } ?>

							<?php
							if ( get_theme_mod( 'general_hero_more_button', false ) ) {
								?>
									<div class="entry-more">
										<a class="button" href="<?php echo esc_url( get_permalink() ); ?>">
											<?php echo esc_html( get_theme_mod( 'misc_label_readmore', __( 'Read More', 'squaretype' ) ) ); ?>
										</a>
									</div>
								<?php
							}
							?>
						</article>
						<?php wp_reset_postdata(); ?>
					</div>

					<!-- List Layout -->
					<?php
					if ( get_theme_mod( 'column_hero', false ) ) {

						$content = get_theme_mod( 'column_hero_content', 'default-list' );

						$column_enabled = false;

						if ( 'custom' === $content || 'widgets' === $content ) {

							$column_enabled = true;

						} else {
							$column_ids = csco_get_column_posts_ids();

							if ( $column_ids ) {
								$args = array(
									'ignore_sticky_posts' => true,
									'post__in'            => $column_ids,
									'posts_per_page'      => count( $column_ids ),
									'orderby'             => 'post__in',
									'post_type'           => array( 'post', 'page' ),
								);

								$column_query = new WP_Query( $args );
							}

							$column_enabled = $column_ids && $column_query->have_posts();
						}

						// Determines whether there are more posts available in the loop.
						if ( $column_enabled ) {

							$meta_setting = 'column_hero_meta';

							// Scheme variants.
							$scheme_current = 'default';
							$scheme_dark    = 'default';
							$scheme_light   = 'default';

							// All schemes.
							$schemes = array( 'default', 'dark' );

							$data = csco_site_scheme_data();

							foreach ( $schemes as $scheme ) {

								$scheme_field = ( 'dark' === $scheme ) ? '_' . $scheme : '';

								$mode = 'default';

								// Set column scheme.
								switch ( get_theme_mod( "column_hero_font_color{$scheme_field}", 'auto' ) ) {
									case 'auto':
										$color = csco_rgba2hex( get_theme_mod( "column_hero_color{$scheme_field}", 'dark' === $scheme ? '#111111' : '#FFFFFF' ) );

										$mode = csco_light_or_dark( $color, 'default', 'inverse' );
										break;
									case 'light':
										$mode = 'inverse';
										break;
									case 'dark':
										$mode = 'default';
										break;
									default:
										$mode = 'default';
										break;
								}

								if ( $scheme === $data['site_scheme'] ) {
									$scheme_current = $mode;
								}

								if ( 'dark' === $scheme ) {
									$scheme_dark  = $mode;
								} else {
									$scheme_light = $mode;
								}
							}
							?>
							<div class="hero-list hero-<?php echo esc_attr( $content ); ?>" data-scheme="<?php echo esc_attr( $scheme_current ); ?>" data-scheme-light="<?php echo esc_attr( $scheme_light ); ?>" data-scheme-dark="<?php echo esc_attr( $scheme_dark ); ?>">
								<?php
								$sidebar_title = get_theme_mod( 'column_hero_title' );
								if ( $sidebar_title ) {
									?>
									<div class="title-block"><?php echo wp_kses_post( $sidebar_title ); ?></div>
									<?php
								}
								?>

								<?php
								if ( 'custom' === $content ) {
									$custom_content = get_theme_mod( 'column_hero_custom_content' );
									?>
									<div class="content-block"><?php echo do_shortcode( $custom_content ); ?></div>
									<?php
								} elseif ( 'widgets' === $content ) {
									if ( is_active_sidebar( 'sidebar-hero' ) ) {
										dynamic_sidebar( 'sidebar-hero' );
									}
								} else {
									while ( $column_query->have_posts() ) {
										$column_query->the_post();

										$preview_image = get_theme_mod( 'column_hero_preview_image', true );

										$preview = ( has_post_thumbnail() && $preview_image ) ? 'cs-preview-enabled' : 'cs-preview-disabled';
										?>
										<article <?php post_class( $preview ); ?>>
											<div class="cs-post-outer">
												<?php if ( 'cs-preview-enabled' === $preview ) { ?>
													<div class="cs-post-inner cs-post-thumbnail">
														<a href="<?php the_permalink(); ?>" class="post-thumbnail">
															<?php the_post_thumbnail( 'csco-small' ); ?>
														</a>
													</div>
												<?php } ?>

												<div class="cs-post-inner cs-post-data">
													<?php
													if ( 'post' === get_post_type() ) {
														if ( 'numbered-list' === $content ) {
															set_query_var( 'csco_category_first_char', $column_query->current_post + 1 );
														}

														csco_get_post_meta( 'category', false, true, $meta_setting );

														if ( 'numbered-list' === $content ) {
															set_query_var( 'csco_category_first_char', false );
														}
													}
													?>

													<?php if ( get_the_title() ) { ?>
														<h5 class="hero-title">
															<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
														</h5>
													<?php } ?>

													<?php
													if ( 'post' === get_post_type() ) {
														csco_get_post_meta( array( 'author', 'date', 'views', 'shares', 'comments', 'reading_time' ), false, true, $meta_setting );
													}
													?>
												</div>
											</div>
										</article>
										<?php
									}
								}
								?>
							</div>
							<?php
						}
					}
					?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>

		</div>
	</div>

	<?php
	$style = csco_large_section_style( '', $hero_object_id );

	if ( $style ) {
		?>
		<style>
			[data-site-scheme="default"] .section-hero-wrap {
				<?php call_user_func( 'printf', '%s', $style ); ?>
			}
		</style>
	<?php } ?>

	<?php
	$style = csco_large_section_style( 'dark', $hero_object_id );

	if ( $style ) {
		?>
		<style>
			[data-site-scheme="dark"] .section-hero-wrap {
				<?php call_user_func( 'printf', '%s', $style ); ?>
			}
		</style>
	<?php } ?>

	<?php
	do_action( 'csco_hero_after' );
}
