<?php // Template Name: Index Template ?>
<?php get_header();?>
<?php
$sb = get_post_meta($post->ID, 'sidebarss_position', 1);
$title = get_post_meta($post->ID, 'page_title', 1) 
?>
<?php
//if( my_wp_is_mobile() ) {
//    get_template_part( 'framework/mobile-404' );
//} else {

?>
<?php if( get_post_meta($post->ID, 'cont_lay', 1) !="Full Page"){?>
<div class="oi_page_holder <?php if ( isset($sb)  && $sb =='No'){?>oi_without_sidebar<?php };?> <?php if( get_post_meta($post->ID, 'cont_lay', 1) =="Without Paddings"){?>oi_page_without_paddings<?php };?> <?php if(get_post_meta($post->ID, 'cont_lay', 1)=='Full Page Raw Scroller'){echo 'oi_full_port_page_raw_scroller oi_page_without_paddings ';};?>">
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
            </div>
        </div> -->
        
        <!-- ========================Page Content Start Here========================= -->
            
            
            <?php putRevSlider("xx-intro"); ?>            

                <div class="xx-index-title-section">
                    <p>乡香热点 | <span class="xx-title-en">WHAT'S ON</span></p>
                </div>
                <div class="xx-index-news clearfix">
                    <div id="xx-index-news-sections" >
                        <div class="row" >



                        </div>

                        
                    </div>

                </div>


                <div class="xx-index-about " style="background-image: url(<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_aboutbg_02.jpg);">
                    <div class="xx-index-abouttext ">
                        <p class="xx-index-aboutcenter">关于乡香 | <span class="xx-title-en">About</span></p>
                        <p class="xx-index-aboutcenters">【VILLAGENES创新型研发运营平台】作为乡香文化线上产业整合引擎，以吉祥物未来鲸为形象主体，具备“蓬勃之势、自然人味、宏大愿景”等主要内涵元素。乡香文化致力于通过平台化“创意研发+特色运营”的专业势能，深度聚焦客栈集群、体育空间、儿童娱乐、品味食街以及演艺剧场等领域，贯通用户集群及产业模块的横纵两端，秉持聚合优质文创IP缔造全新文旅模式的核心目标，提供新时代生活的全新选择。</p>
                        <p class="xx-index-aboutcenters">乡香文化愿以文创之力激发乡村之美，以平台之势聚众多优选。交流整合促进，联接城市与乡村之间的契合与共鸣。在城内寻找心中的故乡，在城外呆驻片刻更好的出发。乡香文化始终在探究未来生活的模样，心动无常又自由生长。</p>
                        <p class="hidden-xs  hidden-sm  xx-index-aboutenglish xx-content-en">
                            Leading Innovator，Operator and Aggregator in Cultural Tourism & Lifestyle Destinations.<br><br>Villagenes functions as an multifaceted empowering platform that goes beyond conventional perception and physical creation of places. We value and unleash the genetic drive of human centered lifestyle, experiences and memories that play a vital role in connecting people and minds, nurturing soulful communities with inspiring energy and sustainable strategy.</p>
                        <p class="hidden-xs  hidden-sm  xx-index-aboutenglish xx-content-en">Villagenes platform is all about people, nature, spaces, lifestyles and relatioships. Ultimately we aims to build a healthier ecosystem that steamlines all elements within our platform, fosters ongoing collaboration with our partners, and creates differentiated experience for our customers. We love what do and we will do it well ! </p>
                       <!-- show in xs sm-->
                        <div class="xx-index-abouttext more visible-xs visible-sm">

                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">  <i class="fa  fa-angle-double-down" aria-hidden="true"></i></a>
                                </h4>

                            <div id="collapseOne" class="panel-collapse collapse">
                                   <p class=" xx-index-aboutenglish xx-content-en">Villagenes functions as an multifaceted empowering platform that goes beyond conventional perception and physical creation of places. We value and unleash the genetic drive of human centered lifestyle, experiences and memories that play a vital role in connecting people and minds, nurturing soulful communities with inspiring energy and sustainable strategy.</p>
                                   <p class=" xx-index-aboutenglish xx-content-en">Villagenes platform is all about people, nature, spaces, lifestyles and relatioships. Ultimately we aims to build a healthier ecosystem that steamlines all elements within our platform, fosters ongoing collaboration with our partners, and creates differentiated experience for our customers. We love what do and we will do it well ! </p>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="xx-index-title-section clearfix ">
                    <p>核心板块 | <span class="xx-title-en">WHAT WE DO</span></p>
                </div>
                <div class="xx-index-product clearfix">
                     <div class="row">
                        <div class="xx-index-product-item col-md-4 col-xs-6">
                            <a href="<?php echo esc_url( get_permalink(4080) ); ?>">
                                <div class="grid" id="effect-5">
                                    <figure class="effect-selena">
                                        <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-product-demo1-1.jpg"/>
                                        
                                        <figcaption>
                                            <h3 style="margin-top: 53%;">客栈集群 <span class="span-text-blue">|</span> ESCAPE</h3>
                                            
                                            <p class="product-description" style="width: 100%;">依托文旅概念，以空间语言为载体打造民宿客栈集群，融合在地人文情怀，通过旅游宿养为突破口弘扬东方文化</p>
                                        </figcaption>   
                                                
                                    </figure>
                                </div>
                            </a>
                        </div>
                        <div class="xx-index-product-item col-md-4 col-xs-6">
                            <a href="<?php echo esc_url( get_permalink(3079) ); ?>">
                                <div class="grid" id="effect-5">
                                    <figure class="effect-selena">
                                        <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-product-demo2-1.jpg"/>
                                        
                                        <figcaption>
                                            <h3 style="margin-top: 53%;">体育空间 <span class="span-text-blue">|</span> MOVE</h3>
                                            
                                            <p class="product-description" style="width: 100%;">响应全民运动风潮，优化周边人群的生活方式。建造以体育场馆为核心辐射生活上下游的新型运动生活社区</p>
                                        </figcaption>   
                                                
                                    </figure>
                                </div>
                            </a>
                        </div>
                        <div class="xx-index-product-item col-md-4 col-xs-6">
                            <a href="<?php echo esc_url( get_permalink(3077) ); ?>">
                                <div class="grid" id="effect-5">
                                    <figure class="effect-selena">
                                        <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-product-demo3-1.jpg"/>
                                        
                                        <figcaption>
                                            <h3 style="margin-top: 53%;">儿童娱乐 <span class="span-text-blue">|</span> FAMILY</h3>
                                            
                                            <p class="product-description" style="width: 100%;">亲近自然走近人味，围绕寓教于乐的互动方式建立全新户外亲子主题娱乐场所，打开亲子对话新模式</p>
                                        </figcaption>   
                                                
                                    </figure>
                                </div>
                            </a>
                        </div>
                    <!-- </div>
                    <div class="row"> -->

                        <div class="xx-index-product-item col-md-4 col-xs-6">
                            <a href="<?php echo esc_url( get_permalink(3085) ); ?>">
                                <div class="grid" id="effect-5">
                                    <figure class="effect-selena">
                                        <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-product-demo4-1.jpg"/>
                                        
                                        <figcaption>
                                            <h3 style="margin-top: 53%;">品味食街 <span class="span-text-blue">|</span> YUMMY</h3>
                                            
                                            <p class="product-description" style="width: 100%;">秉持大规模、多品类、广范围与强带动四大特点，独创多样化、 便捷、速食、易携带的“手持式快餐食街”，为在地美食及文化注入舌尖上的品味新元素</p>
                                        </figcaption>   
                                                
                                    </figure>
                                </div>
                            </a>
                        </div>
                        <div class="xx-index-product-item col-md-4 col-xs-6">
                            <a href="<?php echo esc_url( get_permalink(3056) ); ?>">
                                <div class="grid" id="effect-5">
                                    <figure class="effect-selena">
                                        <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-product-demo5-1.jpg"/>

                                        <figcaption>
                                            <h3 style="margin-top: 53%;">演绎剧场 <span class="span-text-blue">|</span> SHOWS</h3>

                                            <p class="product-description" style="width: 100%;">引入高质量国际化的文化演出展览，落地专属剧场空间，打造社群生活多样且开放的崭新面貌，提升外来用户的在地体验与归属情怀</p>
                                        </figcaption>

                                    </figure>
                                </div>
                            </a>
                        </div>
                        <div class="xx-index-product-item more-item-div col-md-4 col-xs-6">
                            <a class="more-link " href="<?php echo esc_url( get_permalink(3161) ); ?>">
                                  <p class="xx-more-en">MORE</p>
                                  <p class="xx-more-zh">查看更多<span class="xx-index-span glyphicon glyphicon-menu-right"></span></p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="xx-index-member" style="background-image: url(<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_member_02.jpg);">
                    <div class="xx-index-membercenter" style="font-size:size:1.9rem;">
                        <p><span class="xx-title-en">IP</span>联盟 | <span class="xx-title-en">THE LEAGUE</span></p>
                        <p>乡香文化以平台之力聚合一系列优质特色创新IP，赋予其跨越文化直至空间集合的多维度呈现方式，开启文创领域的模式升级与多方联动，实现新文创反哺附能文旅生态圈。</p>
                        <p>乡香IP联盟将全方位塑造汇集人文情感色彩与自然情怀于一体的新型生活导向，赋予未来理想生活状态更多元化及个性化的选择，聚合品牌之力创造链接人与未来的无限可能。</p>
                        <p class=" hidden-xs hidden-sm xx-content-en">Villagenes takes on an innovative and pioneering approach for redefining new choices of  lifestyle where it brings together a wide spectrum of quality cultural tourism brands, Intelligent Properties, spaces & estates, resources and projects from a holistic value adding perspective, online and offline.</p>
                        <!-- show in xs sm-->
                          <div class="xx-index-membercenter more visible-xs visible-sm">
                                     <h4 class="panel-title">
                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapsetwo"> <i class="fa fa-angle-double-down" aria-hidden="true"></i></a>
                                     </h4>

                                     <div id="collapsetwo" class="panel-collapse collapse">
                                        <p class="xx-content-en">Villagenes takes on an innovative and pioneering approach for redefining new choices of  lifestyle where it brings together a wide spectrum of quality cultural tourism brands, Intelligent Properties, spaces & estates, resources and projects from a holistic value adding perspective, online and offline.</p>
                              </div>
                           </div>


                        <p><img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_hotimg_01.png" alt="" /></p>
                    </div>
                </div>

                
                <div class="xx-index-title-section">
                    <p>特色<span class="xx-title-en">IP</span> | <span class="xx-title-en">FEATURED IP</span></p>
                </div>
                <div class="xx-index-ip">
                    <div class="flexChild xx-index-ip-left" style="background-image: url(<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_ipimg.jpg);">
                        <div class="ip-container">
                            <div class="ip-slider-title">
                                <span class="span-accent">心灵对话体验 | 民宿 |</span>
                                <a class="ip-slider-link" href=""><span class="span-normal">二更呆住</span></a>
                            </div>
                            <hr>
                            <div class="ip-slider-description-container">
                                <div class="ip-slider-description">
                                    <p>Less is more, unlock the power of slowing down.<br>
                                        以呆文化为主题，专注于多维度多业态的经营模式，打造精心闲在的精品酒店艺术品牌。<br>
                                    呆住当下，觉知生活</p>
                                </div>
                                
                                <img class="icon-line" src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/11/icon-line.png">
                                <p>SHARE</p>
                                <?php 
                                    if(function_exists('ushare_weixin_display')){
                                        ushare_weixin_display( array('icon' => 'u-icon-weixin', 'style' => 'style-custom sharp style-blue', 'label' => '', 'network' => 'weixin') );
                                    }
                                    if(function_exists('ushare_weibo_display')){
                                        ushare_weibo_display( array('icon' => 'u-icon-weibo', 'style' => 'style-custom sharp style-blue', 'label' => '', 'network' => 'weibo', '') );
                                    }
                                ?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="flexChild xx-index-ip-right">
                        <div class="xx-index-ip-container">
                            <div class="xx-index-ip-content">
                                <div id="index-slider-ip">
                                    
                                </div>
                                <div class="slider-btn"/>
                                    <div class="slider-btn-count"/>
                                        <span class="slider-btn-count-num"></span> / 5
                                    </div>
                                    <div class="slider-btn-left"/>
                                        
                                    </div>
                                    <div class="slider-btn-right"/>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="slider-btn-center"/>
                        <p><i class="fa fa-angle-double-down"></i></p>
                        <p class="font-bold">Scroller<br>Pour En Voir Plus</p>
                    </div> -->
                </div>

                <div class="xx-index-partner clearfix" style="background-image: url(<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_aboutbg_02.jpg);">
                    <div class="xx-index-partner-section clearfix">
                     <div class='row'>
                        <div class="xx-index-partner-item col-xs-4 col-md-2">
                            <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_partner01.jpg" alt="" />
                        </div>
                        <div class="xx-index-partner-item col-xs-4 col-md-2">
                            <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_partner02.jpg" alt="" />
                        </div>
                        <div class="xx-index-partner-item col-xs-4 col-md-2">
                            <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_partner03.jpg" alt="" />
                        </div>
                        <div class="xx-index-partner-item col-xs-4 col-md-2">
                            <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_partner04.jpg" alt="" />
                        </div>
                        <div class="xx-index-partner-item col-xs-4 col-md-2">
                            <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2018/01/xx_index_partner05.jpg" alt="" />
                        </div>

                        <div class="xx-index-partner-item  col-xs-4 col-md-2">
                            <a href="<?php echo esc_url( get_permalink(3041) ); ?>">
                                <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2018/01/xx_index_partner_more-1.jpg" alt="" />
                            </a>
                        </div>
                        </div>

                    </div>
                </div>

               <div class="xx-index-voices clearfix"  style="background: url(<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_voices_03.jpg) no-repeat;">
                       <div class="css-slider-wrapper" >
                             <input type="radio" name="slider" class="slide-radio1" checked="" id="slider_1">
                             <input type="radio" name="slider" class="slide-radio2" id="slider_2">
                             <input type="radio" name="slider" class="slide-radio3" id="slider_3">
                             <input type="radio" name="slider" class="slide-radio4" id="slider_4">
                             <input type="radio" name="slider" class="slide-radio5" id="slider_5">
                             <div class="slider-pagination">
                                 <label for="slider_1" class="page1"></label>
                                 <label for="slider_2" class="page2"></label>
                                 <label for="slider_3" class="page3"></label>
                                 <label for="slider_4" class="page4"></label>
                                 <label for="slider_5" class="page5"></label>
                             </div>
                             <div class="next control">
                                 <label for="slider_1" class="numb1"><i class="fa  fa-angle-right "></i></label>
                                 <label for="slider_2" class="numb2"><i class="fa  fa-angle-right "></i></label>
                                 <label for="slider_3" class="numb3"><i class="fa  fa-angle-right "></i></label>
                                 <label for="slider_4" class="numb4"><i class="fa  fa-angle-right "></i></label>
                                 <label for="slider_5" class="numb5"><i class="fa  fa-angle-right "></i></label>
                             </div>
                             <div class="previous control">
                                 <label for="slider_1" class="numb1"><i class="fa fa-angle-left"></i></label>
                                 <label for="slider_2" class="numb2"><i class="fa fa-angle-left"></i></label>
                                 <label for="slider_3" class="numb3"><i class="fa fa-angle-left"></i></label>
                                 <label for="slider_4" class="numb4"><i class="fa fa-angle-left"></i></label>
                                 <label for="slider_5" class="numb5"><i class="fa fa-angle-left"></i></label>
                             </div>
                             <div class="slider slide1">
                                 <div>
                                     <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/slider_fbg_03.png" alt="" />
                                     <p>在现代经济背景下，文旅产业对传统产业结构转型起推动作用，其发展可以调节第二产业和第三产业的关系，同时还可以在传统服务产业中派生出新的门类，并有利于传统服务产业的升级。通过对城市消费市场的强拉动能力，形成持续不断的消费热点。与此同时， 对相关产业资源整合利用、效益增值有促进作用。因而通过专业科学的切入点进入产业市场，已成为未来资本的重要流向选择之一。</p>
                                     <br><br><p class="text-center">               鄂旅投</p>
                                 </div>
                             </div>
                             <div class="slider slide2">
                                 <div>
                                      <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/slider_fbg_03.png" alt="" />
                                      <p>季节性作为文旅产业一大典型特征，如何扬长避短缩减两季的差异化成为始终需要研究的课题。需要从业态规划定位就开始研究设置能够吸引游客淡季旅游的旅游产品和旅游服务，并且在商业业态中如何呈现落地，乡香文化在前期部署规划及快速落地呈现领域的领先水准在整体解决商业业态——旅游产品体系——旅游淡旺季的条线问题上具备关键优势。</p>
                                  <br><br><p class="text-center">多彩投</p>
                                  </div>
                             </div>
                             <div class="slider slide3">
                                 <div>
                                    <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/slider_fbg_03.png" alt="" />
                                    <p>关于文旅综合体的品牌对象，其并非普通的商户，甚至无需已成一体的大型品类。除立足于本地化之外，更需一群对待“食、宿、购、娱、文”等有特殊研究及追求的优质品牌。乡香文化所致力于的特色化品牌聚合，与众不同的文旅招商，在缔造有文化情怀的新型旅游产业中存在重要意义。与之相关的一切亦是考验一个平台成功与否的重要标准。</p>
                                 <br><br><p class="text-center">首旅集团</p>
                                 </div>
                             </div>

                             <div class="slider slide4">
                                 <div>
                                     <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/slider_fbg_03.png" alt="" />
                                     <p>直至2020年，我国旅游产业将实现质的飞跃，自此将从旅游大国迈向旅游强国的关键5年。中国文旅强化发展的时代已然到来。但中国文旅的发展仍然存在诸多需要提升与改进的内容，并需与城市特色和文化发展紧密结合，这亦成为中国文旅发展亟需解决的时代课题。</p>
                                 <br><br><p class="text-center">凤凰网</p>

                                 </div>
                             </div>
                              <div class="slider slide5">
                                  <div>
                                        <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/slider_fbg_03.png" alt="" />
                                        <p>我们始终倡导“旅游促进和平，旅游促进发展，旅游促进减贫”。当今社会，旅游业早就成为经济增长的重要支柱产业之一。同时，旅游产业产值继续保持高位增长态势。日益蓬勃旅游产业早已成为全国乃至全球的重要生态产业、美好生活的民生产业和转型升级的支柱性产业。愿乡香文化的新文旅聚合模式乘此长风，破万里浪，助力本土优质旅游资源圈层的再次腾飞。</p>
                                         <br><br><p class="text-center">世界旅游联盟</p>
                                    </div>
                              </div>
                         </div>
                </div>




                <div class="xx-index-contact">
                    <div class="xx-index-contactleft" style="background-size:cover; background-image: url(<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/xx_index_contactimg_02.jpg);">
                        <div class="xx-index-contact-form">
                            <h3>留言咨询 | <span class="xx-title-en">CONTACT</span></h3>
                            <p>你有话想对乡香说？我们在听。</p>
                           <form  id='index-form' target='id_iframe' action="https://api.villagenes.cn/forms/index.php/Contact/wpforms" method="post" class="wpcf7-form sent" novalidate="novalidate">
                                         <p><label><span>姓名</span> <span class="wpcf7-form-control-wrap names"><input type="text" name="names"  size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required xx-index-form" aria-required="true" aria-invalid="false"></span> </label></p>
                                         <p><label><span>邮箱</span> <span class="wpcf7-form-control-wrap email"><input type="email" name="email"  size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email xx-index-form" aria-required="true" aria-invalid="false"></span> </label></p>
                                         <p><label><span>主题</span> <span class="wpcf7-form-control-wrap subject"><input type="text" name="subject"  size="40" class="wpcf7-form-control wpcf7-text xx-index-form" aria-invalid="false"></span> </label></p>
                                         <p class="messageText"><label><span>内容</span> <span class="wpcf7-form-control-wrap message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea xx-index-form" aria-invalid="false"></textarea></span> </label></p>
                                         <p><input type="hidden" value="Villie_index" name="type"></p>
                                         <p class='tips wpcf7-response-output  wpcf7-display-none' style="display:none;"></p>
                                         <p><input type="submit"  value="Send" class="wpcf7-form-control wpcf7-submit"><span class="ajax-loader"></span></p>

                               </form>
                                <iframe id="id_iframe" name="id_iframe" style="display:none;"></iframe>

                        </div>
                    </div>
                    <div class="xx-index-contactright">
                        <div class="slider_container">
                            <div>
                                <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-contact-img2.jpg"/>
                            </div>
                            <div>
                                <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-contact-img1.jpg"/>
                            </div>
                            <div>
                                <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-contact-img2.jpg"/>
                            </div>
                            <div>
                                <img src="<?php echo wp_upload_dir()['baseurl']; ?>/2017/12/index-contact-img1.jpg"/>
                            </div>
                        </div>
                    </div>
                </div>
                

            <?php //the_content();?>
            <?php get_footer('xx'); ?>

        <!-- ========================Page Content End Here=========================  --> 
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

<?php //};?>


