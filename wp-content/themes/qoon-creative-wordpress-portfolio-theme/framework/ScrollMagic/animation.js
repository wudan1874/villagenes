/*Villagenes Animation*/
jQuery(function ($) {
    var whale = $('#whale');

    TweenMax.from(whale, 3, {ease: Back.easeOut.config(1.7), left: "100%"}).delay(1);

    if(!whale){}
	else{
		var controller = new ScrollMagic.Controller();

		var introtl = new TweenMax.to('#whale', 1, { 
			bottom: '+=150',
			opacity: 0,
			ease: TweenLite.easeInOut
		});

		var scene = new ScrollMagic.Scene({
        triggerElement: '#slide-5-layer-4'
	    }).setTween([introtl])
	    // .addIndicators()
	    .addTo(controller);
	}
	// TweenMax.from(whale, 0, {ease: Back.easeOut.config(1.7), left: "100%"});

	// if(!whale){}
	// else{
	// 	var controller = new ScrollMagic.Controller();

		

	// 	var introtl = new TweenMax.to( '#whale', 1, {
 //        left: '-=100%'
	//     });

	//     var scene = new ScrollMagic.Scene({
	//         triggerElement: '#slide-3-layer-14',
	//     }).setTween([introtl])
	//     .addIndicators()
	//     .addTo(controller);
	// }
});