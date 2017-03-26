/* Author:
Roy Duineveld
*/

(function(){

	//Internet connection check on every form
	// $('form').submit(function(e) {
	//     $.ajax({
	//     	url: "http://moneycontrolling.com/",
	//     	cache: false,
	//     	error: function(){
	//     		e.preventDefault();
	//     		return false;
	//     		alert('Je bent niet verbonden met het internet!');
	//     	}
	//     });
	// });

	//Show password or name field after entering the email adres function
	function check_login(){
		$.ajax({
		    url: "http://moneycontrolling.com/email_exist/index/" + $("#login_email").val() + "/",
		    dataType: "text",
		    cache: false,
		    success: function(res) {
		        if(res == "TRUE"){
		        	$("#login_hide_password").slideDown();
		        	$("#login_hide_name").slideUp();
		        } else {
		        	if($("#login_hide_password").is(':visible')){
		        		$("#login_hide_password").slideUp();
		        		$("#login_hide_name").slideDown();
		        	}
		        }
		    },
		    error: function(){
		    	//alert('Je bent niet verbonden met het internet!');
		    }
		});
	}
	//Input changed?
	$("#login_email").bind('keyup change',function()
	{
		check_login();
	});
	//Just call on the home page, if input is filled by browser
	if(window.location.pathname == '/home' || window.location.pathname == '/' || window.location.pathname == '/home/submit'){
		check_login();
	}

	//Optimize the hero unit for mobile devices
	/*
	$('#what_is_a').click(function(){
		if( $('.hero-unit').is(':visible') ){
			$('.hero-unit').slideUp();
			$('#what_is_li').removeClass('active');
		} else {
			$('.hero-unit').slideDown();
			$('#what_is_li').addClass('active');
		}
	});
	*/

	//Click to open menu
	$('#click_menu').click(function(){
		$('.btn-navbar').click();
		$('#click_menu').hide();
	});

	//Toggle login function
	function toggle_login(){
		$('.row').slideUp(function(){
			$('.row .span3:first h2').text('Inloggen');
			$('.login_hide').hide();
			$('.login_change p').text('Na het invoeren van je email adres zal het wachtwoord veld verschijnen.');
			$('.row .span3 button').html('<i class="icon-ok icon-white"></i> <strong>Inloggen</strong>');
			$('.row').slideDown(function(){
				$('html,body').animate({scrollTop:$(".row").offset().top}, 500);
			});
		});
	}
	//Login clicked from home?
	$('#toggle_login').click(function(){
		toggle_login();
	});
	//Login hash in url?
	if(window.location.hash.slice(1) == 'login'){
		toggle_login();
	}

	//Password show for settings page
	$('#change_password_text').click(function(){
		$('#change_password_text').hide();
		$('#change_password').slideDown();
	});

	//htmlspecialchars in JS
	function escapeHtml(unsafe) {
	return unsafe
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;");
	}

	//Autocomplete if logged in
	if(typeof(users) != "undefined" && users !== null) {
		$('#autocomplete_name').autocomplete({
			minLength: 2,
			source: users,
			select: function( event, ui ) {
				$("#autocomplete_name").val( ui.item.label );
				$("#autocomplete_email").val( ui.item.email );
				return false;
			}
		}).data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a>" + escapeHtml(item.label) + "<br>" + escapeHtml(item.email) + "</a>" )
				.appendTo( ul );
		};
	}

})();