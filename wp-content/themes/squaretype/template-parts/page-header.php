<?php
/**
 * The template part for displaying page header.
 *
 * @package Squaretype
 */

// Init class and scheme for header.
$class = null;

// Scheme variants.
$scheme_current = 'default';
$scheme_dark    = 'default';
$scheme_light   = 'default';

// If description exists.
if ( get_the_archive_description() ) {
	$class = 'page-header-has-description';
}
?>

<header class="page-header <?php echo esc_attr( $class ); ?>">

	<?php
	if ( is_category() ) {
		$background_id = get_term_meta( get_query_var( 'cat' ), 'csco_background_image', true );
		if ( $background_id ) {
			?>
				<div class="cs-overlay-background">
					<?php
						echo wp_get_attachment_image( $background_id, 'csco-extra-large', array(
							'class' => 'pk-lazyload-disabled',
						) );
					?>
					<span class="cs-overlay-blank"></span>
				</div>
			<?php
		}
	}
	?>

	<div class="cs-container">
		<?php
		if ( is_category() ) {

			// All schemes.
			$schemes = array( 'default', 'dark' );

			$data = csco_site_scheme_data();

			foreach ( $schemes as $scheme ) {

				$scheme_field = ( 'dark' === $scheme ) ? '_' . $scheme : '';

				$mode = 'default';

				// Background color.
				$background_color = get_term_meta( get_query_var( 'cat' ), "csco_background_color{$scheme_field}", true );

				// Set background default.
				if ( 'dark' === $scheme ) {
					$background_color = $background_color ? $background_color : '#333333';
				}

				if ( $background_color ) {
					$mode = csco_light_or_dark( $background_color, 'default', 'inverse' );
				}

				// Gradient.
				$start_color = get_term_meta( get_query_var( 'cat' ), "csco_gradient_start_color{$scheme_field}", true );
				$end_color   = get_term_meta( get_query_var( 'cat' ), "csco_gradient_end_color{$scheme_field}", true );

				// Set gradient default.
				if ( 'dark' === $scheme ) {
					$start_color = $start_color ? $start_color : '#333333';
					$end_color   = $end_color ? $end_color : '#333333';
				}

				$start_mode = $start_color ? csco_light_or_dark( $start_color, 'default', 'inverse' ) : 'default';
				$end_mode   = $end_color ? csco_light_or_dark( $end_color, 'default', 'inverse' ) : 'default';

				if ( $start_color || $end_color ) {
					$mode = 'default';
				}

				if ( 'inverse' === $start_mode || 'inverse' === $end_mode ) {
					$mode = 'inverse';
				}

				// Background image.
				if ( $background_id ) {
					$mode = 'inverse';
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
		}
		?>

		<div class="page-header-content" data-scheme="<?php echo esc_attr( $scheme_current ); ?>" data-scheme-light="<?php echo esc_attr( $scheme_light ); ?>" data-scheme-dark="<?php echo esc_attr( $scheme_dark ); ?>">

			<?php

			do_action( 'csco_page_header_before' );

			if ( is_author() ) {

				$subtitle  = esc_html__( 'All Posts By', 'squaretype' );
				$author_id = get_queried_object_id();
				?>

				<div class="page-author-container">
					<div class="author-avatar">
						<?php
						echo get_avatar( $author_id, 130 );
						if ( csco_powerkit_module_enabled( 'social_links' ) ) {
							powerkit_author_social_links( $author_id );
						}
						?>
					</div>
					<div class="author-content">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						csco_archive_post_count();
						csco_archive_post_description();
						?>
					</div>
				</div>

				<?php
			} elseif ( is_archive() ) {

				// Add special subtitles.
				if ( is_category() ) {
					$subtitle = esc_html__( 'Browsing Category', 'squaretype' );
				} elseif ( is_tag() ) {
					$subtitle = esc_html__( 'Browsing Tag', 'squaretype' );
				} else {
					$subtitle = '';
				}

				// Add a subtitle, wrapped in <p></p> if it exists.
				if ( $subtitle ) {
					?>
					<p class="page-subtitle title-block"><?php echo esc_html( $subtitle ); ?></p>
					<?php
				}

				the_archive_title( '<h1 class="page-title">', '</h1>' );
				csco_archive_post_count();
				csco_archive_post_description();

			} elseif ( is_search() ) {

				?>
				<p class="page-subtitle title-block"><?php esc_html_e( 'Search Results', 'squaretype' ); ?></p>
				<h1 class="page-title"><?php echo get_search_query(); ?></h1>
				<?php
				csco_archive_post_count();

			} elseif ( is_404() ) {

				?>
				<h1 class="page-title"><?php esc_html_e( '404', 'squaretype' ); ?></h1>
				<?php

			}

			do_action( 'csco_page_header_after' );
			?>

		</div>

	</div>

</header>

<?php
$style = csco_large_section_style();

if ( $style ) {
	?>
	<style>
		[data-site-scheme="default"] .page-header {
			<?php call_user_func( 'printf', '%s', $style ); ?>
		}
	</style>
<?php } ?>

<?php
$style = csco_large_section_style( 'dark' );

if ( $style ) {
	?>
	<style>
		[data-site-scheme="dark"] .page-header {
			<?php call_user_func( 'printf', '%s', $style ); ?>
		}
	</style>
<?php } ?>
