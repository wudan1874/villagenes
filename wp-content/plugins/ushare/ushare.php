<?php
/**
 * Plugin Name: Ushare (Tony Edition)
 * Description: Social Media Share 社交分享插件 Tony Edition, modified based on Ushare V1.2.0.
 * Version:     1.3.0
 * Author:      Tony | moyu
 * Author URI:  
 * License:     GPLv2 or later
 */

// 如果直接访问文件则终止程序.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('USHARE_DIR', plugin_dir_path( __FILE__ ));
define('USHARE_URL', plugin_dir_url( __FILE__ ));
define('USHARE_VERSION', '1.3.0');
define('USHARE_FILE', plugin_basename( __FILE__ ));

// 依赖文件载入
require_once USHARE_DIR . 'inc/networks.php';
require_once USHARE_DIR . 'inc/settings.php';
require_once USHARE_DIR . 'inc/developer.php';
require_once USHARE_DIR .  'inc/jssdk.php';
require_once USHARE_DIR . 'inc/core.php';
require_once USHARE_DIR . 'inc/metabox.php';
require_once USHARE_DIR . 'inc/template.php';
require_once USHARE_DIR . 'inc/public.php';

/**
 * 添加设置快捷链接
 * @param  array $links 原链接数组
 * @return array 新链接数组
 */
function ushare_add_settings_link( $links ) {
	$base_url = menu_page_url( 'ushare-settings', false );
	$settings_link  = sprintf( '<a href="%1$s">%2$s</a>', $base_url, 'Settings' );
	array_unshift( $links, $settings_link );
	return $links;
}
add_filter( "plugin_action_links_" . USHARE_FILE, 'ushare_add_settings_link' );

/**
 * 注册后端脚本
 * @return void
 */
function ushare_admin_enqueue_scripts() {
	wp_enqueue_style('ushare-style', USHARE_URL . 'assets/css/ushare.css' );
	wp_enqueue_script('ushare-sortable-scripts', USHARE_URL . 'assets/js/jquery.usortable.min.js', array('jquery') );
	wp_enqueue_script('ushare-admin-scripts', USHARE_URL . 'assets/js/admin-scripts.js', array('jquery'), null, true );
}
add_action('admin_enqueue_scripts', 'ushare_admin_enqueue_scripts' );

/**
 * 注册前端脚本
 * @return void
 */
function ushare_public_enqueue_scripts() {
	global $ushare_options;
	wp_enqueue_style('ushare-style', USHARE_URL . 'assets/css/ushare.css' );
	wp_enqueue_script('ushare-qrcode-script', USHARE_URL . 'assets/js/jquery.qrcode.min.js', array('jquery'), null, false );
	wp_enqueue_script('ushare-public-script', USHARE_URL . 'assets/js/ushare.js', array('jquery'), null, true );
	wp_localize_script( 'ushare-public-script', 'ushare_object', array(
		'ajaxurl'	=> admin_url('admin-ajax.php'),
		'likes_nonce' => wp_create_nonce( 'ushare_likes_nonce' ),
	) );

	wp_enqueue_script( 'ushare-weixin-script', 'https://res.wx.qq.com/open/js/jweixin-1.0.0.js' );
}
add_action('wp_enqueue_scripts', 'ushare_public_enqueue_scripts' );

?>