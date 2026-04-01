(function () {
    /**
     * Helper to set up scrolling for a container
     */
    const setupScrollSlider = (containerSelector, prevBtnSelector, nextBtnSelector, scrollAmount) => {
        const container = $(containerSelector);
        const prevBtn = $(prevBtnSelector);
        const nextBtn = $(nextBtnSelector);

        if (!container.length) return;

        nextBtn.on('click', () => {
            container.animate({
                scrollLeft: container.scrollLeft() + scrollAmount
            }, 500);
        });

        prevBtn.on('click', () => {
            container.animate({
                scrollLeft: container.scrollLeft() - scrollAmount
            }, 500);
        });
    };

    /**
     * Category Slider (Grid)
     * For categories, we might want to toggle visibility if we want to keep the 
     * "show 3 at a time" logic while using Grid.
     */
    const setupCategoryCarousel = () => {
        const items = $('.OSCSS-columns-col');
        const prevBtn = $('#OSCSS-prev');
        const nextBtn = $('#OSCSS-next');
        if (!items.length) return;

        let currentIndex = 0;
        const itemsToShow = matchMedia('(max-width: 768px)').matches ? 1 : 3;

        const updateVisibility = () => {
            items.each(function(index) {
                if (index >= currentIndex && index < currentIndex + itemsToShow) {
                    $(this).show().css('opacity', 1);
                } else {
                    $(this).hide().css('opacity', 0);
                }
            });
        };

        nextBtn.on('click', () => {
            if (currentIndex + itemsToShow < items.length) {
                currentIndex += itemsToShow;
            } else {
                currentIndex = 0; // Loop
            }
            updateVisibility();
        });

        prevBtn.on('click', () => {
            if (currentIndex - itemsToShow >= 0) {
                currentIndex -= itemsToShow;
            } else {
                currentIndex = Math.max(0, items.length - itemsToShow); // Loop to end
            }
            updateVisibility();
        });

        // Initialize
        updateVisibility();
    };

    $(function () {
        // Portfolio Slider
        // Use scroll amount equal to card width (300px) + gap (24px)
        setupScrollSlider('.OSCSS-section-latest-list', '#OSCSS-portfolio-prev', '#OSCSS-portfolio-next', 324);

        // Category Carousel
        setupCategoryCarousel();

        // Reveal animations on scroll (optional improvement if classes exist)
        const reveal = () => {
            $('.animate-box-up').each(function() {
                const elementTop = $(this).offset().top;
                const windowBottom = $(window).scrollTop() + $(window).height();
                if (elementTop < windowBottom - 50) {
                    $(this).addClass('active');
                }
            });
        };
        
        $(window).on('scroll', reveal);
        reveal(); // Initial check
    });
}());
