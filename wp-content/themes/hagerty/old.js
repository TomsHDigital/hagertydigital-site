// Hamburger Menu Toggle - Updated selectors for new header structure
(function(){
    var hamburger = document.getElementById('hamburgerBtn');
    var menuOverlay = document.getElementById('menuOverlay');
    var menuClose = document.querySelector('.menu-close-btn');
    var menuLinks = document.querySelectorAll('.menu-overlay a');
    var mobileHeaders = document.querySelectorAll('.menu-mobile-header');
    
    if (!hamburger || !menuOverlay) return;
    
    function closeMenu() {
        hamburger.classList.remove('active');
        menuOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    function openMenu() {
        hamburger.classList.add('active');
        menuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    hamburger.addEventListener('click', function() {
        if (menuOverlay.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });
    
    // Close button click handler
    if (menuClose) {
        menuClose.addEventListener('click', function() {
            closeMenu();
        });
    }
    
    // Close menu when clicking a link
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            closeMenu();
        });
    });
    
    // Mobile accordion menus
    mobileHeaders.forEach(function(header) {
        header.addEventListener('click', function() {
            var parent = header.parentElement;
            var isOpen = parent.classList.contains('open');
            
            // Close all other open menus
            document.querySelectorAll('.menu-mobile-item.open').forEach(function(item) {
                if (item !== parent) {
                    item.classList.remove('open');
                }
            });
            
            // Toggle current menu
            parent.classList.toggle('open');
        });
    });
    
    // Close menu when clicking outside
    menuOverlay.addEventListener('click', function(e) {
        if (e.target === menuOverlay) {
            closeMenu();
        }
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && menuOverlay.classList.contains('active')) {
            closeMenu();
        }
    });
})();

// Intersection Observer for Scroll Animations - REPEATABLE
(function(){
    function onIntersection(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            } else {
                // Remove class when element leaves viewport to allow re-animation
                entry.target.classList.remove('is-visible');
            }
        });
    }

    var observer = new IntersectionObserver(onIntersection, {
        threshold: 0.1,
        rootMargin: '-50px 0px'
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

// Number Counter Animation for Stats
(function(){
    function animateValue(element, start, end, duration, decimals, prefix, suffix) {
        var startTimestamp = null;
        var step = function(timestamp) {
            if (!startTimestamp) startTimestamp = timestamp;
            var progress = Math.min((timestamp - startTimestamp) / duration, 1);
            
            // Easing function for smooth animation
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
                    
                    // Check if already animated recently
                    var lastAnimated = countersAnimated.get(element);
                    var now = Date.now();
                    
                    if (lastAnimated && (now - lastAnimated) < 2000) {
                        return; // Don't re-animate if animated within last 2 seconds
                    }
                    
                    var target = parseFloat(element.getAttribute('data-target'));
                    var decimals = parseInt(element.getAttribute('data-decimals') || '0', 10);
                    var prefix = element.getAttribute('data-prefix') || '';
                    var suffix = element.getAttribute('data-suffix') || '';
                    
                    countersAnimated.set(element, now);
                    animateValue(element, 0, target, 2000, decimals, prefix, suffix);
                } else {
                    // Reset when out of view for re-animation
                    var element = entry.target;
                    var prefix = element.getAttribute('data-prefix') || '';
                    var suffix = element.getAttribute('data-suffix') || '';
                    var decimals = parseInt(element.getAttribute('data-decimals') || '0', 10);
                    
                    if (decimals > 0) {
                        element.textContent = prefix + '0' + suffix;
                    } else {
                        element.textContent = prefix + '0' + suffix;
                    }
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
        // Remove active from all cards and dots
        cards.forEach(function(card) {
            card.classList.remove('active');
        });
        dots.forEach(function(dot) {
            dot.classList.remove('active');
        });
        
        // Add active to current card and dot
        if (cards[index]) {
            cards[index].classList.add('active');
        }
        if (dots[index]) {
            dots[index].classList.add('active');
        }
        
        currentIndex = index;
    }
    
    // Click dot to change card
    dots.forEach(function(dot, index) {
        dot.addEventListener('click', function() {
            showCard(index);
            // Reset auto-advance timer when user interacts
            resetAutoAdvance();
        });
    });
    
    // Watch button functionality - now opens modal
    var watchBtns = document.querySelectorAll('.team-mobile-watch-btn');
    watchBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var card = btn.closest('.team-mobile-card');
            var memberId = card.getAttribute('data-member');
            openModal(memberId);
        });
    });
    
    // Auto-advance function
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
    
    // Initialize
    showCard(0);
    startAutoAdvance();
})();

