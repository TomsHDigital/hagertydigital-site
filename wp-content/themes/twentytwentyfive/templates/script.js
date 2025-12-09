// Mobile Menu Toggle
(function(){
    var toggle = document.querySelector('.mobile-menu-toggle');
    var mobileNav = document.querySelector('.mobile-nav');
    var navLinks = document.querySelectorAll('.mobile-nav a');
    
    if (toggle && mobileNav) {
        toggle.addEventListener('click', function() {
            toggle.classList.toggle('active');
            mobileNav.classList.toggle('active');
        });
        
        // Close menu when clicking a link
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                toggle.classList.remove('active');
                mobileNav.classList.remove('active');
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileNav.contains(e.target) && !toggle.contains(e.target)) {
                toggle.classList.remove('active');
                mobileNav.classList.remove('active');
            }
        });
    }
})();

// Intersection Observer for Scroll Animations
(function(){
    function onIntersection(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }

    var observer = new IntersectionObserver(onIntersection, {
        threshold: 0.1
    });

    // Observe all animated elements
    var animatedElements = document.querySelectorAll(
        '.animate-fade-in, .animate-slide-left, .animate-slide-right, .animate-slide-up, .animate-scale-in'
    );
    animatedElements.forEach(function(el) {
        observer.observe(el);
    });
})();

// Service card flip animation with auto-play
(function(){
    var cards = document.querySelectorAll('.service-card');
    var currentIndex = 0;
    var interval;
    var isManuallyHovering = false;
    
    function flipCard(index) {
        if (isManuallyHovering) return;
        
        // Flip all cards back first
        cards.forEach(function(card) {
            card.classList.remove('flipped');
        });
        
        // Flip the current card
        if (cards[index]) {
            cards[index].classList.add('flipped');
        }
    }
    
    function startAutoplay() {
        interval = setInterval(function() {
            if (!isManuallyHovering) {
                flipCard(currentIndex);
                currentIndex = (currentIndex + 1) % cards.length;
            }
        }, 2500);
    }
    
    // Manual hover to flip
    cards.forEach(function(card, index) {
        card.addEventListener('mouseenter', function() {
            isManuallyHovering = true;
            clearInterval(interval);
            
            cards.forEach(function(c) {
                c.classList.remove('flipped');
            });
            card.classList.add('flipped');
        });
        
        card.addEventListener('mouseleave', function() {
            isManuallyHovering = false;
            card.classList.remove('flipped');
            
            // Resume auto-play after leaving
            currentIndex = (index + 1) % cards.length;
            startAutoplay();
        });
    });
    
    if (document.readyState === 'complete') {
        startAutoplay();
    } else {
        window.addEventListener('load', startAutoplay);
    }
})();

// Logo marquee
(function(){
    var slider = document.getElementById('logo-marquee');
    if (!slider) return;
    var track = slider.querySelector('.marquee-track');
    
    function build(){
        var size = parseInt(slider.getAttribute('data-size') || '50', 10);
        var gap = parseFloat(slider.getAttribute('data-gap') || '100');
        var pps = parseFloat(slider.getAttribute('data-pps') || '60');
        
        slider.style.setProperty('--size', size + 'px');
        slider.style.setProperty('--gap', gap + 'px');
        
        track.querySelectorAll('.marquee-slide.is-clone').forEach(function(n){
            n.remove();
        });
        
        var baseItems = Array.from(track.querySelectorAll('.marquee-slide[data-base="1"]'));
        var baseWidth = 0;
        baseItems.forEach(function(el){
            baseWidth += el.getBoundingClientRect().width;
        });
        
        var baseWidthWithGaps = baseWidth + gap * (baseItems.length - 1);
        var distance = baseWidthWithGaps + gap;
        
        var containerWidth = slider.clientWidth;
        var requiredWidth = containerWidth + distance + size;
        
        while (track.scrollWidth < requiredWidth) {
            baseItems.forEach(function(orig){
                var clone = orig.cloneNode(true);
                clone.classList.add('is-clone');
                var img = clone.querySelector('img');
                if (img) img.setAttribute('aria-hidden','true');
                track.appendChild(clone);
            });
        }
        
        slider.style.setProperty('--distance', distance + 'px');
        slider.style.setProperty('--duration', (distance / pps) + 's');
        
        slider.classList.add('is-ready');
    }
    
    function debounce(fn, t){
        var id;
        return function(){
            clearTimeout(id);
            id=setTimeout(fn, t);
        };
    }
    
    if (document.readyState === 'complete') build();
    else window.addEventListener('load', build);
    
    window.addEventListener('resize', debounce(function(){
        slider.classList.remove('is-ready');
        build();
    }, 120));
})();

