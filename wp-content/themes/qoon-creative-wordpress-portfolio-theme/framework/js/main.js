var body = document.body;
body.addEventListener('touchstart',function(e){
});
body.addEventListener('mouseenter',function(e){

});
jQuery(function($){
	// ip slider
	var ip_slider = $("#index-slider-ip");
	if(ip_slider.length === 0){}
	else{
		$.get
		  (
		  oi_theme.ajax_url,{"action": "qoon_ajax_request_ip"},function(result,status)
			{
				$(result.new_posts).imagesLoaded( function(){
					result.forEach(function(item){
            			$("#index-slider-ip").append(`<div><a class="ip-slider-link" href="`+item.link+`"><img src='`+item.image[0]+`''></a></div>`);

            		});
            		var $Img=$("#index-slider-ip>div");
		            $("#index-slider-ip").width($(".xx-index-ip-left").width()*$Img.length);
		            $("#index-slider-ip div").width($(".xx-index-ip-left").width());

		            var title = $('.ip-slider-title .span-normal');
		            var subtitle = $('.ip-slider-title .span-accent');
		            var description = $('.ip-slider-description');
		            var title_div = $('.ip-slider-title');
		            var description_div = $('.ip-slider-description-container');
		            var link_title = $('.ip-slider-title .ip-slider-link');
		            
		            

		            title.html(result[0].title);
                    subtitle.html(result[0].tag + ' ｜');
                    description.html(result[0].description);
                    link_title.attr("href", result[0].link);

                    if(typeof ushare.data != "undefined")
                    {
                    	var ushare_wechat = $('.ip-slider-description-container .u-pophint .u-qrcode');
                    	ushare_wechat.attr("data-url", result[0].link);
	                    ushare.weibo_data['url'] = result[0].link;
	                    ushare.weibo_data['title'] = result[0].title;
	                    ushare.weibo_data['pic'] = result[0].image[0];
                    }

                	var i = 0;
                	$('.slider-btn-count-num').html(i+1);
		            function changeText(i) {

					    var tl1 = new TimelineLite();
						tl1.add(TweenLite.set(title_div, {y: 0, opacity: 1}));
						// tl1.add(TweenLite.fromTo(title_div, 0.2, {y: 0, opacity: 1}, {y: 20, opacity: 0}));
						tl1.add(TweenLite.fromTo(title_div, 0.8, {y: -20, opacity: 0}, {y: 0, opacity: 1}));

						var tl2 = new TimelineLite();
						tl2.add(TweenLite.set(description_div, {y: 0, opacity: 1}));
						// tl2.add(TweenLite.fromTo(description_div, 0.2, {y: 0, opacity: 1}, {y: 20, opacity: 0}));
						tl2.add(TweenLite.fromTo(description_div, 1, {y: -20, opacity: 0}, {y: 0, opacity: 1}));

		            	$('.ip-slider-title .span-normal').html(result[i].title);
	                    $('.ip-slider-title .span-accent').html(result[i].tag + ' ｜');
	                    $('.ip-slider-description').html(result[i].description);
	                    $('.slider-btn-count-num').html(i+1);
	                    $('.ip-slider-title .ip-slider-link').attr("href", result[i].link);
	                    
	                    
	                    if(typeof ushare.data != "undefined")
                    	{
                  			$('.ip-slider-description-container .u-pophint .u-qrcode').attr("data-url", result[i].link);
		                    ushare.weibo_data['title'] = result[i].title;
		                    ushare.weibo_data['url'] = result[i].link;
		                    ushare.weibo_data['pic'] = result[i].image[0];
		                }
		            }

		            $(".slider-btn-left").click(function(){
		            	if(!$("#index-slider-ip").is(":animated"))
	            		{
			                $("#index-slider-ip>div:last").prependTo("#index-slider-ip");
			                $("#index-slider-ip").css({"left":-$Img.eq(0).width()});
			                $("#index-slider-ip").not(":animated").animate({"left":0},500);
			                i--;
			                if(i < 0) {
			                    i=$Img.length-1;
			                }
			                changeText(i);
			            }
		            });

	            	$(".slider-btn-right").click(function(){
	            		if(!$("#index-slider-ip").is(":animated"))
	            		{
							$("#index-slider-ip").not(":animated").animate({"left":-$Img.eq(0).width()},500,function(){
			                    $("#index-slider-ip>div:first").appendTo("#index-slider-ip");
			                    $("#index-slider-ip").css({"left":0});
			                });
			                i++;
			                if(i>$Img.length-1){
			                    i=0;
			                }
			                changeText(i);
	            		}
		            	
		            });
	            
		            // $(".slider-btn-center").click(function(){
		            //     $("#index-slider-ip").not(":animated").animate({"left":-$Img.eq(0).width()},500,function(){
		            //         $("#index-slider-ip>div:first").appendTo("#index-slider-ip");
		            //         $("#index-slider-ip").css({"left":0});
		            //     });
		                
		            //     i++;
		            //     if(i>$Img.length-1){
		            //         i=0;
		            //     }
		            //     changeText(i);
		            // });
		          
		            var c = null;  
				    c = setTimeout(auto_slider,5000);//开始执行  
				    function auto_slider()
				    {  
				        clearTimeout(c);//清除定时器  
				    	$("#index-slider-ip").not(":animated").animate({"left":-$Img.eq(0).width()},500,function(){
		                    $("#index-slider-ip>div:first").appendTo("#index-slider-ip");
		                    $("#index-slider-ip").css({"left":0});
		                });
		                i++;
		                if(i>$Img.length-1){
		                    i=0;
		                }
		                changeText(i);
				    	c = setTimeout(auto_slider,5000); //设定定时器，循环执行               
				    }

				    $(".slider-btn").mouseover( function () {
						clearTimeout(c);
					});
					$(".slider-btn").mouseout( function () {
						c = setTimeout(auto_slider,5000);
					});
				});
			},
		"json"
		);
	}


	//index news list
	var news_div = $("#xx-index-news-sections");
	var i = 1;
	if(news_div.length === 0){}
	else{
		$.get
		  (
		  oi_theme.ajax_url,{"action": "qoon_ajax_request_inl"},function(result,status)
			{
				$(result.new_posts).imagesLoaded( function(){
					result.forEach(function(item){
            			$("#xx-index-news-sections .row").append(`
                     
							<div class="xx-index-news-item col-xs-6  col-md-3" >
	                            <a href="`+item.link+`">
	                                <div class="grid">
	                                    <figure class="effect-selena">
	                                        <img src="`+item.thumbnail+`"/>
	                                        
	                                        <figcaption>
	                                            <h3>`+item.index_title+` <span class="span-category span-text-`+item.class+`">`+item.category+`</span></h3>
	                                            
	                                            	<p>`+item.title+` <span class="span-category span-text-`+item.class+`">`+item.category+`</span><br><span class="span-subtitle">`+item.subtitle+`</span></p>
	                                            
	                                        </figcaption>   
	                                                
	                                    </figure>
	                                </div>
	                            </a>
	                        </div>`);
            			i++;
            		});
            		$("#xx-index-news-sections .row").append(`
            			<div class="xx-index-news-item more-item-div col-xs-6 col-md-3" style="background-color: #313131;">
                            <a class="more-link" href="`+directory_uri.more_news_url+`">
                           
                                <p class="xx-more-en">MORE</p>
                                <p class="xx-more-zh">查看更多<span class="xx-index-span glyphicon glyphicon-menu-right"></span></p></figure>
                            </a>
                        </div>`);

            		// for(j=0; j<=i; j++)
            		// {
            		// 	var width = $('.center-title-div-'+j+' p').width();
            		// 	console.log(width);
            		// 	$('.center-title-div-'+j).width(width);
            		// }
            		
				});
			},
		"json"
		);
	}

	//more news page news list
	var more_news_container = $("#fh5co-board");
	if(more_news_container.length === 0){
	}
	else{
		$.get
		  (
		  oi_theme.ajax_url,{"action": "qoon_ajax_request_mnnl"},function(result,status)
			{
				$(result.new_posts).imagesLoaded( function(){
					var num = 0;
					result.forEach(function(item){
						if(item.id != '3622' && item.id != '3910' && item.id != '3843')
						{
							item.link = result[num].link;
							if(num>=2)
							{
								num=0;
							}
							else{
								num++;
							}
						}
            			$("#fh5co-board").append(`
							<li class="item">
								<div class="img-div">
									<a href="`+item.link+`">
										<img src="`+item.thumbnail+`">
									</a>
								</div>
              				</li>`);
            		});

            		for(var i=0; i<2; i++)
        			{
        				$("#fh5co-board").append(`
            			<li class="item">
			                <div class="img-div">
			                  <a href="#">
			                    <img src="`+directory_uri.upload_directory_uri+`/2017/12/xx-img-demo1.jpg">
			                  </a>
			                </div>
			            </li>
						<li class="item">
			                <div class="img-div">
			                  <a href="#">
			                    <img src="`+directory_uri.upload_directory_uri+`/2017/12/xx-img-demo2.jpg">
			                  </a>
			                </div>
			            </li>
			            <li class="item">
			                <div class="img-div">
			                  <a href="#">
			                    <img src="`+directory_uri.upload_directory_uri+`/2017/12/xx-img-demo1.jpg">
			                  </a>
			                </div>
			            </li>
			            `);
        			}

                    $('#fh5co-board').masonry({
                        itemSelector: '.item',
                        columnWidth: 10,
                        percentPosition: true,
                        resizeable: true,//窗口 resize时布局平滑流动.
                    });
                    new AnimOnScroll( document.getElementById( 'fh5co-board' ), {
                        minDuration : 0.4,
                        maxDuration : 0.7,
                        viewportFactor : 0.2
                    } );



				});
			},
		"json"
		);

		
	}


	//index product mode link
	$('#menu-item-4052 > a').click(function(e) {
		window.location.href= directory_uri.product_mode_page_url;
		e.preventDefault();
	});


	// news slider
	var news_slider = $(".index-news-newsbanners");

	if(news_slider.length === 0){}
	else{
		$.get
		  (
		  oi_theme.ajax_url,{"action": "qoon_ajax_request_in"},function(result,status)
			{
				$(result.new_posts).imagesLoaded( function(){
				var time=null;
				clearInterval(time)
				result.forEach(function(item){
        			$(".index-news-newsbanners").append("<div><div class=''><img src="+item.image[0]+"></div><p><span>"+item.date+"</span><span style='color:"+item.color+"'>"+item.tag+"</span></p><p>"+item.title+"</p><div class='index-news-active'></div></div>");
        		});
        		var $Div=$(".index-news-newsbanners>div");
				function animates(){
				    $(".index-news-newsbanners").not(":animated").animate({"left":-$Div.eq(0).outerWidth(true)},500,function(){
	                    $(".index-news-newsbanners>div:first").appendTo(".index-news-newsbanners");
	                    $(".index-news-newsbanners").css({"left":0})
	                });
				}
				$(".index-news-newsbanners").width($Div.eq(0).outerWidth(true)*$Div.length);
				$(".rights").click(function(){
	                animates();
	            });
				$(".lefts").click(function(){
					$(".index-news-newsbanners>div:last").prependTo(".index-news-newsbanners");
		            $(".index-news-newsbanners").css({"left":-$Div.eq(0).outerWidth(true)});
		            $(".index-news-newsbanners").not(":animated").animate({"left":0},500);
				});
				$(".index-news-newsbanner-container").hover(function(){
					clearInterval(time);
				},function(){
					// time=setInterval(animates,1500);
				})
				// time=setInterval(animates,1500);
				});
			},
		"json"
		);


	}

	//go to top

	$("a[href='#top']").click(function() {
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	$(".xx-index-hotimg").hover(function(){
		$(this).find(".xx-index-hotcover").stop().fadeIn(300);
		$(this).find(".xx-index-hotbg").stop().animate({width:"90%",height:"90%",marginTop:"5%"},300);
	},function(){
		$(this).find(".xx-index-hotcover").stop().fadeOut(300);
		$(this).find(".xx-index-hotbg").stop().animate({width:"100%",height:"100%",marginTop:"0"},300);
	});
	$(".xx-index-productan").hover(function(){
		$(this).find(".xx-index-producthide").stop().fadeIn(300);
		$(this).find(".xx-index-productbg img").stop().animate({width:"90%",height:"95%",paddingTop:"5%"},300);
		// $(this).stop().animate({paddingTop:"5%"},40);
	},function(){
		$(this).find(".xx-index-producthide").stop().fadeOut(300);
		$(this).find(".xx-index-productbg img").stop().animate({width:"100%",height:"100%",paddingTop:"0"},300);
		$(this).stop().animate({paddingTop:"0"},40);
	})

    // ip slider
	// var ip_slider_index = $(".index-ip-slider-main");
	// if(!ip_slider){}
	// else{
	// 	$.get
	// 	  (
	// 	  oi_theme.ajax_url,{"action": "qoon_ajax_request_ip"},function(result,status)
	// 		{
	// 			$(result.new_posts).imagesLoaded( function(){
	// 				result.forEach(function(item){
 //            			$(".index-ip-slider-main").append(`<div><p style='background: url(`+item.image[0]+`) 0 0;background-size: 200% 100%;'><span class='titles'><span>`+item.title+`</span><span>平台特色IP推荐 呆文化</span></span></p><p style='background: url(`+item.image[0]+`) -100% 0;background-size: 200% 100%;'></p><p class="link">`+item.link+`</p></div>`);
 //            		});
 //            		var $Img=$(".index-ip-slider-main>div");
	// 	            $(".index-ip-slider-main").width($Img.eq(0).width()*$Img.length);
	// 	            $(".right").click(function(){
	// 	                $(".index-ip-slider-main").not(":animated").animate({"left":-$Img.eq(0).width()},500,function(){
	// 	                    $(".index-ip-slider-main>div:first").appendTo(".index-ip-slider-main");
	// 	                    $(".index-ip-slider-main").css({"left":0})
	// 	                });
	// 	            });
	// 	            $(".left").click(function(){
	// 	                $(".index-ip-slider-main>div:last").prependTo(".index-ip-slider-main");
	// 	                $(".index-ip-slider-main").css({"left":-$Img.eq(0).width()});
	// 	                $(".index-ip-slider-main").not(":animated").animate({"left":0},500)
	// 	            });
	// 	            $(".index-ip-slider-main>div").click(function(){
	// 	            	$(this).children("p:eq(1)").css({
	// 	            		transform:"translateY(50px)",
	// 	            		animation: "opacityAll linear 1s",
	// 	            		visibility: "hidden"
	// 	            	});
	// 	            	$(this).children("p:eq(0)").css({
	// 	            		transform:"translateY(-50px)",
	// 	            		animation: "opacityAll linear 1s",
	// 	            		visibility: "hidden"
	// 	            	});

	// 	            	var ip_link = $(this).children(".link").html();

	//             		setTimeout(function(){
	//             			window.location.href=ip_link;
	//             		},500);
	// 	            });
	// 			});
	// 		},
	// 	"json"
	// 	);
	// }
	/*** 手机端文字折叠 ****/
    $('#collapseOne').prev().find('a').click(function (){
    	foldText("#collapseOne")
    });
    $('#collapsetwo').prev().find('a').click(function (){
    	foldText("#collapsetwo");
    });
    function foldText(content){
        if($(content).hasClass('in')){//已打开状态
            $(content).prev('.panel-title').find('i').removeClass('fa-angle-double-uo').addClass('fa-angle-double-down')
        }else{//未打开
            $(content).prev('.panel-title').find('i').removeClass('fa-angle-double-down').addClass('fa-angle-double-up')
        }
    }


    /**** 表单提交验证 ****/
    $('form').find("input[type='submit']").click(function(){


        if($("input[name='names']").val()==''){
            $(' .tips').html('姓名不能为空').fadeIn(1000);return false;
        }
        var re = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
        if (!re.test($("input[name='email']").val())) {

            $('.tips').html('邮箱格式错误！').fadeIn(1000);
            return false;
        }
        if($("input[name='subject']").val()==''){

            $('.tips').html('主题不能为空！').fadeIn(1000);return false;

        }
        if($("textarea[name='message']").val()==''){

            $('.tips').html('内容不能为空！').fadeIn(1000);return false;
        }
        // console.log('type='+type,'code='+code)
        $.ajax({
            url:'https://api.villagenes.cn/forms/index.php/contact/wpforms/' ,
            type: 'post',
            // async: false,
            data:$('form').serialize(),
            success: function (a) {
                $('.tips').html('提交成功，感谢您的留言！').fadeIn(1000);

                setTimeout(function(){
                  $("form ")[0].reset();
                    $('.tips').fadeOut(1000);


                },100)


            },
            error: function () {
            }
        })
        return false;
	})


})




