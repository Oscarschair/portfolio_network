(function () {
	var curSlider, slidersArray;
	var curPortfolioSlider, portfolioSlidersArray;
	var showSlides = function() {
		i = curSlider;
		for (j = 0; j < slidersArray.length; j++) {
			slidersArray[i].style.zindex = j;
			if (matchMedia('(max-width: 460px)').matches) {
				if(j > 0){
					slidersArray[i].style.left = $('.OSCSS-columns').width() + "px" ;
					slidersArray[i].style.opacity = "0";
					slidersArray[i].style.width = "0";
				}else{
					slidersArray[i].style.left = "0px" ;
					slidersArray[i].style.opacity = "1";
					slidersArray[i].style.width = "100%";
				}
			}else{
				if(j > 2){
					slidersArray[i].style.left = $('.OSCSS-columns').width() / 3 + "px" ;
					slidersArray[i].style.opacity = "0";
					slidersArray[i].style.width = "0";
				}else{
					slidersArray[i].style.left = $('.OSCSS-columns').width() / 3 * j + "px" ;
					slidersArray[i].style.opacity = "1";
					slidersArray[i].style.width = "33%";
				}
			}
			i++;
			if(i>5){i=0};
		}
	}
	var showPortfolioSlides = function() {
		i = curPortfolioSlider;
		for (j = 0; j < portfolioSlidersArray.length; j++) {
			portfolioSlidersArray[i].style.zindex = j;
			if (matchMedia('(max-width: 460px)').matches) {
				if(j > 1){
					portfolioSlidersArray[i].style.left = $('.OSCSS-section-latest-list').width() + "px" ;
					portfolioSlidersArray[i].style.display = "none";
				}else{
					portfolioSlidersArray[i].style.left = $('.OSCSS-section-latest-list').width()/2*j + "px" ;
					portfolioSlidersArray[i].style.display = "block";
				}
			
			}else{
				portfolioSlidersArray[i].style.left = $('.OSCSS-section-latest-list').width()/5*j + "px" ;
				$('.OSCSS-section-latest').css("height",$('.OSCSS-section-latest-col-pic').height()+40+"px");
				$('.OSCSS-section-latest-title').css("line-height",$('.OSCSS-section-latest-col-pic').height()+40+"px");
				$('.OSCSS-section-latest-col').css("height",$('.OSCSS-section-latest-col-pic').height()+20+"px");
			}
			i++;
			if(i>4){i=0};
		}


	}
	var switchSlides = function(movement) {
		curSlider = curSlider + movement;
		if(curSlider>5){curSlider=0};
		if(curSlider<0){curSlider=5};
		showSlides();
	}
	var switchPortfolioSlides = function(movement) {
		curPortfolioSlider = curPortfolioSlider + movement;
		if(curPortfolioSlider>5){curPortfolioSlider=0};
		if(curPortfolioSlider<0){curPortfolioSlider=5};
		showPortfolioSlides();
	}
	var silderSetup = function() {
		curSlider = 0;
		slidersArray = $('.OSCSS-columns-col');
		$('#OSCSS-prev').css("left", $('#OSCSS-prev').width() * (-1) + "px");
		$('#OSCSS-next').css("left", $('.OSCSS-columns').width() + "px");
		
		$('#OSCSS-prev').on('click', function() {
			switchSlides(-1);
		});
		$('#OSCSS-next').on('click', function() {
			switchSlides(1);
		});
		showSlides();
		
		curPortfolioSlider = 0;
		portfolioSlidersArray = $('.OSCSS-section-latest-col');
		$('#OSCSS-portfolio-prev').css("left", $('#OSCSS-portfolio-prev').width() * (-1) + "px");
		$('#OSCSS-portfolio-next').css("left", $('.OSCSS-section-latest-list').width() + "px");

		$('#OSCSS-portfolio-prev').on('click', function() {
			switchPortfolioSlides(-1);
		});
		$('#OSCSS-portfolio-next').on('click', function() {
			switchPortfolioSlides(1);
		});

		showPortfolioSlides();
	};
	$(function(){
		silderSetup();
	});
}());
