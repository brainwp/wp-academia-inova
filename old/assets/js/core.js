/* Twitter Plugin
================================================== */

$(function($){
	$(".tweet").tweet({
		username: "danielhellier",
		join_text: "auto",
		count: 1,
		loading_text: "loading tweets...",
		template: "{text}{time}"
	});
});


/* Progress Plugin
================================================== */

$(function() {
	$('#progressbar').each(function(){
		var t = $(this),
			dataperc = t.attr('data-perc'),
			barperc = Math.round(dataperc);
		t.find('.bar').animate({width:barperc+'%'}, dataperc*50);
		t.find('.label').append('<div class="perc"></div>');
		
		var current = 0;
		var rate = 1;

		var counter = setInterval(function(){
			if(current >= dataperc) clearInterval(counter);

			$(".perc").text(current +'%');

			current = parseInt(current) + parseInt(rate);

		}, dataperc*25 / (dataperc / rate));		
		
		function perc() {
			var length   = t.find('.bar').css('width'),
			    labelpos = (parseInt(length));
			t.find('.label').css('left', labelpos);
		}
		perc();
		setInterval(perc, 0);
	});
});


/* Countdown Widget
================================================== */

$(function() {
	launchTime = new Date(); // Set launch: [year], [month], [day], [hour]...
		launchTime.setDate(launchTime.getDate() + 50); // Add 13 days
	$("#countdown").countdown({until: launchTime, format: "odHMS"});
});


/* Subscribe Widget
================================================== */

$("#subscribe button").click(function() {

	var email	= $("#email").val();
	var emailReg = /^[a-zA-Z0-9._+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}(\.[a-zA-Z]{2,3})?(\.[a-zA-Z]{2,3})?$/;
	
	// client-side validation
	 if(emailReg.test(email) == false ){
		emailError = "Desculpe, o email parece está com erro!";
		return false;
	}

	$.ajax({
		type: "post",
		dataType: "json",
		url: "save-email.php",
		data: $("form#subscribe").serialize(),
		success: function(data) {
			
			$('#subscribe').html('Obrigado');

		}
	});
	return false;
});
