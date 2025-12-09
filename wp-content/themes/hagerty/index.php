<?php
get_header();

// ============================================
// HERO SECTION ACF FIELDS (safe if ACF disabled)
// ============================================
$hero_video           = function_exists('get_field') ? get_field('hero_video') : '';
$hero_heading_line_1  = function_exists('get_field') ? get_field('hero_heading_line_1') : '';
$hero_heading_line_2  = function_exists('get_field') ? get_field('hero_heading_line_2') : '';
$hero_button_text     = function_exists('get_field') ? get_field('hero_button_text') : '';
$hero_button_link     = function_exists('get_field') ? get_field('hero_button_link') : '';

// ============================================
// LOGO MARQUEE ACF FIELDS
// ============================================
$logo_marquee_logos   = function_exists('get_field') ? get_field('logo_marquee_logos') : [];

// ============================================
// ABOUT SECTION ACF FIELDS
// ============================================
$about_heading_line_1 = function_exists('get_field') ? get_field('about_heading_line_1') : '';
$about_heading_line_2 = function_exists('get_field') ? get_field('about_heading_line_2') : '';
$about_image_main     = function_exists('get_field') ? get_field('about_image_main') : '';
$about_image_overlay  = function_exists('get_field') ? get_field('about_image_overlay') : '';
$about_text           = function_exists('get_field') ? get_field('about_text') : '';
$about_button_text    = function_exists('get_field') ? get_field('about_button_text') : '';
$about_button_link    = function_exists('get_field') ? get_field('about_button_link') : '';

// ============================================
// TEAM SECTION ACF FIELDS
// ============================================
$team_heading_line_1  = function_exists('get_field') ? get_field('team_heading_line_1') : '';
$team_heading_line_2  = function_exists('get_field') ? get_field('team_heading_line_2') : '';
$team_intro_text      = function_exists('get_field') ? get_field('team_intro_text') : '';
$team_members         = function_exists('get_field') ? get_field('team_members') : [];
$team_button_text     = function_exists('get_field') ? get_field('team_button_text') : '';
$team_button_link     = function_exists('get_field') ? get_field('team_button_link') : '';

// ============================================
// SERVICES GRID SECTION ACF FIELDS
// ============================================
$services_heading     = function_exists('get_field') ? get_field('services_heading') : '';
$services_grid_items  = function_exists('get_field') ? get_field('services_grid_items') : [];

// ============================================
// CTA SECTION ACF FIELDS
// ============================================
$cta_card_1           = function_exists('get_field') ? get_field('cta_card_1') : '';
$cta_card_2           = function_exists('get_field') ? get_field('cta_card_2') : '';

// ============================================
// CASE STUDIES SECTION ACF FIELDS
// ============================================
$case_studies_heading_line_1   = function_exists('get_field') ? get_field('case_studies_heading_line_1') : '';
$case_studies_heading_line_2   = function_exists('get_field') ? get_field('case_studies_heading_line_2') : '';
$case_studies                  = function_exists('get_field') ? get_field('case_studies') : [];
$case_studies_button_text      = function_exists('get_field') ? get_field('case_studies_button_text') : '';
$case_studies_button_link      = function_exists('get_field') ? get_field('case_studies_button_link') : '';

// ============================================
// INFO SECTION 1 ACF FIELDS
// ============================================
$info1_heading_line_1 = function_exists('get_field') ? get_field('info1_heading_line_1') : '';
$info1_heading_line_2 = function_exists('get_field') ? get_field('info1_heading_line_2') : '';
$info1_text           = function_exists('get_field') ? get_field('info1_text') : '';
$info1_image          = function_exists('get_field') ? get_field('info1_image') : '';
$info1_button_text    = function_exists('get_field') ? get_field('info1_button_text') : '';
$info1_button_link    = function_exists('get_field') ? get_field('info1_button_link') : '';

// ============================================
// INFO SECTION 2 ACF FIELDS
// ============================================
$info2_heading_line_1 = function_exists('get_field') ? get_field('info2_heading_line_1') : '';
$info2_heading_line_2 = function_exists('get_field') ? get_field('info2_heading_line_2') : '';
$info2_text           = function_exists('get_field') ? get_field('info2_text') : '';
$info2_image          = function_exists('get_field') ? get_field('info2_image') : '';
$info2_button_text    = function_exists('get_field') ? get_field('info2_button_text') : '';
$info2_button_link    = function_exists('get_field') ? get_field('info2_button_link') : '';

// ============================================
// NEWS SECTION ACF FIELDS
// ============================================
$news_heading_line_1  = function_exists('get_field') ? get_field('news_heading_line_1') : '';
$news_heading_line_2  = function_exists('get_field') ? get_field('news_heading_line_2') : '';
$news_items           = function_exists('get_field') ? get_field('news_items') : [];
$news_button_text     = function_exists('get_field') ? get_field('news_button_text') : '';
$news_button_link     = function_exists('get_field') ? get_field('news_button_link') : '';

// ============================================
// METRICS SECTION ACF FIELDS
// ============================================
$metrics_eyebrow      = function_exists('get_field') ? get_field('metrics_eyebrow') : '';
$metrics_title        = function_exists('get_field') ? get_field('metrics_title') : '';
$metrics_text         = function_exists('get_field') ? get_field('metrics_text') : '';
$metrics_items        = function_exists('get_field') ? get_field('metrics_items') : [];

