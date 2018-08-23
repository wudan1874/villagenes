jQuery(document).ready(function() {

    jQuery('.left_upload_button').click(function() {
         targetfield = jQuery(this).prev('#left_box');
         tb_show('', 'media-upload.php?type=image&TB_iframe=true');
         return false;
    });

	window.send_to_editor = function(html) {
			 imgurl = jQuery('img',html).attr('src');
			 jQuery("#left_box").val(imgurl);
			 tb_remove();
		}

});