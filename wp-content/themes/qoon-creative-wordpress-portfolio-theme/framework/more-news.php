<?php // Template Name: More News Template ?>
<?php get_header();?>
<?php
$sb = get_post_meta($post->ID, 'sidebarss_position', 1);
$title = get_post_meta($post->ID, 'page_title', 1) 
?>

<?php if( get_post_meta($post->ID, 'cont_lay', 1) !="Full Page"){?>
<div class="oi_page_holder <?php if ( isset($sb)  && $sb =='No'){?>oi_without_sidebar<?php };?> <?php if( get_post_meta($post->ID, 'cont_lay', 1) =="Without Paddings"){?>oi_page_without_paddings<?php };?> <?php if(get_post_meta($post->ID, 'cont_lay', 1)=='Full Page Raw Scroller'){echo 'oi_full_port_page_raw_scroller oi_page_without_paddings ';};?>" style="padding:0!important;">
        <!-- ========================Page Content Start Here========================= -->

          <div class="row fh5co-board-container">

            <ul id="fh5co-board" class="effect-8" data-columns>
              
            </ul>
              

           <?php get_footer('none'); ?>

        <!-- ========================Page Content End Here========================= -->
        
        
    </div>
</div>
<?php }else{?>
<div class="oi_page_holder oi_full_f_page">
<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php the_content();?>
<?php endwhile; endif; ?>
</div>
<?php };?>


