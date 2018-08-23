<?php get_header(); ?>
<?php global $oi_options; ?>
<div class="this_page oi_page_holder <?php if(get_post_meta($post->ID, 'port_cont_lay', 1)=='Full Page'){echo 'oi_full_port_page';};  if(get_post_meta($post->ID, 'port_cont_lay', 1)=='Full Page Raw Scroller'){echo 'oi_full_port_page_raw_scroller';};?>">
	<?php if(get_post_meta($post->ID, 'port_bread', 1) !='No'){ echo qoon_breadcrumbs();};?>
	<div class="oi_single_portfolio_holder" style="width: 100%;">
		<?php if ($oi_qoon_options['site-layout']=='standard'){ echo '<div class="container">';}?>        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="oi_portfolio_page_holder" style="position: relative;zoom: 1;margin-bottom: 0;background: url(<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/ip-detail-bg.jpg);">
			<?php  do_shortcode(the_content());?>

            <!-- ========================Previous Next Button Start Here========================= -->
            <?php
            $next_post = get_next_post();
            $previous_post = get_previous_post();
            if(isset($previous_post->ID)){
            $prev_image = wp_get_attachment_url( get_post_thumbnail_id($previous_post->ID,''));
            }
            if(isset($next_post->ID)){
            $next_image = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID,''));
            }
            ?>

            <div class="ip-detail-np-link-container">
                <div class="ip-detail-np-link-div">
                    <?php if (isset($previous_post->ID) && stristr($previous_post->post_name, 'coming_soon') != true){?>
                    <?php  previous_post_link('%link','<span class="ip-detail-np-link ip-detail-np-link-left" data-id="'.$previous_post->ID.'" title="%title"></span>', false); ?>
                    <?php };?>
                </div>

                <div class="ip-detail-np-link-div">
                    <div style="margin: 0 auto;width: 80px;">
                        <img class="icon-line" src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/icon-line-dark.png">
                        <p>SHARE</p>

                            <?php 
                                if(function_exists('ushare_weixin_display')){
                                    ushare_weixin_display( array('icon' => 'u-icon-weixin', 'style' => 'style-custom sharp', 'label' => '', 'network' => 'weixin') );
                                }

                                if(function_exists('ushare_weibo_display')){
                                    ushare_weibo_display( array('icon' => 'u-icon-weibo', 'style' => 'style-custom sharp', 'label' => '', 'network' => 'weibo') );
                                }
                            ?>
                        
                        
                        <!-- <a class="social-icons" href="">
                        	<i class="fa fa-weixin ip-social-icons" aria-hidden="true">
                        		<?php ushare_weixin_display( array('icon' => 'u-icon-weixin', 'style' => 'style-custom sharp', 'label' => '', 'network' => 'weixin') ); ?> 
                        	</i>
                        </a>
                        <a class="social-icons" href="">
                        	<i class="fa fa-weibo ip-social-icons" aria-hidden="true">
                        		<?php ushare_weibo_display( array('icon' => 'u-icon-weibo', 'style' => 'style-custom sharp', 'label' => '', 'network' => 'weibo') ); ?>
                        	</i>
                        </a> -->
                    </div>
                    
                </div> 

                <div class="ip-detail-np-link-div" style="text-align: right;text-align: -webkit-right;text-align: -moz-right;">
                    <?php if (isset($next_post->ID) && stristr($next_post->post_name, 'coming_soon') != true){?>
                    <?php next_post_link('%link','<span class="ip-detail-np-link ip-detail-np-link-right" data-id="'.$next_post->ID.'" title="%title"></span>', false); ?>
                    <?php };?>
                </div>
            </div>

            <!-- <div>
                <?php if (isset($next_post->ID)){?>
                <?php next_post_link('%link','<span class="ip-detail-np-link ip-detail-np-link-left" data-id="'.$next_post->ID.'"></span>', false); ?>
                <div class="" style=" background-image:url('<?php echo $next_image; ?>');">
                </div>
                <?php };?>

                <?php if (isset($previous_post->ID)){?>
                <?php  previous_post_link('%link','<span class="ip-detail-np-link ip-detail-np-link-right" data-id="'.$previous_post->ID.'"></span>', false); ?>
                <div class="" style="background-image:url('<?php echo $prev_image; ?>');">
                </div>
                <?php };?>
            </div> -->

            <!-- ========================Previous Next Button End Here========================= -->
        </div>
        
        <!-- <div  class="oi_port_nav">
        	<?php
			$next_post = get_next_post();
			$previous_post = get_previous_post();
			if(isset($previous_post->ID)){
			$prev_image = wp_get_attachment_url( get_post_thumbnail_id($previous_post->ID,''));
			}
			if(isset($next_post->ID)){
			$next_image = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID,''));
			}
			?>
            
        </div> -->
        
        <!-- <div class="oi_port_nav oi_main_port_nav">
        	<div class="raw">
            	<?php if (isset($next_post->ID)){?>
                <div class="<?php if (isset($previous_post->ID)){?>col-md-6 col-sm-6 col-xs-6<?php }else{echo 'col-md-12';};?> oi_np_holder" style=" background-image:url('<?php echo $next_image; ?>');">
                    <span class="oi_np_link"><?php next_post_link('%link','<span class="oi_a_holder" data-id="'.$next_post->ID.'"><i class="fa fa-long-arrow-left fa-fw"></i> %title</span>', false); ?></span>
                </div>
                <?php };?>
                <?php if (isset($previous_post->ID)){?>
                <div class="<?php if (isset($next_post->ID)){?>col-md-6 col-sm-6 col-xs-6<?php }else{echo 'col-md-12';};?> oi_np_holder" style="background-image:url('<?php echo $prev_image; ?>');">
                	<span class="oi_np_link"><?php  previous_post_link('%link','<span class="oi_a_holder" data-id="'.$previous_post->ID.'">%title <i class="fa fa-long-arrow-right fa-fw"></i></span>', false); ?></span>
                </div>
                <?php };?>
            </div>
        </div> -->
		<?php endwhile; endif;?>
        <?php if ($oi_qoon_options['site-layout']=='standard'){ echo '</div>';}?> 
       
    </div>
</div>
<?php get_footer(); ?>