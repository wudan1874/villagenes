<?php  

/**
 * 社交按钮样式生成函数
 * @return array
 */
function ushare_get_all_network_styles() {
	$styles = array(
		// 扁平化
		array(
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到微信', 
		        'network' => 'weixin'
			),
			array(
				'icon' => 'u-icon-weixin', 
		        'style' => 'style-plain', 
		        'label' => '分享到微信', 
		        'network' => 'weixin'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到微博', 
		        'network' => 'weibo'
			),
			array(
				'icon' => 'u-icon-weibo', 
		        'style' => 'style-plain', 
		        'label' => '分享到微博', 
		        'network' => 'weibo'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到腾讯微博', 
		        'network' => 'qq'
			),
			array(
				'icon' => 'u-icon-weibo1', 
		        'style' => 'style-plain', 
		        'label' => '分享到腾讯微博', 
		        'network' => 'qq'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到QQ空间', 
		        'network' => 'qzone'
			),
			array(
				'icon' => 'u-icon-qzone', 
		        'style' => 'style-plain', 
		        'label' => '分享到QQ空间', 
		        'network' => 'qzone'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到豆瓣', 
		        'network' => 'douban'
			),
			array(
				'icon' => 'u-icon-douban', 
		        'style' => 'style-plain', 
		        'label' => '分享到豆瓣', 
		        'network' => 'douban'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到人人', 
		        'network' => 'renren'
			),
			array(
				'icon' => 'u-icon-renren', 
		        'style' => 'style-plain', 
		        'label' => '分享到人人', 
		        'network' => 'renren'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '保存至印象笔记', 
		        'network' => 'evernote'
			),
			array(
				'icon' => 'u-icon-evernote', 
		        'style' => 'style-plain', 
		        'label' => '保存至印象笔记', 
		        'network' => 'evernote'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到Facebook', 
		        'network' => 'facebook'
			),
			array(
				'icon' => 'u-icon-facebook', 
		        'style' => 'style-plain', 
		        'label' => '分享到Facebook', 
		        'network' => 'facebook'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到Twitter', 
		        'network' => 'twitter'
			),
			array(
				'icon' => 'u-icon-twitter', 
		        'style' => 'style-plain', 
		        'label' => '分享到Twitter', 
		        'network' => 'twitter'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '分享到Google+', 
		        'network' => 'googleplus'
			),
			array(
				'icon' => 'u-icon-google-plus', 
		        'style' => 'style-plain', 
		        'label' => '分享到Google+', 
		        'network' => 'googleplus'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => '发送给朋友', 
		        'network' => 'mail'
			),
			array(
				'icon' => 'u-icon-feiji', 
		        'style' => 'style-plain', 
		        'label' => '发送给朋友', 
		        'network' => 'mail'
			),
			array(
				'icon' => '', 
		        'style' => 'style-plain', 
		        'label' => "赞(<span class='count'>12</span>)", 
		        'network' => 'likes'
			),
			array(
				'icon' => 'u-icon-thumb', 
		        'style' => 'style-plain', 
		        'label' => "赞(<span class='count'>12</span>)", 
		        'network' => 'likes'
			),
		),
		// 默认
		array(
			array(
				'icon' => 'u-icon-weixin', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'weixin'
			),
			array(
				'icon' => 'u-icon-weibo', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'weibo'
			),
			array(
				'icon' => 'u-icon-weibo1', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'qq'
			),
			array(
				'icon' => 'u-icon-qzone', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'qzone'
			),
			array(
				'icon' => 'u-icon-douban', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'douban'
			),
			array(
				'icon' => 'u-icon-renren', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'renren'
			),
			array(
				'icon' => 'u-icon-evernote', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'evernote'
			),
			array(
				'icon' => 'u-icon-facebook', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'facebook'
			),
			array(
				'icon' => 'u-icon-twitter', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'twitter'
			),
			array(
				'icon' => 'u-icon-google-plus', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'googleplus'
			),
			array(
				'icon' => 'u-icon-feiji', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'mail'
			),
			array(
				'icon' => 'u-icon-thumb', 
		        'style' => 'style-plain', 
		        'label' => '', 
		        'network' => 'likes'
			),
			array(
				'icon' => 'u-icon-share', 
		        'style' => 'style-plain sharp', 
		        'label' => '', 
		        'network' => 'share'
			),
		)
	);

	return $styles;
}

/**
 * 社交按钮侧栏吸附样式生成函数
 * @return array
 */
function ushare_get_all_side_network_styles() {

	$styles = array(
		array(
			'icon' => 'u-icon-weixin', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'weixin'
		),
		array(
			'icon' => 'u-icon-weibo', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'weibo'
		),
		array(
			'icon' => 'u-icon-weibo1', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'qq'
		),
		array(
			'icon' => 'u-icon-qzone', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'qzone'
		),
		array(
			'icon' => 'u-icon-douban', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'douban'
		),
		array(
			'icon' => 'u-icon-renren', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'renren'
		),
		array(
			'icon' => 'u-icon-evernote', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'evernote'
		),
		array(
			'icon' => 'u-icon-facebook', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'facebook'
		),
		array(
			'icon' => 'u-icon-twitter', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'twitter'
		),
		array(
			'icon' => 'u-icon-google-plus', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'googleplus'
		),
		array(
			'icon' => 'u-icon-feiji', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'mail'
		),
		array(
			'icon' => 'u-icon-thumb', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'likes'
		),
		array(
			'icon' => 'u-icon-contact', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'contact'
		),
		array(
			'icon' => 'u-icon-share1', 
	        'style' => 'style-flat sharp bg', 
	        'label' => '', 
	        'network' => 'share'
		),
		array(
			'icon' => 'u-icon-up', 
	        'style' => 'style-flat sharp', 
	        'label' => '', 
	        'network' => 'backup'
		)
	);
	return $styles;
}

/**
 * 生成后台排序所用的分享按钮
 * @param  array  $network_args 配置参数
 * @return string
 */
function ushare_get_network_sorthtml( $network_args ) {

	$network_args = wp_parse_args( $network_args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '', 
        'network' => ''
	) );

	$output = '';
	$output .= '<span class="u-network '. esc_attr($network_args['network']) .' '. esc_attr($network_args['style']) .'"  data-network="'. esc_attr($network_args['network']) .'" data-label="'. esc_attr($network_args['label']) .'" data-style="'. esc_attr($network_args['style']) .'" data-icon="'. esc_attr($network_args['icon']) .'">';
	if( !empty($network_args['icon']) ) {
		$output .= '<div class="u-icon-wrap">';
		$output .= '<i class="u-iconfont '. esc_attr($network_args['icon']) .'"></i>';
		$output .= '</div>';
	}
	if( !empty($network_args['label']) ) {
		$output .= '<div class="u-label">'. $network_args['label'] .'</div>';
	}
	$output .= '<span class="js-remove">×</span>';
	$output .= '</span>';

	return $output;
}

