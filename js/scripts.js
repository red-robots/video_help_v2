jQuery(document).ready(function(){
	
	jQuery('.custom_video_help_container a').click(function(event){
		event.preventDefault();
		console.log( jQuery(this).data('pageid'));
		
		
		jQuery.ajax({
			url: customvideoadminscripts.adminajax,
			type: 'post',
			data: {
				action: 'getvideocontent',
				pageid : jQuery(this).data('pageid')
			},
			
			beforeSend: function() {
				console.log("Loading");
				//customspin
				jQuery('.custom_post_title').html( '' );
				jQuery('.custom_post_content').html( '' );				
				jQuery('.custom_post_video').find('.embed-container').html( '' );				
			
				jQuery('.lds-dual-ring').show()
			},			
			
			success: function( data ) {
				console.log(data);
				
				jQuery('.lds-dual-ring').hide()
				jQuery('.custom_post_title').html( data.title );
				jQuery('.custom_post_content').html( data.content );
				jQuery('.custom_post_video').find('.embed-container').html( data.videoembed );
				
			}
		})				
	})
	
});