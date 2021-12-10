(function () {
	var navSearcher = function() {
		$('#OSCSS-nav-search').on('click', function() {
			console.log($('#keyword'));
			if($('#GlobalSearcher').css('opacity') == 0){
				$('#GlobalSearcher').css('opacity','1');
				$('#keyword').css('pointer-events','all');
				$('#OSCSS-canvas').css('height','100%');
				$('#keyword').focus();
			}else{
				$('#GlobalSearcher').css('opacity','0');
				$('#keyword').css('pointer-events','none');
				$('#OSCSS-canvas').css('height','0');
			}
		});
		$('#OSCSS-canvas').on('click', function() {
			$('#GlobalSearcher').css('opacity','0');
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