// ============================================
// CONTACT FORM SECTION ACF FIELDS
// ============================================
$contact_sidebar_logo         = function_exists('get_field') ? get_field('contact_sidebar_logo') : '';
$contact_sidebar_heading      = function_exists('get_field') ? get_field('contact_sidebar_heading') : '';
$contact_sidebar_text         = function_exists('get_field') ? get_field('contact_sidebar_text') : '';
$contact_form_logo            = function_exists('get_field') ? get_field('contact_form_logo') : '';
$contact_step1_heading        = function_exists('get_field') ? get_field('contact_step1_heading') : '';
$contact_step1_text           = function_exists('get_field') ? get_field('contact_step1_text') : '';
$contact_book_call_text       = function_exists('get_field') ? get_field('contact_book_call_text') : '';
$contact_book_call_link       = function_exists('get_field') ? get_field('contact_book_call_link') : '';
$contact_explore_text         = function_exists('get_field') ? get_field('contact_explore_text') : '';
$contact_services_options     = function_exists('get_field') ? get_field('contact_services_options') : [];

// ============================================
// LONG CTA SECTION ACF FIELDS
// ============================================
$long_cta_label               = function_exists('get_field') ? get_field('long_cta_label') : '';
$long_cta_heading_line_1      = function_exists('get_field') ? get_field('long_cta_heading_line_1') : '';
$long_cta_heading_line_2      = function_exists('get_field') ? get_field('long_cta_heading_line_2') : '';
$long_cta_text                = function_exists('get_field') ? get_field('long_cta_text') : '';
$long_cta_features            = function_exists('get_field') ? get_field('long_cta_features') : [];
$long_cta_primary_button      = function_exists('get_field') ? get_field('long_cta_primary_button') : '';
$long_cta_secondary_button    = function_exists('get_field') ? get_field('long_cta_secondary_button') : '';

// ============================================
// REVIEWS SECTION ACF FIELDS
// ============================================
$reviews_heading_line_1       = function_exists('get_field') ? get_field('reviews_heading_line_1') : '';
$reviews_heading_line_2       = function_exists('get_field') ? get_field('reviews_heading_line_2') : '';
$reviews_count_text           = function_exists('get_field') ? get_field('reviews_count_text') : '';
$reviews_platform_logo        = function_exists('get_field') ? get_field('reviews_platform_logo') : '';
$reviews_items                = function_exists('get_field') ? get_field('reviews_items') : [];

?>

<!-- Hero Section with Video Background -->
<section class="hero" data-section-theme="dark" id="hero">
    <div class="hero-video-container">
        <?php if ($hero_video) : ?>
            <video autoplay muted loop playsinline class="hero-video">
                <source src="<?php echo esc_url($hero_video['url']); ?>" type="video/mp4">
            </video>
        <?php else : ?>
            <video autoplay muted loop playsinline class="hero-video">
                <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/hero-video.mp4" type="video/mp4">
            </video>
        <?php endif; ?>
        <div class="hero-video-overlay"></div>
    </div>

    <div class="hero-content">
        <h1 class="animate-fade-in" id="heroTitle">
            <span class="white-text"><?php echo $hero_heading_line_1 ? esc_html($hero_heading_line_1) : 'Lorem ipsum dolor sit'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $hero_heading_line_2 ? esc_html($hero_heading_line_2) : 'Hagerty Digital'; ?></span>
        </h1>
        
        <!-- Split Button with Arrow on Hover -->
        <a href="<?php echo $hero_button_link ? esc_url($hero_button_link) : '#contact'; ?>" class="hero-cta-btn animate-slide-up" id="heroButton">
            <span class="btn-text"><?php echo $hero_button_text ? esc_html($hero_button_text) : 'Get In Touch'; ?></span>
            <span class="btn-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </span>
        </a>
    </div>
</section>

<!-- Logo Marquee Banner -->
<div id="logo-marquee" data-size="50" data-gap="100" data-pps="60" aria-label="Client logos" data-section-theme="light">
    <div class="marquee-track">
        <?php if ($logo_marquee_logos) : ?>
            <?php foreach ($logo_marquee_logos as $logo) : ?>
                <figure class="marquee-slide" data-base="1">
                    <img src="<?php echo esc_url($logo['logo']['url']); ?>" alt="<?php echo esc_attr($logo['logo']['alt'] ?: 'Client Logo'); ?>">
                </figure>
            <?php endforeach; ?>
        <?php else : ?>
            <figure class="marquee-slide" data-base="1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-placeholder.png" alt="Client Logo"></figure>
            <figure class="marquee-slide" data-base="1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-placeholder.png" alt="Client Logo"></figure>
            <figure class="marquee-slide" data-base="1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-placeholder.png" alt="Client Logo"></figure>
            <figure class="marquee-slide" data-base="1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-placeholder.png" alt="Client Logo"></figure>
            <figure class="marquee-slide" data-base="1"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-placeholder.png" alt="Client Logo"></figure>
        <?php endif; ?>
    </div>
</div>

<!-- About Section with Overlapping Images -->
<section class="about-section" data-section-theme="light" id="about">
    <div class="about-container">
        <h2 class="about-heading animate-fade-in">
            <span class="black-text"><?php echo $about_heading_line_1 ? esc_html($about_heading_line_1) : 'Lorem ipsum dolor sit met,'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $about_heading_line_2 ? esc_html($about_heading_line_2) : 'consectetur'; ?></span>
        </h2>
        
        <div class="about-content">
            <div class="about-images animate-slide-right">
                <div class="about-image-main">
                    <?php if ($about_image_main) : ?>
                        <img src="<?php echo esc_url($about_image_main['url']); ?>" alt="<?php echo esc_attr($about_image_main['alt'] ?: 'Our Office'); ?>">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-main.jpg" alt="Our Office">
                    <?php endif; ?>
                </div>
                <div class="about-image-overlay">
                    <?php if ($about_image_overlay) : ?>
                        <img src="<?php echo esc_url($about_image_overlay['url']); ?>" alt="<?php echo esc_attr($about_image_overlay['alt'] ?: 'Our Team'); ?>">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-overlay.jpg" alt="Our Team">
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="about-text animate-slide-left">
                <p><?php echo $about_text ? esc_html($about_text) : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.'; ?></p>
                <a href="<?php echo $about_button_link ? esc_url($about_button_link) : '#contact'; ?>" class="cta-button"><?php echo $about_button_text ? esc_html($about_button_text) : 'Get In Touch'; ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Meet The Team Section -->
