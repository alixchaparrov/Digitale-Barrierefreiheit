/**
 * Hero Block Functionality
 * Enhances the hero block with interactive features and accessibility improvements
 */
(function($) {
    
    // Initialize Hero Block functionality
    function initHeroBlock() {
        const $heroBlock = $('.hero-block');
        
        if ($heroBlock.length === 0) return;
        
        // Improve keyboard navigation for interest buttons
        const $interestButtons = $heroBlock.find('.interest-button');
        
        $interestButtons.on('keydown', function(e) {
            // Add arrow key navigation between buttons
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                const $nextButton = $(this).next('.interest-button');
                if ($nextButton.length) {
                    $nextButton.focus();
                } else {
                    // Cycle to first button if at the end
                    $interestButtons.first().focus();
                }
            }
            
            if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                const $prevButton = $(this).prev('.interest-button');
                if ($prevButton.length) {
                    $prevButton.focus();
                } else {
                    // Cycle to last button if at the beginning
                    $interestButtons.last().focus();
                }
            }
        });
        
        // Add enhanced focus effect for accessibility
        $interestButtons.on('focus', function() {
            $(this).addClass('focus-visible');
        }).on('blur', function() {
            $(this).removeClass('focus-visible');
        });
        
        // Make hero responsive to screen height on very tall screens
        function adjustHeroHeight() {
            const windowHeight = window.innerHeight;
            const $heroBackground = $heroBlock.find('.hero-background');
            
            // If window is very tall, make hero take up more space
            if (windowHeight > 800 && window.innerWidth > 768) {
                $heroBackground.css('height', Math.min(600, windowHeight * 0.6) + 'px');
            } else {
                $heroBackground.css('height', '');
            }
        }
        
        // Run on load and resize
        adjustHeroHeight();
        $(window).on('resize', adjustHeroHeight);
        
        // Add ARIA live region for dynamic content (if needed)
        $heroBlock.find('.hero-cta').attr({
            'aria-live': 'polite',
            'aria-atomic': 'true'
        });
    }
    
    // Initialize on document ready
    $(document).ready(function() {
        initHeroBlock();
    });
    
  })(jQuery);