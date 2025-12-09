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
// CTA SECTION ACF FIELDS - Ensure they are arrays
// ============================================
$cta_card_1_raw       = function_exists('get_field') ? get_field('cta_card_1') : '';
$cta_card_2_raw       = function_exists('get_field') ? get_field('cta_card_2') : '';

// Safely convert to arrays with defaults
$cta_card_1 = is_array($cta_card_1_raw) ? $cta_card_1_raw : [];
$cta_card_2 = is_array($cta_card_2_raw) ? $cta_card_2_raw : [];

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
$news_items_raw       = function_exists('get_field') ? get_field('news_items') : [];
$news_items           = is_array($news_items_raw) ? $news_items_raw : [];
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

// ============================================
// CONTACT INFO - Shared (from header or options page)
// ============================================
$phone = function_exists('get_field') ? get_field('phone', 'option') : '';
$email = function_exists('get_field') ? get_field('email', 'option') : '';
$address = function_exists('get_field') ? get_field('address', 'option') : '';
?>

<!-- Hero Section with Video Background -->
<section class="hero" data-section-theme="dark">
    <?php if ($hero_video) : ?>
        <div class="hero-video-container">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url($hero_video); ?>" type="video/mp4">
            </video>
            <div class="hero-video-overlay"></div>
        </div>
    <?php else : ?>
        <div class="hero-video-container">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/hd-video-web.mp4" type="video/mp4">
            </video>
            <div class="hero-video-overlay"></div>
        </div>
    <?php endif; ?>
    
    <div class="hero-content">
        <h1 class="animate-fade-in">
            <span class="white-text"><?php echo $hero_heading_line_1 ? esc_html($hero_heading_line_1) : 'Lorem ipsum'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $hero_heading_line_2 ? esc_html($hero_heading_line_2) : 'Dolor Sit'; ?></span>
        </h1>
        
        <div class="hero-cta-wrapper">
            <a href="<?php echo $hero_button_link ? esc_url($hero_button_link) : '#contact'; ?>" class="hero-cta-btn animate-fade-in">
                <span class="btn-text"><?php echo $hero_button_text ? esc_html($hero_button_text) : 'Request a Proposal'; ?></span>
                <span class="btn-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

<!-- Logo Marquee -->
<div id="logo-marquee" data-size="50" data-gap="100" data-pps="60">
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
                            <?php if (!empty($member['photo'])) : ?>
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
                            <?php if (!empty($member['photo'])) : ?>
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
                                <?php if (!empty($member['photo'])) : ?>
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
                name: '<?php echo esc_js($member['name'] ?? ''); ?>',
                role: '<?php echo esc_js($member['role'] ?? ''); ?>',
                image: '<?php echo esc_js(!empty($member['photo']) ? $member['photo']['url'] : ''); ?>',
                bio: '<?php echo esc_js($member['bio'] ?? ''); ?>',
                linkedin: '<?php echo esc_js($member['linkedin_url'] ?? ''); ?>',
                email: '<?php echo esc_js($member['email'] ?? ''); ?>'
            }<?php echo ($index < count($team_members) - 1) ? ',' : ''; ?>
        <?php endforeach; ?>
    <?php endif; ?>
};
</script><!-- Services Grid Section -->
    <section class="services-grid-section" data-section-theme="light">
        <div class="services-grid-container">
            <h2 class="services-grid-heading animate-fade-in">Explore Our Services.</h2>
            
            <div class="services-grid">
                <div class="service-grid-card animate-slide-up">
                    <div class="service-icon">
                     <svg fill="#e65616" height="157px" width="157px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-136.4 -136.4 759.96 759.96" xml:space="preserve" stroke="#e65616">
