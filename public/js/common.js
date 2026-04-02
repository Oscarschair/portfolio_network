(function () {
	var navSearcher = function() {
		$('#OSCSS-nav-search').on('click', function() {
			var searcher = $('#OSCSS-searcher');
			searcher.toggleClass('active');
			
			if(searcher.hasClass('active')){
				$('#OSCSS-canvas').css('height','100%');
				$('#keyword').focus();
			} else {
				$('#OSCSS-canvas').css('height','0');
			}
		});
		$('#OSCSS-canvas').on('click', function() {
			$('#OSCSS-searcher').removeClass('active');
			$('#OSCSS-canvas').css('height','0');
		});
	};
	
	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box-up').waypoint( function( direction ) {
			if( direction === 'down' && !$(this.element).hasClass('animated') ) {
				i++;
				$(this.element).addClass('item-animate');
				setTimeout(function(){
					$('body .animate-box-up.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							el.addClass('fadeInUp animated');
							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
				}, 100);
			}
		} , { offset: '85%' } );
	};
	$(function(){
		contentWayPoint();
		navSearcher();
	});
}());
