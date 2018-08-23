<?php

/**
 * 后台编辑页面属性设置框注册
 * @return void
 */
function ushare_register_metabox() {
	global $ushare_options;
	
	$screens = $ushare_options['posttypes'];

	foreach ($screens as $key => $screen) {
		add_meta_box(
			'ushare_metabox',
			'优享属性',
			'ushare_metabox_callback',
			$screen,
			'side',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'ushare_register_metabox' );

function ushare_metabox_callback( $post ) {
	// 生成签名
	wp_nonce_field( 'ushare_meta_box', 'ushare_meta_box_nonce' );
	$ushare_content_bar = get_post_meta( $post->ID, '_deactivate_ushare_content_bar', true );
	$ushare_side_bar = get_post_meta( $post->ID, '_deactivate_ushare_side_bar', true );
	$ushare_window_bar = get_post_meta( $post->ID, '_deactivate_ushare_window_bar', true );

	$ushare_content_bar = empty( $ushare_content_bar ) 	? '0' : $ushare_content_bar;
	$ushare_side_bar 	= empty( $ushare_side_bar ) 	? '0' : $ushare_side_bar;
	$ushare_window_bar 	= empty( $ushare_window_bar ) 	? '0' : $ushare_window_bar;
	$ushare_likes = ushare_get_likes( $post->ID );

?>
	<p>
		<input type="checkbox" name="deactivate_ushare_content_bar" value="1" <?php checked( '1', $ushare_content_bar ); ?>><label for="deactivate_ushare_content_bar">停用内容分享框</label>
		<br>
		<input type="checkbox" name="deactivate_ushare_side_bar" value="1" <?php checked( '1', $ushare_side_bar ); ?>><label for="deactivate_ushare_side_bar">停用吸附侧栏分享框</label>
		<br>
		<input type="checkbox" name="deactivate_ushare_window_bar" value="1" <?php checked( '1', $ushare_window_bar ); ?>><label for="deactivate_ushare_window">停用边角弹出分享框</label>
	</p>
	<hr>
	<p>
		<label for="ushare_likes">Like次数:</label>
		<input type="number" name="ushare_likes" value="<?php echo esc_attr( $ushare_likes ); ?>">
	</p>
<?php
}

/**
 * 编辑页面点击保存的时候触发此函数
 * 保存优享的页面配置信息
 * 
 * @param  int  $post_id 编辑的文章ID
 * @return void
 */
function ushare_save_metabox_data( $post_id ) {

	// 验证签名是否存在
	if ( ! isset( $_POST['ushare_meta_box_nonce'] ) ) {
		return;
	}
	// 验证签名
	if ( ! wp_verify_nonce( $_POST['ushare_meta_box_nonce'], 'ushare_meta_box' ) ) {
		return;
	}

	// 如果是自动保存, 则不进行处理
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// 检查用户权限
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if(  isset( $_POST['deactivate_ushare_content_bar'] ) && $_POST['deactivate_ushare_content_bar'] ) {
		update_post_meta( $post_id, '_deactivate_ushare_content_bar', '1' );
	} else {
		update_post_meta( $post_id, '_deactivate_ushare_content_bar', '0' );
	}

	if( isset( $_POST['deactivate_ushare_side_bar'] ) && $_POST['deactivate_ushare_side_bar'] ) {
		update_post_meta( $post_id, '_deactivate_ushare_side_bar', '1' );
	} else {
		update_post_meta( $post_id, '_deactivate_ushare_side_bar', '0' );
	}

	if(  isset( $_POST['deactivate_ushare_window_bar'] ) && $_POST['deactivate_ushare_window_bar'] ) {
		update_post_meta( $post_id, '_deactivate_ushare_window_bar', '1' );
	} else {
		update_post_meta( $post_id, '_deactivate_ushare_window_bar', '0' );
	}

	if( $_POST['ushare_likes'] ) {
		update_post_meta( $post_id, '_ushare_likes', absint( $_POST['ushare_likes'] ) );
	}
}
add_action( 'save_post', 'ushare_save_metabox_data' );