// Team Member Modal - Updated with mobile scroll lock fix
(function(){
    var teamCards = document.querySelectorAll('.team-card');
    var modal = document.getElementById('teamModal');
    var modalClose = document.querySelector('.team-modal-close');
    var modalImage = document.getElementById('modalImage');
    var modalName = document.getElementById('modalName');
    var modalRole = document.getElementById('modalRole');
    var modalBio = document.getElementById('modalBio');
    
    if (!modal) return;
    
    // Team member data
    var teamData = {
        1: {
            name: 'Sam Hagerty',
            role: 'CEO',
            image: 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-25-at-10.56.55-1.jpeg',
            bio: 'Sam co-founded Hagerty Digital with a passion for helping businesses grow through digital marketing. With extensive experience in business strategy and digital transformation, Sam leads our vision and ensures every client receives exceptional results. His hands-on approach and dedication to innovation have made Hagerty Digital a trusted partner for businesses across the UK.'
        },
        2: {
            name: 'Elliot Hagerty',
            role: 'CEO',
            image: 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-25-at-10.59.01.jpeg',
            bio: 'Elliot brings creative vision and strategic thinking to Hagerty Digital as co-CEO. His expertise in building client relationships and understanding business needs has been instrumental in driving the agency\'s growth. Elliot is passionate about delivering measurable results and ensuring every project exceeds expectations.'
        },
        3: {
            name: 'Rob James',
            role: 'Head Of Marketing',
            image: 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-25-at-10.56.56.jpeg',
            bio: 'Rob leads our marketing strategy with a data-driven approach that delivers results. With years of experience in digital marketing, SEO, and content strategy, he ensures our clients achieve their growth objectives. Rob is known for his analytical mindset and creative problem-solving abilities.'
        },
        4: {
            name: 'Tom Coombs',
            role: 'Web Developer',
            image: 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-25-at-10.56.56-2.jpeg',
            bio: 'Tom is our technical expert, building high-performance websites that look great and convert visitors into customers. With expertise in modern web technologies and a keen eye for detail, Tom ensures every project is built to the highest standards. He specializes in WordPress, e-commerce, and custom web applications.'
        },
        5: {
            name: 'Alfie Bax',
            role: 'Marketing Apprentice',
            image: 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-25-at-10.56.56-1.jpeg',
            bio: 'Alfie is our rising star in the marketing world. As a marketing apprentice, he brings fresh perspectives and enthusiasm to every project. Alfie is passionate about learning and developing his skills in digital marketing, social media, and content creation.'
        },
        6: {
            name: 'Max Hendy',
            role: 'Paid Ads',
            image: 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-25-at-10.56.55.jpeg',
            bio: 'Max is our paid advertising specialist, managing PPC campaigns across Google Ads, Facebook, and other platforms. His data-driven approach and constant optimization ensure maximum ROI for our clients. Max has a proven track record of scaling campaigns while maintaining profitability.'
        },
        7: {
            name: 'Jessica',
            role: 'Social Media',
            image: 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/Temple1852Exterior1.webp',
            bio: 'Jessica manages our social media strategy and content creation. With a creative eye and deep understanding of social platforms, she helps brands build engaged communities and drive meaningful conversations. Jessica stays on top of the latest trends to keep our clients ahead of the curve.'
        }
    };
    
    // Store scroll position for mobile
    var scrollPosition = 0;
    
    function openModal(memberId) {
        var data = teamData[memberId];
        if (!data) return;
        
        modalImage.src = data.image;
        modalImage.alt = data.name;
        modalName.textContent = data.name;
        modalRole.textContent = data.role;
        modalBio.textContent = data.bio;
        
        // Store current scroll position and lock body scroll (mobile fix)
        scrollPosition = window.pageYOffset;
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = '-' + scrollPosition + 'px';
        document.body.style.width = '100%';
        
        modal.classList.add('active');
    }
    
    window.openModal = openModal; // Make it globally accessible
    
    function closeModal() {
        modal.classList.remove('active');
        
        // Restore body scroll (mobile fix)
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '';
        window.scrollTo(0, scrollPosition);
    }
    
    // Click on "More about" button
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

// Team Card Auto-Animation
(function(){
    var teamSection = document.getElementById('team');
    var teamCards = document.querySelectorAll('.team-deck .team-card');
    
    if (!teamSection || teamCards.length === 0) return;
    
    var autoAnimationInterval = null;
    var currentAutoIndex = 0;
    var isHovering = false;
    
    function startAutoAnimation() {
        if (autoAnimationInterval) return;
        
        autoAnimationInterval = setInterval(function() {
            if (isHovering) return;
            
            // Remove auto-active from all cards
            teamCards.forEach(function(card) {
                card.classList.remove('auto-active');
            });
            
            // Add auto-active to current card
            if (teamCards[currentAutoIndex]) {
                teamCards[currentAutoIndex].classList.add('auto-active');
            }
            
            // Move to next card
            currentAutoIndex = (currentAutoIndex + 1) % teamCards.length;
        }, 2500);
    }
    
    function stopAutoAnimation() {
        if (autoAnimationInterval) {
            clearInterval(autoAnimationInterval);
            autoAnimationInterval = null;
        }
        // Remove auto-active from all cards
        teamCards.forEach(function(card) {
            card.classList.remove('auto-active');
        });
    }
    
    // Pause auto-animation on hover
    teamCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            isHovering = true;
            // Remove auto-active from all cards when user hovers
            teamCards.forEach(function(c) {
                c.classList.remove('auto-active');
            });
        });
        
        card.addEventListener('mouseleave', function() {
            isHovering = false;
        });
    });
    
    // Start/stop auto-animation based on viewport visibility
    if ('IntersectionObserver' in window) {
        var teamObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    startAutoAnimation();
                } else {
                    stopAutoAnimation();
                }
            });
        }, { threshold: 0.3 });
        
        teamObserver.observe(teamSection);
    } else {
        // Fallback: just start it
        startAutoAnimation();
    }
})();

