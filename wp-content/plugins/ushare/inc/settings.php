<?php
// 防止直接访问此文件
if ( !defined( 'ABSPATH' ) ) exit;

function ushare_get_option() {
	global $ushare_options;
	$ushare_options = (array) get_option( 'ushare_settings' );
}
ushare_get_option();

/**
 * 注册后台菜单页面
 * @return void
 */
function ushare_plugin_menu() {
	global $ushare_option_page_id;
	$ushare_option_page_id = add_options_page( 'Ushare Setting', 'Ushare Setting', 'manage_options', 'ushare-settings', 'ushare_plugin_display' );
}
add_action( 'admin_menu', 'ushare_plugin_menu' );

/**
 * 配置页面显示
 * @param  string $active_tab 当前选项卡页面ID
 * @return void
 */
function ushare_plugin_display( $active_tab = '' ) {

	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
	$base_url = menu_page_url( 'ushare-settings', false );
	$sections = ushare_get_registered_settings();
	$callback = '';
?>
	<div class="wrap">
		<h2 class="nav-tab-wrapper">
		<?php  
			foreach ( $sections as $key => $section ) {
				$actived = ( $active_tab == $key ) ? 'nav-tab-active' : '';
				printf('<a href="%1$s" title="%2$s" class="nav-tab %3$s">%4$s</a>',
					add_query_arg('tab', $key, $base_url),
					$section['title'],
					$actived,
					$section['title']
				);
			}
		?>
		</h2>
		<!-- END .nav-tab-wrapper -->
		<div id="tab_container" class="ushare-cols2">
			<div class="ushare-col-1">
		<?php  
			if(!empty($sections[$active_tab]['blank']) && !empty($sections[$active_tab]['callback']) ) {
				$callback = $sections[$active_tab]['callback'];
				if(function_exists($callback)) {
					$callback();
				}
			} else {
		?>
			<form action="options.php" method="post">
				<table class="form-table">
				<?php  
					settings_fields( 'ushare_settings' );
					do_settings_fields( 'ushare_settings_' . $active_tab, 'ushare_settings_' . $active_tab );
				?>	
				</table>
				<!-- END .form-table -->
				<?php submit_button(); ?>
			</form>
		<?php } ?>
			</div>
		</div>
		<!-- END #tab_container -->
	</div>
	<!-- END .wrap -->
<?php
}

/**
 * 配置设置选项
 * @return 设置选项
 */
