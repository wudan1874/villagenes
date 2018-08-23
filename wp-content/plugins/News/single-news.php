<?php get_header(); ?>
<div class="this_page oi_page_holder">
	
	<div class="oi_single_portfolio_holder" style="width: 100%;">
		<?php if ($oi_qoon_options['site-layout']=='standard'){ echo '<div class="container">';}?>        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="oi_portfolio_page_holder" style="position: relative;zoom: 1;overflow: hidden;margin-bottom: 0;">
            <div class="vc_row news-single-breadcrumbs">
                <?php if(get_post_meta($post->ID, 'port_bread', 1) !='No'){ echo qoon_breadcrumbs();};?>
            </div>

            <?php 
                $date = get_the_date( 'F j Y' );
                $author = get_post_meta($post->ID, 'author', 1);
                
            ?>

            <div class="vc_row breadcrumbs news-single-breadcrumbs">
                <p><span class="font-capital font-blue"><?php echo $date; ?></span>&emsp;
                    <span class="font-initial font-blue"><?php echo $author; ?></span>&emsp;
                    <span class="news-single-title-tag">原创</span>
                </p>
            </div>

			<?php  do_shortcode(the_content());?>

        </div>

		<?php endwhile; endif;?>
        <?php if ($oi_qoon_options['site-layout']=='standard'){ echo '</div>';}?> 
       
    </div>

</div>
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
<div class="this_page oi_page_holder" style="background-color: #95a7b5;padding: 10px 30px !important;overflow: initial;">
    <div class="news-detail-np-link-container">
        <div class="news-detail-np-link-div">
            <?php if (isset($previous_post->ID) && stristr($previous_post->post_name, 'coming_soon') != true){?>
            <?php  previous_post_link('%link','<span class="news-detail-np-link news-detail-np-link-left" data-id="'.$previous_post->ID.'" title="%title"></span>', false); ?>
            <?php };?>
        </div>
        
        <div class="news-detail-np-link-div">
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
            </div>
            
        </div> 

        <div class="news-detail-np-link-div" style="text-align: right;text-align: -webkit-right;">
            <?php if (isset($next_post->ID) && stristr($next_post->post_name, 'coming_soon') != true){?>
            <?php next_post_link('%link','<span class="news-detail-np-link news-detail-np-link-right" data-id="'.$next_post->ID.'" title="%title"></span>', false); ?>
            <?php };?>
        </div>
    </div>
</div>

<!-- ========================Previous Next Button End Here========================= -->
<?php get_footer(); ?>