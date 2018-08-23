<?php

/**
 * 微信分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_weixin_display( $args ) {
	global $ushare_options;
	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到微信', 
        'network' => ''
	) );

	if( !empty($ushare_options['weixin_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['weixin_label'];
	}
	$qr_desc = '打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮';
	if( !empty($ushare_options['weixin_qr_desc']) ) {
		$qr_desc = $ushare_options['weixin_qr_desc'];
	}
?>
	<a href="javascript:;" class="u-network weixin pop <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	<div class="u-pophint">
		<div class="u-qrcode" data-url="<?php the_permalink(); ?>"></div>
		<p><?php echo $qr_desc; ?></p>
	</div>
	</a>
<?php
}

/**
 * 联系我们
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_contact_display( $args ) {
	global $ushare_options;
	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '联系我们', 
        'network' => ''
	) );

	$content = empty( $ushare_options['contact_content'] ) ? '' : $ushare_options['contact_content'];
?>
	<a href="javascript:;" class="u-network contact pop <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<div class="u-pophint">
		<?php echo $content; ?>
	</div>
	</a>
<?php
}

/**
 * 新浪微博分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_weibo_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到微博', 
        'network' => ''
	) );

	if( !empty($ushare_options['weibo_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['weibo_label'];
	}
?>
	<a href="#" class="u-network weibo <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * 腾讯微博分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_qq_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到腾讯微博', 
        'network' => ''
	) );

	if( !empty($ushare_options['qq_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['qq_label'];
	}
?>
	<a href="#" class="u-network qq <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * QQ空间分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_qzone_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到QQ空间', 
        'network' => ''
	) );

	if( !empty($ushare_options['qzone_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['qzone_label'];
	}
?>
	<a href="#" class="u-network qzone <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * 人人分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_renren_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到人人', 
        'network' => ''
	) );

	if( !empty($ushare_options['renren_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['renren_label'];
	}
?>
	<a href="#" class="u-network renren <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * Facebook分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_facebook_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到Facebook', 
        'network' => ''
	) );

	if( !empty($ushare_options['facebook_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['facebook_label'];
	}
?>
	<a href="#" class="u-network facebook <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * Twitter分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_twitter_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到Twitter', 
        'network' => ''
	) );
	
	if( !empty($ushare_options['twitter_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['twitter_label'];
	}
?>
	<a href="#" class="u-network twitter <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * Google+分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_googleplus_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享到Google+', 
        'network' => ''
	) );
	
	if( !empty($ushare_options['googleplus_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['googleplus_label'];
	}
?>
	<a href="#" class="u-network googleplus <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * 邮件分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_mail_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '发送给朋友', 
        'network' => ''
	) );

	$link = 'mailto:?subject='. esc_attr( strip_tags(get_the_title()) ) .'&body=' . get_permalink();

	if( !empty($ushare_options['mail_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['mail_label'];
	}
?>
	<a href="<?php echo $link; ?>" class="u-network mail <?php echo esc_attr($config['style']); ?>" target="_blank" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * 保存至印象笔记
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_evernote_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '保存至印象笔记', 
        'network' => ''
	) );

	if( !empty($ushare_options['evernote_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['evernote_label'];
	}
?>
	<a href="http://app.yinxiang.com/clip.action?url=<?php the_permalink(); ?>" class="u-network evernote <?php echo esc_attr($config['style']); ?>" target="_blank" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * 豆瓣分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_douban_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '推荐到豆瓣', 
        'network' => ''
	) );

	if( !empty($ushare_options['douban_label']) && !empty($config['label']) ) {
		$config['label'] = $ushare_options['douban_label'];
	}
?>
	<a href="#" class="u-network douban <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * 更多分享
 * @param  array $args 分享按钮配置参数
 * @return void
 */
function ushare_share_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '分享', 
        'network' => ''
	) );
?>
	<div href="#" class="u-network share <?php echo esc_attr($config['style']); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php echo $config['label']; ?></div>
	<?php endif; ?>
		<div class="u-tooltip">
		<?php  
			if( isset($ushare_options['networks_sort']['more']) ) {
				foreach ($ushare_options['networks_sort']['more'] as $network) {
					if( empty($network['icon']) ) {
						$$network['icon'] = 'share';
					}
					$network['label'] = '';
					$call = 'ushare_' . $network['network'] . '_display';
					if(function_exists($call)) {
						$call($network);
					}
				}
			}
		?>
		</div>
	</div>
<?php
}

/**
 * 点赞
 * @param  array $args 点赞按钮配置参数
 * @return void
 */
function ushare_likes_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => "赞(<span class='count'>%s</span>)", 
        'network' => ''
	) );

	if( !empty($config['label']) && !empty($ushare_options['likes_label']) ) {
		$config['label'] = $ushare_options['likes_label'];
	}

?>
	<a href="#" class="u-network likes <?php echo esc_attr($config['style']); ?>" data-id="<?php the_ID(); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	<?php if( !empty($config['label']) ) : ?>
		<div class="u-label"><?php printf( $config['label'], ushare_get_likes( get_the_ID() ) ); ?></div>
	<?php endif; ?>
	</a>
<?php
}

/**
 * 返回到顶部
 * @param  array $args 点赞按钮配置参数
 * @return void
 */
function ushare_backup_display( $args ) {
	global $ushare_options;

	$config = wp_parse_args( $args, array(
        'icon' => '', 
        'style' => '', 
        'label' => '', 
        'network' => ''
	) );

	if( !empty($config['label']) && !empty($ushare_options['likes_label']) ) {
		$config['label'] = $ushare_options['likes_label'];
	}

?>
	<a href="#" class="u-network backup <?php echo esc_attr($config['style']); ?>" data-id="<?php the_ID(); ?>" rel="nofollow">
	<?php if( !empty($config['icon']) ) : ?>
		<div class="u-icon-wrap">
			<i class="u-iconfont <?php echo esc_attr($config['icon']); ?>"></i>
		</div>
	<?php endif; ?>
	</a>
<?php
}