function ushare_get_registered_settings() {

	$ushare_settings = array(
		'general' => array(
			'title' => '通用',
			'fields' => array(
				'location' => array(
					'title' => '正文显示位置',
					'desc' => '在文章内容前或者后显示分享工具',
					'type' => 'select',
					'options' => array(
						'0' => '不显示',
						'before_content' => '正文顶端',
						'after_content' => '正文底部'
					),
					'std' => 'after_content'
				),
				'window' => array(
					'title' => '窗口显示位置',
					'desc' => '当浏览文章快结束的时候，在浏览器窗口四个角上自动出现一个分享窗口',
					'type' => 'select',
					'options' => array(
						'0' => '不显示',
						'right_bottom' => '右下角',
						'left_bottom' => '左下角',
						'left_top' => '左上角',
						'right_top' => '右上角'
					),
					'std' => '0'
				),
				'posttypes' => array(
					'title' => '文章类型',
					'desc' => '在特定文章类型下显示分享工具',
					'type' => 'multicheck',
					'options' => get_post_types( array('public' => true), 'names' ),
					'std' => array('post')
				),
				'hr_1' => array(
					'title' => '',
					'type' => 'heading'
				),
				'networks_sort' => array(
					'title' => '分享按钮',
					'desc' => '选择需要分享的社交网络',
					'type' => 'networks'
				),
				'hr_2' => array(
					'title' => '',
					'type' => 'heading'
				),
				'side' => array(
					'title' => '侧栏显示位置',
					'desc' => '在浏览窗口固定位置显示分享按钮工具',
					'type' => 'select',
					'options' => array(
						'0' => '不显示',
						'left' => '左边',
						'right' => '右边'
					),
					'std' => '0'
				),
				'side_networks_sort' => array(
					'title' => '侧栏吸附分享按钮',
					'type' => 'side_networks'
				),
				'skin_heading' => array(
					'title' => '文字描述',
					'type' => 'heading'
				),
				'notice_title' => array(
					'title' => '分享窗口标题',
					'type' => 'text',
					'placeholder' => '如果你觉的这篇文章不错，分享给朋友吧！',
					'std' => '如果你觉的这篇文章不错，分享给朋友吧！'
				),
				'weixin_label' => array(
					'title' => '微信描述',
					'type' => 'text',
					'placeholder' => '分享到微信',
					'std' => '分享到微信'
				),
				'weixin_qr_desc' => array(
					'title' => '微信二维码描述',
					'type' => 'text',
					'placeholder' => '打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮',
					'std' => '打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮'
				),
				'weibo_label' => array(
					'title' => '微博描述',
					'type' => 'text',
					'placeholder' => '分享到微博',
					'std' => '分享到微博'
				),
				'qq_label' => array(
					'title' => '腾讯微博描述',
					'type' => 'text',
					'placeholder' => '分享到腾讯微博',
					'std' => '分享到腾讯微博'
				),
				'qzone_label' => array(
					'title' => 'QQ空间描述',
					'type' => 'text',
					'placeholder' => '分享到QQ空间',
					'std' => '分享到QQ空间'
				),
				'douban_label' => array(
					'title' => '豆瓣描述',
					'type' => 'text',
					'placeholder' => '分享到豆瓣',
					'std' => '分享到豆瓣'
				),
				'renren_label' => array(
					'title' => '人人描述',
					'type' => 'text',
					'placeholder' => '分享到人人',
					'std' => '分享到人人'
				),
				'evernote_label' => array(
					'title' => '印象笔记描述',
					'type' => 'text',
					'placeholder' => '保存至印象笔记',
					'std' => '保存至印象笔记'
				),
				'facebook_label' => array(
					'title' => 'Facebook描述',
					'type' => 'text',
					'placeholder' => '分享到Facebook',
					'std' => '分享到Facebook'
				),
				'twitter_label' => array(
					'title' => 'Twitter描述',
					'type' => 'text',
					'placeholder' => '分享到Twitter',
					'std' => '分享到Twitter'
				),
				'googleplus_label' => array(
					'title' => 'Google+描述',
					'type' => 'text',
					'placeholder' => '分享到Google+',
					'std' => '分享到Google+'
				),
				'mail_label' => array(
					'title' => '发送给朋友描述',
					'type' => 'text',
					'placeholder' => '发送给朋友',
					'std' => '发送给朋友'
				),
				'likes_label' => array(
					'title' => '赞描述',
					'type' => 'text',
					'placeholder' => "赞(<span class='count'>%s</span>)",
					'std' => "赞(<span class='count'>%s</span>)",
					'desc' => '描述文字中必须包含<code>'. esc_html("<span class='count'>%s</span>") .'</code>此标签，才能正常显示数量'
				),
				'contact_content' => array(
					'title' => '联系窗口内容',
					'type' => 'rich_editor',
					'placeholder' => "",
					'std' => "",
					'desc' => '点击联系按钮弹出窗口中的内容'
				)
			)
		),
		'api' => array(
			'title' => 'API配置',
			'fields' => array(
				'weibo_heading'	=> array(
					'type' => 'heading',
					'title' => '新浪微博配置',
					'desc'	=> ''
				),
				'weibo_uid'	=> array(
					'type' => 'text',
					'title' => '新浪账户Uid或账户名',
					'desc' => '相关微博Uid，如果有此项，分享内容会自动 @相关微博'
				),
				'weibo_app_key'	=> array(
					'type' => 'text',
					'title' => 'APP Key',
					'desc' => '分享来源的appkey，如果有此项，会在微博正文地下，显示“来自XXX”'
				),
				'weixin_heading'	=> array(
					'type' => 'heading',
					'title' => '微信配置(测试中)',
					'desc'	=> '如果绑定了微信公众号APP ID（公众号的唯一标识）与密匙，能更好的显示社交分享内容'
				),
				'weixin_app' => array(
					'type' => 'text',
					'title' => '微信公众号APP ID',
					'desc' => ''
				),
				'weixin_secret' => array(
					'type' => 'text',
					'title' => '微信公众号APP密匙',
					'desc' => ''
				),
			)
		),
		'developer' => array(
			'title' => '开发者文档',
			'blank' => 'true',
			'callback' => 'ushare_developer_page',
			'fields' => array(
			)
		)
	);

	return $ushare_settings;
}

/**
 * 注册配置项
 * @return void
 */
