(function () {

	$(function() {
	    $('.hamburger').click(function() {
		$(this).toggleClass('active');
	 
		if ($(this).hasClass('active')) {
		    $('.header-nav').addClass('active');
		} else {
		    $('.header-nav').removeClass('active');
		}
	    });

	    $('.header-nav-closer').click(function() {
		    $('.hamburger').removeClass('active');
		    $('.header-nav').removeClass('active');
	    });

	});

}());
