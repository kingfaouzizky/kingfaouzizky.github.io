<?php
/**
 * The template part for displaying default header layout.
 *
 * @package Squaretype
 */

?>

<?php $class = get_theme_mod( 'header_shadow_submenus', false ) ? 'navbar-shadow-enabled' : null; ?>

<?php
$scheme = csco_color_scheme(
	get_theme_mod( 'color_navbar_bg', '#ffffff' ),
	get_theme_mod( 'color_navbar_bg_dark', '#1c1c1c' )
);
?>

<nav class="navbar navbar-primary <?php echo esc_attr( $class ); ?>" <?php echo wp_kses( $scheme, 'post' ); ?>>

	<?php do_action( 'csco_navbar_start' ); ?>

	<div class="navbar-wrap <?php echo esc_attr( $scheme ); ?>">

		<div class="navbar-container">

			<div class="navbar-content">

				<div class="navbar-col">
					<?php do_action( 'csco_navbar_content_left' ); ?>
				</div>

				<div class="navbar-col">
					<?php do_action( 'csco_navbar_content_center' ); ?>
				</div>

				<div class="navbar-col">
					<?php do_action( 'csco_navbar_content_right' ); ?>
				</div>

			</div><!-- .navbar-content -->

		</div><!-- .navbar-container -->

	</div><!-- .navbar-wrap -->

	<?php do_action( 'csco_navbar_end' ); ?>

</nav><!-- .navbar -->