function ushare_register_settings() {
	
	if( false == get_option( 'ushare_settings' ) ) {
		add_option( 'ushare_settings' );
	}

	foreach ( ushare_get_registered_settings() as $tab => $settings ) {

		add_settings_section(
			'ushare_settings_' . $tab,
			'__return_null()',
			'__return_false',
			'ushare_settings_' . $tab
		);

		if(  isset($settings['callback']) && function_exists($settings['callback']) ) {
			break;
		}

		foreach ($settings['fields'] as $key => $option) {

			add_settings_field( 
				'ushare_settings[' . $key . ']',
				$option['title'],
				function_exists( 'ushare_' . $option['type'] . '_callback' ) ? 'ushare_' . $option['type'] . '_callback' : 'ushare_missing_callback',
				'ushare_settings_' . $tab,
				'ushare_settings_' . $tab,
				array(
					'section' 	  => $tab,
					'id'          => $key,
					'desc'        => !empty( $option['desc'] )       ? $option['desc']   	 	: '',
					'title'       => isset( $option['title'] )       ? $option['title']   	 	: null,
					'size'        => isset( $option['size'] )        ? $option['size']    		: null,
					'options'     => isset( $option['options'] )     ? $option['options'] 		: '',
					'std'         => isset( $option['std'] )         ? $option['std']     		: '',
					'min'         => isset( $option['min'] )         ? $option['min']     		: null,
					'max'         => isset( $option['max'] )         ? $option['max']     		: null,
                    'step'        => isset( $option['step'] )        ? $option['step']    		: null,
                    'chosen'      => isset( $option['chosen'] )      ? $option['chosen']  		: null,
                    'placeholder' => isset( $option['placeholder'] ) ? $option['placeholder'] 	: null,
                    'allow_blank' => isset( $option['allow_blank'] ) ? $option['allow_blank'] 	: true
				)
			);
		}
	}

	register_setting( 'ushare_settings', 'ushare_settings', 'ushare_settings_sanitize' );
}
add_action( 'admin_init', 'ushare_register_settings' );

/* ------------------------------------------------------------------------ *
 * Setting Callbacks
 * ------------------------------------------------------------------------ */ 