<g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
<rect x="-136.4" y="-136.4" width="759.96" height="759.96" rx="379.98" fill="#ffffff" strokewidth="0"/>
</g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.97432"/>
<g id="SVGRepo_iconCarrier"> <g> <path d="M240.934,291.482c-13.116,0-23.787,10.671-23.787,23.787c0,13.116,10.671,23.787,23.787,23.787 c13.116,0,23.787-10.671,23.787-23.787C264.721,302.152,254.05,291.482,240.934,291.482z M240.934,330.556 c-8.43,0-15.287-6.857-15.287-15.287c0-8.43,6.857-15.287,15.287-15.287c8.43,0,15.287,6.857,15.287,15.287 C256.221,323.698,249.363,330.556,240.934,330.556z"/> <path d="M453.605,5.261H33.555C15.053,5.261,0,20.315,0,38.817v301.727c0,18.503,15.053,33.556,33.555,33.556h147.497 l-17.482,58.059h-1.96c-14.255,0-25.853,11.599-25.853,25.855v19.635c0,2.348,1.902,4.25,4.25,4.25h207.145 c2.348,0,4.25-1.902,4.25-4.25v-19.635c0-14.257-11.6-25.855-25.857-25.855h-1.956l-17.483-58.059h147.498 c18.502,0,33.555-15.053,33.555-33.556V38.817C487.16,20.315,472.107,5.261,453.605,5.261z M33.555,13.761h420.051 c13.815,0,25.055,11.24,25.055,25.057v1.169h-90.997c-2.348,0-4.25,1.902-4.25,4.25c0,2.348,1.902,4.25,4.25,4.25h90.997v222.043 H8.5v-8.803h170.689c2.348,0,4.25-1.902,4.25-4.25c0-2.348-1.902-4.25-4.25-4.25H8.5V38.817 C8.5,25.001,19.739,13.761,33.555,13.761z M342.902,458.015v15.385H144.258v-15.385c0-9.569,7.784-17.355,17.353-17.355h163.936 C335.116,440.659,342.902,448.445,342.902,458.015z M314.713,432.159H172.447l17.481-58.059H297.23L314.713,432.159z M453.605,365.601H33.555c-13.815,0-25.055-11.24-25.055-25.056v-29.929h77.893c2.348,0,4.25-1.902,4.25-4.25 c0-2.348-1.902-4.25-4.25-4.25H8.5v-23.087h470.16v61.516C478.66,354.36,467.421,365.601,453.605,365.601z"/> <path d="M303.668,48.486h61.496c2.348,0,4.25-1.902,4.25-4.25c0-2.348-1.902-4.25-4.25-4.25h-61.496c-2.348,0-4.25,1.902-4.25,4.25 C299.418,46.584,301.32,48.486,303.668,48.486z"/> <path d="M72.581,118.591c18.196,0,33-14.804,33-33c0-6.51-1.902-12.579-5.169-17.698c6.516-2.948,20.938-8.394,38.964-8.59 c0.35-0.004,0.695-0.006,1.043-0.006c31.787,0,59.356,15.937,81.994,47.374l-29.161-6.479c-2.286-0.51-4.561,0.936-5.07,3.227 c-0.51,2.291,0.936,4.562,3.227,5.07l40.5,9c0.306,0.068,0.614,0.102,0.922,0.102c1.006,0,1.991-0.357,2.77-1.026 c1.016-0.873,1.561-2.173,1.471-3.51l-3-44.5c-0.157-2.341-2.16-4.113-4.526-3.954c-2.342,0.158-4.112,2.185-3.954,4.526 l2.043,30.3c-30.207-40.482-64.504-48.841-88.349-48.622c-21.802,0.237-38.592,7.428-44.542,10.356 c-5.862-5.322-13.64-8.569-22.161-8.569c-18.196,0-33,14.804-33,33C39.581,103.787,54.385,118.591,72.581,118.591z M72.581,61.091 c13.51,0,24.5,10.99,24.5,24.5c0,13.51-10.99,24.5-24.5,24.5c-13.51,0-24.5-10.99-24.5-24.5 C48.081,72.081,59.071,61.091,72.581,61.091z"/> <path d="M210.061,173.031c-1.016,0.873-1.561,2.173-1.471,3.51l3,44.5c0.151,2.244,2.018,3.964,4.236,3.964 c0.096,0,0.192-0.003,0.29-0.01c2.342-0.158,4.112-2.185,3.954-4.526l-2.059-30.538c29.454,37.853,62.269,46.16,85.372,46.16 c0.155,0,0.313,0,0.467-0.001c21.825-0.105,38.556-7.275,44.333-10.115c4.508,12.863,16.764,22.115,31.147,22.115 c18.196,0,33-14.804,33-33s-14.804-33-33-33c-18.196,0-33,14.804-33,33c0,0.758,0.035,1.506,0.086,2.251 c-0.086,0.041-0.175,0.066-0.259,0.113c-0.179,0.102-18.208,10.117-42.717,10.137c-0.025,0-0.05,0-0.075,0 c-30.775,0-57.66-15.017-80-44.642l29.043,6.454c2.293,0.514,4.563-0.935,5.07-3.227c0.51-2.291-0.935-4.562-3.226-5.07l-40.5-9 C212.448,171.816,211.077,172.158,210.061,173.031z M379.33,190.59c13.51,0,24.5,10.99,24.5,24.5c0,13.51-10.99,24.5-24.5,24.5 s-24.5-10.99-24.5-24.5C354.83,201.58,365.82,190.59,379.33,190.59z"/> <path d="M313.571,146.77c0.757,0.553,1.635,0.819,2.505,0.819c1.31,0,2.603-0.604,3.435-1.741l14.491-19.819l19.819,14.491 c0.757,0.553,1.635,0.819,2.505,0.819c1.31,0,2.603-0.604,3.435-1.741c1.386-1.896,0.973-4.554-0.922-5.939l-19.819-14.491 l14.491-19.819c1.386-1.896,0.973-4.554-0.922-5.939c-1.897-1.386-4.555-0.972-5.939,0.922l-14.491,19.819l-19.819-14.491 c-1.897-1.386-4.556-0.972-5.939,0.922c-1.386,1.896-0.973,4.554,0.922,5.939l19.819,14.491l-14.491,19.819 C311.264,142.727,311.677,145.385,313.571,146.77z"/> </g> </g>
</svg>                    </div>
                    <h3>SEO</h3>
                    <p>Boost your organic visibility and achieve sustainable growth with strategic SEO optimization.</p>
                    <a href="/seo" class="service-button">See More</a>
                </div>

                <div class="service-grid-card animate-slide-up">
                    <div class="service-icon">
                        <svg fill="#e65616" height="157px" width="157px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-143.36 -143.36 798.72 798.72" xml:space="preserve" transform="matrix(-1, 0, 0, 1, 0, 0)" stroke="#e65616" stroke-width="0.00512">
<g id="SVGRepo_bgCarrier" stroke-width="0">
<rect x="-143.36" y="-143.36" width="798.72" height="798.72" rx="399.36" fill="#ffffff" strokewidth="0"/>
</g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier"> <g> <g> <path d="M503.418,440.817h-93.429V187.245c0-12.56-10.218-22.778-22.776-22.778H217.992v-7.911h11.298 c4.741,0,8.582-3.843,8.582-8.582V23.465c0-4.74-3.841-8.582-8.582-8.582h-41.98c-4.741,0-8.582,3.843-8.582,8.582v124.509 c0,4.74,3.841,8.582,8.582,8.582h13.518v7.911H22.776C10.218,164.468,0,174.685,0,187.245v272.318 c0,20.707,16.848,37.554,37.554,37.554h99.038h264.813h76.012c19.069,0,34.582-15.513,34.582-34.582v-13.136 C512,444.66,508.157,440.817,503.418,440.817z M195.893,139.392V32.048h24.816v107.345H195.893z M217.992,219.038v-8.277h145.702 v200.927H46.294V210.761h154.533v8.277c0,3.206-2.609,5.815-5.817,5.815H96.652c-12.672,0-22.981,10.309-22.981,22.981v33.852 c0,12.672,10.309,22.98,22.981,22.98h9.631v55.867c0,9.251,4.688,17.644,12.539,22.453c8.049,4.931,17.93,5.282,26.435,0.943 c1.316-0.672,3.505-1.565,7.285-1.565c6.264,0,8.904,2.245,13.279,5.965c4.989,4.243,11.823,10.055,24.398,10.055 c12.574,0,19.408-5.812,24.397-10.055c4.375-3.72,7.016-5.965,13.279-5.965c6.265,0,8.906,2.245,13.281,5.966 c4.99,4.243,11.824,10.054,24.4,10.054c12.576,0,19.41-5.811,24.4-10.054c1.752-1.49,3.408-2.897,5.115-3.914 c10.33-6.148,16.748-17.533,16.748-29.71v-13.137h8.787c14.31,0,25.951-11.641,25.951-25.951v-39.068 c0-14.308-11.641-25.951-25.951-25.951H132.233c-14.31,0-25.951,11.641-25.951,25.951v10.952h-9.631 c-3.208,0-5.817-2.609-5.817-5.817v-33.852c0-3.207,2.609-5.817,5.817-5.817h98.358 C207.682,242.018,217.992,231.708,217.992,219.038z M126.308,287.502h-2.861V276.55c0-4.844,3.941-8.786,8.786-8.786 s8.786,3.941,8.786,8.786v39.068c0,4.844-3.941,8.786-8.786,8.786s-8.786-3.941-8.786-8.786v-10.951h2.861 c4.741,0,8.582-3.843,8.582-8.582C134.891,291.344,131.048,287.502,126.308,287.502z M156.65,267.764h163.977 c4.844,0,8.786,3.941,8.786,8.786v39.068c0,4.844-3.941,8.786-8.786,8.786H156.65c0.991-2.745,1.533-5.703,1.533-8.786V276.55 C158.183,273.467,157.639,270.509,156.65,267.764z M294.675,341.568v13.137c0,6.158-3.204,11.891-8.363,14.96 c-2.948,1.755-5.343,3.791-7.455,5.588c-4.376,3.72-7.017,5.965-13.281,5.965s-8.906-2.245-13.281-5.966 c-4.99-4.243-11.824-10.054-24.4-10.054c-12.575,0-19.409,5.812-24.398,10.055c-4.375,3.72-7.016,5.965-13.279,5.965 c-6.264,0-8.904-2.245-13.279-5.965c-4.989-4.243-11.823-10.055-24.398-10.055c-5.614,0-10.549,1.125-15.088,3.441 c-3.138,1.603-6.753,1.495-9.668-0.292c-2.757-1.689-4.338-4.536-4.338-7.815v-20.497c2.745,0.991,5.703,1.533,8.785,1.533 H294.675z M17.165,187.245c0-3.095,2.518-5.613,5.612-5.613h178.051v11.965H37.712c-4.741,0-8.582,3.843-8.582,8.582v218.091 c0,4.74,3.841,8.582,8.582,8.582h334.564c4.741,0,8.582-3.843,8.582-8.582V202.178c0-4.74-3.841-8.582-8.582-8.582H217.992 v-11.965h169.22c3.094,0,5.612,2.517,5.612,5.613v253.572H17.165V187.245z M37.554,479.952c-11.243,0-20.389-9.148-20.389-20.391 v-1.58h84.846v4.553c0,6.349,1.727,12.298,4.725,17.418H37.554z M477.418,479.952h-76.012H136.592 c-9.604,0-17.417-7.813-17.417-17.418v-4.553h282.23h93.429v4.553h0.001C494.835,472.139,487.022,479.952,477.418,479.952z"/> </g> </g> </g>
</svg>
                    </div>
                    <h3>Web Design</h3>
                    <p>Create stunning, user-friendly websites that engage visitors and convert them into customers.</p>
                    <a href="/web-design" class="service-button">See More</a>
                </div>

                <div class="service-grid-card animate-slide-up">
                    <div class="service-icon">
                        <svg width="800px" height="800px" viewBox="0 0 64.00 64.00" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)">
