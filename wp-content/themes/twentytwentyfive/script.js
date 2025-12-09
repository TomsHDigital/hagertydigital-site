// Hamburger Menu Toggle
(function(){
    var hamburger = document.getElementById('hamburgerBtn');
    var menuOverlay = document.getElementById('menuOverlay');
    var menuClose = document.querySelector('.menu-close-btn');
    var menuLinks = document.querySelectorAll('.menu-overlay a');
    var mobileHeaders = document.querySelectorAll('.menu-mobile-header');
    
    if (!hamburger || !menuOverlay) return;
    
    var scrollPosition = 0;
    
    function closeMenu() {
        hamburger.classList.remove('active');
        menuOverlay.classList.remove('active');
        document.body.classList.remove('nav-open');
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '';
        window.scrollTo(0, scrollPosition);
    }

    function openMenu() {
        scrollPosition = window.pageYOffset;
        hamburger.classList.add('active');
        menuOverlay.classList.add('active');
        document.body.classList.add('nav-open');
        document.body.style.position = 'fixed';
        document.body.style.top = '-' + scrollPosition + 'px';
        document.body.style.width = '100%';
    }
    
    hamburger.addEventListener('click', function() {
        if (menuOverlay.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });
    
    if (menuClose) {
        menuClose.addEventListener('click', function() {
            closeMenu();
        });
    }
    
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            closeMenu();
        });
    });
    
    mobileHeaders.forEach(function(header) {
        header.addEventListener('click', function() {
            var parent = header.parentElement;
            
            document.querySelectorAll('.menu-mobile-item.open').forEach(function(item) {
                if (item !== parent) {
                    item.classList.remove('open');
                }
            });
            
            parent.classList.toggle('open');
        });
    });
    
    menuOverlay.addEventListener('click', function(e) {
        if (e.target === menuOverlay) {
            closeMenu();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && menuOverlay.classList.contains('active')) {
            closeMenu();
        }
    });
})();

// Header Scroll Behavior - SIMPLIFIED
(function() {
    var header = document.getElementById('siteHeader');
    if (!header) return;
    
    function updateHeader() {
        var scrollY = window.pageYOffset || document.documentElement.scrollTop;
        
        // Simple logic: if scrolled more than 10px, add scrolled class
        if (scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
    
    // Run on load
    updateHeader();
    
    // Run on scroll
    window.addEventListener('scroll', updateHeader, { passive: true });
})();

// Intersection Observer for Scroll Animations - REPEATABLE
(function(){
    function onIntersection(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            } else {
                entry.target.classList.remove('is-visible');
            }
        });
    }

    var observer = new IntersectionObserver(onIntersection, {
        threshold: 0.1,
        rootMargin: '-50px 0px'
    });

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
        
        cards.forEach(function(card) {
            card.classList.remove('flipped');
        });
        
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

// Reviews Carousel
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
            return 3;
        } else {
            return 1;
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

// Number Counter Animation for Stats
(function(){
    function animateValue(element, start, end, duration, decimals, prefix, suffix) {
        var startTimestamp = null;
        var step = function(timestamp) {
            if (!startTimestamp) startTimestamp = timestamp;
            var progress = Math.min((timestamp - startTimestamp) / duration, 1);
            
            var easeOutQuart = 1 - Math.pow(1 - progress, 4);
            var current = start + (end - start) * easeOutQuart;
            
            if (decimals > 0) {
                current = current.toFixed(decimals);
            } else {
                current = Math.floor(current);
            }
            
            element.textContent = (prefix || '') + current + (suffix || '');
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    function initCounters() {
        var statNumbers = document.querySelectorAll('.stat-number[data-target]');
        var metricValues = document.querySelectorAll('.hd-metric-card__value[data-target]');
        
        var allCounters = Array.from(statNumbers).concat(Array.from(metricValues));
        
        if (allCounters.length === 0) return;
        
        var observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };
        
        var countersAnimated = new WeakMap();
        
        var counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var element = entry.target;
                    
                    var lastAnimated = countersAnimated.get(element);
                    var now = Date.now();
                    
                    if (lastAnimated && (now - lastAnimated) < 2000) {
                        return;
                    }
                    
                    var target = parseFloat(element.getAttribute('data-target'));
                    var decimals = parseInt(element.getAttribute('data-decimals') || '0', 10);
                    var prefix = element.getAttribute('data-prefix') || '';
                    var suffix = element.getAttribute('data-suffix') || '';
                    
                    countersAnimated.set(element, now);
                    animateValue(element, 0, target, 2000, decimals, prefix, suffix);
                } else {
                    var element = entry.target;
                    var prefix = element.getAttribute('data-prefix') || '';
                    var suffix = element.getAttribute('data-suffix') || '';
                    
                    element.textContent = prefix + '0' + suffix;
                }
            });
        }, observerOptions);
        
        allCounters.forEach(function(counter) {
            counterObserver.observe(counter);
        });
    }
    
    if (document.readyState === 'complete') {
        initCounters();
    } else {
        window.addEventListener('load', initCounters);
    }
})();