function ushare_settings_sanitize( $input = array() ) {

	global $ushare_options;

	if( empty($_POST['_wp_http_referer']) ) {
		return $input;
	}

	parse_str( $_POST['_wp_http_referer'], $referrer );

	$settings 	= ushare_get_registered_settings();
	$tab      	= isset( $referrer['tab'] ) ? $referrer['tab'] : 'general';

	$input 		= $input ? $input : array();
	$input 		= apply_filters( 'ushare_settings_' . $tab . '_sanitize', $input );

	foreach ($input as $key => $value) {

		// 获取设置项类型
		$type = isset( $settings[$tab]['fields'][$key]['type'] ) ? $settings[$tab]['fields'][$key]['type'] : false;

		if ( $type ) {
			// 指定类型过滤器
			$input[$key] = apply_filters( 'ushare_settings_sanitize_' . $type, $value, $key );
		}

		// 基本过滤器
		$input[$key] = apply_filters( 'ushare_settings_sanitize', $input[$key], $key );
	}

	if ( ! empty( $settings[$tab] ) ) {
		foreach ( $settings[$tab]['fields'] as $key => $value ) {

			if ( empty( $input[$key] ) ) {
				unset( $ushare_options[$key] );
			}

		}
	}

	$output = array_merge( $ushare_options, $input );

	add_settings_error( 'ushare-notices', '', '设置已更新!', 'updated' );

	return $output;
}

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 
/**
 * 标题设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_heading_callback( $args ) {

	$html = '<hr>';
	if( !empty($args['desc']) ) {
		$html .= '<p class="description">' . $args['desc'] . '</p>';
	}
	echo $html;
}

/**
 * 文本框设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_text_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = '<input type="text" class="' . $size . '-text" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 确认框设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_checkbox_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$checked = checked( 1, $value, false );
	$html = '<input type="checkbox" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']" value="1" ' . $checked . '/>';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 多选设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_multicheck_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? (array) $args['std'] : NULL;

	if ( ! empty( $args['options'] ) ) {
		foreach( $args['options'] as $key => $option ):
			if( in_array($key, $value) ) { $enabled = $option; } else { $enabled = NULL; }
			echo '<input name="ushare_settings[' . $args['id'] . '][' . $key . ']" id="ushare_settings[' . $args['id'] . '][' . $key . ']" type="checkbox" value="' . $option . '" ' . checked($option, $enabled, false) . '/>&nbsp;';
			echo '<label for="ushare_settings[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
		endforeach;
		echo '<p class="description">' . $args['desc'] . '</p>';
	}
}

/**
 * 单选设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_radio_callback( $args ) {
	global $ushare_options;

	foreach ( $args['options'] as $key => $option ) :
		$checked = false;

		if ( isset( $ushare_options[ $args['id'] ] ) && $ushare_options[ $args['id'] ] == $key )
			$checked = true;
		elseif( isset( $args['std'] ) && $args['std'] == $key && ! isset( $ushare_options[ $args['id'] ] ) )
			$checked = true;

		echo '<input name="ushare_settings[' . $args['id'] . ']"" id="ushare_settings[' . $args['id'] . '][' . $key . ']" type="radio" value="' . $key . '" ' . checked(true, $checked, false) . '/>&nbsp;';
		echo '<label for="ushare_settings[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
	endforeach;

	echo '<p class="description">' . $args['desc'] . '</p>';	
}

/**
 * 数字设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_number_callback( $args ) {
	global $ushare_options;

    if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$max  = isset( $args['max'] ) ? $args['max'] : 999999;
	$min  = isset( $args['min'] ) ? $args['min'] : 0;
	$step = isset( $args['step'] ) ? $args['step'] : 1;

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = '<input type="number" step="' . esc_attr( $step ) . '" max="' . esc_attr( $max ) . '" min="' . esc_attr( $min ) . '" class="' . $size . '-text" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 文本域设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_textarea_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$html = '<textarea class="large-text" cols="50" rows="5" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']">' . esc_textarea( stripslashes( $value ) ) . '</textarea>';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 密码设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_password_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = '<input type="password" class="' . $size . '-text" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 选择设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_select_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

    if ( isset( $args['placeholder'] ) )
        $placeholder = $args['placeholder'];
    else
		$placeholder = '';

	if ( isset( $args['chosen'] ) )
		$chosen = 'class="ushare-chosen"';
	else
		$chosen = '';

    $html = '<select id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']" ' . $chosen . 'data-placeholder="' . $placeholder . '" />';

	foreach ( $args['options'] as $option => $name ) :
		$selected = selected( $option, $value, false );
		$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>';
	endforeach;

	$html .= '</select>';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 颜色设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_color_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$default = isset( $args['std'] ) ? $args['std'] : '';

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = '<input type="text" class="ushare-color-picker" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']" value="' . esc_attr( $value ) . '" data-default-color="' . esc_attr( $default ) . '" />';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 富文本域设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_rich_editor_callback( $args ) {
	global $ushare_options, $wp_version;

	if ( isset( $ushare_options[ $args['id'] ] ) ) {
		$value = $ushare_options[ $args['id'] ];

		if( empty( $args['allow_blank'] ) && empty( $value ) ) {
			$value = isset( $args['std'] ) ? $args['std'] : '';
		}
	} else {
		$value = isset( $args['std'] ) ? $args['std'] : '';
	}

	$rows = isset( $args['size'] ) ? $args['size'] : 20;

	if ( $wp_version >= 3.3 && function_exists( 'wp_editor' ) ) {
		ob_start();
		wp_editor( stripslashes( $value ), 'ushare_settings_' . $args['id'], array( 'textarea_name' => 'ushare_settings[' . $args['id'] . ']', 'textarea_rows' => $rows ) );
		$html = ob_get_clean();
	} else {
		$html = '<textarea class="large-text" rows="10" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']">' . esc_textarea( stripslashes( $value ) ) . '</textarea>';
	}

	$html .= '<br/><label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;	
}

/**
 * 上传设置类型
 * @param  [type] $args 配置参数
 * @return void
 */