// Multi-Step Contact Form - 3 STEPS with Initial Choice
(function(){
    var formSteps = document.querySelectorAll('.form-step');
    var progressSteps = document.querySelectorAll('.progress-step');
    var progressLines = document.querySelectorAll('.progress-line');
    
    if (formSteps.length === 0) return;
    
    // Initial choice buttons
    var bookCallBtn = document.getElementById('bookCallBtn');
    var exploreServicesBtn = document.getElementById('exploreServicesBtn');
    
    // Navigation buttons
    var backToStep1Btn = document.getElementById('backToStep1');
    var toStep3Btn = document.getElementById('toStep3');
    var backToStep2Btn = document.getElementById('backToStep2');
    var submitFormBtn = document.getElementById('submitForm');
    
    function goToStep(stepNumber) {
        // Hide all steps
        formSteps.forEach(function(step) {
            step.classList.remove('active');
        });
        
        // Show target step
        var targetStep = document.getElementById('formStep' + stepNumber);
        if (targetStep) {
            targetStep.classList.add('active');
        }
        
        // Update progress indicators
        progressSteps.forEach(function(step, index) {
            if (index < stepNumber) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
        
        // Update progress lines
        progressLines.forEach(function(line, index) {
            if (index < stepNumber - 1) {
                line.classList.add('active');
            } else {
                line.classList.remove('active');
            }
        });
        
        // Scroll form into view
        var formSection = document.getElementById('contact');
        if (formSection) {
            var header = document.getElementById('siteHeader');
            var headerHeight = header ? header.offsetHeight : 0;
            var targetPosition = formSection.getBoundingClientRect().top + window.pageYOffset - headerHeight - 40;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }
    
    // Book a Call button - opens Calendly link (placeholder)
    if (bookCallBtn) {
        bookCallBtn.addEventListener('click', function(e) {
            e.preventDefault();
            // Replace this URL with actual Calendly link
            window.open('https://calendly.com/hagertydigital', '_blank');
        });
    }
    
    // Explore Services button - go to step 2 (services selection)
    if (exploreServicesBtn) {
        exploreServicesBtn.addEventListener('click', function() {
            goToStep(2);
        });
    }
    
    // Back to Step 1
    if (backToStep1Btn) {
        backToStep1Btn.addEventListener('click', function() {
            goToStep(1);
        });
    }
    
    // Step 2 to Step 3
    if (toStep3Btn) {
        toStep3Btn.addEventListener('click', function() {
            // Check if at least one service is selected
            var selectedServices = document.querySelectorAll('.service-checkbox input:checked');
            if (selectedServices.length === 0) {
                alert('Please select at least one service.');
                return;
            }
            goToStep(3);
        });
    }
    
    // Back to Step 2
    if (backToStep2Btn) {
        backToStep2Btn.addEventListener('click', function() {
            goToStep(2);
        });
    }
    
    // Submit Form
    if (submitFormBtn) {
        submitFormBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Validate required fields
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
            
            // Collect all form data
            var formData = {
                services: [],
                name: document.getElementById('contact-name') ? document.getElementById('contact-name').value : '',
                email: document.getElementById('contact-email') ? document.getElementById('contact-email').value : '',
                company: document.getElementById('contact-company') ? document.getElementById('contact-company').value : '',
                phone: document.getElementById('contact-phone') ? document.getElementById('contact-phone').value : '',
                message: document.getElementById('contact-message') ? document.getElementById('contact-message').value : ''
            };
            
            // Get selected services
            document.querySelectorAll('.service-checkbox input:checked').forEach(function(checkbox) {
                formData.services.push(checkbox.value);
            });
            
            // Log form data (replace with actual submission)
            console.log('Form submitted:', formData);
            
            // Show success message
            alert('Thank you for your enquiry! We will be in touch shortly.');
            
            // Reset form
            document.querySelectorAll('.service-checkbox input').forEach(function(cb) {
                cb.checked = false;
            });
            if (document.getElementById('contact-name')) document.getElementById('contact-name').value = '';
            if (document.getElementById('contact-email')) document.getElementById('contact-email').value = '';
            if (document.getElementById('contact-company')) document.getElementById('contact-company').value = '';
            if (document.getElementById('contact-phone')) document.getElementById('contact-phone').value = '';
            if (document.getElementById('contact-message')) document.getElementById('contact-message').value = '';
            
            // Go back to step 1
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
    // Add loaded class to body for any CSS transitions
    document.body.classList.add('loaded');
    
    // Check for reduced motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.body.classList.add('reduced-motion');
    }
});

// Header theme switching based on section (works on mobile & desktop)
(function () {
    var header = document.getElementById('siteHeader');
    var hamburger = document.getElementById('hamburgerBtn');
    var themedSections = document.querySelectorAll('[data-section-theme]');

    if (!header || !hamburger || !themedSections.length) return;

    function updateHeaderTheme() {
        var headerRect = header.getBoundingClientRect();
        var headerBottom = headerRect.bottom;

        var activeTheme = 'dark'; // default when no match (hero is dark)

        themedSections.forEach(function (section) {
            var rect = section.getBoundingClientRect();

            // Section is "active" if the header bottom sits within it
            if (rect.top <= headerBottom + 10 && rect.bottom >= headerBottom + 10) {
                var theme = section.getAttribute('data-section-theme');
                if (theme) {
                    activeTheme = theme;
                }
            }
        });

        if (activeTheme === 'light') {
            header.classList.add('scrolled');   // gives dark background
            hamburger.classList.add('dark');    // dark lines on light bg
        } else {
            header.classList.remove('scrolled');
            hamburger.classList.remove('dark');
        }
    }

    // Run on load + scroll + resize (no desktop/mobile width check)
    updateHeaderTheme();
    window.addEventListener('scroll', updateHeaderTheme, { passive: true });
    window.addEventListener('resize', updateHeaderTheme);
})();