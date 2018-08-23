<?php // Template Name: Strategy Partner Intro Template ?>
<?php get_header();?>
<?php
$sb = get_post_meta($post->ID, 'sidebarss_position', 1);
$title = get_post_meta($post->ID, 'page_title', 1) 
?>

<?php if( get_post_meta($post->ID, 'cont_lay', 1) !="Full Page"){?>
<div class="oi_page_holder <?php if ( isset($sb)  && $sb =='No'){?>oi_without_sidebar<?php };?> <?php if( get_post_meta($post->ID, 'cont_lay', 1) =="Without Paddings"){?>oi_page_without_paddings<?php };?> <?php if(get_post_meta($post->ID, 'cont_lay', 1)=='Full Page Raw Scroller'){echo 'oi_full_port_page_raw_scroller oi_page_without_paddings ';};?>" style="padding:0!important;">
    <div class="oi_just_page oi_sections_holder">
    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <!-- <div class="row">
            <div class="col-md-12">
                <?php //echo qoon_breadcrumbs()?>
                <?php if ($title != "No"){?>
                    <?php if(!is_home() && !is_front_page()) {?>
                    <div class="oi_page_heading">
                        <h1 class="oi_page_title"><span><?php the_title()?></span></h1>
                    </div>
                    <?php };?>
                <?php };?>
                <?php //the_content();?>
                <?php $defaults = array( 'link_before' => '<span>', 'link_after'  => '</span>','before'   => '<div class="oi_pg" >',    'after' => '</div>',); wp_link_pages( $defaults );?>
                <?php if ( comments_open() ) { ?>
                <div class="single_post_bottom_sidebar_holder">
                <?php comments_template(); ?>
                </div>
        <?php }?>

        </div> -->
        </div>
        <!-- ========================Page Content Start Here========================= -->

           <div class="xx_ip_member" >
              <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/strategy-partner-intro-v2-1.jpg">
              <div class="xx_ip_member_join" style="">
                                   <a href="<?php echo esc_url( get_permalink(3112) ); ?>" class="ip_member_button">立刻加入<i class="fa fa-angle-right"></i></a>
                                   <div class="ip_member_text" >  JOIN US </div>
                                   <div class="ip_member_text" >  期待你的加入 </div>
               </div>
           </div>
           <?php get_footer('none'); ?>

        <!-- ========================Page Content End Here========================= -->
        <?php endwhile; endif; ?>
        
    </div>
</div>
<?php }else{?>
<div class="oi_page_holder oi_full_f_page">
<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php the_content();?>
<?php endwhile; endif; ?>
</div>
<?php };?>


