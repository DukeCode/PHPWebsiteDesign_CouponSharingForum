/**
 * This file is used to provide some helper functions
 */

// original code cited from w3school while significant modification has been made
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("topButton").style.display = "block";
    } else {
        document.getElementById("topButton").style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
// citation end

// This element is cited from https://codepen.io/aleksandarp/pen/WzyEzp
$(".section").click(function() {
	$(this).removeClass("shrink");
	$(".section")
		.not(this)
		.each(function() {
			$(this).addClass("shrink");
		});
	$(".active").removeClass("active");
	$(this).addClass("active");
});
// citation ended