<g id="SVGRepo_bgCarrier" stroke-width="0">
<rect x="0" y="0" width="64.00" height="64.00" rx="32" fill="#ffffff" strokewidth="0"/>
</g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M38.2653 15.3929L15.8615 25.0216L24.2661 45.2543L46.2684 35.6506L38.2653 15.3929Z" fill="#2A2941"/> <path d="M19.7502 52.232L24.1406 43.7788L26.2229 45.3544L26.6996 35.0754L18.3703 41.0027L20.8039 41.9531L16.1375 50.1062L19.7502 52.232Z" fill="#2A2941"/> <path d="M26.6996 35.0755L26.2229 45.3544L24.1406 43.7788L19.7251 52.232L16.1375 50.1062L20.8039 41.9531L18.3452 41.0027L26.6996 35.0755ZM27.8035 33.0747L26.1226 34.2752L17.7933 40.2024L16.288 41.2778L18.0191 41.9531L19.3739 42.4783L15.2845 49.606L14.8078 50.4563L15.6608 50.9565L19.2484 53.0823L20.1516 53.6325L20.6534 52.6822L24.5169 45.2793L25.6459 46.1297L27.1763 47.2801L27.2766 45.3794L27.7533 35.1005L27.8035 33.0747Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M48.4511 31.8742L40.1469 11.5415L17.7933 21.1702L26.1979 41.4279L48.4511 31.8742Z" fill="white"/> <path d="M25.7714 42.4033L16.8149 20.77L40.5483 10.5411L49.4295 32.2494L25.7714 42.4033ZM18.7718 21.5703L26.5993 40.4275L47.4727 31.4741L39.7204 12.5419L18.7718 21.5703Z" fill="#2A2941"/> <path d="M41.9679 16.0395L19.5499 25.4126L20.1325 26.7962L42.5504 17.4231L41.9679 16.0395Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8792 24.1963L22.5601 23.4711L21.9579 22.0455L20.277 22.7458L20.8792 24.1963Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M23.8145 22.9959L25.4954 22.2957L24.8933 20.8701L23.1873 21.5454L23.8145 22.9959Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M26.6996 21.7955L28.3805 21.0702L27.7784 19.6447L26.0975 20.3449L26.6996 21.7955Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M35.4303 23.9962C35.4303 23.9962 38.4158 22.8457 39.4193 25.2967C40.3727 27.5975 37.4875 28.898 37.4875 28.898C37.2868 27.9477 36.4589 25.1966 35.4303 23.9962Z" fill="#e65616"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M35.3049 23.6961L34.9034 23.8462L35.1794 24.1713C36.1579 25.3467 36.9607 28.0227 37.1865 28.9231L37.2868 29.2982L37.6381 29.1482C38.1649 28.8981 38.6416 28.5479 39.043 28.1478C39.4695 27.7727 39.7455 27.2975 39.8709 26.7473C39.9963 26.2221 39.9462 25.6468 39.7204 25.1467C39.5197 24.6215 39.1684 24.1713 38.6918 23.8462C38.2151 23.521 37.6381 23.371 37.061 23.396C36.4589 23.396 35.8819 23.496 35.3049 23.6961ZM35.9571 24.1463C36.3084 24.0462 36.6847 24.0212 37.061 24.0212C37.5126 23.9962 37.9642 24.1213 38.3405 24.3714C38.7168 24.6215 38.9928 24.9716 39.1434 25.3968C39.319 25.7969 39.3441 26.2221 39.2437 26.6472C39.1433 27.0724 38.9176 27.4475 38.5914 27.7226C38.3405 27.9727 38.0395 28.2228 37.7133 28.3979C37.337 26.8973 36.7349 25.4718 35.9571 24.1463Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M29.5597 31.274C28.1547 30.5487 27.6028 28.773 27.653 27.1224C30.7388 26.122 33.4985 24.6715 35.631 22.1455C37.8388 24.1213 38.767 26.2471 38.8423 29.7734C35.0289 29.2982 32.1437 30.1736 29.5597 31.274Z" fill="#e65616"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M29.4091 31.5491L29.5346 31.6241L29.6851 31.5741C32.219 30.4737 35.054 29.6233 38.8172 30.0985L39.1935 30.1485V29.7984C39.1183 26.147 38.1649 23.9712 35.8819 21.9454L35.631 21.7203L35.4052 21.9704C33.3229 24.4464 30.6134 25.8719 27.5777 26.8473L27.377 26.9223V27.1224C27.3017 28.8981 27.9289 30.7738 29.4091 31.5491ZM29.5848 30.9238C28.4307 30.2486 27.9791 28.773 27.9791 27.3225C30.9395 26.3221 33.5738 24.9216 35.6561 22.5707C37.5628 24.3463 38.3907 26.3221 38.5162 29.4233C34.8784 29.0231 32.0936 29.8734 29.5848 30.9238Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M27.7784 28.5979C27.7784 28.5979 26.2229 29.1481 26.7247 30.2735C27.2265 31.374 28.7067 30.5987 28.7067 30.5987C28.23 29.9984 27.9289 29.3232 27.7784 28.5979Z" fill="#4C5EFD"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M28.0795 28.5229L28.0042 28.1727L27.653 28.2978C27.3519 28.4228 27.0759 28.5729 26.8501 28.773C26.5992 28.948 26.4236 29.1981 26.3484 29.4982C26.2731 29.7983 26.2982 30.0985 26.4236 30.3736C26.524 30.5987 26.6745 30.7987 26.9003 30.9238C27.1261 31.0488 27.3519 31.1239 27.6028 31.1239C28.0293 31.1239 28.4558 31.0238 28.8321 30.8487L29.1582 30.6737L28.9325 30.3736C28.506 29.8484 28.23 29.1981 28.0795 28.5229ZM27.5526 29.0481C27.7031 29.5483 27.9038 29.9984 28.1798 30.4486C28.0544 30.4736 27.954 30.5236 27.8286 30.5236C27.678 30.5736 27.5024 30.5486 27.3519 30.4736C27.2014 30.3986 27.0759 30.2985 27.0007 30.1485C26.9254 29.9984 26.9254 29.8234 26.9756 29.6733C27.0257 29.5232 27.1261 29.3732 27.2515 29.2731C27.3519 29.1731 27.4522 29.1231 27.5526 29.0481Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M31.09 30.6988C31.8678 32.0493 32.3695 33.5499 32.5702 35.1005L35.3048 33.9C34.502 32.6996 33.8497 31.3741 33.3981 29.9985C32.5953 30.1736 31.8176 30.4237 31.09 30.6988Z" fill="#e65616"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M30.9646 30.4236L30.6384 30.5487L30.789 30.8488C31.5416 32.1743 32.0434 33.6248 32.2441 35.1254L32.2943 35.5756L35.8066 34.05L35.6059 33.7499C34.8031 32.5494 34.1759 31.2739 33.7243 29.9234L33.6239 29.6483L33.348 29.6983C32.5451 29.8734 31.7423 30.1235 30.9646 30.4236ZM31.5416 30.8488C32.0935 30.6487 32.6455 30.4736 33.2225 30.3486C33.649 31.549 34.201 32.6745 34.8783 33.7499L32.8462 34.6252C32.5953 33.2997 32.1688 32.0492 31.5416 30.8488Z" fill="#2A2941"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M28.4307 26.7973C28.4808 28.3479 29.083 29.8234 30.1367 30.9989C30.1868 31.0489 30.2872 31.0989 30.3625 31.0989C30.4377 31.0989 30.5381 31.0739 30.5882 30.9989C30.6384 30.9239 30.6886 30.8738 30.6886 30.7738C30.6886 30.6988 30.6635 30.6237 30.5882 30.5487C29.6349 29.4983 29.108 28.1728 29.0579 26.7973C29.0579 26.7223 29.0328 26.6472 28.9575 26.5722C28.9073 26.5222 28.807 26.4722 28.7317 26.4722C28.6565 26.4722 28.5561 26.4972 28.5059 26.5722C28.4558 26.6472 28.4307 26.7223 28.4307 26.7973Z" fill="#2A2941"/> <path d="M21.5063 52.232L25.9218 43.7788L27.9791 45.3544L28.4557 35.0754L20.1516 41.0027L22.5851 41.9531L17.9187 50.1062L21.5063 52.232Z" fill="#e65616"/> <path d="M28.4558 35.0755L27.9791 45.3544L25.8968 43.7788L21.4813 52.232L17.9187 50.1062L22.5851 41.9531L20.1265 41.0027L28.4558 35.0755ZM29.5597 33.0747L27.8787 34.2752L19.5495 40.2024L18.0442 41.2778L19.7753 41.9531L21.13 42.4783L17.0406 49.606L16.564 50.4563L17.417 50.9565L21.0046 53.0823L21.9078 53.6325L22.4095 52.6822L26.2731 45.2793L27.4021 46.1297L28.9324 47.2801L29.0328 45.3794L29.5095 35.1005L29.5597 33.0747Z" fill="#2A2941"/> </g>
</svg>
                    </div>
                    <h3>Digital Marketing</h3>
                    <p>Comprehensive digital marketing strategies to grow your brand and reach your target audience.</p>
                    <a href="/digital-marketing" class="service-button">See More</a>
                </div>

                <div class="service-grid-card animate-slide-up">
                    <div class="service-icon">
                        <svg width="800px" height="800px" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg">
