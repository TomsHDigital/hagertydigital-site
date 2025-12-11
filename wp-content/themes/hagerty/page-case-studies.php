<?php
/**
 * Template Name: Case Studies
 * Description: Custom Case Studies page template with full ACF integration
 * All classes prefixed with casestudies-page- for independent styling
 */

get_header();

$has_acf = function_exists('get_field');

// ============================================
// HELPER FUNCTIONS
// ============================================
if (!function_exists('cs_strip_wrapping_p')) {
    function cs_strip_wrapping_p($html) {
        if (!$html) return '';
        return preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($html));
    }
}

if (!function_exists('cs_wysiwyg_or_default')) {
    function cs_wysiwyg_or_default($field_value, $default_html) {
        $val = $field_value ? apply_filters('the_content', $field_value) : $default_html;
        return cs_strip_wrapping_p($val);
    }
}

if (!function_exists('cs_link')) {
    function cs_link($link_field) {
        if (!$link_field || !is_array($link_field) || empty($link_field['url'])) return null;
        return [
            'url'    => esc_url($link_field['url']),
            'title'  => !empty($link_field['title']) ? esc_html($link_field['title']) : 'View Case Study',
            'target' => !empty($link_field['target']) ? esc_attr($link_field['target']) : '_self',
        ];
    }
}

// SVG Output Helper
if (!function_exists('cs_svg_output')) {
    function cs_svg_output($svg_string) {
        if (empty($svg_string)) return '';
        
        $allowed_svg = array(
            'svg' => array(
                'xmlns' => true, 'viewbox' => true, 'width' => true, 'height' => true,
                'fill' => true, 'stroke' => true, 'stroke-width' => true,
                'stroke-linecap' => true, 'stroke-linejoin' => true,
                'class' => true, 'id' => true, 'style' => true,
            ),
            'path' => array(
                'd' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true,
                'stroke-linecap' => true, 'stroke-linejoin' => true,
                'class' => true, 'transform' => true, 'opacity' => true,
            ),
            'circle' => array(
                'cx' => true, 'cy' => true, 'r' => true, 'fill' => true,
                'stroke' => true, 'stroke-width' => true,
            ),
            'rect' => array(
                'x' => true, 'y' => true, 'width' => true, 'height' => true,
                'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true,
            ),
            'line' => array(
                'x1' => true, 'y1' => true, 'x2' => true, 'y2' => true,
                'stroke' => true, 'stroke-width' => true,
            ),
            'polyline' => array('points' => true, 'fill' => true, 'stroke' => true),
            'polygon' => array('points' => true, 'fill' => true, 'stroke' => true),
            'g' => array('fill' => true, 'stroke' => true, 'transform' => true),
        );
        
        return wp_kses($svg_string, $allowed_svg);
    }
}

// ============================================
// HERO SECTION ACF FIELDS
// - casestudies_hero_bg_type (Select: video/image)
// - casestudies_hero_video (File)
// - casestudies_hero_image (Image)
// - casestudies_hero_label (Text)
// - casestudies_hero_heading (WYSIWYG)
// - casestudies_hero_subheading (WYSIWYG)
// - casestudies_hero_button_text (Text)
// - casestudies_hero_button_link (Link)
// ============================================
$hero_bg_type = $has_acf ? get_field('casestudies_hero_bg_type') : 'image';
$hero_video = $has_acf ? get_field('casestudies_hero_video') : '';
$hero_image = $has_acf ? get_field('casestudies_hero_image') : '';
$hero_label = $has_acf ? get_field('casestudies_hero_label') : 'Our Work';
$hero_heading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_hero_heading') : '', 'Real Results for <span class="highlight-text-italic">Real Businesses</span>');
$hero_subheading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_hero_subheading') : '', 'Discover how we\'ve helped businesses like yours achieve measurable growth through strategic digital marketing and web development.');
$hero_button_text = $has_acf ? get_field('casestudies_hero_button_text') : 'Get Started';
$hero_button_link = $has_acf ? cs_link(get_field('casestudies_hero_button_link')) : ['url' => '/contact-us', 'target' => '_self'];
?>

<!-- ==========================================
     HERO SECTION - Video/Image Background
     ========================================== -->
