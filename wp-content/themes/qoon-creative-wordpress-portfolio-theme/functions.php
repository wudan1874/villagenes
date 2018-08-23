<?php
/* ======================================= */
/* Theme Functions */
/* ======================================= */
if ( ! isset( $content_width ) ) $content_width = 1100; /* pixels */

/* Makes theme available for translation. */
add_action('after_setup_theme', 'qoon_theme_setup');
function qoon_theme_setup(){
load_theme_textdomain( 'qoon-creative-wordpress-portfolio-theme', get_template_directory() . '/languages' );
}

/**
 * Include Framework. (Theme options)
 */ 
if ( !class_exists( 'ReduxFramework' ) && file_exists(get_template_directory() . '/theme-options/ReduxCore/framework.php' ) ) {
	require_once( trailingslashit( get_template_directory() ) . '/theme-options/ReduxCore/framework.php' );
	function qoon_removeDemoModeLink() {
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
add_action('init', 'qoon_removeDemoModeLink');

}

if ( !isset( $ct_options ) && file_exists( get_template_directory() . '/theme-options/options.php' ) ) {
	require_once( trailingslashit( get_template_directory() ) . '/theme-options/options.php' );
}


/* ======================================= */
/* Theme Stylesheets */
/* ======================================= */

function qoon_styles_basic()  
{
	$oi_qoon_options = get_option('oi_qoon_options');
	/* Enqueue Stylesheets */
	wp_enqueue_style( 'qoon_stylesheet', get_stylesheet_uri(), array(), '1', 'all' ); // Main Stylesheet
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/framework/css/animate.css', array(), '1', 'all' );
	// wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/framework/FlexSlider/flexslider.css', array(), '1', 'all' );
	// wp_enqueue_style( 'fullpage', get_template_directory_uri() . '/framework/css/jquery.fullpage.min.css', array(), '1', 'all' );
	// wp_enqueue_style( 'carousel', get_template_directory_uri() . '/framework/css/owl.carousel.css', array(), '1', 'all' );
	// wp_enqueue_style( 'remodal', get_template_directory_uri() . '/framework/css/remodal.css', array(), '1', 'all' );
	// wp_enqueue_style( 'remodal_theme', get_template_directory_uri() . '/framework/css/remodal-default-theme.css', array(), '1', 'all' );
	// wp_enqueue_style( 'tipso', get_template_directory_uri() . '/framework/css/tipso.min.css', array(), '1', 'all' );
	// wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri() . '/framework/css/perfect-scrollbar.min.css', false, '1.0.0'); 
	wp_enqueue_style('lightcase', get_template_directory_uri() . '/framework/lightcase/lightcase.css', false, '1.0.0'); 
	wp_enqueue_style('qoon_slider_css', get_template_directory_uri() . '/framework/qoon_slider/qoon_slider.css', false, '1.0.0'); 
	// wp_enqueue_style('qoon_woocommerce_css', get_template_directory_uri() . '/framework/css/woocommerce.css', false, '1.0.0'); 
	wp_enqueue_style('qoon_concent', get_template_directory_uri() . '/framework/css/layout/qoon_'.$oi_qoon_options['site-layout'].'.css', false, '1.2');
	// wp_enqueue_style('hover-demo', get_template_directory_uri() . '/framework/css/demo.css', false, '1.0.0'); 
	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );

	}
}  
add_action( 'wp_enqueue_scripts', 'qoon_styles_basic', 1 ); 

