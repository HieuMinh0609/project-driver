$(document).ready(function() {
    $(".login_click").click(function(){
    	$(".form_login_action").show();
    	$("#form_register").hide();
    	$(this).addClass("login100_form_title")
    	$(".register_click").removeClass("login100_form_title")
    });
     $(".register_click").click(function(){
     	$(".form_login_action").hide();
    	$("#form_register").show();
    	$(this).addClass("login100_form_title")
    	$(".login_click").removeClass("login100_form_title")
     });

     $(".btn_primary_button").click(function(){
     	$(this).addClass("set_background")  	 
     });
    
 
});