<section class="casestudies-page-hero" data-section-theme="dark">
    <div class="casestudies-page-hero-bg">
        <?php if ($hero_bg_type === 'video' && !empty($hero_video)) : ?>
            <video class="casestudies-page-hero-video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(is_array($hero_video) ? $hero_video['url'] : $hero_video); ?>" type="video/mp4">
            </video>
        <?php elseif (!empty($hero_image)) : ?>
            <img class="casestudies-page-hero-image" src="<?php echo esc_url(is_array($hero_image) ? $hero_image['url'] : $hero_image); ?>" alt="Case Studies">
        <?php endif; ?>
        <div class="casestudies-page-hero-overlay"></div>
    </div>

    
    <div class="casestudies-page-hero-content">
        <div class="casestudies-page-hero-text animate-fade-in">
            <?php if ($hero_label) : ?>
                <span class="casestudies-page-hero-label"><?php echo esc_html($hero_label); ?></span>
            <?php endif; ?>
            
            <h1><?php echo wp_kses_post($hero_heading); ?></h1>
            
            <p class="casestudies-page-hero-description"><?php echo wp_kses_post($hero_subheading); ?></p>
            
            <?php if ($hero_button_link) : ?>
                <a href="<?php echo $hero_button_link['url']; ?>" target="<?php echo $hero_button_link['target']; ?>" class="casestudies-page-hero-btn">
                    <span><?php echo esc_html($hero_button_text ?: 'Get Started'); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INTRO SECTION ACF FIELDS
// - casestudies_intro_label (Text)
// - casestudies_intro_heading (WYSIWYG)
// - casestudies_intro_text (WYSIWYG)
// ============================================
$intro_label = $has_acf ? get_field('casestudies_intro_label') : 'Success Stories';
$intro_heading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_intro_heading') : '', 'Proven Results <span class="highlight-text-italic">That Speak</span>');
$intro_text = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_intro_text') : '', 'We believe in transparency and letting our work speak for itself. Each case study represents a partnership built on trust, strategy, and measurable outcomes. From increasing organic traffic to revolutionising e-commerce experiences, we\'ve helped businesses across industries achieve their digital goals.');
?>

<!-- ==========================================
     INTRO SECTION - White Background
     ========================================== -->
<section class="casestudies-page-intro" data-section-theme="light">
    <div class="casestudies-page-container">
        <div class="casestudies-page-intro-content animate-fade-in">
            <?php if ($intro_label) : ?>
                <span class="casestudies-page-intro-label"><?php echo esc_html($intro_label); ?></span>
            <?php endif; ?>
            
            <h2><?php echo wp_kses_post($intro_heading); ?></h2>
            
            <div class="casestudies-page-intro-text">
                <?php echo wp_kses_post($intro_text); ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// STATS SECTION ACF FIELDS
// - casestudies_stats (Repeater)
//   - stat_number (Number)
//   - stat_suffix (Text) e.g., +, %, M
//   - stat_label (Text)
// ============================================
$stats_items = $has_acf ? get_field('casestudies_stats') : [];
if (!$stats_items || empty($stats_items)) {
    $stats_items = [
        ['stat_number' => '150', 'stat_suffix' => '+', 'stat_label' => 'Projects Completed'],
        ['stat_number' => '98', 'stat_suffix' => '%', 'stat_label' => 'Client Satisfaction'],
        ['stat_number' => '45', 'stat_suffix' => 'M', 'stat_label' => 'Revenue Generated'],
        ['stat_number' => '7', 'stat_suffix' => '+', 'stat_label' => 'Years Experience'],
    ];
}
?>

<!-- ==========================================
     STATS SECTION - #f8f8f8 Background
     ========================================== -->
<section class="casestudies-page-stats" data-section-theme="light">
    <div class="casestudies-page-container">
        <div class="casestudies-page-stats-grid">
            <?php foreach ($stats_items as $stat) : ?>
                <div class="casestudies-page-stat-item animate-scale-in">
                    <span class="casestudies-page-stat-value" data-target="<?php echo esc_attr($stat['stat_number']); ?>">0</span>
                    <span class="casestudies-page-stat-suffix"><?php echo esc_html($stat['stat_suffix']); ?></span>
                    <span class="casestudies-page-stat-label"><?php echo esc_html($stat['stat_label']); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// FEATURED CASE STUDIES ACF FIELDS
// - casestudies_featured_label (Text)
// - casestudies_featured_heading (WYSIWYG)
// - casestudies_featured_subheading (WYSIWYG)
// - casestudies_featured_items (Repeater)
//   - image (Image)
//   - client_name (Text)
//   - industry (Text)
//   - description (WYSIWYG)
//   - stat_1_number (Text)
//   - stat_1_label (Text)
//   - stat_2_number (Text)
//   - stat_2_label (Text)
//   - case_study_link (Link)
// ============================================
$featured_label = $has_acf ? get_field('casestudies_featured_label') : 'Featured Work';
$featured_heading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_featured_heading') : '', 'Our <span class="highlight-text-italic">Best Work</span>');
$featured_subheading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_featured_subheading') : '', 'Hand-picked projects that showcase our expertise and the exceptional results we\'ve achieved for our clients.');
$featured_items = $has_acf ? get_field('casestudies_featured_items') : [];

