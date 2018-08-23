<?php
/**
 * 添加文章喜欢次数
 * @param  int $post_id 文章ID
 * @return void
 */
function ushare_add_likes( $post_id ) {

	$old_likes = get_post_meta( $post_id, '_ushare_likes', true );
	$new_likes = (!empty($old_likes)) ? intval($old_likes) + 1 : 1;

	$status = update_post_meta( $post_id, '_ushare_likes', $new_likes );

	if($status) {
		return $new_likes;
	} else {
		return 0;
	}
	
}

/**
 * 获取文章喜欢次数
 * @param  int $post_id 文章ID
 * @return int 文章喜欢次数
 */
function ushare_get_likes( $post_id ) {

	$likes = get_post_meta( $post_id, '_ushare_likes', true );
	$likes = (!empty($likes)) ? intval($likes) : 0;

	return $likes;
}

/**
 * AJAX增加点赞次数
 * @return void
 */
function ushare_ajax_likeit() {

	$response = array(
		'status' => '0',
		'msg' => '',
		'count' => 0
	);

	if(!isset($_POST['post_id']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'ushare_likes_nonce' )) {
		$response['status'] = '-1';
		$response['msg'] = 'error';
	}

	$post_id =  intval($_POST['post_id']);
	$count = ushare_add_likes($post_id);

	if($count) {
		$response['status'] = '1';
		$response['msg'] = 'succeed';
		$response['count'] = $count;
		ushare_set_cookie($post_id, 'likes');
	} else {
		$response['status'] = '-1';
		$response['msg'] = 'error';
	}

	wp_send_json( $response );
}
add_action('wp_ajax_ushare_likeit', 'ushare_ajax_likeit' );
add_action('wp_ajax_nopriv_ushare_likeit', 'ushare_ajax_likeit' );

/**
 * AJAX获取点赞次数
 * @return void
 */
function ushare_ajax_getlikes() {

	global $post;
	$post_id = null;

	$response = array(
		'status' => '0',
		'msg' => '',
		'count' => 0
	);

	if( ! isset( $_POST['post_id'] ) ) {
		$response['status'] = '-1';
		$response['msg'] = 'error';
	}

	if( isset( $_POST['post_id'] ) ) {
		$post_id = $_POST['post_id'];
	}

	$likes = ushare_get_likes( $post_id );

	$response['status'] = '1';
	$response['msg'] = 'succeed';
	$response['count'] = $likes;

	wp_send_json( $response );

}
add_action('wp_ajax_ushare_getlikes', 'ushare_ajax_getlikes' );
add_action('wp_ajax_nopriv_ushare_getlikes', 'ushare_ajax_getlikes' );

/**
 * 设置Cookie
 * @param  int    $post_id 文章ID
 * @param  string $type    Cookie类型
 * @return void
 */
function ushare_set_cookie( $post_id, $type = 'likes' ) {
	$cookie = array();
	if( isset( $_COOKIE["ushare"] ) ) {
		$cookie = json_decode( stripslashes( $_COOKIE["ushare"] ) );

		if( isset( $cookie->$type ) )
			array_push( $cookie->$type, $post_id );
		else
			$cookie->$type = array( $post_id );
	} else {
		$cookie[$type] = array( $post_id );
	}

	setcookie( 'ushare', json_encode( $cookie ), time() + (5*365*24*60*60), COOKIEPATH, COOKIE_DOMAIN );
}

/**
 * 获取微信token，并缓存之
 * @return void
 */
function ushare_get_weixin_config() {
	global $ushare_options;

	if( empty( $ushare_options['weixin_app'] ) || empty( $ushare_options['weixin_secret'] ) ) {
		return false;
	}


	$jssdk = new JSSDK( $ushare_options['weixin_app'], $ushare_options['weixin_secret']);

	$new_config = $jssdk->GetSignPackage();

	return $new_config;

}

/**
 * 添加供分享所用的图片尺寸
 * @return void
 */
function ushare_add_features() {
	add_image_size( '300x300', '300', '300', true );
}
add_action( 'after_setup_theme', 'ushare_add_features' );