<g id="SVGRepo_bgCarrier" stroke-width="0">
<rect x="-2.4" y="-2.4" width="28.80" height="28.80" rx="14.4" fill="#ffffff" strokewidth="0"/>
</g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier"> <path d="M16 10L18.5768 8.45392C19.3699 7.97803 19.7665 7.74009 20.0928 7.77051C20.3773 7.79703 20.6369 7.944 20.806 8.17433C21 8.43848 21 8.90095 21 9.8259V14.1741C21 15.099 21 15.5615 20.806 15.8257C20.6369 16.056 20.3773 16.203 20.0928 16.2295C19.7665 16.2599 19.3699 16.022 18.5768 15.5461L16 14M6.2 18H12.8C13.9201 18 14.4802 18 14.908 17.782C15.2843 17.5903 15.5903 17.2843 15.782 16.908C16 16.4802 16 15.9201 16 14.8V9.2C16 8.0799 16 7.51984 15.782 7.09202C15.5903 6.71569 15.2843 6.40973 14.908 6.21799C14.4802 6 13.9201 6 12.8 6H6.2C5.0799 6 4.51984 6 4.09202 6.21799C3.71569 6.40973 3.40973 6.71569 3.21799 7.09202C3 7.51984 3 8.07989 3 9.2V14.8C3 15.9201 3 16.4802 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.51984 18 5.07989 18 6.2 18Z" stroke="#e65616" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>
</svg>
                    </div>
                    <h3>Video Production</h3>
                    <p>Professional video content that tells your story and engages your audience across all platforms.</p>
                    <a href="/video-production" class="service-button">See More</a>
                </div>

                <div class="service-grid-card animate-slide-up">
                    <div class="service-icon">
                        <svg fill="#e65616" height="800px" width="800px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-143.36 -143.36 798.72 798.72" xml:space="preserve">
