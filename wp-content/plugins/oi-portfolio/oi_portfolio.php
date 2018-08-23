<?php
/**
* Plugin Name: OI Portfolio
* Plugin URI: http://themeforest.net/user/OrangeIdea
* Description: Portfolio Plugin.
* Version: 1.0.1
* Author: OrangeIdea
* Author URI: http://themeforest.net/user/OrangeIdea
* License: 
*/

add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
    if ( get_post_type() == 'portfolio' ) {
        if ( is_single() ) {

                $template_path = dirname( __FILE__ ) . '/single-portfolio.php';
        }
    }
    return $template_path;
}


/* ------------------------------------------------------------------------ */
/* Plugin Scripts */
/* ------------------------------------------------------------------------ */
add_action('wp_enqueue_scripts', 'oi_plugin_scripts');
if ( !function_exists( 'oi_plugin_scripts' ) ) {
	function oi_plugin_scripts() {
		wp_enqueue_script('oi_custom_plugin',plugin_dir_url( __FILE__ ).'framework/js/custom_plugin.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('oi_Waitimages', plugin_dir_url( __FILE__ ).'framework/js/jquery.waitforimages.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('oi_isotope', plugin_dir_url( __FILE__ ).'framework/js/isotope.pkgd.min.js',  array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script('oi_imagesloaded', plugin_dir_url( __FILE__ ).'framework/js/imagesloaded.js',  array( 'jquery' ), '1.0.0', true );
		$oi_theme_plugin = array( 
				'theme_url' => plugin_dir_url( __FILE__ ),
			);
    	wp_localize_script( 'oi_custom_plugin', 'oi_theme_plugin', $oi_theme_plugin );
	}    
}


/* ------------------------------------------------------------------------ */
/* Portfolio Post Type.  */
/* ------------------------------------------------------------------------ */



//Create Post Formats
add_action( 'init', 'oi_portfolio' );
function oi_portfolio() {
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name' => __( 'IP Member', 'orangeidea' ),
				'singular_name' => __( 'IP Member', 'orangeidea' ),
				'new_item' => __( 'Add New IP Member', 'orangeidea' ),
				'add_new_item' => __( 'Add New IP Member', 'orangeidea' ),
				'breadcrumbs_name' => __( '平台IP会员', 'orangeidea' )
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			'capability_type' => 'post',
			'menu_position'       => 4,
			'menu_icon'           => "dashicons-nametag",
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'publicly_queryable' => true,
			'rewrite' => array('slug' => 'ip_member'),
		)
	);
}


function oi_portfolio_taxonomies() {
	// Portfolio Categories	
	
	$labels = array(
		'add_new_item' => 'Add New Category',
		'all_items' => 'All Categories' ,
		'edit_item' => 'Edit Category' , 
		'name' => 'IP Member Categories', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Category' ,
		'menu_name' => 'IP Member Categories' ,
		'parent_item' => 'Parent Category' ,
		'parent_item_colon' => 'Parent Category:',
		'singular_name' => 'IP Member Category', 'taxonomy singular name' ,
		'search_items' =>  'Search Categories' ,
		'update_item' => 'Update Category' ,
	);
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ip_member/category' ),
		'show_ui' => true,
	));
	
	
	// Portfolio Tags	
	
	$labels = array(
		'add_new_item' => 'Add New Tag' ,
		'all_items' => 'All Tags' ,
		'edit_item' => 'Edit Tag' , 
		'menu_name' => 'IP Member Tags' ,
		'name' => 'IP Member Tags', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Tag' ,
		'parent_item' => 'Parent Tag' ,
		'parent_item_colon' => 'Parent Tag:' ,
		'singular_name' =>  'IP Member Tag', 'taxonomy singular name' ,
		'search_items' =>   'Search Tags' ,
		'update_item' => 'Update Tag' ,
	);
	register_taxonomy( 'portfolio-tags', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ip_member/tag' ),
		'show_ui' => true,
	));


	// Portfolio Product Tags	
	
	$labels = array(
		'add_new_item' => 'Add New Product Tag' ,
		'all_items' => 'All Product Tags' ,
		'edit_item' => 'Edit Product Tag' , 
		'menu_name' => 'IP Member Product Tags' ,
		'name' => 'IP Member Product Tags', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Product Tag' ,
		'parent_item' => 'Parent Product Tag' ,
		'parent_item_colon' => 'Parent Product Tag:' ,
		'singular_name' =>  'IP Member Product Tag', 'taxonomy singular name' ,
		'search_items' =>   'Search Product Tags' ,
		'update_item' => 'Update Product Tag' ,
	);
	register_taxonomy( 'portfolio-product-tags', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'ip_member/product_tag' ),
		'show_ui' => true,
	));
	
		
}

add_action( 'init', 'oi_portfolio_taxonomies', 0 );




