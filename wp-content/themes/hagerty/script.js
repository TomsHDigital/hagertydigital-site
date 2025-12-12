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

// Number Counter Animation for Stats (includes About Us page stats)
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
        var aboutStatValues = document.querySelectorAll('.about-stat-value[data-target]');
        var casestudiesStatValues = document.querySelectorAll('.casestudies-page-stat-value[data-target]');
        
        var allCounters = Array.from(statNumbers)
            .concat(Array.from(metricValues))
            .concat(Array.from(aboutStatValues))
            .concat(Array.from(casestudiesStatValues));
        
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
            modalBio.innerHTML = data.bio || '';
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
            
            teamCards.forEach(function(card) {
                card.classList.remove('auto-active');
            });
            
            if (teamCards[currentAutoIndex]) {
                teamCards[currentAutoIndex].classList.add('auto-active');
            }
            
            currentAutoIndex = (currentAutoIndex + 1) % teamCards.length;
        }, 2500);
    }
    
    function stopAutoAnimation() {
        if (autoAnimationInterval) {
            clearInterval(autoAnimationInterval);
            autoAnimationInterval = null;
        }
        teamCards.forEach(function(card) {
            card.classList.remove('auto-active');
        });
    }
    
    teamCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            isHovering = true;
            teamCards.forEach(function(c) {
                c.classList.remove('auto-active');
            });
        });
        
        card.addEventListener('mouseleave', function() {
            isHovering = false;
        });
    });
    
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
        startAutoAnimation();
    }
})();

// Multi-Step Contact Form - 3 STEPS with Initial Choice
(function(){
    var formSteps = document.querySelectorAll('.form-step');
    var progressSteps = document.querySelectorAll('.progress-step');
    var progressLines = document.querySelectorAll('.progress-line');
    
    if (formSteps.length === 0) return;
    
    var bookCallBtn = document.getElementById('bookCallBtn');
    var exploreServicesBtn = document.getElementById('exploreServicesBtn');
    
    var backToStep1Btn = document.getElementById('backToStep1');
    var toStep3Btn = document.getElementById('toStep3');
    var backToStep2Btn = document.getElementById('backToStep2');
    var submitFormBtn = document.getElementById('submitForm');
    
    function goToStep(stepNumber) {
        formSteps.forEach(function(step) {
            step.classList.remove('active');
        });
        
        var targetStep = document.getElementById('formStep' + stepNumber);
        if (targetStep) {
            targetStep.classList.add('active');
        }
        
        progressSteps.forEach(function(step, index) {
            if (index < stepNumber) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
        
        progressLines.forEach(function(line, index) {
            if (index < stepNumber - 1) {
                line.classList.add('active');
            } else {
                line.classList.remove('active');
            }
        });
        
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

// Footer is now a simple static footer - no reveal/transform effects

// ==========================
// MEET THE TEAM PAGE SCRIPTS
// ==========================

// Meet The Team - Mouse Following Tooltip
(function(){
    var tooltip = document.getElementById('mttCursorTooltip');
    var tooltipText = document.getElementById('mttTooltipText');
    var teamCards = document.querySelectorAll('.mtt-team-card');
    
    if (!tooltip || teamCards.length === 0) return;
    
    var isOverCard = false;
    var mouseX = 0;
    var mouseY = 0;
    
    // Update tooltip position with smooth follow
    function updateTooltipPosition() {
        if (isOverCard) {
            tooltip.style.left = mouseX + 'px';
            tooltip.style.top = (mouseY - 40) + 'px';
        }
        requestAnimationFrame(updateTooltipPosition);
    }
    
    updateTooltipPosition();
    
    // Track mouse movement
    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });
    
    teamCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            var memberName = card.getAttribute('data-member-name');
            var firstName = memberName ? memberName.split(' ')[0] : 'Team Member';
            tooltipText.textContent = 'More about ' + firstName;
            tooltip.classList.add('visible');
            isOverCard = true;
        });
        
        card.addEventListener('mouseleave', function() {
            tooltip.classList.remove('visible');
            isOverCard = false;
        });
    });
})();

// Meet The Team - Video Hover Playback
(function(){
    var teamCards = document.querySelectorAll('.mtt-team-card');
    
    if (teamCards.length === 0) return;
    
    teamCards.forEach(function(card) {
        var video = card.querySelector('.mtt-card-video');
        
        if (video && video.src) {
            // Mark card as having video
            card.classList.add('has-video');
            
            card.addEventListener('mouseenter', function() {
                video.currentTime = 0;
                var playPromise = video.play();
                
                if (playPromise !== undefined) {
                    playPromise.catch(function(error) {
                        console.log('Video autoplay prevented:', error);
                    });
                }
            });
            
            card.addEventListener('mouseleave', function() {
                video.pause();
                video.currentTime = 0;
            });
        }
    });
})();

// Meet The Team - Modal Functionality
(function(){
    var teamCards = document.querySelectorAll('.mtt-team-card');
    var modal = document.getElementById('mttModal');
    var modalClose = modal ? modal.querySelector('.mtt-modal-close') : null;
    var modalImage = document.getElementById('mttModalImage');
    var modalVideo = document.getElementById('mttModalVideo');
    var modalName = document.getElementById('mttModalName');
    var modalTitle = document.getElementById('mttModalTitle');
    var modalBio = document.getElementById('mttModalBio');
    var modalLinkedIn = document.getElementById('mttModalLinkedIn');
    var modalEmail = document.getElementById('mttModalEmail');
    
    if (!modal || teamCards.length === 0) return;
    
    var scrollPosition = 0;
    
    function openMttModal(memberId) {
        // Use the global mttTeamData variable set by PHP
        if (typeof mttTeamData === 'undefined' || !mttTeamData[memberId]) {
            console.warn('MTT Team data not found for member:', memberId);
            return;
        }
        
        var data = mttTeamData[memberId];
        
        // Set modal content
        if (modalImage) {
            modalImage.src = data.image || '';
            modalImage.alt = data.name || '';
        }
        
        if (modalName) {
            modalName.textContent = data.name || '';
        }
        
        if (modalTitle) {
            modalTitle.textContent = data.title || '';
        }
        
        if (modalBio) {
            modalBio.innerHTML = data.bio || '';
        }
        
        // Handle video
        if (modalVideo) {
            if (data.video && data.video.length > 0) {
                modalVideo.src = data.video;
                modalVideo.classList.add('active');
                modalVideo.currentTime = 0;
                var playPromise = modalVideo.play();
                if (playPromise !== undefined) {
                    playPromise.catch(function(error) {
                        console.log('Modal video autoplay prevented:', error);
                    });
                }
            } else {
                modalVideo.classList.remove('active');
                modalVideo.src = '';
            }
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
        
        // Show modal and lock scroll
        scrollPosition = window.pageYOffset;
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = '-' + scrollPosition + 'px';
        document.body.style.width = '100%';
        modal.classList.add('active');
    }
    
    function closeMttModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '';
        window.scrollTo(0, scrollPosition);
        
        // Stop video
        if (modalVideo) {
            modalVideo.pause();
            modalVideo.currentTime = 0;
        }
    }
    
    // Make function globally accessible
    window.openMttModal = openMttModal;
    
    // Click handlers for cards
    teamCards.forEach(function(card) {
        card.addEventListener('click', function() {
            var memberId = card.getAttribute('data-member-id');
            openMttModal(memberId);
        });
    });
    
    // Close button
    if (modalClose) {
        modalClose.addEventListener('click', closeMttModal);
    }
    
    // Click outside to close
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeMttModal();
        }
    });
    
    // Escape key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeMttModal();
        }
    });
})();

