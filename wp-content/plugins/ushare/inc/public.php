<?php
/*----------------------------------------------------------------------*/
/* 分享工具栏调用
/*----------------------------------------------------------------------*/
/**
 * 输出文章内容页分享工具栏固定位置的HTML
 * @param string $location 分享工具栏的位置 (left/middle/right)
 */
function ushare_get_content_bar( $location = 'left' ) {
	global $ushare_options;
	$output = '';
	ob_start();
	if( !empty( $ushare_options['networks_sort'][ $location ] ) ) {
		foreach ( $ushare_options['networks_sort'][ $location ] as $network ) {
			$call = 'ushare_' . $network['network'] . '_display';
			if( function_exists( $call ) ) {
				$call( $network );
			}
		}
	}
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

/**
 * 文章内容页分享工具栏
 * @param  $content 文章内容
 * @return 新的文章内容
 */
function ushare_the_content_bar() {
	global $ushare_options;

	if( !is_singular() ) {
		return;
	}

	if( empty($ushare_options['posttypes']) || !in_array(get_post_type(), $ushare_options['posttypes']) ) {
		return;
	}

	if(empty($ushare_options['networks_sort']['left']) && empty($ushare_options['networks_sort']['middle']) && empty($ushare_options['networks_sort']['right']) ) {
		return;
	}
	if( get_post_meta( get_the_ID(), '_deactivate_ushare_content_bar', true ) ) {
		return;
	}
?>
	<div class="u-post-share-wrap">
		<div class="u-left-group">
		<?php echo ushare_get_content_bar('left'); ?>
		</div>
		<div class="u-middle-group">
		<?php echo ushare_get_content_bar('middle'); ?>
		</div>
		<div class="u-right-group">
		<?php echo ushare_get_content_bar('right'); ?>
		</div>
	</div>
<?php
}

/**
 * 文章内容页分享工具栏
 * @param  $content 文章内容
 * @return 新的文章内容
 */
function ushare_hook_the_content( $content ) {
	global $ushare_options;

	if( !is_singular() ) {
		return $content;
	}

	if( empty($ushare_options['location']) || $ushare_options['location'] == '0' || $ushare_options['location'] == false ) {
		return $content;
	}

	if( empty($ushare_options['posttypes']) || !in_array(get_post_type(), $ushare_options['posttypes']) ) {
		return $content;
	}

	if(empty($ushare_options['networks_sort']['left']) && empty($ushare_options['networks_sort']['middle']) && empty($ushare_options['networks_sort']['right']) ) {
		return $content;
	}
	if( get_post_meta( get_the_ID(), '_deactivate_ushare_content_bar', true ) ) {
		return $content;
	}
	$share_html = '<div class="u-post-share-wrap>"';
	ob_start();
?>
	<div class="u-post-share-wrap">
		<div class="u-left-group">
		<?php echo ushare_get_content_bar('left'); ?>
		</div>
		<div class="u-middle-group">
		<?php echo ushare_get_content_bar('middle'); ?>
		</div>
		<div class="u-right-group">
		<?php echo ushare_get_content_bar('right'); ?>
		</div>
	</div>
<?php
	$share_html = ob_get_contents();
	ob_end_clean();

	if($ushare_options['location'] == 'before_content') {
		return $share_html . $content;
	} else {
		return $content . $share_html;
	}
}
add_action('the_content', 'ushare_hook_the_content', 20 );


/**
 * 侧边吸附分享工具栏调用
 * @return HTML
 */
function ushare_get_side_bar() {
	global $ushare_options;

	if( !is_singular() ) {
		return;
	}

	if( empty($ushare_options['posttypes']) || !in_array(get_post_type(), $ushare_options['posttypes']) ){
		return;
	}

	if(empty($ushare_options['side_networks_sort'])) {
		return;
	}

	if( get_post_meta( get_the_ID(), '_deactivate_ushare_side_bar', true ) ) {
		return;
	}

	$class = '';
	if($ushare_options['side'] == 'left') {
		$class .= 'left-side';
	} else {
		$class .= 'right-side';
	}
	$class .= ' u-side-custom';
	ob_start();
?>
<div class="u-side <?php echo $class; ?>">
	<ul class="u-networks-list">
	<?php  
		if( !empty($ushare_options['side_networks_sort']) ) {
			foreach ($ushare_options['side_networks_sort'] as $network) {
				echo '<li>';
				$network['style'] = 'style-flat sharp';
				$network['label'] = '';
				$call = 'ushare_' . $network['network'] . '_display';
				if(function_exists($call)) {
					$call($network);
				}
				echo  '</li>';
			}
		}
	?>
	</ul>
</div>
<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

/**
 * 侧边吸附分享工具栏输出
 * @return void
 */
function ushare_side_bar() {
	global $ushare_options;

	if( empty($ushare_options['side']) || $ushare_options['side'] == false) {
		return;
	}

	if( !is_singular() ) {
		return;
	}

	if( empty($ushare_options['posttypes']) || !in_array(get_post_type(), $ushare_options['posttypes']) ){
		return;
	}

	if(empty($ushare_options['side_networks_sort'])) {
		return;
	}

	if( get_post_meta( get_the_ID(), '_deactivate_ushare_side_bar', true ) ) {
		return;
	}

	$class = '';
	if($ushare_options['side'] == 'left') {
		$class .= 'left-side';
	} else {
		$class .= 'right-side';
	}
?>
<div class="u-side <?php echo $class; ?>">
	<ul class="u-networks-list">
	<?php  
		if( !empty($ushare_options['side_networks_sort']) ) {
			foreach ($ushare_options['side_networks_sort'] as $network) {
				echo '<li>';
				$network['style'] = 'style-flat sharp';
				$network['label'] = '';
				$call = 'ushare_' . $network['network'] . '_display';
				if(function_exists($call)) {
					$call($network);
				}
				echo  '</li>';
			}
		}
	?>
	</ul>
</div>
<?php
}
add_action( 'wp_footer', 'ushare_side_bar' );

/**
 * 浮动分享框
 * @return void
 */
function ushare_float_window() {
	global $ushare_options;

	if( empty($ushare_options['window']) || $ushare_options['window'] == false) {
		return;
	}

	if( !is_singular() ) {
		return;
	}

	if( empty($ushare_options['posttypes']) || !in_array(get_post_type(), $ushare_options['posttypes']) ) {
		return;
	}

	if(empty($ushare_options['networks_sort']['notification'])) {
		return;
	}

	if( get_post_meta( get_the_ID(), '_deactivate_ushare_window_bar', true ) ) {
		return;
	}

	$class = '';
	if($ushare_options['window'] == 'right_bottom') {
		$class .= 'right-bottom';
	} else if($ushare_options['window'] == 'right_top') {
		$class .= 'right-top';
	} else if ($ushare_options['window'] == 'left_top') {
		$class .= 'left-top';
	} else if ($ushare_options['window'] == 'left_bottom') {
		$class .= 'left-bottom';
	} else {
		return;
	}

	$title = !empty($ushare_options['notice_title']) ? $ushare_options['notice_title'] : '如果你觉的这篇文章不错，分享给朋友吧！';
?>
	<div class="u-notification <?php echo $class; ?>">
		<div class="unotice-header">
			<?php echo $title; ?>

		</div>
		<div class="unotice-body">
		<?php  
			if(isset($ushare_options['networks_sort']['notification'])) {
				foreach ($ushare_options['networks_sort']['notification'] as $network) {
					$call = 'ushare_' . $network['network'] . '_display';
					if(function_exists($call)) {
						$call($network);
					}
				}
			}
		?>
		</div>
		<span class="js-close">×</span>
	</div>
<?php
}
add_action( 'wp_footer', 'ushare_float_window' );

function ushare_float_trigger( $content ) {
	global $ushare_options;

	if( empty($ushare_options['window']) || $ushare_options['window'] == false) {
		return $content;
	}

	if( !is_singular() ) {
		return $content;
	}

	if( empty($ushare_options['posttypes']) || !in_array(get_post_type(), $ushare_options['posttypes']) ){
		return $content;
	}

	if(empty($ushare_options['networks_sort']['notification'])) {
		return $content;
	}
	
	if( get_post_meta( get_the_ID(), '_deactivate_ushare_window_bar', true ) ) {
		return $content;
	}

	return $content . '<div class="u-float-trigger"></div>';
}
add_action( 'the_content', 'ushare_float_trigger', 25 );

/**
 * 供社交分享所用的页面数据输出
 * @return void
 */
function ushare_jsdata() {
	global $ushare_options;

	$title = get_the_title();
	$desc = esc_html( get_the_excerpt() );
	$weibo_ralatedUid = (!empty($ushare_options['weibo_uid'])) ? $ushare_options['weibo_uid'] : '';
	$weibo_appKey = (!empty($ushare_options['weibo_app_key'])) ? $ushare_options['weibo_app_key'] : '';
	$weixin_appKey = (!empty($ushare_options['weixin_app'])) ? $ushare_options['weixin_app'] : '';
?>
<script type="text/javascript">
	// 默认分享数据
	ushare = {};
	ushare.data = {
		title: "<?php echo $title; ?>",
		desc: "<?php echo $desc; ?>",
		url: "<?php the_permalink(); ?>",
		pic: "<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>",
	};

	ushare.weibo_data = {
		title: "<?php printf('「%1$s」%2$s', $title, strip_tags(get_the_excerpt()) ); ?>",
		url: "<?php the_permalink(); ?>",
		pic: "<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>",
		ralateUid: "<?php echo strip_tags($weibo_ralatedUid); ?>",
		appkey: "<?php echo strip_tags($weibo_appKey); ?>"
	};

	ushare.qq_data = {
		title: "<?php printf('「%1$s」%2$s', $title, strip_tags(get_the_excerpt()) ); ?>",
		url: "<?php the_permalink(); ?>",
		pic: "<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>",
		ralateUid: "",
		appkey: ""
	};

	ushare.qzone_data = {
		url: ushare.data.url,
		showcount: '0',/*是否显示分享总数,显示：'1'，不显示：'0' */
		desc: '',/*默认分享理由(可选)*/
		summary: ushare.data.desc,/*分享摘要(可选)*/
		title: ushare.data.title,/*分享标题(可选)*/
		site: "<?php bloginfo('name'); ?>",/*分享来源 如：腾讯网(可选)*/
		pics: ushare.data.pic, /*分享图片的路径(可选)*/
	};

	ushare.renren_data = {
		resourceUrl : ushare.data.url,	//分享的资源Url
		srcUrl : ushare.data.url,	//分享的资源来源Url,默认为header中的Referer,如果分享失败可以调整此值为resourceUrl试试
		pic : ushare.data.pic,		//分享的主题图片Url
		title : ushare.data.title,		//分享的标题
		description : ushare.data.desc	//分享的详细描述
	};

	ushare.facebook_data = {
		t: ushare.data.title,
		u: ushare.data.url
	};

	ushare.twitter_data = {
		text: "<?php printf('「%1$s」%2$s', $title, strip_tags(get_the_excerpt()) ); ?>",
		url: ushare.data.url,
		via: "<?php bloginfo('name'); ?>"
	};

	ushare.googleplus_data = {
		t: ushare.data.title,
		url: ushare.data.url
	};
</script>
<?php 
	if( !empty($weixin_appKey) ) {
		$signPackage = ushare_get_weixin_config();
		if( !empty($signPackage) ) {
?>
			<script type="text/javascript">
				(function(e) {
					wx.config({
					    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
			    		appId: '<?php echo $signPackage["appId"];?>',
			    		timestamp: <?php echo $signPackage["timestamp"];?>,
			    		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			    		signature: '<?php echo $signPackage["signature"];?>',
					    jsApiList: [ 
					    	'checkJsApi',
					    	'onMenuShareTimeline', 
					    	'onMenuShareAppMessage', 
					    	'onMenuShareQQ', 
					    	'onMenuShareWeibo' ] 
					    	// 必填，需要使用的JS接口列表，所有JS接口列表见附录2
					});

					wx.ready(function(){
						// “分享到朋友圈”按钮点击状态及自定义分享内容接口
						wx.onMenuShareTimeline({
						    title: ushare.data.title, // 分享标题
						    link: ushare.data.url, // 分享链接
						    imgUrl: ushare.data.pic, // 分享图标
						    success: function () { 
						        // 用户确认分享后执行的回调函数
						       	
						    },
						    cancel: function () { 
						        // 用户取消分享后执行的回调函数
						    }
						});

						// “分享给朋友”按钮点击状态及自定义分享内容接口
						wx.onMenuShareAppMessage({
						    title: ushare.data.title, // 分享标题
						    desc: ushare.data.desc, // 分享描述
						    link: ushare.data.url, // 分享链接
						    imgUrl: ushare.data.pic, // 分享图标
						    type: 'link', // 分享类型,music、video或link，不填默认为link
						    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
						    success: function () { 
						        // 用户确认分享后执行的回调函数
						    },
						    cancel: function () { 
						        // 用户取消分享后执行的回调函数
						    }
						});

						// “分享到QQ”按钮点击状态及自定义分享内容接口
						wx.onMenuShareQQ({
						    title: ushare.data.title, // 分享标题
						    desc: ushare.data.desc, // 分享描述
						    link: ushare.data.url, // 分享链接
						    imgUrl: ushare.data.pic, // 分享图标
						    success: function () { 
						       // 用户确认分享后执行的回调函数
						    },
						    cancel: function () { 
						       // 用户取消分享后执行的回调函数
						    }
						});

						// “分享到腾讯微博”按钮点击状态及自定义分享内容接口
						wx.onMenuShareWeibo({
						    title: ushare.data.title, // 分享标题
						    desc: ushare.data.desc, // 分享描述
						    link: ushare.data.url, // 分享链接
						    imgUrl: ushare.data.pic, // 分享图标
						    success: function () { 
						       // 用户确认分享后执行的回调函数
						    },
						    cancel: function () { 
						        // 用户取消分享后执行的回调函数
						    }
						});

					});
					

					wx.error(function(res){
    					console.log($res);	
					});

				})(jQuery);
			</script>
<?php 
		}
	}
}
add_action('wp_footer', 'ushare_jsdata' );