class PageTemplater {
	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;
	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;
	/**
	 * Returns an instance of this class. 
	 */
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		} 
		return self::$instance;
	} 
	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {
		$this->templates = array();
		// Add a filter to the attributes metabox to inject template into the cache.
        	if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) { // 4.6 and older
            		add_filter(
                		'page_attributes_dropdown_pages_args',
                		array( $this, 'register_project_templates' )
            		);
        	} else { // Add a filter to the wp 4.7 version attributes metabox
            		add_filter(
                		'theme_page_templates', array( $this, 'add_new_template' )
            		);
        	}
		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data', 
			array( $this, 'register_project_templates' ) 
		);
		// Add a filter to the template include to determine if the page has our 
		// template assigned and return it's path
		add_filter(
			'template_include', 
			array( $this, 'view_project_template') 
		);
		// Add your templates to this array.
		$this->templates = array(
			'portfolio.php' => 'Portfolio',
		);
			
	} 
	/**
     	 * Adds our template to the page dropdown for v4.7+
     	 *
     	 */
    	public function add_new_template( $posts_templates ) {
        	$posts_templates = array_merge( $posts_templates, $this->templates );
        	return $posts_templates;
    	}
	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 */
	public function register_project_templates( $atts ) {
		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
		// Retrieve the cache list. 
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		} 
		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');
		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );
		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );
		return $atts;
	} 
	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {
		
		// Get global post
		global $post;
		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}
		// Return default template if we don't have a custom one defined
		if ( !isset( $this->templates[get_post_meta( 
			$post->ID, '_wp_page_template', true 
		)] ) ) {
			return $template;
		} 
		$file = plugin_dir_path(__FILE__). get_post_meta( 
			$post->ID, '_wp_page_template', true
		);
		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}
		// Return template
		return $template;
	}
} 
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );


/* ------------------------------------------------------------------------ */
/* Extra Fields.  */
/* ------------------------------------------------------------------------ */
add_action('admin_init', 'extra_fields_plugins', 0);
function extra_fields_plugins() {
	add_meta_box( 'extra_fields_plugin', 'IP Additional settings', 'extra_fields_for_portfolio', 'portfolio', 'normal', 'high'  );
	add_meta_box( 'extra_fields_plugin', 'IP Portfolio Page settings', 'extra_fields_for_pages_plugin', 'page', 'normal', 'high'  );
}

add_action( 'save_post', function( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'mam_nonce' ] ) && wp_verify_nonce( $_POST[ 'mam_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // If the checkbox was not empty, save it as array in post meta
    if ( ! empty( $_POST['multval'] ) ) {
        update_post_meta( $post_id, 'sp_ids', $_POST['multval'] );

    // Otherwise just delete it if its blank value.
    } else {
        delete_post_meta( $post_id, 'sp_ids' );
    }

});