// Reviews Carousel - Mobile First: 1 card on mobile/tablet, 3 on desktop
(function(){
    var track = document.querySelector('.carousel-track');
    var prevBtn = document.querySelector('.carousel-nav.prev');
    var nextBtn = document.querySelector('.carousel-nav.next');
    
    if (!track || !prevBtn || !nextBtn) return;
    
    var cards = Array.from(track.querySelectorAll('.review-card'));
    var currentIndex = 0;
    var cardsToShow = 1;
    var cardWidth = 0;
    var gap = 15;
    var autoplayInterval;
    
    function getCardsToShow() {
        if (window.innerWidth >= 1600) {
            return 3; // Desktop
        } else {
            return 1; // Mobile and Tablet
        }
    }
    
    function updateCardWidth() {
        cardsToShow = getCardsToShow();
        if (cards.length > 0) {
            var containerWidth = track.parentElement.offsetWidth;
            if (cardsToShow === 1) {
                gap = 15;
                cardWidth = containerWidth;
            } else {
                gap = 25;
                cardWidth = (containerWidth - (gap * (cardsToShow - 1))) / cardsToShow;
            }
        }
    }
    
    function moveToIndex(index) {
        var maxIndex = cards.length - cardsToShow;
        if (index < 0) index = 0;
        if (index > maxIndex) index = maxIndex;
        
        var offset = -index * (cardWidth + gap);
        track.style.transform = 'translateX(' + offset + 'px)';
        currentIndex = index;
    }
    
    function nextSlide() {
        var maxIndex = cards.length - cardsToShow;
        if (currentIndex < maxIndex) {
            moveToIndex(currentIndex + 1);
        } else {
            moveToIndex(0);
        }
    }
    
    function prevSlide() {
        if (currentIndex > 0) {
            moveToIndex(currentIndex - 1);
        } else {
            moveToIndex(cards.length - cardsToShow);
        }
    }
    
    function startAutoplay() {
        stopAutoplay();
        autoplayInterval = setInterval(nextSlide, 4000);
    }
    
    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }
    
    nextBtn.addEventListener('click', function() {
        nextSlide();
        startAutoplay();
    });
    
    prevBtn.addEventListener('click', function() {
        prevSlide();
        startAutoplay();
    });
    
    // Pause on hover
    track.addEventListener('mouseenter', stopAutoplay);
    track.addEventListener('mouseleave', startAutoplay);
    
    function init() {
        updateCardWidth();
        moveToIndex(0);
        startAutoplay();
    }
    
    if (document.readyState === 'complete') {
        init();
    } else {
        window.addEventListener('load', init);
    }
    
    var resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            stopAutoplay();
            updateCardWidth();
            moveToIndex(0);
            startAutoplay();
        }, 250);
    });
})();

// Metrics Animation
document.addEventListener('DOMContentLoaded', function () {
    const section = document.querySelector('.hd-metrics');
    const cards = document.querySelectorAll('.hd-metric-card');
    const icons = document.querySelectorAll('.hd-metric-card__icon');

    if (!section || cards.length === 0) return;

    function revealElements() {
        cards.forEach((card, index) => {
            // card fade/slide animation
            setTimeout(() => {
                card.classList.add('hd-metric-card--visible');
            }, index * 120);

            // icon pop animation
            const icon = card.querySelector('.hd-metric-card__icon');
            if (icon) {
                icon.classList.add('hd-metric-card__icon--visible');
                icon.style.animationDelay = (index * 140) + 'ms';
            }
        });
    }

    // If browser doesn't support intersection observer
    if (!('IntersectionObserver' in window)) {
        revealElements();
        return;
    }

    const observer = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    revealElements();
                    observer.disconnect(); // only run once
                }
            });
        },
        { threshold: 0.3 }
    );

    observer.observe(section);
});