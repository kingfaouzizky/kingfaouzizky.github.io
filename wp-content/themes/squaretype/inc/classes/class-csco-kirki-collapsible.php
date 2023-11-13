<?php
/**
 * Add Collapsible Control to Kirki.
 *
 * @package Squaretype
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer theme collapsible.
 *
 * @package Squaretype
 */

add_action( 'customize_register', function( $wp_customize ) {
	if ( class_exists( 'Kirki_Control_Base' ) ) {
		/**
		 * The custom control class
		 */
		class CSCO_Kirki_Collapsible extends Kirki_Control_Base {
			/**
			 * Control's Type.
			 *
			 * @since 3.4.0
			 * @var string
			 */
			public $type = 'collapsible';

			/**
			 * Renders the control content.
			 *
			 * @since 0.1
			 * @access protected
			 * @return void
			 */
			protected function render_content() {

				$collapsed_class = null;

				if ( isset( $this->input_attrs['collapsed'] ) && $this->input_attrs['collapsed'] ) {
					$collapsed_class = 'customize-collapsed';
				}
				?>
				<div class="customize-collapsible <?php echo esc_attr( $collapsed_class ); ?>"><h3><?php echo esc_attr( $this->label ); ?></h3></div>
				<?php
			}
		}

		// Register our custom control with Kirki.
		add_filter( 'kirki_control_types', function( $controls ) {
			$controls['collapsible'] = 'CSCO_Kirki_Collapsible';
			return $controls;
		} );
	}
} );