// Metrics Animation - Enhanced
(function(){
    var section = document.querySelector('.hd-metrics');
    var cards = document.querySelectorAll('.hd-metric-card');
    
    if (!section || cards.length === 0) return;
    
    function revealElements() {
        cards.forEach(function(card, index) {
            setTimeout(function() {
                card.classList.add('is-visible');
            }, index * 100);
            
            var icon = card.querySelector('.hd-metric-card__icon');
            if (icon) {
                setTimeout(function() {
                    icon.style.transform = 'scale(1.15) rotate(10deg)';
                    setTimeout(function() {
                        icon.style.transform = '';
                    }, 300);
                }, index * 100 + 200);
            }
        });
    }
    
    function hideElements() {
        cards.forEach(function(card) {
            card.classList.remove('is-visible');
        });
    }
    
    if (!('IntersectionObserver' in window)) {
        revealElements();
        return;
    }
    
    var observer = new IntersectionObserver(
        function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    revealElements();
                } else {
                    hideElements();
                }
            });
        },
        { threshold: 0.2 }
    );
    
    observer.observe(section);
})();

// Mobile Team Carousel with Name Tooltips
(function(){
    var carousel = document.querySelector('.team-mobile-carousel');
    if (!carousel) return;
    
    var cards = Array.from(document.querySelectorAll('.team-mobile-card'));
    var dots = Array.from(document.querySelectorAll('.team-mobile-dot'));
    var currentIndex = 0;
    var autoAdvanceInterval;
    
    function showCard(index) {
        cards.forEach(function(card) {
            card.classList.remove('active');
        });
        dots.forEach(function(dot) {
            dot.classList.remove('active');
        });
        
        if (cards[index]) {
            cards[index].classList.add('active');
        }
        if (dots[index]) {
            dots[index].classList.add('active');
        }
        
        currentIndex = index;
    }
    
    dots.forEach(function(dot, index) {
        dot.addEventListener('click', function() {
            showCard(index);
            resetAutoAdvance();
        });
    });
    
    var watchBtns = document.querySelectorAll('.team-mobile-watch-btn');
    watchBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var card = btn.closest('.team-mobile-card');
            var memberId = card.getAttribute('data-member');
            if (typeof openModal === 'function') {
                openModal(memberId);
            }
        });
    });
    
    function autoAdvance() {
        var nextIndex = (currentIndex + 1) % cards.length;
        showCard(nextIndex);
    }
    
    function startAutoAdvance() {
        autoAdvanceInterval = setInterval(autoAdvance, 5000);
    }
    
    function resetAutoAdvance() {
        clearInterval(autoAdvanceInterval);
        startAutoAdvance();
    }
    
    showCard(0);
    startAutoAdvance();
})();

// Team Member Modal - Uses ACF data from teamData global variable
(function(){
    var teamCards = document.querySelectorAll('.team-card');
    var modal = document.getElementById('teamModal');
    var modalClose = document.querySelector('.team-modal-close');
    var modalImage = document.getElementById('modalImage');
    var modalName = document.getElementById('modalName');
    var modalRole = document.getElementById('modalRole');
    var modalBio = document.getElementById('modalBio');
    var modalLinkedIn = document.getElementById('modalLinkedIn');
    var modalEmail = document.getElementById('modalEmail');
    
    if (!modal) return;
    
    var modalScrollPosition = 0;

    function openModal(memberId) {
        // Use the global teamData variable set by PHP in front-page.php
        // This contains ACF field data for each team member
        if (typeof teamData === 'undefined' || !teamData[memberId]) {
            console.warn('Team data not found for member:', memberId);
            return;
        }
        
        var data = teamData[memberId];

        // Set modal content from ACF data
        if (modalImage) {
            modalImage.src = data.image || '';
            modalImage.alt = data.name || '';
        }
        if (modalName) {
            modalName.textContent = data.name || '';
        }
        if (modalRole) {
            modalRole.textContent = data.role || '';
        }
        if (modalBio) {
            modalBio.textContent = data.bio || '';
        }
        
        // Handle LinkedIn link
        if (modalLinkedIn) {
            if (data.linkedin && data.linkedin.length > 0) {
                modalLinkedIn.href = data.linkedin;
                modalLinkedIn.style.display = '';
            } else {
                modalLinkedIn.style.display = 'none';
            }
        }
        
        // Handle Email link
        if (modalEmail) {
            if (data.email && data.email.length > 0) {
                modalEmail.href = 'mailto:' + data.email;
                modalEmail.style.display = '';
            } else {
                modalEmail.style.display = 'none';
            }
        }

        modalScrollPosition = window.pageYOffset;
        document.body.style.overflow = 'hidden';
        modal.classList.add('active');
    }

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Make openModal globally accessible for mobile carousel
    window.openModal = openModal;

    teamCards.forEach(function(card) {
        var btn = card.querySelector('.more-about-btn');
        if (btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                var memberId = card.getAttribute('data-member');
                openModal(memberId);
            });
        }
    });
    
    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });
})();