<g id="SVGRepo_bgCarrier" stroke-width="0">
<rect x="-143.36" y="-143.36" width="798.72" height="798.72" rx="399.36" fill="#ffffff" strokewidth="0"/>
</g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier"> <g> <g> <path d="M438.428,236.088c-0.317-11.571-6.001-21.92-14.633-28.724c2.28-4.886,3.554-10.333,3.554-16.071 c0-21.028-17.108-38.136-38.136-38.136h-44.203l0.227-53.358c0.044-10.451-3.993-20.286-11.368-27.692 c-7.375-7.406-17.192-11.485-27.643-11.485c-15.681,0-29.787,9.355-35.935,23.832c-5.271,12.408-15.34,30.832-29.12,53.278 c-5.84,9.513-16.409,15.424-27.581,15.424h-31.346h-30.417h-78.27v213.841h78.271h30.417v0.001h195.875 c21.028,0,38.136-17.109,38.136-38.137c0-5.669-1.244-11.054-3.473-15.894c8.866-6.99,14.567-17.823,14.567-29.961 c0-5.662-1.24-11.038-3.462-15.874c1.313-1.037,2.567-2.169,3.754-3.389C434.882,256.3,438.713,246.478,438.428,236.088z M151.827,336.58h-47.853V183.574h47.853V336.58z M405.843,242.53c-0.85,0.873-2.698,2.338-5.534,2.338h-11.093h-30.393v30.417 h30.393c4.256,0,7.719,3.464,7.719,7.72c0,4.256-3.462,7.719-7.719,7.719h-11.094h-19.298v30.417h19.298 c4.256,0,7.719,3.464,7.719,7.719c0,4.256-3.462,7.72-7.719,7.72H182.244V183.574h31.346c21.671,0,42.173-11.468,53.505-29.929 c10.15-16.534,23.802-39.896,31.194-57.3c1.369-3.223,4.486-5.306,7.939-5.306c2.303,0,4.464,0.898,6.09,2.53 c1.625,1.631,2.513,3.798,2.504,6.101l-0.358,83.904h74.751c4.256,0,7.719,3.464,7.719,7.719c0,4.256-3.463,7.72-7.719,7.72 h-30.393v30.417h30.393h10.617c4.404,0,8.08,3.36,8.193,7.492C408.103,239.77,406.691,241.658,405.843,242.53z"/> </g> </g> <g> <g> <path d="M0,10.015v417.73h201.339l54.661,74.239l54.661-74.239h201.339V10.015H0z M481.583,397.328H295.283l-39.284,53.354 l-39.284-53.355H30.417V40.431h451.166V397.328z"/> </g> </g> </g>
</svg>
                    </div>
                    <h3>Social Media</h3>
                    <p>Build your brand presence and engage with your audience through strategic social media management.</p>
                    <a href="/social-media" class="service-button">See More</a>
                </div>

                <div class="service-grid-card animate-slide-up">
                    <div class="service-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-102.4 -102.4 716.79 716.79" xml:space="preserve" width="800px" height="800px" fill="#e65616" stroke="#e65616">
<g id="SVGRepo_bgCarrier" stroke-width="0">
<rect x="-102.4" y="-102.4" width="716.79" height="716.79" rx="358.395" fill="#ffffff" strokewidth="0"/>
</g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier"> <path style="fill:#F6BB42;" d="M284.847,95.997c-16.453-37.671-54.029-63.998-97.778-63.998c-43.733,0-81.31,26.327-97.778,63.998 l-8.875,10.663v31.999c0,58.913,47.749,106.669,106.653,106.669c58.92,0,106.669-47.756,106.669-106.669V106.66L284.847,95.997z"/> <path style="fill:#FFCE54;" d="M293.738,106.66c0,58.913-47.749,106.669-106.669,106.669c-58.904,0-106.653-47.756-106.653-106.669 C80.416,47.756,128.165,0,187.069,0C245.99,0,293.738,47.756,293.738,106.66z"/> <rect x="219.073" y="189.332" width="21.343" height="35.999"/> <path style="fill:#E8AA3D;" d="M187.069,63.998c-5.89,0-10.656,4.773-10.656,10.663v63.998c0,5.898,4.766,10.672,10.656,10.672 c5.891,0,10.672-4.773,10.672-10.672V74.661C197.741,68.771,192.96,63.998,187.069,63.998z"/> <path style="fill:#F5F7FA;" d="M420.562,294.429c0-13.281-9.453-24.046-22.828-24.046c-13.374,0-28.607,10.765-28.607,24.046 v-11.812c0-13.28-13.594-24.054-26.953-24.054c-13.391,0-26.968,10.773-26.968,24.054v-17.929c0-13.133-13.437-23.797-26.593-24.039 c-0.578-0.031-1.172-0.07-1.781-0.07c-13.359,0-26.812,10.773-26.812,24.055v-91.248c0-13.28-12.624-24.054-25.998-24.054 c-13.375,0-25.593,10.773-25.593,24.054v183.683l-17.703-23.108c-9.359-12.203-26.905-14.578-39.202-5.281 s-14.672,26.718-5.297,38.936l82.919,108.217l4.922,15.124c1.359,5.937,6.703,10.374,13.093,10.374h130.762 c0,0,0.016-0.016,0.047-0.031c0.109,0,0.203,0.031,0.312,0.031c6.125,0,11.265-4.062,12.905-9.624 c0.031-0.094,0.078-0.156,0.094-0.25C426.109,349.239,420.562,294.429,420.562,294.429z"/> <path style="fill:#e65616;" d="M431.234,293.929c-0.266-19.219-14.875-34.21-33.5-34.21c-7.656,0-15.687,2.531-22.483,6.906 c-6.483-10.938-19.202-18.727-33.077-18.727c-6.703,0-13.125,1.812-18.703,4.914c-2.031-4.82-5.28-9.266-9.64-13.039 c-6.938-6.007-15.968-9.569-24.812-9.788l0,0c-0.609-0.031-1.344-0.07-2.188-0.07c-5.688,0-11.203,1.32-16.156,3.641v-60.171 c0-18.819-16.78-34.726-36.654-34.726c-19.656,0-36.265,15.906-36.265,34.726v152.324c-7.344-8.531-17.906-13.375-29.312-13.375 c-8.5,0-16.578,2.719-23.343,7.844c-8.25,6.219-13.546,15.266-14.921,25.468c-1.375,10.188,1.312,20.28,7.578,28.468l81.81,106.747 l4.219,13.031c2.719,10.671,12.265,18.093,23.375,18.093h132.339l0.109-0.031c9.937-0.562,18.687-7.297,21.687-16.812 c0.109-0.312,0.234-0.719,0.344-1.188C435.062,357.489,431.765,300.459,431.234,293.929z M381.032,488.423 c-0.016,0.094-0.047,0.188-0.078,0.281c-0.266,0.891-1.125,1.828-2.422,1.938c-0.172,0-0.359-0.016-0.562-0.016h-3.5l-0.031,0.016 H247.161c-1.469,0-2.469-1.047-2.703-2.094l-0.109-0.438l-5.625-17.312l-84.044-109.67c-2.781-3.624-3.968-8.108-3.359-12.608 c0.609-4.531,2.968-8.562,6.64-11.343c3.047-2.281,6.672-3.5,10.484-3.5c5.484,0,10.515,2.469,13.812,6.749l36.843,48.093V173.385 c0-7.007,7.109-13.39,14.921-13.39c7.875,0,15.328,6.508,15.328,13.39v91.248v44.514h0.016c0,0.062-0.016,0.125-0.016,0.188 c0,5.875,4.781,10.656,10.67,10.656c5.891,0,10.656-4.781,10.656-10.656c0-0.062,0-0.125,0-0.188l0,0v-44.514 c0-6.758,8.016-13.391,16.156-13.391c0.344,0,0.688,0.023,1,0.047l0.578,0.023c8.141,0.148,16.14,6.781,16.14,13.375v17.929v26.53 l0,0c0,0.062,0,0.125,0,0.188c0,5.875,4.766,10.656,10.656,10.656s10.671-4.781,10.671-10.656c0-0.062-0.016-0.125-0.016-0.188 h0.016v-26.53c0-6.75,8.062-13.382,16.297-13.382c8.062,0,16.281,6.757,16.281,13.382v11.812v14.718h0.016 c0,0.062-0.016,0.125-0.016,0.188c0,5.875,4.781,10.656,10.672,10.656c5.89,0,10.671-4.781,10.671-10.656 c0-0.062-0.016-0.125-0.016-0.188h0.016v-14.718c0-6.375,9.39-13.375,17.937-13.375c7.984,0,12.156,6.719,12.156,13.375v0.5 l0.062,0.547C410,296.022,414.656,350.942,381.032,488.423z"/> </g>
</svg>
                    </div>
                    <h3>Pay-Per-Click</h3>
                    <p>Maximize ROI with targeted PPC campaigns that drive qualified traffic and convert visitors.</p>
                    <a href="/pay-per-click" class="service-button">See More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" data-section-theme="light">
        <div class="cta-container">
            <div class="cta-cards">
                <div class="cta-card cta-card-light animate-slide-up">
                    <span class="cta-label">CONTACT US</span>
                    <h2>Get a Custom Quote for Your Project <span class="highlight-text-italic">Today!</span></h2>
                    <p>We've helped businesses rank for over 5,000 first-page keywords and grow their organic traffic to 300K+ monthly visits.</p>
                    <a href="#contact" class="cta-button">Request a Proposal</a>
                </div>

                <div class="cta-card cta-card-blue animate-slide-up">            
                    <span class="cta-label">SEO AND GOOGLE ADS</span>
                    <h2>Free SEO and Google Ads Audit.</h2>
                    <p>Our team has delivered proven strategies that drive results—and we're offering a free audit to help you get started.</p>
                    <a href="#contact" class="cta-button cta-button-white">Request a Proposal</a>
                </div>
            </div>
        </div>
    </section>

