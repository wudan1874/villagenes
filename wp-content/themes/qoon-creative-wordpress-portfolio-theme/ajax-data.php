<?php 
// ip slider
add_action( 'wp_ajax_qoon_ajax_request_ip', 'qoon_ajax_request_ip' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request_ip', 'qoon_ajax_request_ip' );
function qoon_ajax_request_ip() {
	global $portfolio_array;

	$args = array(
		'post_type' 		=> 'portfolio',
		'posts_per_page' 	=> 5,
		'post_status' 		=> 'publish',
		'orderby' 			=> 'date',
		'order' 			=> 'DESC',
		'meta_key' 			=> 'port_slidercheck',
		'meta_value'		=> 'yes',
	);
	$portfolio_array = get_posts( $args );

	foreach ( $portfolio_array as $k=>$item ) {
		$p_arr[$k]['link'] = get_post_permalink($item->ID);
        $p_arr[$k]['id'] = $item->ID;
        $p_arr[$k]['title'] = $item->post_title;
        $p_arr[$k]['subtitle'] = get_post_meta($item->ID, 'ip-subtitle');
        $p_arr[$k]['image'] = get_post_meta($item->ID, 'ip-img');
        $p_arr[$k]['description'] = get_post_meta($item->ID, 'port-description');
        

        $tag = get_the_terms( $item->ID, 'portfolio-tags' );
		if (isset($tag) && ($tag!='')){
			$tag_name = ''; 
			foreach($tag as $value=>$key){
				$tag_name  .= ' '.$key->name;
			}
		};

		if ($tag) {
			$p_arr[$k]['tag'] = $tag[0]->name;
		}
		else{
			$p_arr[$k]['tag'] = '';
		}
    }
	print json_encode($p_arr);
	die();
}

//index news list
add_action( 'wp_ajax_qoon_ajax_request_inl', 'qoon_ajax_request_inl' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request_inl', 'qoon_ajax_request_inl' );
function qoon_ajax_request_inl() {
	global $post_array;

	$args = array(
		'post_type' 		=> 'news_programmes',
		'posts_per_page' 	=> 3,
		'post_status' 		=> 'publish',
		'orderby' 			=> 'date',
		'order' 			=> 'DESC',
		'meta_key' 			=> 'show_index',
		'meta_value'		=> 'yes',

	);
	$post_array = get_posts( $args );

	foreach ( $post_array as $k=>$item ) {
		$p_arr[$k]['link'] = get_post_permalink($item->ID);
        $p_arr[$k]['id'] = $item->ID;
        $p_arr[$k]['title'] = $item->post_title;
        $p_arr[$k]['subtitle'] = get_post_meta($item->ID, 'subtitle');
        $p_arr[$k]['index_title'] = get_post_meta($item->ID, 'index_title');
        $p_arr[$k]['thumbnail'] = get_post_meta($item->ID, 'news_imgurl');

		$cat = get_the_terms( $item->ID, 'news_programme_category' );
		if (isset($cat) && ($cat!='')){
			$cat_name = ''; 
			foreach($cat as $value=>$key){
				$cat_name  .= ' '.$key->name;
			}
		};

		if ($cat) {
			$p_arr[$k]['category'] = $cat[0]->name;

			if($p_arr[$k]['category'] == 'News')
			{
				$p_arr[$k]['class'] = 'purple';
			}
			elseif($p_arr[$k]['category'] == 'Insights')
			{
				$p_arr[$k]['class'] = 'pink';
			}
			elseif($p_arr[$k]['category'] == 'Event')
			{
				$p_arr[$k]['class'] = 'green';
			}

		}
		else{
			$p_arr[$k]['category'] = '';
			$p_arr[$k]['class'] = '';
		}
        
    }

	print json_encode($p_arr);
	die();
}


//more news page news list
add_action( 'wp_ajax_qoon_ajax_request_mnnl', 'qoon_ajax_request_mnnl' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request_mnnl', 'qoon_ajax_request_mnnl' );
function qoon_ajax_request_mnnl() {
	global $post_array;

	$args = array(
		'post_type' 		=> 'news_programmes',
		'posts_per_page' 	=> -1,
		'post_status' 		=> 'publish',
		'orderby' 			=> 'date',
		// 'order' 			=> 'DESC',
		'order' 			=> 'ASC',
	);
	$post_array = get_posts( $args );

	foreach ( $post_array as $k=>$item ) {
		$p_arr[$k]['link'] = get_post_permalink($item->ID);
        $p_arr[$k]['id'] = $item->ID;
        $p_arr[$k]['thumbnail'] = wp_get_attachment_url( get_post_thumbnail_id($item->ID) );

		$cat = get_the_terms( $item->ID, 'news_programme_category' );
		if (isset($cat) && ($cat!='')){
			$cat_name = ''; 
			foreach($cat as $value=>$key){
				$cat_name  .= ' '.$key->name;
			}
		};

		if ($cat) {
			$p_arr[$k]['category'] = $cat[0]->name;

			if($p_arr[$k]['category'] == 'News')
			{
				$p_arr[$k]['class'] = 'purple';
			}
			elseif($p_arr[$k]['category'] == 'Insights')
			{
				$p_arr[$k]['class'] = 'pink';
			}
			elseif($p_arr[$k]['category'] == 'Event')
			{
				$p_arr[$k]['class'] = 'green';
			}

		}
		else{
			$p_arr[$k]['category'] = '';
			$p_arr[$k]['class'] = '';
		}
        
    }

	print json_encode($p_arr);
	die();
}

// news slider
add_action( 'wp_ajax_qoon_ajax_request_in', 'qoon_ajax_request_in' );
add_action( 'wp_ajax_nopriv_qoon_ajax_request_in', 'qoon_ajax_request_in' );
function qoon_ajax_request_in() {
	global $post_array;

	$args = array(
		'post_type' 		=> 'post',
		'posts_per_page' 	=> 10,
		'post_status' 		=> 'publish',
		'orderby' 			=> 'date',
		'order' 			=> 'DESC',
	);
	$post_array = get_posts( $args );

	foreach ( $post_array as $k=>$item ) {
		$p_arr[$k]['link'] = get_post_permalink($item->ID);
        $p_arr[$k]['id'] = $item->ID;
        $p_arr[$k]['title'] = $item->post_title;
        $p_arr[$k]['image'] = wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), 'thumbnail');
        $p_arr[$k]['date'] = mysql2date( 'Y.m.d', $item->post_date );


        $tag = get_the_tags($item->ID);

		if ($tag) {
			$p_arr[$k]['tag'] = $tag[0]->name;

			if($p_arr[$k]['tag'] == 'Awesome')
			{
				$p_arr[$k]['color'] = '#fa9901';
			}
			elseif($p_arr[$k]['tag'] == 'Design')
			{
				$p_arr[$k]['color'] = '#fa9901';
			}
			elseif($p_arr[$k]['tag'] == 'New')
			{
				$p_arr[$k]['color'] = '#94d578';
			}
			elseif($p_arr[$k]['tag'] == 'Event')
			{
				$p_arr[$k]['color'] = '#94d578';
			}
			elseif($p_arr[$k]['tag'] == 'Launch')
			{
				$p_arr[$k]['color'] = '#d578aa';
			}
			elseif($p_arr[$k]['tag'] == 'Story')
			{
				$p_arr[$k]['color'] = '#d578aa';
			}

		}
		else{
			$p_arr[$k]['tag'] = '';
			$p_arr[$k]['color'] = '';
		}
        
    }

	print json_encode($p_arr);
	die();
}
?>