// Meet The Team - Card Entrance Animation
(function(){
    var teamCards = document.querySelectorAll('.mtt-team-card');
    
    if (teamCards.length === 0) return;
    
    var observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    var cardObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    teamCards.forEach(function(card, index) {
        // Set initial state
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        card.style.transition = 'opacity 0.6s ease ' + (index * 0.1) + 's, transform 0.6s ease ' + (index * 0.1) + 's';
        
        cardObserver.observe(card);
    });
})();
// ==========================
// SEO PAGE - FAQ ACCORDION
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.seo-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.seo-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                // Check if this item is already active
                var isActive = item.classList.contains('active');
                
                // Close all other items
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                });
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });
})();

// ==========================
// SEO PAGE - STATS COUNTER ANIMATION
// ==========================
(function(){
    var statNumbers = document.querySelectorAll('.seo-stat-number');
    
    if (statNumbers.length === 0) return;
    
    var animated = false;
    
    function animateValue(element, start, end, duration, suffix) {
        var startTimestamp = null;
        var step = function(timestamp) {
            if (!startTimestamp) startTimestamp = timestamp;
            var progress = Math.min((timestamp - startTimestamp) / duration, 1);
            var easeProgress = 1 - Math.pow(1 - progress, 3); // easeOutCubic
            var currentValue = Math.floor(easeProgress * (end - start) + start);
            element.textContent = currentValue + suffix;
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    function parseStatValue(text) {
        // Handle formats like "150%", "£2.5M+", "50+", "Top 10"
        var numMatch = text.match(/[\d.]+/);
        if (numMatch) {
            var num = parseFloat(numMatch[0]);
            var prefix = text.substring(0, text.indexOf(numMatch[0]));
            var suffix = text.substring(text.indexOf(numMatch[0]) + numMatch[0].length);
            return { num: num, prefix: prefix, suffix: suffix, original: text };
        }
        return null;
    }
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
                animated = true;
                
                statNumbers.forEach(function(stat) {
                    var originalText = stat.textContent;
                    var parsed = parseStatValue(originalText);
                    
                    if (parsed && parsed.num > 0) {
                        stat.textContent = parsed.prefix + '0' + parsed.suffix;
                        
                        setTimeout(function() {
                            var startTimestamp = null;
                            var duration = 2000;
                            
                            var step = function(timestamp) {
                                if (!startTimestamp) startTimestamp = timestamp;
                                var progress = Math.min((timestamp - startTimestamp) / duration, 1);
                                var easeProgress = 1 - Math.pow(1 - progress, 3);
                                var currentValue = easeProgress * parsed.num;
                                
                                // Format based on original number format
                                if (parsed.num % 1 !== 0) {
                                    stat.textContent = parsed.prefix + currentValue.toFixed(1) + parsed.suffix;
                                } else {
                                    stat.textContent = parsed.prefix + Math.floor(currentValue) + parsed.suffix;
                                }
                                
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                } else {
                                    stat.textContent = originalText;
                                }
                            };
                            window.requestAnimationFrame(step);
                        }, 100);
                    }
                });
            }
        });
    }, { threshold: 0.5 });
    
    var statsSection = document.querySelector('.seo-stats');
    if (statsSection) {
        observer.observe(statsSection);
    }
})();
// ==========================
// SEO PAGE - FAQ ACCORDION - FIXED
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.seo-page-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.seo-page-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                // Check if this item is already active
                var isActive = item.classList.contains('active');
                
                // Close all other items
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                });
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });
})();

// ==========================
// PPC PAGE - FAQ ACCORDION (same functionality)
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.ppc-page-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.ppc-page-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                var isActive = item.classList.contains('active');
                
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                });
                
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });
})();

// ==========================
// PPC PAGE - STATS COUNTER ANIMATION
// ==========================
(function(){
    var statNumbers = document.querySelectorAll('.ppc-page-stat-number');
    
    if (statNumbers.length === 0) return;
    
    var animated = false;
    
    function parseStatValue(text) {
        var numMatch = text.match(/[\d.]+/);
        if (numMatch) {
            var num = parseFloat(numMatch[0]);
            var prefix = text.substring(0, text.indexOf(numMatch[0]));
            var suffix = text.substring(text.indexOf(numMatch[0]) + numMatch[0].length);
            return { num: num, prefix: prefix, suffix: suffix, original: text };
        }
        return null;
    }
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
                animated = true;
                
                statNumbers.forEach(function(stat) {
                    var originalText = stat.textContent;
                    var parsed = parseStatValue(originalText);
                    
                    if (parsed && parsed.num > 0) {
                        stat.textContent = parsed.prefix + '0' + parsed.suffix;
                        
                        setTimeout(function() {
                            var startTimestamp = null;
                            var duration = 2000;
                            
                            var step = function(timestamp) {
                                if (!startTimestamp) startTimestamp = timestamp;
                                var progress = Math.min((timestamp - startTimestamp) / duration, 1);
                                var easeProgress = 1 - Math.pow(1 - progress, 3);
                                var currentValue = easeProgress * parsed.num;
                                
                                if (parsed.num % 1 !== 0) {
                                    stat.textContent = parsed.prefix + currentValue.toFixed(1) + parsed.suffix;
                                } else {
                                    stat.textContent = parsed.prefix + Math.floor(currentValue) + parsed.suffix;
                                }
                                
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                } else {
                                    stat.textContent = originalText;
                                }
                            };
                            window.requestAnimationFrame(step);
                        }, 100);
                    }
                });
            }
        });
    }, { threshold: 0.5 });
    
    var statsSection = document.querySelector('.ppc-page-stats');
    if (statsSection) {
        observer.observe(statsSection);
    }
})();