<!-- CTA Section -->
<section class="cta-section" data-section-theme="light">
    <div class="cta-container">
        <div class="cta-cards">
            <div class="cta-card cta-card-light animate-slide-up">
                <span class="cta-label"><?php echo !empty($cta_card_1['label']) ? esc_html($cta_card_1['label']) : 'CONTACT US'; ?></span>
                <h2><?php echo !empty($cta_card_1['heading']) ? wp_kses_post($cta_card_1['heading']) : 'Get a Custom Quote for Your Project <span class="highlight-text-italic">Today!</span>'; ?></h2>
                <p><?php echo !empty($cta_card_1['text']) ? esc_html($cta_card_1['text']) : 'We\'ve helped businesses rank for over 5,000 first-page keywords and grow their organic traffic to 300K+ monthly visits.'; ?></p>
                <a href="<?php echo !empty($cta_card_1['button_link']) ? esc_url($cta_card_1['button_link']) : '#contact'; ?>" class="cta-button"><?php echo !empty($cta_card_1['button_text']) ? esc_html($cta_card_1['button_text']) : 'Request a Proposal'; ?></a>
            </div>

            <div class="cta-card cta-card-blue animate-slide-up">            
                <span class="cta-label"><?php echo !empty($cta_card_2['label']) ? esc_html($cta_card_2['label']) : 'SEO AND GOOGLE ADS'; ?></span>
                <h2><?php echo !empty($cta_card_2['heading']) ? esc_html($cta_card_2['heading']) : 'Free SEO and Google Ads Audit.'; ?></h2>
                <p><?php echo !empty($cta_card_2['text']) ? esc_html($cta_card_2['text']) : 'Our team has delivered proven strategies that drive results—and we\'re offering a free audit to help you get started.'; ?></p>
                <a href="<?php echo !empty($cta_card_2['button_link']) ? esc_url($cta_card_2['button_link']) : '#contact'; ?>" class="cta-button cta-button-white"><?php echo !empty($cta_card_2['button_text']) ? esc_html($cta_card_2['button_text']) : 'Request a Proposal'; ?></a>
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
            <?php if ($case_studies && is_array($case_studies)) : ?>
                <?php foreach ($case_studies as $case) : ?>
                    <div class="case-study-card animate-slide-up">
                        <div class="case-study-image">
                            <?php if (!empty($case['image'])) : ?>
                                <img src="<?php echo esc_url($case['image']['url']); ?>" alt="<?php echo esc_attr($case['title'] ?? ''); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="case-study-content">
                            <h3><?php echo esc_html($case['title'] ?? ''); ?></h3>
                            <p><?php echo esc_html($case['description'] ?? ''); ?></p>
                            
                            <?php if (!empty($case['stats']) && is_array($case['stats'])) : ?>
                                <div class="case-study-stats">
                                    <?php foreach ($case['stats'] as $stat) : ?>
                                        <div class="stat">
                                            <span class="stat-number" data-target="<?php echo esc_attr($stat['value'] ?? 0); ?>" data-suffix="<?php echo esc_attr($stat['suffix'] ?? ''); ?>">0<?php echo esc_html($stat['suffix'] ?? ''); ?></span>
                                            <span class="stat-label"><?php echo esc_html($stat['label'] ?? ''); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($case['link'])) : ?>
                                <a href="<?php echo esc_url($case['link']['url']); ?>" class="case-study-link"><?php echo esc_html($case['link']['title'] ?: 'View Case Study'); ?> →</a>
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
                        <h3>Client Success Story</h3>
                        <p>Discover how we helped this client achieve remarkable results through our comprehensive digital strategy.</p>
                        <div class="case-study-stats">
                            <div class="stat">
                                <span class="stat-number" data-target="150" data-suffix="%">0%</span>
                                <span class="stat-label">Traffic Increase</span>
                            </div>
                            <div class="stat">
                                <span class="stat-number" data-target="200" data-suffix="%">0%</span>
                                <span class="stat-label">Revenue Growth</span>
                            </div>
                        </div>
                        <a href="#" class="case-study-link">View Case Study →</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="case-studies-cta animate-fade-in">
            <a href="<?php echo $case_studies_button_link ? esc_url($case_studies_button_link) : '#case-studies'; ?>" class="case-studies-cta-btn"><?php echo $case_studies_button_text ? esc_html($case_studies_button_text) : 'View All Case Studies'; ?></a>
        </div>
    </div>
</section>

