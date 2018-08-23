<?php
/*
 Plugin Name: Villagenes What's On
 Plugin URI: http://www.villagenes.com/
 Description: Villagenes What's On.
 Version: 1.0
 Author: Tony Wu
 Author URI: http://blog.tonywu.win/
 License: GPLv2
 */

/**
 * Registers a new post type
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 * ref: https://codex.wordpress.org/Function_Reference/register_post_type
 */


add_filter( 'template_include', 'include_news_template_function', 1 );
function include_news_template_function( $template_path ) {
    if ( get_post_type() == 'news_programmes' ) {
        if ( is_single() ) {

                $template_path = dirname( __FILE__ ) . '/single-news.php';
        }
    }
    return $template_path;
}
 
function create_news_programme() {

    $labels = array(
        'name'                => __( 'Whats On', 'text-domain' ),
        'singular_name'       => __( 'Whats On', 'text-domain' ),
        'add_new'             => _x( 'Add New Whats On', 'text-domain', 'text-domain' ),
        'add_new_item'        => __( 'Add New Whats On', 'text-domain' ),
        'edit_item'           => __( 'Edit Whats On', 'text-domain' ),
        'new_item'            => __( 'New Whats On', 'text-domain' ),
        'view_item'           => __( 'View Whats On', 'text-domain' ),
        'search_items'        => __( 'Search Whats On', 'text-domain' ),
        'not_found'           => __( 'No Whats On found', 'text-domain' ),
        'not_found_in_trash'  => __( 'No Whats On found in Trash', 'text-domain' ),
        'parent_item_colon'   => __( 'Parent Whats On:', 'text-domain' ),
        'menu_name'           => __( 'Whats On', 'text-domain' ),
        'breadcrumbs_name'    => __( '乡香热点', 'text-domain' ),
    );

    $args = array(
        'labels'                   => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => "dashicons-megaphone",
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'show_in_rest'       => true,
        'supports'            => array(
            'title', 'editor', 'author', 'thumbnail',
            'excerpt',
            // 'custom-fields',
            'revisions', 'page-attributes'
            // , 'post-formats'
        )
    );

    register_post_type( 'news_programmes', $args );
}
add_action( 'init', 'create_news_programme' );