function qoon_load_custom_wp_admin_style() {
	wp_register_style( 'qoon_custom_wp_admin_css', get_template_directory_uri() . '/framework/css/qoon_wp-admin.css', false, '1.0.0' );
	wp_enqueue_style( 'qoon_custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'qoon_load_custom_wp_admin_style' );

/* index load style */
function wpse_enqueue_page_template_style_index() {
	if ( is_page_template( 'framework/index-xx.php' ) ) {
		
		wp_enqueue_style('set2', get_template_directory_uri() . '/framework/css/set2.css', false, '1.0.0'); 

		wp_enqueue_script('AnimOnScroll', get_template_directory_uri().'/framework/js/AnimOnScroll.js',  array( 'jquery' ), '1.0.0', true );
    }
}
add_action('wp_enqueue_scripts', 'wpse_enqueue_page_template_style_index', 1);


/* ======================================= */
/* Loading Theme Scripts */
/* ======================================= */
add_action('wp_enqueue_scripts', 'qoon_load_scripts');
if ( !function_exists( 'qoon_load_scripts' ) ) {
	function qoon_load_scripts() {
		$oi_qoon_options = get_option('oi_qoon_options');
		// wp_enqueue_script('qoon_console_text', get_template_directory_uri().'/framework/js/qoon_console_text.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('qoon_scroll', get_template_directory_uri().'/framework/js/qoon_smoothscroll.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('bootstrap', get_template_directory_uri().'/framework/bootstrap/bootstrap.min.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('lightbox', get_template_directory_uri().'/framework/js/lightbox.min.js',  array( 'jquery' ), '1.0.0', false );
		// wp_enqueue_script('flexslider', get_template_directory_uri().'/framework/FlexSlider/jquery.flexslider-min.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('fullpage', get_template_directory_uri().'/framework/js/jquery.fullpage.min.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('gmap3', get_template_directory_uri().'/framework/js/gmap3.min.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('owl.carousel', get_template_directory_uri().'/framework/js/owl.carousel.min.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('remodal', get_template_directory_uri().'/framework/js/remodal.min.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('perfect-scrollbar', get_template_directory_uri().'/framework/js/perfect-scrollbar.jquery.min.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('qoon_slider_js', get_template_directory_uri().'/framework/qoon_slider/qoon_slider.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('lightcase', get_template_directory_uri().'/framework/lightcase/lightcase.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('hoverinit', get_template_directory_uri().'/framework/js/hoverinit.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('waitimages', get_template_directory_uri().'/framework/js/jquery.waitforimages.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('imagesloaded', get_template_directory_uri().'/framework/js/imagesloaded.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('BackgroundCheck', get_template_directory_uri().'/framework/js/backgroundcheck.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('jquery.appear', get_template_directory_uri().'/framework/js/jquery.appear.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('qoon_custom', get_template_directory_uri().'/framework/js/qoon_custom.js',  array( 'jquery' ), '1.0.0', true );

		$check_url = array(
			// 'if_home' => $_SERVER['PHP_SELF'] == '/index.php'? 'yes':'no',
			'if_home' => is_front_page()?'yes':'no',
		);
		wp_enqueue_script('qoon_layout', get_template_directory_uri().'/framework/js/qoon_custom_'.$oi_qoon_options['site-layout'].'.js',  array( 'jquery' ), '1.0.0', true );
		wp_localize_script( 'qoon_layout', 'check_url', $check_url );
		// wp_enqueue_script('tipso', get_template_directory_uri().'/framework/js/tipso.min.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('qoon_woo', get_template_directory_uri().'/woocommerce/woo.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('TweenMax.min', get_template_directory_uri().'/framework/ScrollMagic/TweenMax.min.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('ScrollMagic', get_template_directory_uri().'/framework/ScrollMagic/ScrollMagic.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('animation.gsap', get_template_directory_uri().'/framework/ScrollMagic/plugins/animation.gsap.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('debug.addIndicators', get_template_directory_uri().'/framework/ScrollMagic/plugins/debug.addIndicators.js',  array( 'jquery' ), '1.0.0', true );
		// wp_enqueue_script('animation', get_template_directory_uri().'/framework/ScrollMagic/animation.js',  array( 'jquery' ), '1.0.0', true );
		

		//wp_enqueue_script('main', get_template_directory_uri().'/framework/js/main.js',  array( 'jquery' ), '1.0.0', true );

		wp_register_script('main',get_stylesheet_directory_uri().'/framework/js/main.js',array(),NULL,true);
		wp_enqueue_script('main');

		// $stylesheet_url = array( 'stylesheet_directory_uri' => get_stylesheet_directory_uri() );
		$resource_url = array( 
			'upload_directory_uri' => wp_upload_dir()['baseurl'],
			'more_news_url' => esc_url(get_permalink(3991)),
			'product_mode_page_url' => esc_url(get_permalink(3106)),
		);
		wp_localize_script( 'main', 'directory_uri', $resource_url );
		
		wp_enqueue_script('TweenMax', get_template_directory_uri().'/framework/js/TweenMax.min.js',  array( 'jquery' ), '1.0.0', true );

		$qoon_theme = array( 
				'theme_url' => get_template_directory_uri(),
				'is_blog' => qoon_is_blog(),
				'is_blog_t' => is_page_template( 'blog.php' ),
				'hide_empty_pag' => $oi_qoon_options['oi_empty_pag'],
				'menu_type' => $oi_qoon_options['logo-menu_onepage'],
				'home_url' => esc_url(home_url('/')),
				'home_blog' => get_option( 'page_for_posts' ),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'show_ajax' => $oi_qoon_options['oi_concept_ajax']
			);
    	wp_localize_script( 'qoon_custom', 'oi_theme', $qoon_theme );
	}    
}

function qoon_custom_register_admin_scripts() {

wp_register_script( 'qoon_custom-javascript', get_template_directory_uri().'/framework/js/admin-custom.js' );
wp_enqueue_script( 'qoon_custom-javascript' );

} // end custom_register_admin_scripts
add_action( 'admin_enqueue_scripts', 'qoon_custom_register_admin_scripts' );


/*=======================================
	Includes
=======================================*/
include_once(trailingslashit( get_template_directory() ).'/framework/functions/menus.php'); //Theme Menu
include_once(trailingslashit( get_template_directory() ).'/framework/functions/sidebars.php'); //Sidebars
include_once(trailingslashit( get_template_directory() ).'/framework/functions/thumbs.php'); //Thumbnails
include_once(trailingslashit( get_template_directory() ).'/framework/functions/misc.php'); //Misc
include_once(trailingslashit( get_template_directory() ).'/framework/functions/extrafields.php'); //ExtraFields
include_once(trailingslashit( get_template_directory() ).'/framework/functions/breadcrumbs.php'); //Thumbnails
include_once(trailingslashit( get_template_directory() ).'/framework/qoon_ajax.php'); //Thumbnails
include_once(trailingslashit( get_template_directory() ).'/ajax-data.php'); //Thumbnails


/*=======================================
	TGM Plugins Activations
=======================================*/
require_once (trailingslashit( get_template_directory() ) . '/framework/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'qoon_register_required_plugins' );
function qoon_register_required_plugins() {
	$plugins = array(

		  array(
			'name'     				=> __('Envato Market','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'envato-market', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/envato-market.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		 array(
			'name'     				=> __('Visual Composer','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> __('Ultimate Addons for Visual Composer','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'Ultimate_VC_Addons', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/Ultimate_VC_Addons.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> __('OI Shortcodes','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'oi-shortcodes', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/oi-shortcodes.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> __('Slider Revolution','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		
		array(
			'name'     				=> __('OI Portfolio','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'oi-portfolio', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/oi-portfolio.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> __('OI Testimonials','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'oi-testimonials', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/oi-testimonials.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> __('OI Widgets','qoon-creative-wordpress-portfolio-theme'), // The plugin name
			'slug'     				=> 'oi-widgets', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/oi-widgets.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),


	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
};




// Add specific CSS class by filter
add_filter( 'body_class', 'qoon_extra_body_class' );
function qoon_extra_body_class( $classes ) {
	global $post;
	$oi_qoon_options = get_option('oi_qoon_options');
	$oi_blog_page_id = get_option( 'page_for_posts' );
	$oi_body_class = 'oi_site_layout-'.$oi_qoon_options['site-layout'];
	if(post_password_required()){$oi_body_class .=' oi_pwd_proteced '; } 
	if($oi_qoon_options['site-layout'] === 'left-menu'){
		if (qoon_is_blog () || is_search()){
			if(get_post_meta($oi_blog_page_id, 'sidebarss_position', 1) =='Left Sidebar'){$oi_body_class .= ' oi_left_sb ';};
			if(get_post_meta($oi_blog_page_id, 'sidebarss_position', 1) =='Right Sidebar'){$oi_body_class .= ' oi_right_sb ';};
			if(get_post_meta($oi_blog_page_id, 'sidebarss_position', 1) =='Disabled'){$oi_body_class .= ' oi_disabled_sb ';};
		}else{
			if(get_post_meta($post->ID, 'cont_lay', 1) =="Full Page"){$oi_body_class.=' oi_will_be_full_page ';};
			if(get_post_meta($post->ID, 'sidebarss_position', 1) =='Left Sidebar'){$oi_body_class .= ' oi_left_sb ';};
			if(get_post_meta($post->ID, 'sidebarss_position', 1) =='Right Sidebar'){$oi_body_class .= ' oi_right_sb ';};
			if(get_post_meta($post->ID, 'sidebarss_position', 1) =='Disabled'){$oi_body_class .= ' oi_disabled_sb ';};
			if((get_post_meta($post->ID, 'oi_ps', 1) =='creative')) {$oi_body_class .= ' oi_ps_'.get_post_meta($post->ID, 'oi_ps', 1).' oi_will_be_full_page ';}
			if((get_post_meta($post->ID, 'oi_ps', 1) =='modern')) {$oi_body_class .= ' oi_ps_'.get_post_meta($post->ID, 'oi_ps', 1).' oi_will_be_full_page ';}
		}
	}
	// add 'class-name' to the $classes array
	$classes[] = $oi_body_class;
	// return the $classes array
	return $classes;
}


//Woocpmmerce
add_action( 'after_setup_theme', 'qoon_woocommerce_support' );
function qoon_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
if ( class_exists( 'WooCommerce' ) ) {
// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
// Removes the "shop" title on the main shop page
function woo_hide_page_title() {
	return false;
}


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
<div class="oi_head_cart">
    <a class="" href="<?php echo WC()->cart->get_cart_url(); ?>"><span class="oi_cart_icon"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'orangeidea' ), WC()->cart->cart_contents_count ); ?></span></a>
</div>
<?php
	$fragments['div.oi_head_cart'] = ob_get_clean();
	return $fragments;
}


function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 2;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 2; // arranged in 2 columns
	return $args;
}

if ($_GET['per_page']!=''){$oi_qoon_options['oi_shop_per_page'] = $_GET['per_page'];}

// Display products per page. 
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$oi_qoon_options['oi_shop_per_page'].';' ), 20 );
}


function qoon_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <h2>' . __( "PRIVATE PAGE" ) . '</h2>
    <div></div><label for="' . $label . '">' . __( "Enter Your Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'qoon_password_form' );

//menu feature
add_filter( 'wp_nav_menu_objects', 'active_wp_nav_menu_objects' );
function active_wp_nav_menu_objects( $sorted_menu_items )
{
    foreach ( $sorted_menu_items as $menu_item ) {
        if ( $menu_item->current ) {
            $GLOBALS['current_title'] = $menu_item->title;
            $GLOBALS['current_id'] = $menu_item->ID;
            break;
        }
    }

	$i_class = "'fa fa-long-arrow-left'";

	if(empty($GLOBALS['current_id'])){

	}
	else
	{
		if( $GLOBALS['current_id'] == "2859" || $GLOBALS['current_id'] == "2910" || $GLOBALS['current_id'] == "3556" || $GLOBALS['current_id'] == "3043" || $GLOBALS['current_id'] == "4202" || $GLOBALS['current_id'] == "3146")
		{
		}else{
			echo '
				<script type=text/javascript>
					jQuery(function($) {
						$current_item = $("#menu-item-' . $GLOBALS["current_id"]. '");

						if( $current_item.find(".sub-menu").length != 0)
						{
							$current_item.find(" > ul").prepend("<li class=oi_go_back><span><i class='.$i_class.'></i> '.$GLOBALS["current_title"].'</span></li>");
							$current_item.parent().find("> li > a").animate({"opacity":0}, 100);
							$current_item.find("> ul").css("display","block").animate({"opacity":1	,"margin-left":0}, 1000);
						}
						else{
							$parent_title = $current_item.parent().parent().find(" > a").html();
							$current_item.parent().parent().find(" > ul").prepend("<li class=oi_go_back><span><i class='.$i_class.'></i>"+$parent_title+"</span></li>");
							$current_item.parent().parent().parent().find("> li > a").css("pointer-events", "none").animate({"opacity":0}, 100);
							$current_item.parent().parent().find("> ul").css("display","block").animate({"opacity":1	,"margin-left":0}, 1000);
						}
						
						$(".oi_go_back").click(function(e) {
							$(this).parent().animate({"opacity":0}, 100).css("display","none").css("margin-left","100px");
							$(this).parent().parent().parent().find(">li > a").css("pointer-events", "auto").animate({"opacity":1}, 100)	
							$(this).remove();
						});
						
					});

				</script>
			';
		}
	}
	

    return $sorted_menu_items;
    
}

//IP member slider
add_shortcode('ip_slider', 'ip_slider');

function ip_slider() {

	echo '
	<div class="index-ip-slider-box">
		<div class="btn left"/>
			<p>PREV</p>
			<p class="glyphicon glyphicon-arrow-left"></p>
		</div>
	    <div class="index-ip-slider-container">
	    	<div class="index-ip-slider-main"></div>
	    </div>
	    <div class="btn right"/>
	    	<p>SUIVANT</p>
	    	<p class="glyphicon glyphicon-arrow-right"></p>
	    </div>
	</div>
	';
}

//News slider
add_shortcode('news_slider', 'news_slider');

function news_slider() {

	echo '
	<div class="index-news-container">
		<div class="index-news">
			<div class="index-news-btns lefts"/>
				<p>PREV</p>
				<p class="glyphicon glyphicon-arrow-left"></p>
			</div>
			<div class="index-news-newsbanner-container">
				<div class="index-news-newsbanners"></div>
			</div>
			<div class="index-news-btns rights"/>
		    	<p>SUIVANT</p>
		    	<p class="glyphicon glyphicon-arrow-right"></p>
		    </div>
		    <div class="clear"></div>
		</div>
	</div>
	';
}

/* check if user using smaller mobile device */
function my_wp_is_mobile() {
	include_once ( get_template_directory() . '/Mobile_Detect.php');
	$detect = new Mobile_Detect;
	if( $detect->isMobile() && !$detect->isTablet() ) {
		return true;
	} else {
		return false;
	}
}

/* load js for more news page */

function wpse_enqueue_page_template_scripts() {
	if ( is_page_template( 'framework/more-news.php' ) ) {
		
		wp_enqueue_script('modernizr.custom', get_template_directory_uri().'/framework/js/modernizr.custom.js',  array( 'jquery' ), '1.0.0', true );

		wp_enqueue_script('masonry-docs', get_template_directory_uri().'/framework/js/masonry.pkgd.min.js',  array( 'jquery' ), '1.0.0', true );

        wp_enqueue_script('classie', get_template_directory_uri().'/framework/js/classie.js',  array( 'jquery' ), '1.0.0', true );

		wp_enqueue_script('AnimOnScroll', get_template_directory_uri().'/framework/js/AnimOnScroll.js',  array( 'jquery' ), '1.0.0', true );
    }
}
add_action('wp_enqueue_scripts', 'wpse_enqueue_page_template_scripts', 20);

//login-img
function custom_loginlogo() {
echo '<style type="text/css">
h1 a {background-image: url('. wp_upload_dir()['baseurl'].'/2018/01/login_img.png) !important; }
</style>';
}
add_action('login_head', 'custom_loginlogo');

// for debug use w_log, added by Tony
if (!function_exists('w_log')) {
    function w_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}


//News form
add_shortcode('sub_form', 'sub_form');

function sub_form() {

	echo '
	<form id="contact-form" action="https://api.villagenes.cn/forms/index.php/contact/wpforms/" method="post" class="xx-contact-form " target="id_iframe" novalidate="novalidate">

        <p><span class="fa fa-user"></span><span class="wpcf7-form-control-wrap your-name"><input type="text" name="names"  size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Your Name"></span></p>
        <p><span class="fa fa-envelope"></span><span class="wpcf7-form-control-wrap your-email"><input type="email" name="email"  size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-email" aria-invalid="false" placeholder="Your Email"></span></p>
        <p><span class="fa fa-folder"></span><span class="wpcf7-form-control-wrap your-subject"><input type="text" name="subject"  size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Subject"></span></p>
        <p><span class="fa fa-pencil"></span><span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span></p>
        <p><input type="hidden" value="Villie_Contact" name="type"></p>
        <p><input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit"><span class="ajax-loader"></span></p>
        <div class="tips  wpcf7-response-output wpcf7-display-none"></div>

    </form>
     <iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>
	';
}


?>