<!-- Info Section 1 -->
<section class="info1-section" data-section-theme="light">
    <div class="info1-container">
        <h2 class="info1-heading animate-fade-in">
            <span class="black-text"><?php echo $info1_heading_line_1 ? esc_html($info1_heading_line_1) : 'Achieve Your'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $info1_heading_line_2 ? esc_html($info1_heading_line_2) : 'Business Goals'; ?></span>
        </h2>
        
        <div class="info1-content">
            <div class="info1-text animate-slide-left">
                <p><?php echo $info1_text ? esc_html($info1_text) : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.'; ?></p>
                <a href="<?php echo $info1_button_link ? esc_url($info1_button_link) : '#contact'; ?>" class="cta-button"><?php echo $info1_button_text ? esc_html($info1_button_text) : 'Get Started'; ?></a>
            </div>
            
            <div class="info1-image animate-slide-right">
                <?php if ($info1_image) : ?>
                    <img src="<?php echo esc_url($info1_image['url']); ?>" alt="<?php echo esc_attr($info1_image['alt'] ?: 'Business Growth'); ?>">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info1-placeholder.jpg" alt="Business Growth">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Info Section 2 -->
<section class="info2-section" data-section-theme="light">
    <div class="info2-container">
        <h2 class="info2-heading animate-fade-in">
            <span class="black-text"><?php echo $info2_heading_line_1 ? esc_html($info2_heading_line_1) : 'Expert'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $info2_heading_line_2 ? esc_html($info2_heading_line_2) : 'Solutions'; ?></span>
        </h2>
        
        <div class="info2-content">
            <div class="info2-image animate-slide-left">
                <?php if ($info2_image) : ?>
                    <img src="<?php echo esc_url($info2_image['url']); ?>" alt="<?php echo esc_attr($info2_image['alt'] ?: 'Expert Team'); ?>">
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/info2-placeholder.jpg" alt="Expert Team">
                <?php endif; ?>
            </div>
            
            <div class="info2-text animate-slide-right">
                <p><?php echo $info2_text ? esc_html($info2_text) : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes.'; ?></p>
                <a href="<?php echo $info2_button_link ? esc_url($info2_button_link) : '#contact'; ?>" class="cta-button"><?php echo $info2_button_text ? esc_html($info2_button_text) : 'Learn More'; ?></a>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news-section" data-section-theme="dark">
    <div class="news-container">
        <h2 class="news-heading animate-fade-in">
            <span class="black-text"><?php echo $news_heading_line_1 ? esc_html($news_heading_line_1) : 'Latest'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $news_heading_line_2 ? esc_html($news_heading_line_2) : 'News'; ?></span>
        </h2>
        
        <div class="news-grid">
            <?php if ($news_items && is_array($news_items) && !empty($news_items)) : ?>
                <?php foreach ($news_items as $news) : ?>
                    <?php if (is_array($news)) : ?>
                        <div class="news-card animate-slide-up">
                            <div class="news-card-image">
                                <?php if (!empty($news['image'])) : ?>
                                    <img src="<?php echo esc_url($news['image']['url']); ?>" alt="<?php echo esc_attr($news['title'] ?? ''); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="news-card-content">
                                <div class="news-card-meta">
                                    <span class="news-card-category"><?php echo esc_html($news['category'] ?? ''); ?></span>
                                    <span class="news-card-date"><?php echo esc_html($news['date'] ?? ''); ?></span>
                                </div>
                                <h3><?php echo esc_html($news['title'] ?? ''); ?></h3>
                                <p><?php echo esc_html($news['excerpt'] ?? ''); ?></p>
                                <?php if (!empty($news['link'])) : ?>
                                    <a href="<?php echo esc_url($news['link']['url']); ?>" class="news-card-link">
                                        <?php echo esc_html($news['link']['title'] ?: 'Read More'); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
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
            <?php if ($metrics_items && is_array($metrics_items)) : ?>
                <?php foreach ($metrics_items as $metric) : ?>
                    <div class="hd-metric-card animate-slide-up">
                        <div class="hd-metric-card__icon"><span><?php echo esc_html($metric['icon'] ?? ''); ?></span></div>
                        <div class="hd-metric-card__value" 
                             data-target="<?php echo esc_attr($metric['value'] ?? 0); ?>"
                             <?php echo !empty($metric['prefix']) ? 'data-prefix="' . esc_attr($metric['prefix']) . '"' : ''; ?>
                             <?php echo !empty($metric['suffix']) ? 'data-suffix="' . esc_attr($metric['suffix']) . '"' : ''; ?>
                             <?php echo !empty($metric['decimals']) ? 'data-decimals="' . esc_attr($metric['decimals']) . '"' : ''; ?>>
                            <?php echo esc_html($metric['prefix'] ?? ''); ?>0<?php echo esc_html($metric['suffix'] ?? ''); ?>
                        </div>
                        <div class="hd-metric-card__label"><?php echo esc_html($metric['label'] ?? ''); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default metrics if no ACF data -->
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>📈</span></div>
                    <div class="hd-metric-card__value" data-target="500" data-suffix="+">0+</div>
                    <div class="hd-metric-card__label">Projects Completed</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>🎯</span></div>
                    <div class="hd-metric-card__value" data-target="98" data-suffix="%">0%</div>
                    <div class="hd-metric-card__label">Client Satisfaction</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>🚀</span></div>
                    <div class="hd-metric-card__value" data-target="10" data-suffix="M+">0M+</div>
                    <div class="hd-metric-card__label">Monthly Traffic Generated</div>
                </div>
                <div class="hd-metric-card animate-slide-up">
                    <div class="hd-metric-card__icon"><span>⭐</span></div>
                    <div class="hd-metric-card__value" data-target="4.9" data-decimals="1">0</div>
                    <div class="hd-metric-card__label">Average Rating</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section" id="contact" data-section-theme="light">
    <div class="contact-form-container">
        <div class="contact-sidebar animate-slide-right">
            <?php if ($contact_sidebar_logo) : ?>
                <img src="<?php echo esc_url($contact_sidebar_logo['url']); ?>" alt="Hagerty Digital" class="contact-sidebar-logo">
            <?php else : ?>
                <img src="https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/logoblack.png" alt="Hagerty Digital" class="contact-sidebar-logo">
            <?php endif; ?>
            
            <h2><?php echo $contact_sidebar_heading ? esc_html($contact_sidebar_heading) : 'Let\'s Build Something Great Together'; ?></h2>
            <p><?php echo $contact_sidebar_text ? esc_html($contact_sidebar_text) : 'Ready to transform your digital presence? Get in touch with our team and let\'s discuss how we can help your business grow.'; ?></p>
            
            <div class="contact-info">
                <div class="contact-info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span><?php echo $phone ? esc_html($phone) : '01onal 792 114'; ?></span>
                </div>
                <div class="contact-info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <span><?php echo $email ? esc_html($email) : 'hello@hagertydigital.com'; ?></span>
                </div>
            </div>
        </div>
        
        <div class="contact-form-card animate-slide-left">
            <?php if ($contact_form_logo) : ?>
                <img src="<?php echo esc_url($contact_form_logo['url']); ?>" alt="Hagerty Digital" class="form-logo">
            <?php else : ?>
                <img src="https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/logoblack.png" alt="Hagerty Digital" class="form-logo">
            <?php endif; ?>
            
            <div class="form-content">
                <!-- Step 1: Initial Choice -->
                <div class="form-step active" id="step1">
                    <h3><?php echo $contact_step1_heading ? esc_html($contact_step1_heading) : 'How can we help?'; ?></h3>
                    <p><?php echo $contact_step1_text ? esc_html($contact_step1_text) : 'Choose an option to get started'; ?></p>
                    
                    <div class="initial-choice-buttons">
                        <a href="<?php echo $contact_book_call_link ? esc_url($contact_book_call_link) : 'https://calendly.com/hagertydigital'; ?>" class="choice-btn choice-btn-primary" id="bookCallBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <?php echo $contact_book_call_text ? esc_html($contact_book_call_text) : 'Book a Call'; ?>
                        </a>
                        <button class="choice-btn choice-btn-secondary" id="exploreServicesBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                                <line x1="12" y1="17" x2="12.01" y2="17"/>
                            </svg>
                            <?php echo $contact_explore_text ? esc_html($contact_explore_text) : 'Explore Services'; ?>
                        </button>
                    </div>
                </div>
                
                <!-- Step 2: Service Selection -->
                <div class="form-step" id="step2">
                    <h3>What services are you interested in?</h3>
                    <p>Select all that apply</p>
                    
                    <div class="services-grid-select">
                        <?php if ($contact_services_options && is_array($contact_services_options)) : ?>
                            <?php foreach ($contact_services_options as $service) : ?>
                                <div class="service-checkbox">
                                    <input type="checkbox" id="service-<?php echo sanitize_title($service['service_name'] ?? ''); ?>" name="services" value="<?php echo esc_attr($service['service_name'] ?? ''); ?>">
                                    <label for="service-<?php echo sanitize_title($service['service_name'] ?? ''); ?>"><?php echo esc_html($service['service_name'] ?? ''); ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-seo" name="services" value="SEO">
                                <label for="service-seo">SEO</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-ppc" name="services" value="PPC">
                                <label for="service-ppc">PPC</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-web-design" name="services" value="Web Design">
                                <label for="service-web-design">Web Design</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-web-dev" name="services" value="Web Development">
                                <label for="service-web-dev">Web Development</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-social" name="services" value="Social Media">
                                <label for="service-social">Social Media</label>
                            </div>
                            <div class="service-checkbox">
                                <input type="checkbox" id="service-email" name="services" value="Email Marketing">
                                <label for="service-email">Email Marketing</label>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="btn-back" id="backToStep1">Back</button>
                        <button type="button" class="btn-next" id="toStep3">Continue</button>
                    </div>
                </div>
                
                <!-- Step 3: Contact Details -->
                <div class="form-step" id="step3">
                    <h3>Tell us about yourself</h3>
                    <p>We'll get back to you within 24 hours</p>
                    
                    <form id="contactForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-name">Full Name *</label>
                                <input type="text" id="contact-name" name="name" required placeholder="Your name">
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Email *</label>
                                <input type="email" id="contact-email" name="email" required placeholder="your@email.com">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-company">Company</label>
                                <input type="text" id="contact-company" name="company" placeholder="Your company">
                            </div>
                            <div class="form-group">
                                <label for="contact-phone">Phone *</label>
                                <input type="tel" id="contact-phone" name="phone" required placeholder="Your phone number">
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="contact-message">Message *</label>
                            <textarea id="contact-message" name="message" rows="4" required placeholder="Tell us about your project..."></textarea>
                        </div>
                        
                        <div class="form-buttons">
                            <button type="button" class="btn-back" id="backToStep2">Back</button>
                            <button type="submit" class="btn-submit" id="submitForm">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Long CTA Section - Dark Theme -->