// ==========================
// PPC PAGE - SMOOTH SCROLL FOR ANCHOR LINKS
// ==========================
(function(){
    var ppcPage = document.querySelector('.ppc-page-hero');
    if (!ppcPage) return;
    
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            var targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                var headerOffset = 100;
                var elementPosition = targetElement.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
})();
// ==========================
// SEO PAGE - SMOOTH SCROLL FOR ANCHOR LINKS
// ==========================
(function(){
    var seoPage = document.querySelector('.seo-hero');
    if (!seoPage) return;
    
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            var targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                var headerOffset = 100;
                var elementPosition = targetElement.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
})();

// ==========================
// MENU CONTACT IMAGE SLIDESHOW
// Rotates images every 3 seconds with fade effect
// ==========================
(function(){
    // Slideshow for both desktop and mobile menus
    var slideshowContainers = [
        document.getElementById('menuContactSlideshow'),
        document.getElementById('menuMobileSlideshow')
    ];
    
    slideshowContainers.forEach(function(container) {
        if (!container) return;
        
        var slides = container.querySelectorAll('.menu-slideshow-slide');
        if (slides.length <= 1) return; // No need for slideshow with 1 or 0 slides
        
        var currentIndex = 0;
        var interval = null;
        
        function nextSlide() {
            // Remove active from current slide
            slides[currentIndex].classList.remove('active');
            
            // Move to next slide
            currentIndex = (currentIndex + 1) % slides.length;
            
            // Add active to new slide
            slides[currentIndex].classList.add('active');
        }
        
        function startSlideshow() {
            if (interval) return; // Already running
            interval = setInterval(nextSlide, 3000); // 3 seconds
        }
        
        function stopSlideshow() {
            if (interval) {
                clearInterval(interval);
                interval = null;
            }
        }
        
        // Start slideshow when menu opens
        var menuOverlay = document.getElementById('menuOverlay');
        if (menuOverlay) {
            // Use MutationObserver to detect menu open/close
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        if (menuOverlay.classList.contains('active')) {
                            startSlideshow();
                        } else {
                            stopSlideshow();
                            // Reset to first slide when menu closes
                            slides.forEach(function(slide, index) {
                                slide.classList.toggle('active', index === 0);
                            });
                            currentIndex = 0;
                        }
                    }
                });
            });
            
            observer.observe(menuOverlay, { attributes: true });
        }
        
        // Pause on hover
        container.addEventListener('mouseenter', stopSlideshow);
        container.addEventListener('mouseleave', function() {
            var menuOverlay = document.getElementById('menuOverlay');
            if (menuOverlay && menuOverlay.classList.contains('active')) {
                startSlideshow();
            }
        });
    });
})();
// ==========================
// WEB DESIGN PAGE - FAQ ACCORDION
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.webdesign-page-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.webdesign-page-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                var isActive = item.classList.contains('active');
                
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                });
                
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });
})();

// ==========================
// WEB DESIGN PAGE - STATS COUNTER ANIMATION
// ==========================
(function(){
    var statNumbers = document.querySelectorAll('.webdesign-page-stat-number');
    
    if (statNumbers.length === 0) return;
    
    var animated = false;
    
    function parseStatValue(text) {
        var numMatch = text.match(/[\d.]+/);
        if (numMatch) {
            var num = parseFloat(numMatch[0]);
            var prefix = text.substring(0, text.indexOf(numMatch[0]));
            var suffix = text.substring(text.indexOf(numMatch[0]) + numMatch[0].length);
            return { num: num, prefix: prefix, suffix: suffix, original: text };
        }
        return null;
    }
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
                animated = true;
                
                statNumbers.forEach(function(stat) {
                    var originalText = stat.textContent;
                    var parsed = parseStatValue(originalText);
                    
                    if (parsed && parsed.num > 0) {
                        stat.textContent = parsed.prefix + '0' + parsed.suffix;
                        
                        setTimeout(function() {
                            var startTimestamp = null;
                            var duration = 2000;
                            
                            var step = function(timestamp) {
                                if (!startTimestamp) startTimestamp = timestamp;
                                var progress = Math.min((timestamp - startTimestamp) / duration, 1);
                                var easeProgress = 1 - Math.pow(1 - progress, 3);
                                var currentValue = easeProgress * parsed.num;
                                
                                if (parsed.num % 1 !== 0) {
                                    stat.textContent = parsed.prefix + currentValue.toFixed(1) + parsed.suffix;
                                } else {
                                    stat.textContent = parsed.prefix + Math.floor(currentValue) + parsed.suffix;
                                }
                                
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                } else {
                                    stat.textContent = originalText;
                                }
                            };
                            window.requestAnimationFrame(step);
                        }, 100);
                    }
                });
            }
        });
    }, { threshold: 0.5 });
    
    var statsSection = document.querySelector('.webdesign-page-stats');
    if (statsSection) {
        observer.observe(statsSection);
    }
})();

// ==========================
// WEB DESIGN PAGE - SMOOTH SCROLL FOR ANCHOR LINKS
// ==========================
(function(){
    var webdesignPage = document.querySelector('.webdesign-page-hero');
    if (!webdesignPage) return;
    
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            var targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                var headerOffset = 100;
                var elementPosition = targetElement.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
})();
// ==========================
// WEB DEVELOPMENT PAGE - FAQ ACCORDION
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.webdev-page-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.webdev-page-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                var isActive = item.classList.contains('active');
                
                // Close all other FAQ items
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                    var otherQuestion = otherItem.querySelector('.webdev-page-faq-question');
                    if (otherQuestion) {
                        otherQuestion.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                    question.setAttribute('aria-expanded', 'true');
                }
            });
        }
    });
})();