//======
/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function create_news_programmes_taxonomies() {

    $labels = array(
        'name'					=> _x( 'Whats On Categories', 'taxonomy general name', 'text-domain' ),
        'singular_name'			=> _x( 'Whats On Category', 'taxonomy singular name', 'text-domain' ),
        'search_items'			=> __( 'Search Whats On Categories', 'text-domain' ),
        'popular_items'			=> __( 'Popular Whats On Categories', 'text-domain' ),
        'all_items'				=> __( 'All Whats On Categories', 'text-domain' ),
        'parent_item'			=> __( 'Parent Whats On Category', 'text-domain' ),
        'parent_item_colon'		=> __( 'Parent Whats On Category', 'text-domain' ),
        'edit_item'				=> __( 'Edit Whats On Category', 'text-domain' ),
        'update_item'			=> __( 'Update Whats On Category', 'text-domain' ),
        'add_new_item'			=> __( 'Add New Whats On Category', 'text-domain' ),
        'new_item_name'			=> __( 'New Whats On Category Name', 'text-domain' ),
        'add_or_remove_items'	=> __( 'Add or remove Whats On Categories', 'text-domain' ),
        'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'text-domain' ),
        'menu_name'				=> __( 'Whats On Category', 'text-domain' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
        'show_in_rest'       => true,
        'rest_base'          => 'news_programme_category',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy( 'news_programme_category', array( 'news_programmes' ), $args );

    unset( $args );
    unset( $labels );

    //Add NOT hierarchical (tags) taxonomy for TV Programme

    $labels = array(
        'name'					=> _x( 'Whats On Tags', 'taxonomy general name', 'text-domain' ),
        'singular_name'			=> _x( 'Whats On Tag', 'taxonomy singular name', 'text-domain' ),
        'search_items'			=> __( 'Search Whats On Tags', 'text-domain' ),
        'popular_items'			=> __( 'Popular Whats On Tags', 'text-domain' ),
        'all_items'				=> __( 'All Whats On Tags', 'text-domain' ),
        'parent_item'			=> null,
        'parent_item_colon'		=> null,
        'edit_item'				=> __( 'Edit Whats On Tag', 'text-domain' ),
        'update_item'			=> __( 'Update Whats On Tag', 'text-domain' ),
        'add_new_item'			=> __( 'Add New Whats On Tag', 'text-domain' ),
        'new_item_name'			=> __( 'New Whats On Tag Name', 'text-domain' ),
        'add_or_remove_items'	=> __( 'Add or remove Whats On Tags', 'text-domain' ),
        'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'text-domain' ),
        'menu_name'				=> __( 'Whats On Tag', 'text-domain' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'hierarchical'      => false,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
        // 'show_in_rest'       => true,
        // 		'rest_base'          => 'tv_programme_tag',
        // 		'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy( 'news_programme_tag', array( 'news_programmes' ), $args );
    
    unset( $args );
    unset( $labels );
    
    $labels = array(
        'name'					=> _x( 'Whats On Image', 'taxonomy general name', 'text-domain' ),
        'singular_name'			=> _x( 'Whats On Images', 'taxonomy singular name', 'text-domain' ),
        'search_items'			=> __( 'Search Whats On Images', 'text-domain' ),
        'popular_items'			=> __( 'Popular Whats On Images', 'text-domain' ),
        'all_items'				=> __( 'All Whats On Images', 'text-domain' ),
        'parent_item'			=> null,
        'parent_item_colon'		=> null,
        'edit_item'				=> __( 'Edit Whats On Images', 'text-domain' ),
        'update_item'			=> __( 'Update Whats On Images', 'text-domain' ),
        'add_new_item'			=> __( 'Add New Whats On Images', 'text-domain' ),
        'new_item_name'			=> __( 'New Whats On Images Name', 'text-domain' ),
        'add_or_remove_items'	=> __( 'Add or remove Whats On Images', 'text-domain' ),
        'choose_from_most_used'	=> __( 'Choose from most used text-domain', 'text-domain' ),
        'menu_name'				=> __( 'Whats On Image', 'text-domain' ),
    );
    
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'hierarchical'      => false,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
        // 'show_in_rest'       => true,
        // 		'rest_base'          => 'tv_programme_tag',
        // 		'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    
    register_taxonomy( 'news_programme_tag', array( 'news_programmes' ), $args );
}

add_action( 'init', 'create_news_programmes_taxonomies' );

// ==========
// function posts_for_current_author($query) {

//   if($query->is_admin) {

//         if ($query->get('post_type') == 'tv_programmes')
    //         {
    //           $query->set('orderby', 'menu_order');
    //           $query->set('order', 'ASC');
    //         }
//   }
//   return $query;
// }
// add_filter('pre_get_posts', 'posts_for_current_author');

//=================================================================================
function add_news_order_columns($columns) {
    unset($columns['author']);
    $order_colums = array('menu_order' => 'Order');
    return array_merge($columns, $order_colums);
}
add_filter('manage_news_programmes_posts_columns', 'add_news_order_columns');

function manage_news_order_columns($colum, $post_id) {
    $the_post = get_post($post_id);
    switch ($colum) {
        case 'menu_order':
            echo $the_post->menu_order;
            break;
    }
}

add_action('manage_posts_custom_column', 'manage_news_order_columns', 10, 2);

/**
 * make column sortable
 */
function order_column_register_sortable($columns){
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter('manage_edit-news_programmes_sortable_columns','order_column_register_sortable', 10, 1);


//=============================================================

function add_news_meta() {
    add_meta_box( 'news_programme_meta_box', 'News Details', 'display_news_programme_meta_box', 'news_programmes', 'advanced', 'default', null );
};

function display_news_programme_meta_box( $news_programme ){

    $attachment_id = esc_html( get_post_meta( $news_programme->ID, 'news_imgurl', true ) );
    $subtitle = esc_html( get_post_meta( $news_programme->ID, 'subtitle', true ) );
    $index_title = esc_html( get_post_meta( $news_programme->ID, 'index_title', true ) );
    $author = esc_html( get_post_meta( $news_programme->ID, 'author', true ) );
    $show_index = esc_html( get_post_meta( $news_programme->ID, 'show_index', true ) );
    ?>
    <div style="zoom: 1; overflow: auto;">
        <h4>News subtitle</h4>
        <input type="text" name="news_subtitle" value="<?php echo $subtitle; ?>" />

        <h4>Index news title</h4>
        <input type="text" name="news_index_title" value="<?php echo $index_title; ?>" />

        <h4>News author name</h4>
        <input type="text" name="news_author" value="<?php echo $author; ?>" />

        <h4>Show on index news list?</h4>
        <select name="news_show_index">
        <?php
        $news_show_index = array (
        "no"  => array("name" => "No"),
        "yes"  => array("name" => "Yes"),
        );
        ?>
        <?php foreach ($news_show_index as $val){ ?>
        <option <?php if ($val['name'] == get_post_meta($news_programme->ID, 'show_index', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
        <?php } ?>
        </select>
<!-- <input id="custom_media_id" type="text" name="attachment_id" value=""> -->
<!-- <a href="#" class="button custom_media_upload" title="Add Media">Add Media</a> -->

<!-- <script type="text/javascript"> -->

<!-- </script> -->
        <h4>Upload thumbnail image for homepage:</h4>
        <!-- Image Thumbnail -->
        <img class="custom_media_image" src="<?php echo $attachment_id; ?>" style="max-width:100px; float:left; margin: 0px 10px 0px 0px; display:inline-block;" />

        <!-- Upload button and text field -->
        <input class="custom_media_url" id="abc" type="text" name="attachment_id" value="<?php echo $attachment_id; ?>" style="margin-bottom:10px; clear:right;">
        <a href="#" class="button custom_media_upload">Upload</a>
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
    </div>
    <?php	
}

add_action( 'admin_init', 'add_news_meta' );

add_action( 'save_post', 'add_news_programme_fields', 10, 2 );

function add_news_programme_fields( $news_programme_id, $news_programme ) {
    
    // Check post type for movie reviews
    if ( $news_programme->post_type == 'news_programmes' ) {//yes
        // Store data in post meta table if present in post data
        if ( isset( $_POST['attachment_id'] ) && $_POST['attachment_id'] != '' ) {//yes
            update_post_meta( $news_programme_id, 'news_imgurl', $_POST['attachment_id'] );
        }
        if ( isset( $_POST['news_subtitle'] ) ) {//yes
            update_post_meta( $news_programme_id, 'subtitle', $_POST['news_subtitle'] );
        }
        if ( isset( $_POST['news_index_title'] ) ) {//yes
            update_post_meta( $news_programme_id, 'index_title', $_POST['news_index_title'] );
        }
        if ( isset( $_POST['news_author'] ) ) {//yes
            update_post_meta( $news_programme_id, 'author', $_POST['news_author'] );
        }
        if ( isset( $_POST['news_show_index'] ) && $_POST['news_show_index'] != '' ) {//yes
            update_post_meta( $news_programme_id, 'show_index', $_POST['news_show_index'] );
        }
    }
}
//================
function news_get_post_meta_attachment_id( $object ) {
	return get_post_meta( $object['id'], 'attachment_id');
}
function news_get_post_meta_subtitle( $object ) {
    return get_post_meta( $object['id'], 'subtitle');
}
function news_get_post_meta_index_title( $object ) {
    return get_post_meta( $object['id'], 'index_title');
}
function news_get_post_meta_author( $object ) {
    return get_post_meta( $object['id'], 'author');
}
function news_get_post_meta_show_index( $object ) {
    return get_post_meta( $object['id'], 'show_index');
}


function add_news_programme_meta_rest() {
	register_rest_field(
		'news_programmes',
		'attachment_id',
		array(
			'get_callback' => 'news_get_post_meta_attachment_id',
			'schema' => null,
			));
    register_rest_field(
        'news_programmes',
        'subtitle',
        array(
            'get_callback' => 'news_get_post_meta_subtitle',
            'schema' => null,
            ));
    register_rest_field(
        'news_programmes',
        'index_title',
        array(
            'get_callback' => 'news_get_post_meta_index_title',
            'schema' => null,
            ));
	register_rest_field(
        'news_programmes',
        'author',
        array(
            'get_callback' => 'news_get_post_meta_author',
            'schema' => null,
            ));
    register_rest_field(
        'news_show_index',
        'show_index',
        array(
            'get_callback' => 'news_get_post_meta_show_index',
            'schema' => null,
            ));
}

add_action( 'rest_api_init', 'add_news_programme_meta_rest' );

//=============
//Get image URL
function news_get_thumbnail_url_full( $object ){
    if(has_post_thumbnail($object['id'])){
        $imgArray = wp_get_attachment_image_src( get_post_thumbnail_id( $object['id'] ), 'full' ); 
        // replace 'full' with 'thumbnail' to get a thumbnail
        $imgURL = $imgArray[0];
        echo $imgURL;die;
        return $imgURL;
    } else {
        return false;
    }
}
function news_get_thumbnail_url_th( $object ){
    if(has_post_thumbnail($object['id'])){
        $imgArray = wp_get_attachment_image_src( get_post_thumbnail_id( $object['id'] ), 'thumbnail' ); 
        // replace 'full' with 'thumbnail' to get a thumbnail
        $imgURL = $imgArray[0];
        return $imgURL;
    } else {
        return false;
    }
}

//Get tv programme tag
function news_get_tag( $object ) {
	//Returns Array of Term Names for "tv_programme_tag"
	$terms = get_the_terms($object['id'], 'news_programme_tag');
	// print_r($terms);
	if($terms){
		// $term_names='';
		// foreach( $terms as $key => $term ){

		// 	if($key == count($terms) - 1){
		// 		$term_names .= $term_names . $term->name;
		// 	} else {
		// 		$term_names .= $term_names . $term->name . ',';
		// 	}
			

		// }
		// return $term_names;
		return $terms;
	} else {
		return false;
	}
	
}

//Get tv programme cate
function news_get_cate( $object ) {
	//Returns Array of Term Names for "tv_programme_category"
	$terms = get_the_terms($object['id'], 'news_programme_category');
	// print_r($terms);
	if($terms){
		// $term_names='';
		// foreach( $terms as $key => $term ){

		// 	if($key == count($terms) - 1){
		// 		$term_names .= $term_names . $term->name;
		// 	} else {
		// 		$term_names .= $term_names . $term->name . ',';
		// 	}
			

		// }
		// return $term_names;
		return $terms;
	} else {
		return false;
	}
	
}



//integrate with WP-REST-API
function add_news_programme_thumbnail_url() {
	register_rest_field( 
		'news_programmes',
		'featured_image_url_full',  //key-name in json response
		array(
	     	'get_callback'    => 'news_get_thumbnail_url_full',
	     	'update_callback' => null,
	     	'schema'          => null,
	     )
	 );
	register_rest_field( 
		'news_programmes',
		'featured_image_url_th',  //key-name in json response
		array(
	     	'get_callback'    => 'news_get_thumbnail_url_th',
	    	'update_callback' => null,
	     	'schema'          => null,
	     )
	 );
	register_rest_field( 
		'news_programmes', 
		'news_programme_tag', 
		array(
			'get_callback'		=> 'news_get_tag',
			'update_callback'	=>	null,
			'schema'			=>	null, 
			) 
	);
	register_rest_field( 
		'news_programmes', 
		'news_programme_category', 
		array(
			'get_callback'		=> 'news_get_cate',
			'update_callback'	=>	null,
			'schema'			=>	null, 
			) 
	);

}
//register action
add_action( 'rest_api_init', 'add_news_programme_thumbnail_url' );



?>