<section class="long-cta-section" data-section-theme="dark">
    <div class="long-cta-container">
        <div class="long-cta-content">
            <span class="long-cta-label animate-fade-in"><?php echo $long_cta_label ? esc_html($long_cta_label) : 'READY TO GROW?'; ?></span>
            <h2 class="long-cta-heading animate-fade-in">
                <?php echo $long_cta_heading_line_1 ? esc_html($long_cta_heading_line_1) : 'Transform Your Digital Presence'; ?>
                <span class="highlight-text-italic"><?php echo $long_cta_heading_line_2 ? esc_html($long_cta_heading_line_2) : 'Today'; ?></span>
            </h2>
            <p class="long-cta-text animate-fade-in"><?php echo $long_cta_text ? esc_html($long_cta_text) : 'Join hundreds of businesses that have transformed their online presence with Hagerty Digital. Let\'s build something great together.'; ?></p>
            
            <div class="long-cta-features">
                <?php if ($long_cta_features && is_array($long_cta_features)) : ?>
                    <?php foreach ($long_cta_features as $feature) : ?>
                        <div class="long-cta-feature animate-slide-up">
                            <div class="long-cta-feature-icon">
                                <?php if (!empty($feature['icon'])) : ?>
                                    <?php echo $feature['icon']; ?>
                                <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="long-cta-feature-text">
                                <h4><?php echo esc_html($feature['title'] ?? ''); ?></h4>
                                <p><?php echo esc_html($feature['description'] ?? ''); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="long-cta-feature animate-slide-up">
                        <div class="long-cta-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                        <div class="long-cta-feature-text">
                            <h4>Proven Results</h4>
                            <p>Track record of delivering measurable growth for our clients</p>
                        </div>
                    </div>
                    <div class="long-cta-feature animate-slide-up">
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
                            <p>Expert strategists committed to your success</p>
                        </div>
                    </div>
                    <div class="long-cta-feature animate-slide-up">
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
                    <?php if ($reviews_items && is_array($reviews_items)) : ?>
                        <?php foreach ($reviews_items as $review) : ?>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-avatar" style="background: <?php echo esc_attr($review['avatar_color'] ?? '#4285f4'); ?>;"><?php echo esc_html(substr($review['reviewer_name'] ?? 'C', 0, 1)); ?></div>
                                    <div class="reviewer-info">
                                        <h4><?php echo esc_html($review['reviewer_name'] ?? ''); ?></h4>
                                        <p class="review-date"><?php echo esc_html($review['review_date'] ?? ''); ?></p>
                                    </div>
                                </div>
                                <div class="review-stars">
                                    <?php 
                                    $stars = intval($review['star_rating'] ?? 5);
                                    echo str_repeat('★', $stars);
                                    ?>
                                </div>
                                <p class="review-text"><?php echo esc_html($review['review_text'] ?? ''); ?></p>
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