// Team Card Auto-Hover Effect (Desktop)
(function(){
    var teamCards = document.querySelectorAll('.team-card');
    if (teamCards.length === 0) return;
    
    var currentIndex = 0;
    var autoHoverInterval;
    var isUserHovering = false;
    
    function activateCard(index) {
        if (isUserHovering) return;
        
        teamCards.forEach(function(card) {
            card.classList.remove('auto-active');
        });
        
        if (teamCards[index]) {
            teamCards[index].classList.add('auto-active');
        }
    }
    
    function startAutoHover() {
        autoHoverInterval = setInterval(function() {
            if (!isUserHovering) {
                activateCard(currentIndex);
                currentIndex = (currentIndex + 1) % teamCards.length;
            }
        }, 3000);
    }
    
    function stopAutoHover() {
        clearInterval(autoHoverInterval);
        teamCards.forEach(function(card) {
            card.classList.remove('auto-active');
        });
    }
    
    teamCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            isUserHovering = true;
            stopAutoHover();
        });
        
        card.addEventListener('mouseleave', function() {
            isUserHovering = false;
            startAutoHover();
        });
    });
    
    // Only run on desktop
    if (window.innerWidth > 1024) {
        startAutoHover();
    }
    
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) {
            if (!autoHoverInterval) {
                startAutoHover();
            }
        } else {
            stopAutoHover();
        }
    });
})();

// Contact Form Multi-Step
(function(){
    var step1 = document.getElementById('step1');
    var step2 = document.getElementById('step2');
    var step3 = document.getElementById('step3');
    
    var bookCallBtn = document.getElementById('bookCallBtn');
    var exploreServicesBtn = document.getElementById('exploreServicesBtn');
    var backToStep1Btn = document.getElementById('backToStep1');
    var toStep3Btn = document.getElementById('toStep3');
    var backToStep2Btn = document.getElementById('backToStep2');
    var submitFormBtn = document.getElementById('submitForm');
    
    if (!step1) return;
    
    function goToStep(stepNum) {
        if (step1) step1.classList.remove('active');
        if (step2) step2.classList.remove('active');
        if (step3) step3.classList.remove('active');
        
        if (stepNum === 1 && step1) step1.classList.add('active');
        if (stepNum === 2 && step2) step2.classList.add('active');
        if (stepNum === 3 && step3) step3.classList.add('active');
        
        var formCard = document.querySelector('.contact-form-card');
        if (formCard) {
            var header = document.getElementById('siteHeader');
            var headerHeight = header ? header.offsetHeight : 0;
            var targetPosition = formCard.getBoundingClientRect().top + window.pageYOffset - headerHeight - 40;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }
    
    if (bookCallBtn) {
        bookCallBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.open('https://calendly.com/hagertydigital', '_blank');
        });
    }
    
    if (exploreServicesBtn) {
        exploreServicesBtn.addEventListener('click', function() {
            goToStep(2);
        });
    }
    
    if (backToStep1Btn) {
        backToStep1Btn.addEventListener('click', function() {
            goToStep(1);
        });
    }
    
    if (toStep3Btn) {
        toStep3Btn.addEventListener('click', function() {
            var selectedServices = document.querySelectorAll('.service-checkbox input:checked');
            if (selectedServices.length === 0) {
                alert('Please select at least one service.');
                return;
            }
            goToStep(3);
        });
    }
    
    if (backToStep2Btn) {
        backToStep2Btn.addEventListener('click', function() {
            goToStep(2);
        });
    }
    
    if (submitFormBtn) {
        submitFormBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            var name = document.getElementById('contact-name');
            var email = document.getElementById('contact-email');
            var phone = document.getElementById('contact-phone');
            var message = document.getElementById('contact-message');
            
            if (!name || !name.value.trim()) {
                alert('Please enter your name.');
                if (name) name.focus();
                return;
            }
            if (!email || !email.value.trim() || !email.value.includes('@')) {
                alert('Please enter a valid email address.');
                if (email) email.focus();
                return;
            }
            if (!phone || !phone.value.trim()) {
                alert('Please enter your telephone number.');
                if (phone) phone.focus();
                return;
            }
            if (!message || !message.value.trim()) {
                alert('Please enter a message.');
                if (message) message.focus();
                return;
            }
            
            var formData = {
                services: [],
                name: document.getElementById('contact-name') ? document.getElementById('contact-name').value : '',
                email: document.getElementById('contact-email') ? document.getElementById('contact-email').value : '',
                company: document.getElementById('contact-company') ? document.getElementById('contact-company').value : '',
                phone: document.getElementById('contact-phone') ? document.getElementById('contact-phone').value : '',
                message: document.getElementById('contact-message') ? document.getElementById('contact-message').value : ''
            };
            
            document.querySelectorAll('.service-checkbox input:checked').forEach(function(checkbox) {
                formData.services.push(checkbox.value);
            });
            
            console.log('Form submitted:', formData);
            
            alert('Thank you for your enquiry! We will be in touch shortly.');
            
            document.querySelectorAll('.service-checkbox input').forEach(function(cb) {
                cb.checked = false;
            });
            if (document.getElementById('contact-name')) document.getElementById('contact-name').value = '';
            if (document.getElementById('contact-email')) document.getElementById('contact-email').value = '';
            if (document.getElementById('contact-company')) document.getElementById('contact-company').value = '';
            if (document.getElementById('contact-phone')) document.getElementById('contact-phone').value = '';
            if (document.getElementById('contact-message')) document.getElementById('contact-message').value = '';
            
            goToStep(1);
        });
    }
})();