<section class="team-section" id="team" data-section-theme="light">
    <div class="team-container">
        <h2 class="section-heading animate-fade-in">
            <span class="black-text"><?php echo $team_heading_line_1 ? esc_html($team_heading_line_1) : 'Meet The'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $team_heading_line_2 ? esc_html($team_heading_line_2) : 'Team'; ?></span>
        </h2>
        
        <div class="team-intro animate-fade-in">
            <p><?php echo $team_intro_text ? esc_html($team_intro_text) : 'Talk to someone who understands you and your business. Make progress and feel empowered.'; ?></p>
        </div>
        
        <!-- Desktop/Tablet Team Deck -->
        <div class="team-deck">
            <?php if ($team_members) : ?>
                <?php foreach ($team_members as $index => $member) : ?>
                    <div class="team-card" data-member="<?php echo $index + 1; ?>">
                        <div class="team-card-image">
                            <?php if ($member['photo']) : ?>
                                <img src="<?php echo esc_url($member['photo']['url']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="team-card-overlay">
                            <h4 class="team-card-name"><?php echo esc_html($member['name']); ?></h4>
                            <p class="team-card-role"><?php echo esc_html($member['role']); ?></p>
                            <button class="more-about-btn">More about <?php echo esc_html(explode(' ', $member['name'])[0]); ?></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default team members if no ACF data -->
                <div class="team-card" data-member="1">
                    <div class="team-card-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-placeholder.jpg" alt="Team Member">
                    </div>
                    <div class="team-card-overlay">
                        <h4 class="team-card-name">Team Member</h4>
                        <p class="team-card-role">Role</p>
                        <button class="more-about-btn">More about Team</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Mobile Team Carousel with Name Tooltips -->
        <div class="team-mobile-carousel">
            <!-- Navigation Dots with Tooltips -->
            <div class="team-mobile-dots">
                <?php if ($team_members) : ?>
                    <?php foreach ($team_members as $index => $member) : ?>
                        <div class="team-mobile-dot<?php echo $index === 0 ? ' active' : ''; ?>" data-name="<?php echo esc_attr(explode(' ', $member['name'])[0]); ?>">
                            <?php if ($member['photo']) : ?>
                                <img src="<?php echo esc_url($member['photo']['url']); ?>" alt="<?php echo esc_attr(explode(' ', $member['name'])[0]); ?>">
                            <?php endif; ?>
                            <span class="team-mobile-dot-tooltip"><?php echo esc_html(explode(' ', $member['name'])[0]); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="team-mobile-slider">
                <?php if ($team_members) : ?>
                    <?php foreach ($team_members as $index => $member) : ?>
                        <div class="team-mobile-card<?php echo $index === 0 ? ' active' : ''; ?>" data-member="<?php echo $index + 1; ?>">
                            <div class="team-mobile-card-image">
                                <?php if ($member['photo']) : ?>
                                    <img src="<?php echo esc_url($member['photo']['url']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
                                <?php endif; ?>
                                <div class="team-mobile-card-info">
                                    <h4 class="team-mobile-card-name"><?php echo esc_html($member['name']); ?></h4>
                                    <p class="team-mobile-card-role"><?php echo esc_html($member['role']); ?></p>
                                    <button class="team-mobile-watch-btn">Learn More About <?php echo esc_html(explode(' ', $member['name'])[0]); ?></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="team-cta animate-fade-in">
            <a href="<?php echo $team_button_link ? esc_url($team_button_link) : '#contact'; ?>" class="team-cta-btn"><?php echo $team_button_text ? esc_html($team_button_text) : 'Get In Touch'; ?></a>
        </div>
    </div>
</section>

<!-- Team Member Modal -->
<div class="team-modal" id="teamModal">
    <div class="team-modal-content">
        <button class="team-modal-close" aria-label="Close modal">&times;</button>
        <div class="team-modal-grid">
            <div class="team-modal-image">
                <img src="" alt="" id="modalImage">
            </div>
            <div class="team-modal-info">
                <h3 id="modalName"></h3>
                <p class="team-modal-role" id="modalRole"></p>
                <p class="team-modal-bio" id="modalBio"></p>
                <div class="team-modal-socials">
                    <a href="#" aria-label="LinkedIn" id="modalLinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 50 50">
                            <path fill="currentColor" d="M20.832 19.793c1.718 0 3.437 0 5.21 0 .051 1.235.051 1.235.102 2.5.242-.312.484-.621.73-.937 1.183-1.184 2.48-1.559 4.121-1.59 1.723.027 3.32.524 4.601 1.719 1.528 1.64 1.922 3.757 1.914 5.917 0 .11 0 .22 0 .332 0 .36 0 .72 0 1.079 0 .25 0 .5-.004.754-.004.656-.004 1.312-.004 1.969 0 .793-.004 1.582-.004 2.371 0 1.199-.004 2.394-.004 3.594-1.719 0-3.438 0-5.208 0-.004-.739-.008-1.477-.008-2.235-.004-.469-.008-.937-.012-1.406-.004-.746-.008-1.488-.012-2.23 0-.602-.004-1.2-.008-1.801-.004-.227-.004-.457-.004-.684.02-2.11.02-2.11-.91-3.961-.82-.781-1.636-.957-2.734-.949-.723.07-1.277.371-1.77.902-.593.727-.75 1.414-.746 2.336 0 .11-.004.219-.004.328-.004.36-.004.715-.004 1.075 0 .246-.004.496-.004.746-.004.652-.008 1.304-.008 1.957-.004.785-.008 1.57-.016 2.351-.004 1.192-.008 2.379-.012 3.571-1.719 0-3.438 0-5.208 0 0-5.844 0-11.688 0-17.707z"/>
                            <path fill="currentColor" d="M12.5 19.793c1.719 0 3.438 0 5.207 0 0 5.844 0 11.688 0 17.707-1.719 0-3.438 0-5.207 0 0-5.844 0-11.688 0-17.707z"/>
                            <path fill="currentColor" d="M16.457 12.77c.605.421 1.046 1.003 1.25 1.71.097.789.003 1.5-.415 2.187-.507.582-1.097.992-1.882 1.074-.848.031-1.438-.055-2.071-.633-.609-.645-.851-1.227-.886-2.109.023-.719.183-1.165.683-1.688.942-.875 2.125-1.164 3.321-.54z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Email" id="modalEmail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pass team data to JavaScript -->
