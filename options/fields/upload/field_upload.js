jQuery(document).ready(function(){

	
	/*
	 *
	 * NHP_Options_upload function
	 * Adds media upload functionality to the page
	 *
	 */
	 
	 var header_clicked = false;
	 
	jQuery("img[src='']").attr("src", nhp_upload.url);
	
	jQuery('#nhp-opts-form-wrapper').on('click', '.nhp-opts-upload', function() {
		header_clicked = true;
		formfield = jQuery(this).attr('rel-id');
        context = jQuery(this).parent();
		preview = jQuery(this).prev('img');
		tb_show('', 'media-upload.php?type=image&amp;post_id=0&amp;TB_iframe=true');
		return false;
	});
	
	
	// Store original function
	window.original_send_to_editor = window.send_to_editor;
	
	
	window.send_to_editor = function(html) {
		if (header_clicked) {
			var imgurl = jQuery('img',html).attr('src');
            
            var classes = jQuery('img', html).attr('class');
            var regex = /wp-image-([0-9]+)/g;
            var imgid = regex.exec(classes);
                imgid = imgid[1];
                     
            if (preview.attr('data-return') == 'id') {
                jQuery('#' + formfield, context).val(imgid);
            } else {
                jQuery('#' + formfield, context).val(imgurl);              
            }
			
			jQuery('#' + formfield, context).next().fadeIn('slow');
			jQuery('#' + formfield, context).next().next().fadeOut('slow');
			jQuery('#' + formfield, context).next().next().next().fadeIn('slow');
			jQuery(preview).attr('src' , imgurl);
			tb_remove();
			header_clicked = false;
		} else {
			window.original_send_to_editor(html);
		}
	}
	
	jQuery('#nhp-opts-form-wrapper').on('click', '.nhp-opts-upload-remove', function(){
		$relid = jQuery(this).attr('rel-id');
		jQuery('#'+$relid).val('');
		jQuery(this).prev().fadeIn('slow');
		jQuery(this).prev().prev().fadeOut('slow', function(){jQuery(this).attr("src", nhp_upload.url);});
		jQuery(this).fadeOut('slow');
	});
});