if (!$featured_items || empty($featured_items)) {
    $featured_items = [
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/01_1500x-768x768.webp'],
            'client_name' => 'My Reusable',
            'industry' => 'E-Commerce / Sustainability',
            'description' => 'Complete digital transformation including website redesign, SEO optimisation, and PPC campaigns that drove a 340% increase in organic traffic.',
            'stat_1_number' => '+340%',
            'stat_1_label' => 'Organic Traffic',
            'stat_2_number' => '+180%',
            'stat_2_label' => 'Revenue Growth',
            'case_study_link' => ['url' => '/case-studies/my-reusable/', 'target' => '_self'],
        ],
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/280711060_395420632495232_3213611193764219936_n-768x768.jpeg'],
            'client_name' => 'LaserX',
            'industry' => 'Healthcare / Beauty',
            'description' => 'Strategic local SEO and Google Ads campaigns that established LaserX as the go-to laser treatment provider in their region.',
            'stat_1_number' => '+520%',
            'stat_1_label' => 'Lead Generation',
            'stat_2_number' => '#1',
            'stat_2_label' => 'Local Rankings',
            'case_study_link' => ['url' => '/case-studies/laserx/', 'target' => '_self'],
        ],
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/PXL_20220716_144417894-768x578.jpeg'],
            'client_name' => 'Severnside Campervans',
            'industry' => 'Automotive / Tourism',
            'description' => 'Custom e-commerce website development with integrated booking system and comprehensive SEO strategy.',
            'stat_1_number' => '+290%',
            'stat_1_label' => 'Online Bookings',
            'stat_2_number' => '4.2x',
            'stat_2_label' => 'ROI Achieved',
            'case_study_link' => ['url' => '/case-studies/severnside-campervans/', 'target' => '_self'],
        ],
    ];
}
?>

<!-- ==========================================
     FEATURED CASE STUDIES - White Background
     ========================================== -->
<section class="casestudies-page-featured" data-section-theme="light">
    <div class="casestudies-page-container">
        <div class="casestudies-page-section-header animate-fade-in">
            <?php if ($featured_label) : ?>
                <span class="casestudies-page-section-label"><?php echo esc_html($featured_label); ?></span>
            <?php endif; ?>
            
            <h2><?php echo wp_kses_post($featured_heading); ?></h2>
            
            <p class="casestudies-page-section-subheading"><?php echo wp_kses_post($featured_subheading); ?></p>
        </div>
        
        <div class="casestudies-page-featured-grid">
            <?php foreach ($featured_items as $index => $item) : 
                $link = cs_link($item['case_study_link'] ?? null);
                $animation_class = ($index % 2 === 0) ? 'animate-slide-left' : 'animate-slide-right';
            ?>
                <div class="casestudies-page-featured-card <?php echo $animation_class; ?>">
                    <div class="casestudies-page-featured-image">
                        <?php if (!empty($item['image'])) : ?>
                            <img src="<?php echo esc_url(is_array($item['image']) ? $item['image']['url'] : $item['image']); ?>" alt="<?php echo esc_attr($item['client_name']); ?>">
                        <?php endif; ?>
                        <div class="casestudies-page-featured-overlay">
                            <?php if ($link) : ?>
                                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="casestudies-page-featured-view">
                                    View Case Study
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="casestudies-page-featured-content">
                        <div class="casestudies-page-featured-meta">
                            <span class="casestudies-page-featured-industry"><?php echo esc_html($item['industry']); ?></span>
                        </div>
                        
                        <h3><?php echo esc_html($item['client_name']); ?></h3>
                        
                        <p><?php echo wp_kses_post(cs_wysiwyg_or_default($item['description'] ?? '', '')); ?></p>
                        
                        <div class="casestudies-page-featured-stats">
                            <div class="casestudies-page-featured-stat">
                                <span class="casestudies-page-featured-stat-number"><?php echo esc_html($item['stat_1_number']); ?></span>
                                <span class="casestudies-page-featured-stat-label"><?php echo esc_html($item['stat_1_label']); ?></span>
                            </div>
                            <div class="casestudies-page-featured-stat">
                                <span class="casestudies-page-featured-stat-number"><?php echo esc_html($item['stat_2_number']); ?></span>
                                <span class="casestudies-page-featured-stat-label"><?php echo esc_html($item['stat_2_label']); ?></span>
                            </div>
                        </div>
                        
                        <?php if ($link) : ?>
                            <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="casestudies-page-featured-link">
                                Read Full Case Study
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// ALL CASE STUDIES SECTION ACF FIELDS
// - casestudies_all_label (Text)
// - casestudies_all_heading (WYSIWYG)
// - casestudies_all_subheading (WYSIWYG)
// - casestudies_all_items (Repeater)
//   - image (Image)
//   - client_name (Text)
//   - services (Text)
//   - case_study_link (Link)
// ============================================
$all_label = $has_acf ? get_field('casestudies_all_label') : 'More Projects';
$all_heading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_all_heading') : '', 'All <span class="highlight-text-italic">Case Studies</span>');
$all_subheading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_all_subheading') : '', 'Explore our complete portfolio of successful digital projects across various industries.');
$all_items = $has_acf ? get_field('casestudies_all_items') : [];