<script>
var teamData = {
    <?php if ($team_members) : ?>
        <?php foreach ($team_members as $index => $member) : ?>
            <?php echo ($index + 1); ?>: {
                name: '<?php echo esc_js($member['name']); ?>',
                role: '<?php echo esc_js($member['role']); ?>',
                image: '<?php echo esc_js($member['photo']['url']); ?>',
                bio: '<?php echo esc_js($member['bio']); ?>',
                linkedin: '<?php echo esc_js($member['linkedin_url'] ?? ''); ?>',
                email: '<?php echo esc_js($member['email'] ?? ''); ?>'
            }<?php echo ($index < count($team_members) - 1) ? ',' : ''; ?>
        <?php endforeach; ?>
    <?php endif; ?>
};
</script>

<!-- Services Grid Section -->
<section class="services-grid-section" data-section-theme="light">
    <div class="services-grid-container">
        <h2 class="services-grid-heading animate-fade-in"><?php echo $services_heading ? esc_html($services_heading) : 'Explore Our Services.'; ?></h2>
        
        <div class="services-grid">
            <?php if ($services_grid_items) : ?>
                <?php foreach ($services_grid_items as $service) : ?>
                    <div class="service-grid-card animate-slide-up">
                        <div class="service-icon">
                            <?php if ($service['icon']) : ?>
                                <img src="<?php echo esc_url($service['icon']['url']); ?>" alt="<?php echo esc_attr($service['title']); ?>">
                            <?php endif; ?>
                        </div>
                        <h3><?php echo esc_html($service['title']); ?></h3>
                        <p><?php echo esc_html($service['description']); ?></p>
                        <?php if ($service['button_link']) : ?>
                            <a href="<?php echo esc_url($service['button_link']['url']); ?>" class="service-button"><?php echo esc_html($service['button_link']['title'] ?: 'See More'); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default services if no ACF data -->
                <div class="service-grid-card animate-slide-up">
                    <div class="service-icon">
                        <svg fill="#e65616" height="157px" width="157px" viewBox="0 0 512 512"><rect fill="#ffffff" rx="50"/></svg>
                    </div>
                    <h3>SEO</h3>
                    <p>Boost your organic visibility and achieve sustainable growth with strategic SEO optimization.</p>
                    <a href="/seo" class="service-button">See More</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" data-section-theme="light">
    <div class="cta-container">
        <div class="cta-cards">
            <div class="cta-card cta-card-light animate-slide-up">
                <span class="cta-label"><?php echo $cta_card_1['label'] ? esc_html($cta_card_1['label']) : 'CONTACT US'; ?></span>
                <h2><?php echo $cta_card_1['heading'] ? wp_kses_post($cta_card_1['heading']) : 'Get a Custom Quote for Your Project <span class="highlight-text-italic">Today!</span>'; ?></h2>
                <p><?php echo $cta_card_1['text'] ? esc_html($cta_card_1['text']) : 'We\'ve helped businesses rank for over 5,000 first-page keywords and grow their organic traffic to 300K+ monthly visits.'; ?></p>
                <a href="<?php echo $cta_card_1['button_link'] ? esc_url($cta_card_1['button_link']) : '#contact'; ?>" class="cta-button"><?php echo $cta_card_1['button_text'] ? esc_html($cta_card_1['button_text']) : 'Request a Proposal'; ?></a>
            </div>

            <div class="cta-card cta-card-blue animate-slide-up">            
                <span class="cta-label"><?php echo $cta_card_2['label'] ? esc_html($cta_card_2['label']) : 'SEO AND GOOGLE ADS'; ?></span>
                <h2><?php echo $cta_card_2['heading'] ? esc_html($cta_card_2['heading']) : 'Free SEO and Google Ads Audit.'; ?></h2>
                <p><?php echo $cta_card_2['text'] ? esc_html($cta_card_2['text']) : 'Our team has delivered proven strategies that drive results—and we\'re offering a free audit to help you get started.'; ?></p>
                <a href="<?php echo $cta_card_2['button_link'] ? esc_url($cta_card_2['button_link']) : '#contact'; ?>" class="cta-button cta-button-white"><?php echo $cta_card_2['button_text'] ? esc_html($cta_card_2['button_text']) : 'Request a Proposal'; ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Case Studies Section -->
