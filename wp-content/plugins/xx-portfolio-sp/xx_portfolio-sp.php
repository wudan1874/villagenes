<?php
/**
* Plugin Name: XX Portfolio for Strategic Partner
* Plugin URI: 
* Description: Portfolio for Strategic Partner Plugin.
* Version: 1.0.1
* Author: Tony Wu
* License: 
*/

add_filter( 'template_include', 'include_template_function_sp', 1 );
function include_template_function_sp( $template_path ) {
    if ( get_post_type() == 'portfolio-sp' ) {
        if ( is_single() ) {

                $template_path = dirname( __FILE__ ) . '/single-portfolio-sp.php';
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
/* Portfolio-sp Post Type.  */
/* ------------------------------------------------------------------------ */



//Create Post Formats
add_action( 'init', 'xx_portfolio_sp' );
function xx_portfolio_sp() {
	register_post_type( 'portfolio-sp',
		array(
			'labels' => array(
				'name' => __( 'Strategic Partner', 'orangeidea' ),
				'singular_name' => __( 'Strategic Partner', 'orangeidea' ),
				'new_item' => __( 'Add New SP', 'orangeidea' ),
				'add_new_item' => __( 'Add New SP', 'orangeidea' ),
				'menu_name'           => __( 'Strategic Partner', 'orangeidea' ),
				'breadcrumbs_name' => __( '平台战略伙伴', 'orangeidea' )
			),
			'public' => true,
			'has_archive' => false,
			'menu_position'       => 4,
			'menu_icon'           => "dashicons-universal-access-alt",
			'show_in_nav_menus'   => true,
			'supports' => array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			'capability_type' => 'post',
			'show_ui' => true,
			'publicly_queryable' => true,
			'rewrite' => array('slug' => 'portfolio-sp'),
		)
	);
}


function xx_portfolio_sp_taxonomies() {
	// Portfolio Categories	
	
	$labels = array(
		'add_new_item' => 'Add New Category',
		'all_items' => 'All Categories' ,
		'edit_item' => 'Edit Category' , 
		'name' => 'Strategic Partner Categories', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Category' ,
		'menu_name' => 'Strategic Partner Categories' ,
		'parent_item' => 'Parent Category' ,
		'parent_item_colon' => 'Parent Category:',
		'singular_name' => 'Strategic Partner Category', 'taxonomy singular name' ,
		'search_items' =>  'Search Strategic Partner Categories' ,
		'update_item' => 'Update Category' ,
	);
	register_taxonomy( 'portfolio-sp-category', array( 'portfolio-sp' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-sp/category' ),
		'show_ui' => true,
	));
	
	
	// Portfolio Tags	
	
	$labels = array(
		'add_new_item' => 'Add New Tag' ,
		'all_items' => 'All Tags' ,
		'edit_item' => 'Edit Tag' , 
		'menu_name' => 'Strategic Partner Tags' ,
		'name' => 'Strategic Partner Tags', 'taxonomy general name' ,
		'new_item_name' => 'New Genre Tag' ,
		'parent_item' => 'Parent Tag' ,
		'parent_item_colon' => 'Parent Tag:' ,
		'singular_name' =>  'Strategic Partner Tag', 'taxonomy singular name' ,
		'search_items' =>   'Search Strategic Partner Tags' ,
		'update_item' => 'Update Tag' ,
	);
	register_taxonomy( 'portfolio-sp-tags', array( 'portfolio-sp' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-sp/tag' ),
		'show_ui' => true,
	));
	
		
}

add_action( 'init', 'xx_portfolio_sp_taxonomies', 0 );




class PageTemplaterSP {
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
			self::$instance = new PageTemplaterSP();
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
			'portfolio-sp.php' => 'Portfolio-SP',
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
add_action( 'plugins_loaded', array( 'PageTemplaterSP', 'get_instance' ) );


/* ------------------------------------------------------------------------ */
/* Extra Fields.  */
/* ------------------------------------------------------------------------ */

add_action('admin_init' , 'extra_fields_for_sp', 0 );

function extra_fields_for_sp(){
	add_meta_box( 'sp_extra_fields', 'SP Portfolio Page Setting', 'extra_fields_for_portfolio_sp_pages', 'page', 'normal', 'high' ); //for page
	add_meta_box( 'sp_extra_fields_plugin', 'SP Additional settings', 'extra_fields_for_portfolio_sp_post', 'portfolio-sp', 'normal', 'high'  );
	//for post 
 }

function extra_fields_for_portfolio_sp_pages( $post ) {
?>
    <div style="padding:20px; border:1px solid #eaeaea; background:#f6f6f6; margin:20px;">
    <h2>For SP Portfolio Templates.</h2>
    <hr>
    
    <h4>Show PS portfolio posts from (Use CATEGORIES)</h4>
    <?php $categories = get_categories('taxonomy=portfolio-sp-category&orderby=name'); ?>
    <select name="extra[xx_sp_category]">
        <option <?php if ("All" == get_post_meta($post->ID, 'xx_sp_category', 1)) { echo 'selected';} ?> value="All">All</option>
        <?php
        foreach ( $categories as $val ) {  ?>
        <option <?php if ($val->name == get_post_meta($post->ID, 'xx_sp_category', 1)) { echo 'selected';} ?> value="<?php echo esc_attr($val->name) ?>"><?php echo esc_attr($val->name) ?></option>
        <?php } ?>
    </select>
	</div>
    
    
<?php 

}

function extra_fields_for_portfolio_sp_post( $post ){
?>   
    
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
 