function ushare_upload_callback( $args ) {
	global $ushare_options;

	if ( isset( $ushare_options[ $args['id'] ] ) )
		$value = $ushare_options[$args['id']];
	else
		$value = isset($args['std']) ? $args['std'] : '';

	$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
	$html = '<input type="text" class="' . $size . '-text" id="ushare_settings[' . $args['id'] . ']" name="ushare_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
	$html .= '<span>&nbsp;<input type="button" class="ushare_settings_upload_button button-secondary" value="' . __( 'Upload' ) . '"/></span>';
	$html .= '<label for="ushare_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/**
 * 缺省类型
 * @param  array $args 配置参数
 * @return void
 */
function ushare_missing_callback($args) {
	echo '此设置项类型不存在！';
}

/**
 * 社交按钮选择
 * @param  array $args 配置参数
 * @return void
 */
function ushare_networks_callback( $args ) {
	global $ushare_options;
?>
	<div class="style-select-wrap">
		<label for="network_style">
			样式:
			<select id="network_style">
				<option value="plain">透明背景</option>
				<option value="flat">扁平化</option>
				<option value="reverse">反转</option>
			</select>
		</label>
		<label for="network_radius">
			圆角:
			<select id="network_radius">
				<option value="default">默认</option>
				<option value="rounded">圆角</option>
				<option value="sharp">方角</option>
			</select>
		</label>
	</div>
	<p class="u-wrap-desc">所有社交分享按钮样式(拖拽以下按钮至需要显示的区域即可)</p>
	<div id="inactive-networks" class="networks-wrap block-group">
	<?php foreach (ushare_get_all_network_styles() as $group) : ?>
		<div class="block">
		<?php
			foreach ($group as $network_args) {
				echo ushare_get_network_sorthtml($network_args);
			}
		?>
		</div>
		<!-- END .block -->
	<?php endforeach; ?>
	</div>
	<p class="u-wrap-desc">文章正文社交分享按钮：</p>
	<div id="active-networks" class="networks-wrap group">
		<div class="left-group">
		<?php  
			if(isset($ushare_options['networks_sort']['left'])) {
				foreach ($ushare_options['networks_sort']['left'] as $network_args) {
					echo ushare_get_network_sorthtml($network_args);
				}
			}
		?>
		</div>
		<div class="middle-group">
		<?php  
			if(isset($ushare_options['networks_sort']['middle'])) {
				foreach ($ushare_options['networks_sort']['middle'] as $network_args) {
					echo ushare_get_network_sorthtml($network_args);
				}
			}
		?>	
		</div>
		<div class="right-group">
		<?php  
			if(isset($ushare_options['networks_sort']['right'])) {
				foreach ($ushare_options['networks_sort']['right'] as $network_args) {
					echo ushare_get_network_sorthtml($network_args);
				}
			}
		?>		
		</div>
	</div>
	<p class="u-wrap-desc">边角窗口社交分享按钮：</p>
	<div class="admin-u-notification-wrap">
		<div class="admin-u-notification">
			<div class="unotice-header">
				如果你觉的这篇文章不错，分享给朋友吧！
			</div>
			<div id="active_notification_networks" class="unotice-body">
			<?php  
				if(isset($ushare_options['networks_sort']['notification'])) {
					foreach ($ushare_options['networks_sort']['notification'] as $network_args) {
						echo ushare_get_network_sorthtml($network_args);
					}
				}
			?>	
			</div>
		</div>
	</div>
	<p class="u-wrap-desc">更多分享按钮包含社交选项：</p>
	<div class="admin-u-sharemore-wrap">
		<span class="u-network share style-plain sharp" data-network="share" data-label="" data-style="style-plain sharp" data-icon="icon-share1">
			<div class="u-icon-wrap">
				<i class="u-iconfont u-icon-share1"></i>
			</div>
			<div id="active_sharemore" class="u-tooltip" style="min-width: 240px;">
			<?php  
				if(isset($ushare_options['networks_sort']['more'])) {
					foreach ($ushare_options['networks_sort']['more'] as $network_args) {
						echo ushare_get_network_sorthtml($network_args);
					}
				}
			?>	
			</div>
		</span>
	</div>
	<div id="networks_sort_hidden" class="hidden-data"></div>
<?php
}

function ushare_side_networks_callback( $args ) {
	global $ushare_options;
?>
	<div id="inactive_side_networks" class="side-networks-wrap">
	<?php 
		foreach (ushare_get_all_side_network_styles() as $network_args) {
			echo ushare_get_network_sorthtml($network_args);
		}
	?>
	</div>
	<div id="active_side_networks" class="side-networks-wrap">
	<?php  
		if(isset($ushare_options['side_networks_sort'])) {
			foreach ($ushare_options['side_networks_sort'] as $network_args) {
				echo ushare_get_network_sorthtml($network_args);
			}
		}
	?>	
	</div>
	<div id="side_networks_hidden" class="hidden-data"></div>
<?php
}

function ushare_admin_footer_text($footer_text) {

	global $ushare_option_page_id;

	$screen = get_current_screen();

	if($screen->id == $ushare_option_page_id) {
		$rate_text = sprintf( __( '<strong>优享 Ushare v1.3.0</strong> | Tony 特别修改版 | This is a special edition modified by Tony', 'eof' ),
			''
		);
		return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
	} else {
		return $footer_text;
	}
}
add_filter('admin_footer_text', 'ushare_admin_footer_text');