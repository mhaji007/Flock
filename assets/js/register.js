$(document).ready(function() {
	//On click signup, hide login and show registeration
	$("#signup").click(function() {
		$("#first").slideUp("slow", function () {
			$("#second").slideDown("slow");
		});
	});

	//On click signin, hide registeration and show login
	$("#signin").click(function() {
		$("#second").slideUp("slow", function () {
			$("#first").slideDown("slow");
		});
	});



});