// Touch/Swipe support for mobile carousel
(function(){
    var track = document.querySelector('.carousel-track');
    var container = document.querySelector('.carousel-track-container');
    
    if (!track || !container) return;
    
    var startX = 0;
    var currentX = 0;
    var isDragging = false;
    
    container.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
        isDragging = true;
    }, { passive: true });
    
    container.addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
    }, { passive: true });
    
    container.addEventListener('touchend', function() {
        if (!isDragging) return;
        isDragging = false;
        
        var diff = startX - currentX;
        var threshold = 50;
        
        if (Math.abs(diff) > threshold) {
            var nextBtn = document.querySelector('.carousel-nav.next');
            var prevBtn = document.querySelector('.carousel-nav.prev');
            
            if (diff > 0 && nextBtn) {
                nextBtn.click();
            } else if (diff < 0 && prevBtn) {
                prevBtn.click();
            }
        }
    });
})();

// Smooth scroll for anchor links
(function(){
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            var targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                var header = document.getElementById('siteHeader');
                var headerHeight = header ? header.offsetHeight : 0;
                var targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 40;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
})();

// Parallax effect for hero section (desktop only)
(function(){
    if (window.innerWidth < 1024) return;
    
    var heroContent = document.querySelector('.hero-content');
    if (!heroContent) return;
    
    window.addEventListener('scroll', function() {
        var scrolled = window.pageYOffset;
        if (scrolled < window.innerHeight) {
            heroContent.style.transform = 'translateY(' + (scrolled * 0.3) + 'px)';
            heroContent.style.opacity = 1 - (scrolled / window.innerHeight * 0.5);
        }
    });
})();

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    document.body.classList.add('loaded');
    
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.body.classList.add('reduced-motion');
    }
});

// Footer Reveal Effect
(function() {
    var footer = document.getElementById('siteFooter');
    
    if (!footer) return;
    
    function updateFooterReveal() {
        // Don't update if nav is open
        if (document.body.classList.contains('nav-open')) {
            return;
        }

        var footerHeight = footer.offsetHeight;
        var windowHeight = window.innerHeight;
        var documentHeight = document.documentElement.scrollHeight;
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        var scrollBottom = scrollTop + windowHeight;
        var distanceFromBottom = documentHeight - scrollBottom;

        document.body.style.paddingBottom = footerHeight + 'px';

        if (distanceFromBottom <= footerHeight) {
            var visibleAmount = footerHeight - distanceFromBottom;
            var opacity = Math.min(visibleAmount / footerHeight, 1);

            footer.style.opacity = opacity;
            footer.style.transform = 'translateY(' + Math.max(0, distanceFromBottom) + 'px)';
        } else {
            footer.style.opacity = 0;
            footer.style.transform = 'translateY(' + footerHeight + 'px)';
        }
    }
    
    updateFooterReveal();
    
    window.addEventListener('scroll', updateFooterReveal, { passive: true });
    
    window.addEventListener('resize', function() {
        updateFooterReveal();
    });
    
    window.addEventListener('load', function() {
        setTimeout(updateFooterReveal, 100);
    });
})();