if (!$all_items || empty($all_items)) {
    $all_items = [
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/01_1500x-768x768.webp'],
            'client_name' => 'My Reusable',
            'services' => 'Web Design, SEO, PPC',
            'case_study_link' => ['url' => '/case-studies/my-reusable/', 'target' => '_self'],
        ],
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/280711060_395420632495232_3213611193764219936_n-768x768.jpeg'],
            'client_name' => 'LaserX',
            'services' => 'Local SEO, Google Ads',
            'case_study_link' => ['url' => '/case-studies/laserx/', 'target' => '_self'],
        ],
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/PXL_20220716_144417894-768x578.jpeg'],
            'client_name' => 'Severnside Campervans',
            'services' => 'E-Commerce, SEO',
            'case_study_link' => ['url' => '/case-studies/severnside-campervans/', 'target' => '_self'],
        ],
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/Academy-of-Applied-Pharmaceutical-Sciences-Lab-July2020-768x512.png'],
            'client_name' => 'Hassel Services',
            'services' => 'Web Development, SEO',
            'case_study_link' => ['url' => '/case-studies/hassel-services/', 'target' => '_self'],
        ],
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/crop-testing.jpeg'],
            'client_name' => 'MicroDetect',
            'services' => 'Web Design, Branding',
            'case_study_link' => ['url' => '/case-studies/microdetect/', 'target' => '_self'],
        ],
        [
            'image' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/02/2023-10-istock-1406550413_bildnachweis_pixelseffect-768x576.png'],
            'client_name' => 'Isgus UK',
            'services' => 'Web Design, Digital Marketing',
            'case_study_link' => ['url' => '/case-studies/isgus-uk/', 'target' => '_self'],
        ],
    ];
}
?>

<!-- ==========================================
     ALL CASE STUDIES - #f8f8f8 Background
     ========================================== -->
<section class="casestudies-page-all" data-section-theme="light">
    <div class="casestudies-page-container">
        <div class="casestudies-page-section-header animate-fade-in">
            <?php if ($all_label) : ?>
                <span class="casestudies-page-section-label"><?php echo esc_html($all_label); ?></span>
            <?php endif; ?>
            
            <h2><?php echo wp_kses_post($all_heading); ?></h2>
            
            <p class="casestudies-page-section-subheading"><?php echo wp_kses_post($all_subheading); ?></p>
        </div>
        
        <div class="casestudies-page-all-grid">
            <?php foreach ($all_items as $item) : 
                $link = cs_link($item['case_study_link'] ?? null);
            ?>
                <a href="<?php echo $link ? $link['url'] : '#'; ?>" target="<?php echo $link ? $link['target'] : '_self'; ?>" class="casestudies-page-all-card animate-scale-in">
                    <div class="casestudies-page-all-image">
                        <?php if (!empty($item['image'])) : ?>
                            <img src="<?php echo esc_url(is_array($item['image']) ? $item['image']['url'] : $item['image']); ?>" alt="<?php echo esc_attr($item['client_name']); ?>">
                        <?php endif; ?>
                        <div class="casestudies-page-all-overlay">
                            <span class="casestudies-page-all-view">
                                View Project
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    
                    <div class="casestudies-page-all-content">
                        <h3><?php echo esc_html($item['client_name']); ?></h3>
                        <span class="casestudies-page-all-services"><?php echo esc_html($item['services']); ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// CLIENTS SECTION ACF FIELDS
