jQuery(document).ready(function( $ ){

	$( '.cpa-color-picker' ).wpColorPicker();
	
	$('.custom_video_help_container a').click(function(event){
		event.preventDefault();
		//console.log( jQuery(this).data('pageid'));
		
		
		$.ajax({
			url: customvideoadminscripts.adminajax,
			type: 'post',
			data: {
				action: 'getvideocontent',
				pageid : $(this).data('pageid')
			},
			
			beforeSend: function() {
				//console.log("Loading");
				//customspin
				$('.custom_post_title').html( '' );
				$('.custom_post_content').html( '' );				
				$('.custom_post_video').find('.embed-container').html( '' );				
			
				$('.lds-dual-ring').show()
			},			
			
			success: function( data ) {
				//console.log(data);
				
				$('.lds-dual-ring').hide()
				$('.custom_post_title').html( data.title );
				$('.custom_post_content').html( data.content );
				$('.custom_post_video').find('.embed-container').html( data.videoembed );
				
			}
		})				
	})
	
});