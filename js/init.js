//Hook up the tweet display

$(document).ready(function() {
						   
	$(".countdown").countdown({
				date: "21 Decemeber 2022 10:30:00",
				format: "on"
			},
			
			function() {
				// callback function
			});
});	


