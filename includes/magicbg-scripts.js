jQuery(document).ready(function($) {

	window.widgetFormfield = '';

	jQuery('.upload_image_button').on('click', function() {
		window.widgetFormfield = jQuery('.upload_field',jQuery(this).parent());
		tb_show('Choose Image', 'media-upload.php?TB_iframe=true');
		return false;
	});

	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {
		if (window.widgetFormfield) {
			imgurl = jQuery('img',html).attr('src');
			window.widgetFormfield.val(imgurl);
			tb_remove();
		}
		else {
			window.original_send_to_editor(html);
		}
		window.widgetFormfield = '';
		window.imagefield = false;

		jQuery('#magicbg_preview_imageeeeee').attr('src', imgurl);
	}
	



});