<section class="case-studies-section" data-section-theme="light" id="case-studies">
    <div class="case-studies-container">
        <h2 class="section-heading animate-fade-in">
            <span class="black-text"><?php echo $case_studies_heading_line_1 ? esc_html($case_studies_heading_line_1) : 'Our Latest'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $case_studies_heading_line_2 ? esc_html($case_studies_heading_line_2) : 'Case Studies'; ?></span>
        </h2>
        
        <div class="case-studies-grid">
            <?php if ($case_studies) : ?>
                <?php foreach ($case_studies as $case) : ?>
                    <div class="case-study-card animate-slide-up">
                        <div class="case-study-image">
                            <?php if ($case['image']) : ?>
                                <img src="<?php echo esc_url($case['image']['url']); ?>" alt="<?php echo esc_attr($case['title']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="case-study-content">
                            <h3><?php echo esc_html($case['title']); ?></h3>
                            <p><?php echo esc_html($case['description']); ?></p>
                            <div class="case-study-stats">
                                <?php if ($case['stats']) : ?>
                                    <?php foreach ($case['stats'] as $stat) : ?>
                                        <div class="stat">
                                            <span class="stat-number" 
                                                  data-target="<?php echo esc_attr($stat['value']); ?>"
                                                  <?php echo $stat['prefix'] ? 'data-prefix="' . esc_attr($stat['prefix']) . '"' : ''; ?>
                                                  <?php echo $stat['suffix'] ? 'data-suffix="' . esc_attr($stat['suffix']) . '"' : ''; ?>
                                                  <?php echo $stat['decimals'] ? 'data-decimals="' . esc_attr($stat['decimals']) . '"' : ''; ?>>
                                                <?php echo esc_html($stat['prefix'] ?? ''); ?>0<?php echo esc_html($stat['suffix'] ?? ''); ?>
                                            </span>
                                            <span class="stat-label"><?php echo esc_html($stat['label']); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($case['link']) : ?>
                                <a href="<?php echo esc_url($case['link']['url']); ?>" class="case-study-link"><?php echo esc_html($case['link']['title'] ?: 'Read Case Study'); ?> →</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default case study if no ACF data -->
                <div class="case-study-card animate-slide-up">
                    <div class="case-study-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/case-study-placeholder.jpg" alt="Case Study">
                    </div>
                    <div class="case-study-content">
                        <h3>Case Study Title</h3>
                        <p>Brief description of the case study and the results achieved.</p>
                        <div class="case-study-stats">
                            <div class="stat">
                                <span class="stat-number" data-target="100" data-suffix="%">0%</span>
                                <span class="stat-label">Metric Label</span>
                            </div>
                        </div>
                        <a href="#" class="case-study-link">Read Case Study →</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- View All Case Studies Button -->
        <div class="case-studies-cta animate-fade-in">
            <a href="<?php echo $case_studies_button_link ? esc_url($case_studies_button_link) : '/case-studies'; ?>" class="case-studies-cta-btn"><?php echo $case_studies_button_text ? esc_html($case_studies_button_text) : 'View All Case Studies'; ?></a>
        </div>
    </div>
</section>

<!-- Info Section 1 -->
<section class="info1-section" data-section-theme="light">
    <div class="info1-container">
        <h2 class="info1-heading animate-fade-in">
            <span class="black-text"><?php echo $info1_heading_line_1 ? esc_html($info1_heading_line_1) : 'Lorem ipsum dolor sit met,'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $info1_heading_line_2 ? esc_html($info1_heading_line_2) : 'consectetur'; ?></span>
        </h2>
        
        <div class="info1-content">
            <div class="info1-text animate-slide-left">
                <p><?php echo $info1_text ? esc_html($info1_text) : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'; ?></p>
                <a href="<?php echo $info1_button_link ? esc_url($info1_button_link) : '#contact'; ?>" class="cta-button"><?php echo $info1_button_text ? esc_html($info1_button_text) : 'Get In Touch'; ?></a>
            </div>
            <div class="info1-image animate-slide-right">
                <?php if ($info1_image) : ?>
                    <img src="<?php echo esc_url($info1_image['url']); ?>" alt="<?php echo esc_attr($info1_image['alt'] ?: 'Info Image'); ?>">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info-placeholder.jpg" alt="Our Team">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Info Section 2 -->
<section class="info2-section" data-section-theme="light">
    <div class="info2-container">
        <h2 class="info2-heading animate-fade-in">
            <span class="black-text"><?php echo $info2_heading_line_1 ? esc_html($info2_heading_line_1) : 'Lorem ipsum dolor sit met,'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $info2_heading_line_2 ? esc_html($info2_heading_line_2) : 'consectetur'; ?></span>
        </h2>
        
        <div class="info2-content">
            <div class="info2-image animate-slide-right">
                <?php if ($info2_image) : ?>
                    <img src="<?php echo esc_url($info2_image['url']); ?>" alt="<?php echo esc_attr($info2_image['alt'] ?: 'Info Image'); ?>">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info-placeholder.jpg" alt="Our Team">
                <?php endif; ?>
            </div>
            <div class="info2-text animate-slide-left">
                <p><?php echo $info2_text ? esc_html($info2_text) : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.'; ?></p>
                <a href="<?php echo $info2_button_link ? esc_url($info2_button_link) : '#contact'; ?>" class="cta-button"><?php echo $info2_button_text ? esc_html($info2_button_text) : 'Get In Touch'; ?></a>
            </div>
        </div>
    </div>
</section>