// ==========================
// WEB DEVELOPMENT PAGE - STATS COUNTER ANIMATION
// ==========================
(function(){
    var statNumbers = document.querySelectorAll('.webdev-page-stat-number');
    
    if (statNumbers.length === 0) return;
    
    var animated = false;
    
    function parseStatValue(text) {
        var numMatch = text.match(/[\d.]+/);
        if (numMatch) {
            var num = parseFloat(numMatch[0]);
            var prefix = text.substring(0, text.indexOf(numMatch[0]));
            var suffix = text.substring(text.indexOf(numMatch[0]) + numMatch[0].length);
            return { num: num, prefix: prefix, suffix: suffix, original: text };
        }
        return null;
    }
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
                animated = true;
                
                statNumbers.forEach(function(stat) {
                    var originalText = stat.textContent;
                    var parsed = parseStatValue(originalText);
                    
                    if (parsed && parsed.num > 0) {
                        stat.textContent = parsed.prefix + '0' + parsed.suffix;
                        
                        setTimeout(function() {
                            var startTimestamp = null;
                            var duration = 2000;
                            
                            var step = function(timestamp) {
                                if (!startTimestamp) startTimestamp = timestamp;
                                var progress = Math.min((timestamp - startTimestamp) / duration, 1);
                                var easeProgress = 1 - Math.pow(1 - progress, 3);
                                var currentValue = easeProgress * parsed.num;
                                
                                if (parsed.num % 1 !== 0) {
                                    stat.textContent = parsed.prefix + currentValue.toFixed(1) + parsed.suffix;
                                } else {
                                    stat.textContent = parsed.prefix + Math.floor(currentValue) + parsed.suffix;
                                }
                                
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                } else {
                                    stat.textContent = originalText;
                                }
                            };
                            window.requestAnimationFrame(step);
                        }, 100);
                    }
                });
            }
        });
    }, { threshold: 0.5 });
    
    var statsSection = document.querySelector('.webdev-page-stats');
    if (statsSection) {
        observer.observe(statsSection);
    }
})();

// ==========================
// WEB DEVELOPMENT PAGE - SMOOTH SCROLL FOR ANCHOR LINKS
// ==========================
(function(){
    var webdevPage = document.querySelector('.webdev-page-hero');
    if (!webdevPage) return;
    
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            var targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                var headerOffset = 100;
                var elementPosition = targetElement.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
})();
// ==========================
// CRO PAGE - FAQ ACCORDION
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.cro-page-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.cro-page-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                var isActive = item.classList.contains('active');
                
                // Close all other FAQs
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                    var otherQuestion = otherItem.querySelector('.cro-page-faq-question');
                    if (otherQuestion) {
                        otherQuestion.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Toggle current FAQ
                if (!isActive) {
                    item.classList.add('active');
                    question.setAttribute('aria-expanded', 'true');
                }
            });
        }
    });
})();

// ==========================
// CRO PAGE - STATS COUNTER ANIMATION
// ==========================
(function(){
    var statNumbers = document.querySelectorAll('.cro-page-stat-number');
    
    if (statNumbers.length === 0) return;
    
    var animated = false;
    
    function parseStatValue(text) {
        var numMatch = text.match(/[\d.]+/);
        if (numMatch) {
            var num = parseFloat(numMatch[0]);
            var prefix = text.substring(0, text.indexOf(numMatch[0]));
            var suffix = text.substring(text.indexOf(numMatch[0]) + numMatch[0].length);
            return { num: num, prefix: prefix, suffix: suffix, original: text };
        }
        return null;
    }
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
                animated = true;
                
                statNumbers.forEach(function(stat) {
                    var originalText = stat.textContent;
                    var parsed = parseStatValue(originalText);
                    
                    if (parsed && parsed.num > 0) {
                        stat.textContent = parsed.prefix + '0' + parsed.suffix;
                        
                        setTimeout(function() {
                            var startTimestamp = null;
                            var duration = 2000;
                            
                            var step = function(timestamp) {
                                if (!startTimestamp) startTimestamp = timestamp;
                                var progress = Math.min((timestamp - startTimestamp) / duration, 1);
                                var easeProgress = 1 - Math.pow(1 - progress, 3);
                                var currentValue = easeProgress * parsed.num;
                                
                                if (parsed.num % 1 !== 0) {
                                    stat.textContent = parsed.prefix + currentValue.toFixed(1) + parsed.suffix;
                                } else {
                                    stat.textContent = parsed.prefix + Math.floor(currentValue) + parsed.suffix;
                                }
                                
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                } else {
                                    stat.textContent = originalText;
                                }
                            };
                            window.requestAnimationFrame(step);
                        }, 100);
                    }
                });
            }
        });
    }, { threshold: 0.5 });
    
    var statsSection = document.querySelector('.cro-page-stats');
    if (statsSection) {
        observer.observe(statsSection);
    }
})();

// ==========================
// CRO PAGE - SCROLL ANIMATIONS
// ==========================
(function(){
    var croPage = document.querySelector('.cro-page-hero');
    if (!croPage) return;
    
    var animatedElements = document.querySelectorAll('.animate-fade-in, .animate-slide-left, .animate-slide-right, .animate-scale-in');
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(function(el) {
        observer.observe(el);
    });
})();

// ==========================
// EMAIL MARKETING PAGE - FAQ ACCORDION
// ==========================
(function(){
    function initEmailFAQ() {
        var faqItems = document.querySelectorAll('.email-page-faq-item');
        
        if (faqItems.length === 0) return;
        
        faqItems.forEach(function(item) {
            var question = item.querySelector('.email-page-faq-question');
            
            if (question) {
                question.addEventListener('click', function(e) {
                    e.preventDefault();
                    var isActive = item.classList.contains('active');
                    
                    // Close all other FAQs
                    faqItems.forEach(function(otherItem) {
                        otherItem.classList.remove('active');
                        var otherQuestion = otherItem.querySelector('.email-page-faq-question');
                        if (otherQuestion) {
                            otherQuestion.setAttribute('aria-expanded', 'false');
                        }
                    });
                    
                    // Toggle current FAQ
                    if (!isActive) {
                        item.classList.add('active');
                        question.setAttribute('aria-expanded', 'true');
                    }
                });
            }
        });
    }
    
    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initEmailFAQ);
    } else {
        initEmailFAQ();
    }
})();

