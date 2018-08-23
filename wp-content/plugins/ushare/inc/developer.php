<?php
function ushare_developer_page() {
?>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row" valign="top">
					<?php _e('内容页分享工具栏调用方法：'); ?>
				</th>
				<td>
					<p>
						在文章页面的正文上下放显示的分享工具栏分为左，中，右三个区域。若要单独调用其中一个区域的分享按钮，只需要在需要显示的页面位置的源文件加入以下代码：
					</p>
					<p>
						<code>ushare_get_content_bar( $location )</code>，其中<code>$location</code>参数为具体的区域栏目，有以下几个值:
					</p>
					<ul style="list-style: disc;padding-left: 30px">
						<li><strong>left</strong> - 调用左边区域的分享菜单</li>
						<li><strong>middle</strong> - 调用中间区域的分享菜单</li>
						<li><strong>right</strong> - 调用右边区域的分享菜单</li>
					</ul>
					<p>此调用方法的例子为:</p>
					<p><code>&lt;div class=&quot;social-share-bar&quot;&gt;&lt;?php echo ushare_get_content_bar( 'left' ); ?&gt;&lt;/div&gt;</code></p>
					<hr>
					<p>若需要直接一次性调用整个完整的分享工具栏，包含三个区域，则调用以下代码：</p>
					<p><code>ushare_the_content_bar()</code></p>
					<p>此调用方法的例子为:</p>
					<p><code>&lt;div class=&quot;social-share-bar&quot;&gt;&lt;?php ushare_the_content_bar(); ?&gt;&lt;/div&gt;</code></p>
					<p>需要注意的是，此调用会受到页面的设置参数的影响，如果你在页面里停用了内容分享工具栏，那么函数在此页面里不会输出任何内容</p>
					
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<?php _e('侧栏分享工具调用方法：'); ?>
				</th>
				<td>
					<p>
						侧栏分享主要有左右边框吸附两种方式，但如果你需要调用侧栏的分享栏目可以通过以下函数来调用：
					</p>
					<p><code>&lt;div class=&quot;social-share-bar&quot;&gt;&lt;?php echo ushare_get_side_bar(); ?&gt;&lt;/div&gt;</code></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<?php _e('单个分享按钮调用：'); ?>
				</th>
				<td>
					<p>
						如果需要单独调用某个社交分享按钮，则可通过以下代码调用，其参数可配置具体样式：
					</p>
					<p>
						<code>
						ushare_{network}_display( $args )
						</code>
					</p>
					<p>
						其中<code>{network}</code>替换为想要的社交分享按钮代码，具体有：微信：<code>weixin</code>, 微博：<code>weibo</code>, 腾讯微博：<code>qq</code>, QQ空间：<code>qzone</code>, 人人网：<code>renren</code>, Facebook：<code>facebook</code>, Twitter：<code>twitter</code>, Google+：<code>googleplus</code>, 邮件分享：<code>mail</code>, 印象笔记：<code>evernote</code>, 豆瓣：<code>douban</code>, 更多分享：<code>share</code>,点赞：<code>likes</code>
					</p>
					<p>
						其中<code>$args</code>为数组参数, 以微信为例：
						<br>
						<code>
							$args = array(
								'icon' => 'u-icon-iconfuzhi', 
						        'style' => 'style-plain', 
						        'label' => '分享到微信', 
						        'network' => 'weixin'
							)
						</code>
					</p>
					<p>其中的参数分别可以填写如下值：</p>
					<ul style="list-style: disc;padding-left: 30px">
						<li>
							'icon' - 微信：<code>u-icon-iconfuzhi</code>, 微博：<code>u-icon-weibo1</code>, 腾讯微博：<code>u-icon-weibo</code>, QQ空间：<code>u-icon-qzone</code>, 人人网：<code>u-icon-renrenicon</code>, Facebook：<code>u-icon-facebook</code>, Twitter：<code>u-icon-twitter</code>, Google+：<code>u-icon-google-plus</code>, 邮件分享：<code>u-icon-feiji</code>, 印象笔记：<code>u-icon-evernote</code>, 豆瓣：<code>u-icon-douban</code>, 更多分享：<code>share</code>,点赞：<code>u-icon-thumb</code>(若留空，则不显示图标)
						</li>
						<li>
							'style' - 这里style样式可以由这些参数任意组合:
							<ul style="list-style: disc;padding-left: 30px">
								<li>
									<code>style-plain</code>，<code>style-flat</code>，<code>style-reverse</code>
								</li>
								<li>
									<code>rounded</code>，<code>sharp</code>
								</li>
							</ul>
						</li>
						<li>
							'label' - 此为具体的文字描述，如果想要只显示图标，这此项留空
						</li>
						<li>
							'network' - 这个填写具体的社交网络代码，具体有：微信：<code>weixin</code>, 微博：<code>weibo</code>, 腾讯微博：<code>qq</code>, QQ空间：<code>qzone</code>, 人人网：<code>renren</code>, Facebook：<code>facebook</code>, Twitter：<code>twitter</code>, Google+：<code>googleplus</code>, 邮件分享：<code>mail</code>, 印象笔记：<code>evernote</code>, 豆瓣：<code>douban</code>, 更多分享：<code>share</code>,点赞：<code>likes</code>
						</li>
					</ul>
					<p>
						以调用微信按钮为例：
					</p>
					<p>
						<code>
							&lt;?php ushare_weixin_display( array('icon' => 'u-icon-iconfuzhi', 'style' => 'style-plain', 'label' => '分享到微信', 'network' => 'weixin') ); ?&gt;
						</code>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
<?php
}