<!-- News/Blog Section -->
<section class="news-section" data-section-theme="light" id="news">
    <div class="news-container">
        <h2 class="news-heading animate-fade-in">
            <span class="black-text"><?php echo $news_heading_line_1 ? esc_html($news_heading_line_1) : 'Latest'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $news_heading_line_2 ? esc_html($news_heading_line_2) : 'News & Insights'; ?></span>
        </h2>
        
        <div class="news-grid">
            <?php if ($news_items) : ?>
                <?php foreach ($news_items as $news) : ?>
                    <div class="news-card animate-slide-up">
                        <div class="news-card-image">
                            <?php if ($news['image']) : ?>
                                <img src="<?php echo esc_url($news['image']['url']); ?>" alt="<?php echo esc_attr($news['title']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="news-card-content">
                            <div class="news-card-meta">
                                <span class="news-card-category"><?php echo esc_html($news['category']); ?></span>
                                <span class="news-card-date"><?php echo esc_html($news['date']); ?></span>
                            </div>
                            <h3><?php echo esc_html($news['title']); ?></h3>
                            <p><?php echo esc_html($news['excerpt']); ?></p>
                            <?php if ($news['link']) : ?>
                                <a href="<?php echo esc_url($news['link']['url']); ?>" class="news-card-link">
                                    <?php echo esc_html($news['link']['title'] ?: 'Read More'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default news items if no ACF data -->
                <div class="news-card animate-slide-up">
                    <div class="news-card-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/news-placeholder.jpg" alt="News Article">
                    </div>
                    <div class="news-card-content">
                        <div class="news-card-meta">
                            <span class="news-card-category">Category</span>
                            <span class="news-card-date">Nov 25, 2025</span>
                        </div>
                        <h3>News Article Title</h3>
                        <p>Brief excerpt of the news article goes here.</p>
                        <a href="#" class="news-card-link">
                            Read More 
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="news-cta animate-fade-in">
            <a href="<?php echo $news_button_link ? esc_url($news_button_link) : '/news'; ?>" class="news-cta-btn"><?php echo $news_button_text ? esc_html($news_button_text) : 'View All News'; ?></a>
        </div>
    </div>
</section>

<!-- Metrics Section - Light Theme -->
<section class="hd-metrics" data-section-theme="light">
    <div class="hd-metrics__container">
        <div class="hd-metrics__header">
            <p class="hd-metrics__eyebrow animate-fade-in"><?php echo $metrics_eyebrow ? esc_html($metrics_eyebrow) : 'By the numbers'; ?></p>
            <h2 class="hd-metrics__title animate-fade-in"><?php echo $metrics_title ? esc_html($metrics_title) : 'Results we\'ve delivered for clients'; ?></h2>
            <p class="hd-metrics__text animate-fade-in"><?php echo $metrics_text ? esc_html($metrics_text) : 'A quick snapshot of the campaigns, websites and growth projects we run every day.'; ?></p>
        </div>

        <div class="hd-metrics__grid">
            <?php if ($metrics_items) : ?>
                <?php foreach ($metrics_items as $metric) : ?>
                    <div class="hd-metric-card animate-slide-up">
                        <div class="hd-metric-card__icon"><span><?php echo esc_html($metric['icon']); ?></span></div>
                        <div class="hd-metric-card__value" 
                             data-target="<?php echo esc_attr($metric['value']); ?>"
                             <?php echo $metric['prefix'] ? 'data-prefix="' . esc_attr($metric['prefix']) . '"' : ''; ?>
                             <?php echo $metric['suffix'] ? 'data-suffix="' . esc_attr($metric['suffix']) . '"' : ''; ?>
                             <?php echo $metric['decimals'] ? 'data-decimals="' . esc_attr($metric['decimals']) . '"' : ''; ?>>
                            <?php echo esc_html($metric['prefix'] ?? ''); ?>0<?php echo esc_html($metric['suffix'] ?? ''); ?>
                        </div>
                        <div class="hd-metric-card__label"><?php echo esc_html($metric['label']); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default metrics if no ACF data -->
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>🏢</span></div>
                    <div class="hd-metric-card__value" data-target="5" data-suffix="+">0+</div>
                    <div class="hd-metric-card__label">Cities & offices in the UK</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>🤝</span></div>
                    <div class="hd-metric-card__value" data-target="1000" data-suffix="+">0+</div>
                    <div class="hd-metric-card__label">Businesses we've worked with</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>💻</span></div>
                    <div class="hd-metric-card__value" data-target="250" data-suffix="+">0+</div>
                    <div class="hd-metric-card__label">Websites designed & developed</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>📈</span></div>
                    <div class="hd-metric-card__value" data-target="25" data-prefix="£" data-suffix="M">£0M</div>
                    <div class="hd-metric-card__label">Revenue generated for clients</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>🌍</span></div>
                    <div class="hd-metric-card__value" data-target="50" data-suffix="+">0+</div>
                    <div class="hd-metric-card__label">International clients</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>⭐</span></div>
                    <div class="hd-metric-card__value" data-target="5.0" data-decimals="1">0.0</div>
                    <div class="hd-metric-card__label">Average Google rating</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Multi-Step Contact Form Section -->
<section class="contact-form-section" data-section-theme="light" id="contact">
    <div class="contact-form-container">
        <!-- Left Sidebar -->
        <div class="contact-sidebar">
            <?php if ($contact_sidebar_logo) : ?>
                <img src="<?php echo esc_url($contact_sidebar_logo['url']); ?>" alt="<?php echo esc_attr($contact_sidebar_logo['alt'] ?: get_bloginfo('name')); ?>" class="contact-sidebar-logo">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logoblack.png" alt="<?php bloginfo('name'); ?>" class="contact-sidebar-logo">
            <?php endif; ?>
            
            <h2><?php echo $contact_sidebar_heading ? esc_html($contact_sidebar_heading) : 'Get in Touch'; ?></h2>
            <p><?php echo $contact_sidebar_text ? esc_html($contact_sidebar_text) : 'Contact Hagerty Digital with any enquiries – our team is on hand to assist and will respond promptly.'; ?></p>
            
            <?php 
            $email = get_field('email_address', 'option');
            $phone = get_field('phone_number', 'option');
            $address1 = get_field('address_line_1', 'option');
            $address2 = get_field('address_line_2', 'option');
            ?>
            
            <div class="contact-info-item">
                <svg class="contact-info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                <div class="contact-info-content">
                    <h4>Send Us an Email</h4>
                    <a href="mailto:<?php echo $email ? esc_attr($email) : 'hello@hagertydigital.com'; ?>"><?php echo $email ? esc_html($email) : 'hello@hagertydigital.com'; ?></a>
                </div>
            </div>
            
            <div class="contact-info-item">
                <svg class="contact-info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                <div class="contact-info-content">
                    <h4>Our Bristol Office</h4>
                    <a href="#"><?php echo $address1 ? esc_html($address1) : '88 High Street'; ?>,<br><?php echo $address2 ? esc_html($address2) : 'Nailsea, Bristol, BS48 1AS'; ?></a>
                </div>
            </div>
            
            <div class="contact-info-item">
                <svg class="contact-info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <div class="contact-info-content">
                    <h4>Call Us Today</h4>
                    <a href="tel:<?php echo $phone ? esc_attr(preg_replace('/[^0-9+]/', '', $phone)) : '01275792114'; ?>"><?php echo $phone ? esc_html($phone) : '01275 792 114'; ?></a>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Form Card -->
        <div class="contact-form-card">
            <!-- Progress Steps -->
            <div class="form-progress">
                <div class="progress-step active" data-step="1">1</div>
                <div class="progress-line"></div>
                <div class="progress-step" data-step="2">2</div>
                <div class="progress-line"></div>
                <div class="progress-step" data-step="3">3</div>
            </div>
            
            <div class="form-content">
                <!-- Step 1: Initial Choice - Book a Call or Explore Services -->
                <div class="form-step active" id="formStep1">
                    <?php if ($contact_form_logo) : ?>
                        <img src="<?php echo esc_url($contact_form_logo['url']); ?>" alt="<?php echo esc_attr($contact_form_logo['alt'] ?: get_bloginfo('name')); ?>" class="form-step-logo">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logoblack.png" alt="<?php bloginfo('name'); ?>" class="form-step-logo">
                    <?php endif; ?>
                    <h3><?php echo $contact_step1_heading ? esc_html($contact_step1_heading) : 'How Can We Help?'; ?></h3>
                    <p><?php echo $contact_step1_text ? esc_html($contact_step1_text) : 'Choose how you\'d like to get started. Book a call with our team or explore our services.'; ?></p>
                    
                    <div class="initial-choice-buttons">
                        <a href="<?php echo $contact_book_call_link ? esc_url($contact_book_call_link) : 'https://calendly.com/hagertydigital'; ?>" class="choice-btn choice-btn-primary" id="bookCallBtn" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?php echo $contact_book_call_text ? esc_html($contact_book_call_text) : 'Book a Call'; ?>
                        </a>
                        <button type="button" class="choice-btn choice-btn-secondary" id="exploreServicesBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo $contact_explore_text ? esc_html($contact_explore_text) : 'Explore Our Services'; ?>
                        </button>
                    </div>
                </div>
                
                <!-- Step 2: Services Selection -->
                <div class="form-step" id="formStep2">
                    <h3>Select Your Services</h3>
                    <p>Choose the services you're interested in. We'll tailor our approach to your needs.</p>
                    
                    <label class="services-label">Services</label>
                    <div class="services-grid-select">
                        <?php if ($contact_services_options) : ?>
                            <?php foreach ($contact_services_options as $index => $option) : ?>
                                <div class="service-checkbox">
                                    <input type="checkbox" id="service-<?php echo $index; ?>" name="services" value="<?php echo esc_attr($option['service_name']); ?>">
                                    <label for="service-<?php echo $index; ?>"><?php echo esc_html($option['service_name']); ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-marketing" name="services" value="Marketing">
                                <label for="service-marketing">Marketing</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-websites" name="services" value="Websites">
                                <label for="service-websites">Websites</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-seo" name="services" value="SEO">
                                <label for="service-seo">SEO</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-ppc" name="services" value="PPC">
                                <label for="service-ppc">PPC</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-branding" name="services" value="Branding">
                                <label for="service-branding">Branding</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-photography" name="services" value="Photography">
                                <label for="service-photography">Photography</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-video" name="services" value="Video Production">
                                <label for="service-video">Video Production</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-multiple" name="services" value="Multiple Services">
                                <label for="service-multiple">Multiple Services</label>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn-back" id="backToStep1">Back</button>
                        <button type="button" class="btn-next" id="toStep3">Next</button>
                    </div>
                </div>
                
                <!-- Step 3: Contact Information -->
                <div class="form-step" id="formStep3">
                    <h3>Your Contact Information</h3>
                    <p>Tell us a bit about yourself so we can get in touch.</p>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name">Name <span class="required">*</span></label>
                            <input type="text" id="contact-name" placeholder="Enter Full Name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email <span class="required">*</span></label>
                            <input type="email" id="contact-email" placeholder="Enter Email Address" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-company">Company</label>
                            <input type="text" id="contact-company" placeholder="Company name">
                        </div>
                        <div class="form-group">
                            <label for="contact-phone">Telephone <span class="required">*</span></label>
                            <input type="tel" id="contact-phone" placeholder="Your Telephone Number" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-message">Message <span class="required">*</span></label>
                        <textarea id="contact-message" placeholder="Hi Hagerty Digital, we are interested in..." required></textarea>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn-back" id="backToStep2">Back</button>
                        <button type="submit" class="btn-submit" id="submitForm">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Long CTA Section - Before Reviews -->
<section class="long-cta-section" data-section-theme="light">
    <div class="long-cta-container">
        <div class="long-cta-content animate-fade-in">
            <span class="long-cta-label"><?php echo $long_cta_label ? esc_html($long_cta_label) : 'READY TO GROW?'; ?></span>
            <h2 class="long-cta-heading">
                <span class="black-text"><?php echo $long_cta_heading_line_1 ? esc_html($long_cta_heading_line_1) : 'Let\'s Build Something'; ?></span><br>
                <span class="highlight-text-italic"><?php echo $long_cta_heading_line_2 ? esc_html($long_cta_heading_line_2) : 'Amazing Together'; ?></span>
            </h2>
            <p class="long-cta-text"><?php echo $long_cta_text ? esc_html($long_cta_text) : 'Whether you\'re looking to increase your online visibility, generate more leads, or create a stunning website that converts, our team of experts is here to help. We\'ve helped hundreds of businesses achieve their digital goals — yours could be next.'; ?></p>
            
            <div class="long-cta-features">
                <?php if ($long_cta_features) : ?>
                    <?php foreach ($long_cta_features as $feature) : ?>
                        <div class="long-cta-feature">
                            <div class="long-cta-feature-icon">
                                <?php if ($feature['icon']) : ?>
                                    <img src="<?php echo esc_url($feature['icon']['url']); ?>" alt="">
                                <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <polyline points="22 4 12 14.01 9 11.01"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="long-cta-feature-text">
                                <h4><?php echo esc_html($feature['title']); ?></h4>
                                <p><?php echo esc_html($feature['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="long-cta-feature">
                        <div class="long-cta-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                        <div class="long-cta-feature-text">
                            <h4>Proven Results</h4>
                            <p>Data-driven strategies that deliver measurable ROI</p>
                        </div>
                    </div>
                    <div class="long-cta-feature">
                        <div class="long-cta-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <div class="long-cta-feature-text">
                            <h4>Dedicated Team</h4>
                            <p>Personal account managers who truly understand your business</p>
                        </div>
                    </div>
                    <div class="long-cta-feature">
                        <div class="long-cta-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </div>
                        <div class="long-cta-feature-text">
                            <h4>Fast Turnaround</h4>
                            <p>Quick response times and efficient project delivery</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="long-cta-buttons">
                <?php if ($long_cta_primary_button) : ?>
                    <a href="<?php echo esc_url($long_cta_primary_button['url']); ?>" class="long-cta-btn long-cta-btn-primary">
                        <span><?php echo esc_html($long_cta_primary_button['title']); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                <?php else : ?>
                    <a href="#contact" class="long-cta-btn long-cta-btn-primary">
                        <span>Start Your Project</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                <?php endif; ?>
                
                <?php if ($long_cta_secondary_button) : ?>
                    <a href="<?php echo esc_url($long_cta_secondary_button['url']); ?>" class="long-cta-btn long-cta-btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <span><?php echo esc_html($long_cta_secondary_button['title']); ?></span>
                    </a>
                <?php else : ?>
                    <a href="tel:<?php echo $phone ? esc_attr(preg_replace('/[^0-9+]/', '', $phone)) : '01275792114'; ?>" class="long-cta-btn long-cta-btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <span>Call Us: <?php echo $phone ? esc_html($phone) : '01275 792 114'; ?></span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews-section" data-section-theme="light">
    <div class="reviews-container">
        <div class="reviews-left animate-scale-in">
            <h2><?php echo $reviews_heading_line_1 ? esc_html($reviews_heading_line_1) : 'We are rated'; ?> <span class="highlight-text-italic"><?php echo $reviews_heading_line_2 ? esc_html($reviews_heading_line_2) : 'Excellent'; ?></span></h2>
            <div class="star-rating">
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
            </div>
            <p class="review-count"><?php echo $reviews_count_text ? esc_html($reviews_count_text) : 'Based on 27 reviews'; ?></p>
            <?php if ($reviews_platform_logo) : ?>
                <img src="<?php echo esc_url($reviews_platform_logo['url']); ?>" alt="<?php echo esc_attr($reviews_platform_logo['alt'] ?: 'Review Platform'); ?>" class="google-logo">
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/google-logo.png" alt="Google" class="google-logo">
            <?php endif; ?>
        </div>
        
        <div class="reviews-carousel">
            <button class="carousel-nav prev" aria-label="Previous review">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            
            <div class="carousel-track-container">
                <div class="carousel-track">
                    <?php if ($reviews_items) : ?>
                        <?php foreach ($reviews_items as $review) : ?>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-avatar" style="background: <?php echo esc_attr($review['avatar_color'] ?: '#4285f4'); ?>;"><?php echo esc_html(substr($review['reviewer_name'], 0, 1)); ?></div>
                                    <div class="reviewer-info">
                                        <h4><?php echo esc_html($review['reviewer_name']); ?></h4>
                                        <p class="review-date"><?php echo esc_html($review['review_date']); ?></p>
                                    </div>
                                </div>
                                <div class="review-stars">
                                    <?php 
                                    $stars = intval($review['star_rating'] ?: 5);
                                    echo str_repeat('★', $stars);
                                    ?>
                                </div>
                                <p class="review-text"><?php echo esc_html($review['review_text']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-avatar" style="background: #4285f4;">L</div>
                                <div class="reviewer-info">
                                    <h4>Customer Name</h4>
                                    <p class="review-date">2025-01-01</p>
                                </div>
                            </div>
                            <div class="review-stars">★★★★★</div>
                            <p class="review-text">Really easy to deal with, nothing was too much trouble. Super happy with the end result.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <button class="carousel-nav next" aria-label="Next review">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<?php get_footer(); ?>