// ==========================
// EMAIL MARKETING PAGE - STATS COUNTER ANIMATION
// ==========================
(function(){
    function initEmailStats() {
        var statNumbers = document.querySelectorAll('.email-page-stat-number');
        
        if (statNumbers.length === 0) return;
        
        var animated = false;
        
        function parseStatValue(text) {
            var numMatch = text.match(/[\d.]+/);
            if (numMatch) {
                var num = parseFloat(numMatch[0]);
                var prefix = text.substring(0, text.indexOf(numMatch[0]));
                var suffix = text.substring(text.indexOf(numMatch[0]) + numMatch[0].length);
                return { num: num, prefix: prefix, suffix: suffix, original: text };
            }
            return null;
        }
        
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !animated) {
                    animated = true;
                    
                    statNumbers.forEach(function(stat) {
                        var originalText = stat.textContent;
                        var parsed = parseStatValue(originalText);
                        
                        if (parsed && parsed.num > 0) {
                            stat.textContent = parsed.prefix + '0' + parsed.suffix;
                            
                            setTimeout(function() {
                                var startTimestamp = null;
                                var duration = 2000;
                                
                                var step = function(timestamp) {
                                    if (!startTimestamp) startTimestamp = timestamp;
                                    var progress = Math.min((timestamp - startTimestamp) / duration, 1);
                                    var easeProgress = 1 - Math.pow(1 - progress, 3);
                                    var currentValue = easeProgress * parsed.num;
                                    
                                    if (parsed.num % 1 !== 0) {
                                        stat.textContent = parsed.prefix + currentValue.toFixed(1) + parsed.suffix;
                                    } else {
                                        stat.textContent = parsed.prefix + Math.floor(currentValue) + parsed.suffix;
                                    }
                                    
                                    if (progress < 1) {
                                        window.requestAnimationFrame(step);
                                    } else {
                                        stat.textContent = originalText;
                                    }
                                };
                                window.requestAnimationFrame(step);
                            }, 100);
                        }
                    });
                }
            });
        }, { threshold: 0.5 });
        
        var statsSection = document.querySelector('.email-page-stats');
        if (statsSection) {
            observer.observe(statsSection);
        }
    }
    
    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initEmailStats);
    } else {
        initEmailStats();
    }
})();

// ==========================
// EMAIL MARKETING PAGE - SCROLL ANIMATIONS
// ==========================
(function(){
    function initEmailAnimations() {
        var emailPage = document.querySelector('.email-page-hero');
        if (!emailPage) return;
        
        var animatedElements = document.querySelectorAll('.animate-fade-in, .animate-slide-left, .animate-slide-right, .animate-scale-in');
        
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, { threshold: 0.1 });
        
        animatedElements.forEach(function(el) {
            observer.observe(el);
        });
    }
    
    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initEmailAnimations);
    } else {
        initEmailAnimations();
    }
})();

// ==========================
// DIGITAL STRATEGY PAGE - FAQ ACCORDION
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.ds-page-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.ds-page-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                // Check if this item is already active
                var isActive = item.classList.contains('active');
                
                // Close all other items
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                });
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });
})();
// ==========================
// AUTOMATION PAGE - FAQ ACCORDION
// ==========================
(function(){
    var faqItems = document.querySelectorAll('.auto-page-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.auto-page-faq-question');
        
        if (question) {
            question.addEventListener('click', function() {
                // Check if this item is already active
                var isActive = item.classList.contains('active');
                
                // Close all other items
                faqItems.forEach(function(otherItem) {
                    otherItem.classList.remove('active');
                    var otherQuestion = otherItem.querySelector('.auto-page-faq-question');
                    if (otherQuestion) {
                        otherQuestion.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                    question.setAttribute('aria-expanded', 'true');
                }
            });
        }
    });
})();

// ==========================
// AUTOMATION PAGE - STATS COUNTER ANIMATION
// ==========================
(function(){
    var statNumbers = document.querySelectorAll('.auto-page-stat-number');
    
    if (statNumbers.length === 0) return;
    
    var animated = false;
    
    function parseStatValue(text) {
        var numMatch = text.match(/[\d.]+/);
        if (numMatch) {
            var num = parseFloat(numMatch[0]);
            var prefix = text.substring(0, text.indexOf(numMatch[0]));
            var suffix = text.substring(text.indexOf(numMatch[0]) + numMatch[0].length);
            return { num: num, prefix: prefix, suffix: suffix, original: text };
        }
        return null;
    }
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
                animated = true;
                
                statNumbers.forEach(function(stat) {
                    var originalText = stat.textContent;
                    var parsed = parseStatValue(originalText);
                    
                    if (parsed && parsed.num > 0) {
                        stat.textContent = parsed.prefix + '0' + parsed.suffix;
                        
                        setTimeout(function() {
                            var startTimestamp = null;
                            var duration = 2000;
                            
                            var step = function(timestamp) {
                                if (!startTimestamp) startTimestamp = timestamp;
                                var progress = Math.min((timestamp - startTimestamp) / duration, 1);
                                var easeProgress = 1 - Math.pow(1 - progress, 3);
                                var currentValue = easeProgress * parsed.num;
                                
                                if (parsed.num % 1 !== 0) {
                                    stat.textContent = parsed.prefix + currentValue.toFixed(1) + parsed.suffix;
                                } else {
                                    stat.textContent = parsed.prefix + Math.floor(currentValue) + parsed.suffix;
                                }
                                
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                } else {
                                    stat.textContent = originalText;
                                }
                            };
                            window.requestAnimationFrame(step);
                        }, 100);
                    }
                });
            }
        });
    }, { threshold: 0.5 });
    
    var statsSection = document.querySelector('.auto-page-stats');
    if (statsSection) {
        observer.observe(statsSection);
    }
})();

