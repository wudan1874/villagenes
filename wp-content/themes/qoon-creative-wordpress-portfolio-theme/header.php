<?php
/*
* Theme Name: QOON -  Creative WordPress Portfolio Theme
* Author: OrangeIdea
* Text Domain: qoon-creative-wordpress-portfolio-theme
* Domain Path: /languages
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">

    <meta name="description" content="VILLAGENES乡香文化以吉祥物未来鲸为形象主体，深度聚焦客栈集群、体育空间、儿童娱乐、品味食街以及演艺剧场等领域，秉持聚合优质文创IP缔造全新文旅模式的核心目标，提供新时代生活的全新选择。" />
    <meta property="og:title" content="Villagenes-乡香文化" />
    <meta property="og:description" content="VILLAGENES乡香文化以吉祥物未来鲸为形象主体，深度聚焦客栈集群、体育空间、儿童娱乐、品味食街以及演艺剧场等领域，秉持聚合优质文创IP缔造全新文旅模式的核心目标，提供新时代生活的全新选择。" />
    <meta property="og:image" content="<?php echo wp_upload_dir()['baseurl']; ?>/2018/01/site-villagenes-1200x630.jpg" />

    <link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php $oi_qoon_options = get_option('oi_qoon_options'); $allowed_html_array = wp_kses_allowed_html( 'post' )?>
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {?>
    <link rel="shortcut icon" href="<?php  echo esc_url(stripslashes($oi_qoon_options['oi_header_favicon']['url']));?>">
    <?php };?>
    <?php wp_head(); ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111475592-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-111475592-1');
	</script>
</head>
<?php get_template_part( 'framework/layout/layout', $oi_qoon_options['site-layout'] );?>


