jQuery(document).ready(function(){
	jQuery('.close_notification').click(function(){
		jQuery(this).parent().hide('slow');
	});
	jQuery( ".wp_notification" ).animate({    
    left: "+=50",
    height: "toggle"
  }, 1000);
});