// ==========================
// AUTOMATION PAGE - SCROLL ANIMATIONS
// ==========================
(function(){
    var autoPage = document.querySelector('.auto-page-hero');
    if (!autoPage) return;
    
    var animatedElements = document.querySelectorAll('.animate-fade-in, .animate-slide-left, .animate-slide-right, .animate-scale-in');
    
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, { threshold: 0.1 });
    
    animatedElements.forEach(function(el) {
        observer.observe(el);
    });
})();
// ========================================
// TESTIMONIALS PAGE SCRIPTS
// ========================================

// Testimonials Counter Animation
(function() {
    function animateCounters() {
        var counters = document.querySelectorAll('.testimonials-page-counter');
        
        counters.forEach(function(counter) {
            var target = parseFloat(counter.getAttribute('data-target')) || 0;
            var suffix = counter.getAttribute('data-suffix') || '';
            var duration = 2000;
            var start = 0;
            var startTime = null;
            var isDecimal = target % 1 !== 0;
            
            function easeOutQuart(t) {
                return 1 - Math.pow(1 - t, 4);
            }
            
            function updateCounter(timestamp) {
                if (!startTime) startTime = timestamp;
                var progress = Math.min((timestamp - startTime) / duration, 1);
                var easedProgress = easeOutQuart(progress);
                var current = start + (target - start) * easedProgress;
                
                if (isDecimal) {
                    counter.textContent = current.toFixed(1) + suffix;
                } else {
                    counter.textContent = Math.floor(current) + suffix;
                }
                
                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    if (isDecimal) {
                        counter.textContent = target.toFixed(1) + suffix;
                    } else {
                        counter.textContent = target + suffix;
                    }
                }
            }
            
            // Start animation when in view
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        requestAnimationFrame(updateCounter);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(counter);
        });
    }
    
    // Initialize counters when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', animateCounters);
    } else {
        animateCounters();
    }
})();


// Testimonials Carousel
(function() {
    var carousel = document.querySelector('.testimonials-page-carousel-track');
    var slides = document.querySelectorAll('.testimonials-page-carousel-slide');
    var prevBtn = document.querySelector('.testimonials-page-carousel-prev');
    var nextBtn = document.querySelector('.testimonials-page-carousel-next');
    var dotsContainer = document.querySelector('.testimonials-page-carousel-dots');
    
    if (!carousel || slides.length === 0) return;
    
    var currentIndex = 0;
    var totalSlides = slides.length;
    var autoplayInterval;
    var isPlaying = true;
    
    // Create dots
    for (var i = 0; i < totalSlides; i++) {
        var dot = document.createElement('div');
        dot.className = 'testimonials-page-carousel-dot' + (i === 0 ? ' active' : '');
        dot.setAttribute('data-index', i);
        dotsContainer.appendChild(dot);
        
        dot.addEventListener('click', function() {
            goToSlide(parseInt(this.getAttribute('data-index')));
            resetAutoplay();
        });
    }
    
    var dots = document.querySelectorAll('.testimonials-page-carousel-dot');
    
    function goToSlide(index) {
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        
        currentIndex = index;
        carousel.style.transform = 'translateX(-' + (currentIndex * 100) + '%)';
        
        // Update dots
        dots.forEach(function(dot, i) {
            dot.classList.toggle('active', i === currentIndex);
        });
    }
    
    function nextSlide() {
        goToSlide(currentIndex + 1);
    }
    
    function prevSlide() {
        goToSlide(currentIndex - 1);
    }
    
    function startAutoplay() {
        if (isPlaying) {
            autoplayInterval = setInterval(nextSlide, 5000);
        }
    }
    
    function resetAutoplay() {
        clearInterval(autoplayInterval);
        startAutoplay();
    }
    
    // Event listeners
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            prevSlide();
            resetAutoplay();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            nextSlide();
            resetAutoplay();
        });
    }
    
    // Touch/swipe support
    var touchStartX = 0;
    var touchEndX = 0;
    
    carousel.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    carousel.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        var diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
            resetAutoplay();
        }
    }
    
    // Pause on hover
    carousel.addEventListener('mouseenter', function() {
        isPlaying = false;
        clearInterval(autoplayInterval);
    });
    
    carousel.addEventListener('mouseleave', function() {
        isPlaying = true;
        startAutoplay();
    });
    
    // Start autoplay
    startAutoplay();
})();


