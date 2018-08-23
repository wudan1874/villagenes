<?php
/* webpage will show in desktop/tablet but not mobile device */
//if( my_wp_is_mobile() ) {
	
//} else {

?>

<?php $oi_qoon_options = get_option('oi_qoon_options');?>
<?php get_template_part( 'framework/footer/footer-xx' );?>
</div>
<?php wp_footer(); ?>


<?php 
/* webpage will show in desktop/tablet but not mobile device */
//}?>
</body>
</html>