function extra_fields_for_portfolio( $post ){
	?>
	<h4>IP subtitle</h4>
    <input type="text" name="extra[ip-subtitle]" value="<?php echo get_post_meta($post->ID, 'ip-subtitle', true); ?>" />


	<h4>IP slider image</h4>
	<input class="custom_media_url" id="abc" type="text" name="extra[ip-img]" value="<?php echo get_post_meta($post->ID, 'ip-img', true); ?>" style="margin-bottom:10px; clear:right;">
    <a href="#" class="button custom_media_upload">Upload</a>
    <img class="custom_media_image" src="<?php echo get_post_meta($post->ID, 'ip-img', true); ?>" style="max-width:100px; float:left; margin: 0px 10px 0px 0px; display:inline-block;" />
        <script>
        jQuery(document).ready(function($){

        	$('.custom_media_upload').click(function() {

        	        var send_attachment_bkp = wp.media.editor.send.attachment;
        	        var button = $(this);

        	        wp.media.editor.send.attachment = function(props, attachment) {

        	            $(button).prev().prev().attr('src', attachment.url);
        	            $(button).prev().val(attachment.url);

        	            wp.media.editor.send.attachment = send_attachment_bkp;
        	        }

        	        wp.media.editor.open(button);

        	        return false;       
        	    });

        	});
        </script>

	<h4>Show on index IP Slider?</h4>
    <select name="extra[port_slidercheck]">
    <?php
    $port_slidercheck = array (
	"no"  => array("name" => "No"),
    "yes"  => array("name" => "Yes"),
    );
    ?>
    <?php foreach ($port_slidercheck as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_slidercheck', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>

	<?php
	wp_nonce_field( basename(__FILE__), 'mam_nonce' );
	$postmeta = maybe_unserialize( get_post_meta( $post->ID, 'sp_ids', true ) );
	
	$args = array('post_type' => 'portfolio-sp');
	$the_query = new WP_Query( $args );
	?>
	
    <h4>Select the Strategic Partner that belongs to:</h4>
    
    <?php
    	if ($the_query->have_posts()) {
    		while($the_query->have_posts()) {
    			$the_query->the_post();
    			if ( is_array( $postmeta ) && in_array( $the_query->post->ID, $postmeta ) ) {
		            $checked = 'checked="checked"';
		        } else {
		            $checked = null;
		        }
    ?>

    	 		<input type="checkbox" name="multval[]" value="<?php echo $the_query->post->ID;?>" <?php echo $checked; ?> /><?php echo get_the_title($the_query->post->ID); ?><br />


	<?php
			}
			wp_reset_postdata();
    	 } 

    	// var_dump($postmeta);
    ?>

    <hr>

    <h4>Hover BG color</h4>
    <input type="text" name="extra[port-bg]" value="<?php echo get_post_meta($post->ID, 'port-bg', true); ?>" />
    <h4>Hover TEXT color</h4>
    <input type="text" name="extra[port-text-color]" value="<?php echo get_post_meta($post->ID, 'port-text-color', true); ?>" />
    <h4>Thumbnail</h4>
    <select name="extra[oi_th]">
    <?php $oi_thumb_array = array(
		'1' => 'portfolio-squre',
		'2' => 'portfolio-squrex2',
		'3' => 'portfolio-wide',
		'4' => 'portfolio-long'
		);?>
    <?php foreach ($oi_thumb_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_th', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val) ?>"><?php echo esc_attr($val) ?></option>
	<?php } ?>
    </select>
    
    <h4><?php _e('Show Breadcrumbs','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[port_bread]">
    <?php
    $port_bread = array (
    "yes"  => array("name" => "Yes"),
    "no"  => array("name" => "No"),
    );
    ?>
    <?php foreach ($port_bread as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_bread', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    
    <h4><?php _e('Contant Layout','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[port_cont_lay]">
    <?php
    $port_cont_lay = array (
    "with_paddings"  => array("name" => "Normal"),
	"full_page"  => array("name" => "Full Page"),
	"full_page_scroll"  => array("name" => "Full Page Raw Scroller"),
    );
    ?>
    <?php foreach ($port_cont_lay as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_cont_lay', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    <h4><?php _e('Featured Image Height','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[feat_h]">
    <?php
    $feat_h = array (
    "Do Not Show"  => array("name" => "Do Not Show"),
	"1/3"  => array("name" => "1/3"),
    "1/2"  => array("name" => "1/2"),
	"1/1"  => array("name" => "Full Screen"),
    );
    ?>
    <?php foreach ($feat_h as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'feat_h', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    <h4><?php _e('Featured Image Position','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[feat_h_pos]">
    <?php
    $feat_h_pos = array (
    "center bottom"  => array("name" => "center bottom"),
    "center center"  => array("name" => "center center"),
	"center top"  => array("name" => "center top"),
    );
    ?>
    <?php foreach ($feat_h_pos as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'feat_h_pos', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    <h4><?php _e('Slider instead Featured Image?','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[rev_s]">
    <?php
	$slider = new RevSlider();
	$slugs = $slider->getAllSliderAliases();
	array_unshift($slugs, "Do not use Slider");
    ?>
    <?php foreach ($slugs as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'rev_s', 1)) { echo 'selected';} ?> value="<?php echo $val ?>"><?php echo $val ?></option>
    <?php } ?>
    </select>
    
    
    <h4><?php _e('Description (For Creative Style Only)','qoon-creative-wordpress-portfolio-theme')?></h4>
    <textarea rows="10" style="width:100%" type="text" name="extra[port-description]" value="<?php echo esc_textarea(get_post_meta($post->ID, 'port-description', true)); ?>" ><?php echo esc_textarea(get_post_meta($post->ID, 'port-description', true)); ?></textarea>
	
<?php };


	add_filter('manage_posts_columns', 'posts_columns_id', 5);
    add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
    add_filter('manage_pages_columns', 'posts_columns_id', 5);
    add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);

function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
        if($column_name === 'wps_post_id'){
                echo $id;
    }
}

add_filter('manage_posts_columns', 'posts_columns', 1);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs');
    return $defaults;
}

function posts_custom_columns($column_name, $id){
        if($column_name === 'riv_post_thumbs'){
        echo the_post_thumbnail( 'thumbnail' );
    }
};


function extra_fields_for_pages_plugin( $post ){
?>
    <div style="padding:20px; border:1px solid #eaeaea; background:#f6f6f6; margin:20px;">
    <h2>For IP Portfolio Templates.</h2>
    <hr>
    
    <h4>IP Portfolio Style</h4>
    <select id="oi_ps" name="extra[oi_ps]">
    <?php $oi_ps_array = array(
		'1' => 'standard',
		'2' => 'creative',
		'3' => 'modern',
		);?>
    <?php foreach ($oi_ps_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_ps', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val) ?>"><?php echo esc_attr($val) ?></option>
	<?php } ?>
    </select>
    
    <h4>Portfolio page width</h4>
    <select id="oi_ps_w" name="extra[oi_ps_w]">
    <?php $oi_ps_w_array = array(
		'1' => 'boxed',
		'2' => 'fullwidth',
		);?>
    <?php foreach ($oi_ps_w_array as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'oi_ps_w', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val) ?>"><?php echo esc_attr($val) ?></option>
	<?php } ?>
    </select>
    <h4>Show posts from (Use TAGS)</h4>
    <?php $tags = get_categories('taxonomy=portfolio-tags&orderby=name'); ?>
    <select name="extra[oi_tag]">
        <option <?php if ("All" == get_post_meta($post->ID, 'oi_tag', 1)) { echo 'selected';} ?> value="All">All</option>
        <?php
        foreach ( $tags as $val ) {  ?>
        <option <?php if ($val->name == get_post_meta($post->ID, 'oi_tag', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val->name) ?>"><?php echo esc_attr($val->name) ?></option>
        <?php } ?>
    </select>

    <h4>Show posts from (Use PRODUCT TAGS)</h4>
    <?php $tags = get_categories('taxonomy=portfolio-product-tags&orderby=name'); ?>
    <select name="extra[oi_ptag]">
        <option <?php if ("All" == get_post_meta($post->ID, 'oi_ptag', 1)) { echo 'selected';} ?> value="All">All</option>
        <?php
        foreach ( $tags as $val ) {  ?>
        <option <?php if ($val->name == get_post_meta($post->ID, 'oi_ptag', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val->name) ?>"><?php echo esc_attr($val->name) ?></option>
        <?php } ?>
    </select>
    
    <h4>Show posts from (Use CATEGORIES)</h4>
    <?php $categories = get_categories('taxonomy=portfolio-category&orderby=name'); ?>
    <select name="extra[oi_category]">
        <option <?php if ("All" == get_post_meta($post->ID, 'oi_category', 1)) { echo 'selected';} ?> value="All">All</option>
        <?php
        foreach ( $categories as $val ) {  ?>
        <option <?php if ($val->name == get_post_meta($post->ID, 'oi_category', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val->name) ?>"><?php echo esc_attr($val->name) ?></option>
        <?php } ?>
    </select>
    
    <div id="oi_p_creative">
    </div>
    
    <div id="oi_p_standard">
	
    <h4>Page Content Position?</h4>
    <select style="width:50%;" name="extra[port_page]">
    <?php
    $oi_port_page = array (
    "top"  => array("name" => "Top"),
    "bottom"  => array("name" => "Bottom"),
    );
    ?>
    <?php foreach ($oi_port_page as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_page', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>Portfolio Layout</h4>
    <select style="width:50%;" name="extra[port_layout]">
    <?php
    $oi_port_lay = array (
    "rtws"  => array("name" => "Random Thumbnails With Spaces"),
    "rtwos"  => array("name" => "Random Thumbnails Without Spaces"),
	"sqws"  => array("name" => "Square Thumbnails With Spaces"),
	"sqwos"  => array("name" => "Square Thumbnails Without Spaces"),
	"fsqws"  => array("name" => "4 Square Thumbnails With Spaces"),
	"fsqwos"  => array("name" => "4 Square Thumbnails Without Spaces"),
	"htwos"  => array("name" => "Half Thumbnails Without Spaces"),
	"htws"  => array("name" => "Half Thumbnails With Spaces"),
    );
    ?>
    <?php foreach ($oi_port_lay as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_layout', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>How many posts to show?</h4>
    <input type="text" name="extra[port-count]" value="<?php echo esc_attr(get_post_meta($post->ID, 'port-count', true)); ?>" />
	<h4>Show "Load More"?</h4>
    <select style="width:50%;" name="extra[port_load_more]">
    <?php
    $oi_port_load_more = array (
    "yes"  => array("name" => "Yes"),
    "no"  => array("name" => "No"),
    );
    ?>
    <?php foreach ($oi_port_load_more as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_load_more', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>Show Filters?</h4>
    <select style="width:50%;" name="extra[port_filters]">
    <?php
    $oi_port_filters = array (
    "yes"  => array("name" => "Yes"),
    "no"  => array("name" => "No"),
    );
    ?>
    <?php foreach ($oi_port_filters as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'port_filters', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val['name']) ?>"><?php echo esc_attr($val['name']) ?></option>
    <?php } ?>
    </select>
    <h4>How many posts to load on button click?</h4>
    <input type="text" name="extra[port-load_count]" value="<?php echo esc_attr(get_post_meta($post->ID, 'port-load_count', true)); ?>" />
    </div>
    </div>
<?php }

?>