// Video Modal Functionality
(function() {
    var videoThumbnails = document.querySelectorAll('.testimonials-page-video-thumbnail');
    var modal = document.getElementById('testimonialVideoModal');
    var iframe = document.getElementById('testimonialVideoIframe');
    var closeBtn = document.querySelector('.testimonials-page-video-modal-close');
    
    if (!modal || !iframe) return;
    
    function openModal(videoUrl) {
        // Convert YouTube URL to embed format if necessary
        var embedUrl = videoUrl;
        
        if (videoUrl.includes('youtube.com/watch')) {
            var videoId = videoUrl.split('v=')[1];
            var ampersandPosition = videoId.indexOf('&');
            if (ampersandPosition !== -1) {
                videoId = videoId.substring(0, ampersandPosition);
            }
            embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
        } else if (videoUrl.includes('youtu.be')) {
            var videoId = videoUrl.split('youtu.be/')[1];
            embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
        } else if (videoUrl.includes('vimeo.com')) {
            var videoId = videoUrl.split('vimeo.com/')[1];
            embedUrl = 'https://player.vimeo.com/video/' + videoId + '?autoplay=1';
        }
        
        iframe.src = embedUrl;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        modal.classList.remove('active');
        iframe.src = '';
        document.body.style.overflow = '';
    }
    
    videoThumbnails.forEach(function(thumbnail) {
        thumbnail.addEventListener('click', function() {
            var videoUrl = this.getAttribute('data-video-url');
            if (videoUrl) {
                openModal(videoUrl);
            }
        });
    });
    
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
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


// Masonry Card Hover Effects with Stagger
(function() {
    var cards = document.querySelectorAll('.testimonials-page-masonry-card');
    
    cards.forEach(function(card, index) {
        // Add staggered animation delay
        card.style.animationDelay = (index * 0.05) + 's';
        
        // Enhanced hover effect
        card.addEventListener('mouseenter', function() {
            this.querySelector('.testimonials-page-masonry-front').style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.querySelector('.testimonials-page-masonry-front').style.transform = 'translateY(0)';
        });
    });
})();


// Parallax Effect for Full Quote Section
(function() {
    var quoteSection = document.querySelector('.testimonials-page-full-quote');
    
    if (!quoteSection) return;
    
    function parallaxScroll() {
        var scrolled = window.pageYOffset;
        var rect = quoteSection.getBoundingClientRect();
        var sectionTop = rect.top + scrolled;
        var sectionHeight = quoteSection.offsetHeight;
        var windowHeight = window.innerHeight;
        
        if (scrolled + windowHeight > sectionTop && scrolled < sectionTop + sectionHeight) {
            var parallaxValue = (scrolled - sectionTop + windowHeight) * 0.1;
            var pattern = quoteSection.querySelector('.testimonials-page-full-quote-pattern');
            if (pattern) {
                pattern.style.transform = 'translateY(' + parallaxValue + 'px)';
            }
        }
    }
    
    window.addEventListener('scroll', parallaxScroll, { passive: true });
})();


// Smooth Scroll for Hero CTA
(function() {
    var heroCta = document.querySelector('.testimonials-page-hero-cta');
    
    if (!heroCta) return;
    
    heroCta.addEventListener('click', function(e) {
        var href = this.getAttribute('href');
        
        if (href && href.startsWith('#')) {
            e.preventDefault();
            var target = document.querySelector(href);
            
            if (target) {
                var headerHeight = document.getElementById('siteHeader') ? document.getElementById('siteHeader').offsetHeight : 80;
                var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        }
    });
})();


// Logo Marquee - Ensure smooth infinite scroll
(function() {
    var track = document.querySelector('.testimonials-page-logos-track');
    
    if (!track) return;
    
    // Clone items for seamless loop
    var items = track.querySelectorAll('.testimonials-page-logo-item');
    
    // Pause animation on hover
    track.addEventListener('mouseenter', function() {
        this.style.animationPlayState = 'paused';
    });
    
    track.addEventListener('mouseleave', function() {
        this.style.animationPlayState = 'running';
    });
})();


// Intersection Observer for Testimonials Page Animations
(function() {
    var observerOptions = {
        threshold: 0.1,
        rootMargin: '-50px 0px'
    };
    
    function handleIntersection(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }
    
    var observer = new IntersectionObserver(handleIntersection, observerOptions);
    
    // Select all animated elements on testimonials page
    var animatedElements = document.querySelectorAll(
        '.testimonials-page-featured .animate-slide-right, ' +
        '.testimonials-page-featured .animate-slide-left, ' +
        '.testimonials-page-stats .animate-fade-in, ' +
        '.testimonials-page-stats .animate-scale-in, ' +
        '.testimonials-page-grid-section .animate-fade-in, ' +
        '.testimonials-page-logos .animate-fade-in, ' +
        '.testimonials-page-video-section .animate-fade-in, ' +
        '.testimonials-page-video-section .animate-scale-in, ' +
        '.testimonials-page-carousel-section .animate-fade-in, ' +
        '.testimonials-page-full-quote .animate-fade-in, ' +
        '.testimonials-page-cta .animate-fade-in'
    );
    
    animatedElements.forEach(function(el) {
        observer.observe(el);
    });
})();


// Stagger animation for masonry cards
(function() {
    var masonryCards = document.querySelectorAll('.testimonials-page-masonry-card');
    
    if (masonryCards.length === 0) return;
    
    var observerOptions = {
        threshold: 0.1,
        rootMargin: '0px'
    };
    
    var cardObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry, index) {
            if (entry.isIntersecting) {
                setTimeout(function() {
                    entry.target.classList.add('is-visible');
                }, index * 100);
                cardObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    masonryCards.forEach(function(card) {
        cardObserver.observe(card);
    });
})();

// ========================================
// CONTACT US PAGE SCRIPTS
// ========================================

// Contact Page Animations - Intersection Observer
(function() {
    var observerOptions = {
        threshold: 0.1,
        rootMargin: '-50px 0px'
    };
    
    function handleIntersection(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }
    
    var observer = new IntersectionObserver(handleIntersection, observerOptions);
    
    // Select all animated elements on contact page
    var animatedElements = document.querySelectorAll(
        '.contact-hero .animate-fade-in, ' +
        '.contact-form-section .animate-slide-left, ' +
        '.contact-form-section .animate-slide-right, ' +
        '.contact-form-section .animate-fade-up, ' +
        '.contact-booking-section .animate-fade-in, ' +
        '.contact-booking-section .animate-scale-in, ' +
        '.contact-map-section .animate-fade-in, ' +
        '.contact-map-section .animate-scale-in, ' +
        '.contact-map-section .animate-fade-up, ' +
        '.contact-faq-section .animate-fade-in, ' +
        '.contact-cta-section .animate-fade-in'
    );
    
    animatedElements.forEach(function(el) {
        observer.observe(el);
    });
})();


// Contact FAQ Accordion
(function() {
    var faqItems = document.querySelectorAll('.contact-faq-item');
    
    if (faqItems.length === 0) return;
    
    faqItems.forEach(function(item) {
        var question = item.querySelector('.contact-faq-question');
        var answer = item.querySelector('.contact-faq-answer');
        
        if (!question || !answer) return;
        
        question.addEventListener('click', function() {
            var isActive = item.classList.contains('active');
            
            // Close all other items
            faqItems.forEach(function(otherItem) {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    var otherAnswer = otherItem.querySelector('.contact-faq-answer');
                    var otherQuestion = otherItem.querySelector('.contact-faq-question');
                    if (otherAnswer) otherAnswer.style.maxHeight = '0';
                    if (otherQuestion) otherQuestion.setAttribute('aria-expanded', 'false');
                }
            });
            
            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
                answer.style.maxHeight = '0';
                question.setAttribute('aria-expanded', 'false');
            } else {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                question.setAttribute('aria-expanded', 'true');
            }
        });
    });
})();


// Contact Form Validation & Submission
(function() {
    var form = document.getElementById('contactPageForm');
    
    if (!form) return;
    
    // Add floating label effect
    var inputs = form.querySelectorAll('input, textarea, select');
    
    inputs.forEach(function(input) {
        // Add focus/blur effects
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check on load if field has value
        if (input.value) {
            input.parentElement.classList.add('focused');
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        var submitBtn = form.querySelector('.contact-form-submit');
        var originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.innerHTML = '<span>Sending...</span><svg class="contact-form-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 11-6.219-8.56"/></svg>';
        submitBtn.disabled = true;
        
        // Simulate form submission (replace with actual AJAX call)
        setTimeout(function() {
            submitBtn.innerHTML = '<span>Message Sent!</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>';
            submitBtn.style.background = '#22c55e';
            
            // Reset form after delay
            setTimeout(function() {
                form.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                submitBtn.style.background = '';
                
                // Remove focused class from all fields
                inputs.forEach(function(input) {
                    input.parentElement.classList.remove('focused');
                });
            }, 3000);
        }, 2000);
    });
})();


// Smooth scroll for anchor links on contact page
(function() {
    var contactPage = document.querySelector('.contact-hero');
    
    if (!contactPage) return;
    
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            var target = document.querySelector(targetId);
            
            if (target) {
                e.preventDefault();
                
                var headerHeight = 80;
                var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
})();


// Parallax effect for hero shapes
(function() {
    var shapes = document.querySelectorAll('.contact-hero-shape');
    
    if (shapes.length === 0) return;
    
    var heroSection = document.querySelector('.contact-hero');
    
    if (!heroSection) return;
    
    window.addEventListener('scroll', function() {
        var scrolled = window.pageYOffset;
        var heroHeight = heroSection.offsetHeight;
        
        if (scrolled > heroHeight) return;
        
        shapes.forEach(function(shape, index) {
            var speed = 0.1 + (index * 0.05);
            var yPos = scrolled * speed;
            shape.style.transform = 'translateY(' + yPos + 'px)';
        });
    }, { passive: true });
})();


// Contact info cards hover effect
(function() {
    var infoCards = document.querySelectorAll('.contact-info-card');
    
    infoCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
})();


// Magnetic button effect for CTA buttons
(function() {
    var magneticBtns = document.querySelectorAll('.contact-hero-btn, .contact-cta-btn');
    
    magneticBtns.forEach(function(btn) {
        btn.addEventListener('mousemove', function(e) {
            var rect = this.getBoundingClientRect();
            var x = e.clientX - rect.left - rect.width / 2;
            var y = e.clientY - rect.top - rect.height / 2;
            
            this.style.transform = 'translate(' + (x * 0.1) + 'px, ' + (y * 0.1) + 'px)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
})();


// Typing effect for hero heading (optional - activate by adding class)
(function() {
    var typingElement = document.querySelector('.contact-hero-typing');
    
    if (!typingElement) return;
    
    var text = typingElement.textContent;
    typingElement.textContent = '';
    typingElement.style.visibility = 'visible';
    
    var i = 0;
    var speed = 50;
    
    function typeWriter() {
        if (i < text.length) {
            typingElement.textContent += text.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
        }
    }
    
    // Start typing when element is in view
    var observer = new IntersectionObserver(function(entries) {
        if (entries[0].isIntersecting) {
            typeWriter();
            observer.disconnect();
        }
    });
    
    observer.observe(typingElement);
})();


// Counter animation for any stats on the page
(function() {
    var counters = document.querySelectorAll('.contact-counter');
    
    if (counters.length === 0) return;
    
    var observerOptions = {
        threshold: 0.5
    };
    
    var counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var counter = entry.target;
                var target = parseInt(counter.getAttribute('data-target'));
                var duration = 2000;
                var step = target / (duration / 16);
                var current = 0;
                
                function updateCounter() {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                }
                
                updateCounter();
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);
    
    counters.forEach(function(counter) {
        counterObserver.observe(counter);
    });
})();


// Map card tilt effect
(function() {
    var mapCard = document.querySelector('.contact-map-card');
    
    if (!mapCard) return;
    
    mapCard.addEventListener('mousemove', function(e) {
        var rect = this.getBoundingClientRect();
        var x = e.clientX - rect.left;
        var y = e.clientY - rect.top;
        
        var centerX = rect.width / 2;
        var centerY = rect.height / 2;
        
        var rotateX = (y - centerY) / 50;
        var rotateY = (centerX - x) / 50;
        
        this.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg)';
    });
    
    mapCard.addEventListener('mouseleave', function() {
        this.style.transform = '';
    });
})();


// Staggered animation for contact info cards
(function() {
    var cards = document.querySelectorAll('.contact-info-card');
    
    if (cards.length === 0) return;
    
    var observerOptions = {
        threshold: 0.1,
        rootMargin: '0px'
    };
    
    var cardObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry, index) {
            if (entry.isIntersecting) {
                var card = entry.target;
                var delay = Array.from(cards).indexOf(card) * 150;
                
                setTimeout(function() {
                    card.classList.add('is-visible');
                }, delay);
                
                cardObserver.unobserve(card);
            }
        });
    }, observerOptions);
    
    cards.forEach(function(card) {
        card.classList.add('animate-fade-up');
        cardObserver.observe(card);
    });
})();


// Quick links staggered animation
(function() {
    var quickLinks = document.querySelectorAll('.contact-quick-link');
    
    if (quickLinks.length === 0) return;
    
    var observerOptions = {
        threshold: 0.1,
        rootMargin: '0px'
    };
    
    var linkObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var link = entry.target;
                var delay = Array.from(quickLinks).indexOf(link) * 100;
                
                setTimeout(function() {
                    link.classList.add('is-visible');
                }, delay);
                
                linkObserver.unobserve(link);
            }
        });
    }, observerOptions);
    
    quickLinks.forEach(function(link) {
        link.classList.add('animate-fade-up');
        linkObserver.observe(link);
    });
})();


// Form input ripple effect
(function() {
    var formInputs = document.querySelectorAll('.contact-form-group input, .contact-form-group textarea');
    
    formInputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            var ripple = document.createElement('span');
            ripple.className = 'contact-input-ripple';
            this.parentElement.appendChild(ripple);
            
            setTimeout(function() {
                ripple.remove();
            }, 600);
        });
    });
})();


// Scroll progress indicator (optional)
(function() {
    var progressBar = document.querySelector('.contact-scroll-progress');
    
    if (!progressBar) return;
    
    window.addEventListener('scroll', function() {
        var scrollTop = window.pageYOffset;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var scrollPercent = (scrollTop / docHeight) * 100;
        
        progressBar.style.width = scrollPercent + '%';
    }, { passive: true });
})();