// - casestudies_clients_label (Text)
// - casestudies_clients_heading (WYSIWYG)
// - casestudies_clients_logos (Repeater)
//   - logo (Image)
// ============================================
$clients_label = $has_acf ? get_field('casestudies_clients_label') : 'Our Clients';
$clients_heading = cs_wysiwyg_or_default($has_acf ? get_field('casestudies_clients_heading') : '', 'Trusted by <span class="highlight-text-italic">Industry Leaders</span>');
$clients_logos = $has_acf ? get_field('casestudies_clients_logos') : [];

if (!$clients_logos || empty($clients_logos)) {
    $clients_logos = [
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2023/12/vileda-logo-1.png']],
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2023/12/isgus-logo-copy.png']],
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2023/12/severnside-logo.png']],
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2023/12/micro-white.png']],
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2023/12/clearvision-logo.png']],
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2023/12/myr-logo.png']],
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2024/04/culligan-logo-white.png']],
        ['logo' => ['url' => 'https://hagertydigital.co.uk/wp-content/uploads/2021/06/client-8@2x.png']],
    ];
}
?>

<!-- ==========================================
     CLIENTS SECTION - White Background
     ========================================== -->
<section class="casestudies-page-clients" data-section-theme="light">
    <div class="casestudies-page-container">
        <div class="casestudies-page-section-header animate-fade-in">
            <?php if ($clients_label) : ?>
                <span class="casestudies-page-section-label"><?php echo esc_html($clients_label); ?></span>
            <?php endif; ?>
            
            <h2><?php echo wp_kses_post($clients_heading); ?></h2>
        </div>
        
        <div class="casestudies-page-clients-grid animate-fade-in">
            <?php foreach ($clients_logos as $client) : ?>
                <div class="casestudies-page-client-logo">
                    <?php if (!empty($client['logo'])) : ?>
                        <img src="<?php echo esc_url(is_array($client['logo']) ? $client['logo']['url'] : $client['logo']); ?>" alt="Client Logo">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ==========================================
     LONG CTA SECTION - #f8f8f8 Background
     ========================================== -->
<section class="long-cta-section casestudies-page-cta" data-section-theme="light">
    <div class="long-cta-container">
        <div class="long-cta-content animate-fade-in">
            <span class="long-cta-label">READY TO GROW?</span>
            
            <h2 class="long-cta-heading">
                <span class="black-text">Let's Create Your</span><br>
                <span class="highlight-text-italic">Success Story</span>
            </h2>
            
            <div class="long-cta-features">
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
            </div>
            
            <div class="long-cta-buttons">
                <a href="/contact-us" class="long-cta-btn long-cta-btn-primary">
                    <span>Start Your Project</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="tel:01275792114" class="long-cta-btn long-cta-btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span>Call Us: 01275 792 114</span>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ==========================================
     REVIEWS SECTION - White Background
     ========================================== -->
<section class="reviews-section white" data-section-theme="white">
    <div class="reviews-container">
        <div class="reviews-left animate-scale-in">
            <h2>We are rated <span class="highlight-text-italic">Excellent</span></h2>
            
            <div class="star-rating">
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
            </div>
            
            <p class="review-count">Based on 27 reviews</p>
            
            <img src="/wp-content/uploads/2025/11/1763649835241_image.webp" alt="Google" class="google-logo">
        </div>
        
        <div class="reviews-carousel">
            <button class="carousel-nav prev" aria-label="Previous review">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            
            <div class="carousel-track-container">
                <div class="carousel-track">
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar" style="background:#4285f4;">L</div>
                            <div class="reviewer-info">
                                <h4>Lucy P.</h4>
                                <p class="review-date">2025-01-01</p>
                            </div>
                        </div>
                        <div class="review-stars">★★★★★</div>
                        <p class="review-text">Really easy to deal with, nothing was too much trouble. Super happy with the end result.</p>
                    </div>
                    
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-avatar" style="background:#34a853;">J</div>
                            <div class="reviewer-info">
                                <h4>James R.</h4>
                                <p class="review-date">2025-02-14</p>
                            </div>
                        </div>
                        <div class="review-stars">★★★★★</div>
                        <p class="review-text">Prompt, professional, and the quality was spot on. Would absolutely recommend.</p>
                    </div>
                    
                    <div class="review-card white">
                        <div class="review-header">
                            <div class="reviewer-avatar" style="background:#fbbc05;">S</div>
                            <div class="reviewer-info">
                                <h4>Sophie T.</h4>
                                <p class="review-date">2025-03-06</p>
                            </div>
                        </div>
                        <div class="review-stars">★★★★★</div>
                        <p class="review-text">Great communication throughout and everything was left tidy. Five stars.</p>
                    </div>
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