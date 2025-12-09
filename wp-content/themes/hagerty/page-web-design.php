<?php
/**
 * Template Name: Web Design Services
 * All classes prefixed with webdesign-page- for independent styling
 */

get_header();

$has_acf = function_exists('get_field');

// Helpers
if (!function_exists('hd_strip_wrapping_p')) {
    function hd_strip_wrapping_p($html) {
        if (!$html) return '';
        return preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($html));
    }
}

if (!function_exists('hd_wysiwyg_or_default')) {
    function hd_wysiwyg_or_default($field_value, $default_html) {
        $val = $field_value ? apply_filters('the_content', $field_value) : $default_html;
        return hd_strip_wrapping_p($val);
    }
}

if (!function_exists('hd_link')) {
    function hd_link($link_field) {
        if (!$link_field || !is_array($link_field) || empty($link_field['url'])) return null;
        return [
            'url'    => esc_url($link_field['url']),
            'title'  => !empty($link_field['title']) ? esc_html($link_field['title']) : 'Learn more',
            'target' => !empty($link_field['target']) ? esc_attr($link_field['target']) : '_self',
        ];
    }
}

// ============================================
// HERO SECTION
// ============================================
$hero_label = $has_acf ? (get_field('webdesign_hero_label') ?: 'Web Design') : 'Web Design';
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_hero_heading_line_1') : '', 'Beautiful Websites');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_hero_heading_line_2') : '', '<span class="highlight-text-italic">That Convert</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_hero_description') : '', 'Stunning, user-focused web design that captures your brand essence and drives real business results.');

$hero_bg_type = $has_acf ? (get_field('webdesign_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('webdesign_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('webdesign_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('webdesign_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('webdesign_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('webdesign_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? hd_link(get_field('webdesign_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? hd_link(get_field('webdesign_hero_secondary_button')) : null;

if (!$hero_primary_btn) $hero_primary_btn = ['url' => '#contact', 'title' => 'Start Your Project', 'target' => '_self'];
if (!$hero_secondary_btn) $hero_secondary_btn = ['url' => '#services', 'title' => 'Our Services', 'target' => '_self'];

$hero_image_url = ($hero_bg_image && is_array($hero_bg_image) && !empty($hero_bg_image['url'])) ? esc_url($hero_bg_image['url']) : '';
$hero_video_poster_url = ($hero_bg_video_poster && is_array($hero_bg_video_poster) && !empty($hero_bg_video_poster['url'])) ? esc_url($hero_bg_video_poster['url']) : '';

// Extract video URLs from File arrays
$hero_video_mp4_url = ($hero_bg_video_mp4 && is_array($hero_bg_video_mp4) && !empty($hero_bg_video_mp4['url'])) ? esc_url($hero_bg_video_mp4['url']) : '';
$hero_video_webm_url = ($hero_bg_video_webm && is_array($hero_bg_video_webm) && !empty($hero_bg_video_webm['url'])) ? esc_url($hero_bg_video_webm['url']) : '';

$has_hero_media = ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) || ($hero_bg_type === 'image' && $hero_image_url);
$hero_text_class = $has_hero_media ? 'has-media' : '';
?>

<!-- HERO - Same style as SEO/PPC pages -->
<section class="webdesign-page-hero" data-section-theme="dark">
  <div class="webdesign-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="webdesign-page-hero-video">
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="Web Design Services" class="webdesign-page-hero-image">
    <?php endif; ?>
    <div class="webdesign-page-hero-overlay"></div>
  </div>

  <div class="webdesign-page-hero-content">
    <div class="webdesign-page-hero-text animate-fade-in">
      <span class="webdesign-page-hero-label"><?php echo esc_html($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="webdesign-page-hero-description">
        <?php echo wp_kses_post($hero_desc); ?>
      </p>

      <a href="<?php echo $hero_primary_btn['url']; ?>" target="<?php echo $hero_primary_btn['target']; ?>" class="cta-btn">
        <span><?php echo $hero_primary_btn['title']; ?></span>
      </a>
    </div>
  </div>

</section>

<?php
// ============================================
// STATS SECTION
// ============================================
$stats = $has_acf ? get_field('webdesign_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '200+', 'label' => 'Websites Launched'],
        ['number' => '98%', 'label' => 'Client Satisfaction'],
        ['number' => '150%', 'label' => 'Avg. Conversion Boost'],
        ['number' => '10+', 'label' => 'Years Experience'],
    ];
}
?>

<section class="webdesign-page-stats" data-section-theme="light">
    <div class="webdesign-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="webdesign-page-stat-item">
                <span class="webdesign-page-stat-number"><?php echo esc_html($stat['number'] ?? ''); ?></span>
                <span class="webdesign-page-stat-label"><?php echo esc_html($stat['label'] ?? ''); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is Web Design?
// ============================================
$what_is_heading_line1 = $has_acf ? get_field('webdesign_what_is_heading_line1') : '';
$what_is_heading_line2 = $has_acf ? get_field('webdesign_what_is_heading_line2') : '';
$what_is_content = $has_acf ? get_field('webdesign_what_is_content') : '';
$what_is_image = $has_acf ? get_field('webdesign_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('webdesign_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="webdesign-page-info webdesign-page-info-1" data-section-theme="light">
    <div class="webdesign-page-info-container">
        <h2 class="webdesign-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo $what_is_heading_line1 ? esc_html($what_is_heading_line1) : 'What is'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $what_is_heading_line2 ? esc_html($what_is_heading_line2) : 'Web Design?'; ?></span>
        </h2>
        <div class="webdesign-page-info-content">
            <div class="webdesign-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>Web design is much more than just making things look pretty. It's the art and science of creating digital experiences that engage visitors and guide them towards taking action.</p>
                    <p>Great web design combines visual aesthetics, user experience (UX), and conversion optimisation to create websites that not only look stunning but actually work for your business.</p>
                    <p>From the layout and colour scheme to the navigation and call-to-actions, every element is carefully crafted to tell your brand's story and connect with your target audience.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="webdesign-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is Web Design">
                <?php else : ?>
                    <div class="webdesign-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1
// ============================================
$long_cta1_label = $has_acf ? get_field('webdesign_long_cta1_label') : '';
$long_cta1_heading_line1 = $has_acf ? get_field('webdesign_long_cta1_heading_line1') : '';
$long_cta1_heading_line2 = $has_acf ? get_field('webdesign_long_cta1_heading_line2') : '';
$long_cta1_text = $has_acf ? get_field('webdesign_long_cta1_text') : '';
$long_cta1_features = $has_acf ? get_field('webdesign_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('webdesign_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('webdesign_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Project', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="webdesign-page-longcta webdesign-page-longcta-1" data-section-theme="light">
    <div class="webdesign-page-longcta-container">
        <div class="webdesign-page-longcta-content animate-fade-in">
            <span class="webdesign-page-longcta-label"><?php echo $long_cta1_label ? esc_html($long_cta1_label) : 'READY TO STAND OUT?'; ?></span>
            <h2 class="webdesign-page-longcta-heading">
                <span class="black-text"><?php echo $long_cta1_heading_line1 ? esc_html($long_cta1_heading_line1) : 'Let\'s Create Your'; ?></span><br>
                <span class="highlight-text-italic"><?php echo $long_cta1_heading_line2 ? esc_html($long_cta1_heading_line2) : 'Dream Website'; ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="webdesign-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="webdesign-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="webdesign-page-longcta-feature">
                            <div class="webdesign-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? wp_kses_post($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="webdesign-page-longcta-feature-text"><h4><?php echo esc_html($feature['title'] ?? ''); ?></h4><p><?php echo esc_html($feature['description'] ?? ''); ?></p></div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="webdesign-page-longcta-feature"><div class="webdesign-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div><div class="webdesign-page-longcta-feature-text"><h4>Custom Design</h4><p>Every website is uniquely crafted to match your brand identity</p></div></div>
                    <div class="webdesign-page-longcta-feature"><div class="webdesign-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div><div class="webdesign-page-longcta-feature-text"><h4>Responsive Design</h4><p>Perfect display on desktops, tablets, and mobile devices</p></div></div>
                    <div class="webdesign-page-longcta-feature"><div class="webdesign-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg></div><div class="webdesign-page-longcta-feature-text"><h4>Fast Performance</h4><p>Optimised for speed to keep visitors engaged longer</p></div></div>
                <?php endif; ?>
            </div>
            <div class="webdesign-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="webdesign-page-longcta-btn webdesign-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="webdesign-page-longcta-btn webdesign-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES
// ============================================
$services_label = $has_acf ? (get_field('webdesign_services_label') ?: 'What We Offer') : 'What We Offer';
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_services_heading') : '', 'Our Web Design <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_services_subheading') : '', 'Comprehensive web design solutions tailored to your business needs');
$services = $has_acf ? get_field('webdesign_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'Bespoke Website Design', 'description' => 'Unique, custom-designed websites that perfectly represent your brand and engage your audience.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>'],
        ['title' => 'E-commerce Design', 'description' => 'Beautiful online stores that make shopping a pleasure and drive sales conversions.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>'],
        ['title' => 'Landing Page Design', 'description' => 'High-converting landing pages optimised for lead generation and campaign success.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>'],
        ['title' => 'Website Redesign', 'description' => 'Transform your outdated website into a modern, user-friendly experience that converts.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>'],
    ];
}
?>

<section class="webdesign-page-services" id="services" data-section-theme="light">
    <div class="webdesign-page-services-container">
        <div class="webdesign-page-services-header">
            <span class="webdesign-page-services-label"><?php echo esc_html($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="webdesign-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="webdesign-page-service-card">
                    <div class="webdesign-page-service-icon"><?php echo wp_kses_post($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo esc_html($service['title'] ?? ''); ?></h3>
                    <p><?php echo esc_html($service['description'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - Why Choose Us (Reversed)
// ============================================
$why_heading_line1 = $has_acf ? get_field('webdesign_why_different_heading_line1') : '';
$why_heading_line2 = $has_acf ? get_field('webdesign_why_different_heading_line2') : '';
$why_content = $has_acf ? get_field('webdesign_why_different_content') : '';
$why_image = $has_acf ? get_field('webdesign_why_different_image') : null;
$why_button = $has_acf ? hd_link(get_field('webdesign_why_different_button')) : null;
$why_image_url = ($why_image && is_array($why_image) && !empty($why_image['url'])) ? esc_url($why_image['url']) : '';
if (!$why_button) $why_button = ['url' => '#contact', 'title' => 'Let\'s Talk', 'target' => '_self'];
?>

<section class="webdesign-page-info webdesign-page-info-2" data-section-theme="light">
    <div class="webdesign-page-info-container">
        <h2 class="webdesign-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo $why_heading_line1 ? esc_html($why_heading_line1) : 'Why Choose'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $why_heading_line2 ? esc_html($why_heading_line2) : 'Us?'; ?></span>
        </h2>
        <div class="webdesign-page-info-content webdesign-page-info-reversed">
            <div class="webdesign-page-info-image animate-slide-left">
                <?php if ($why_image_url) : ?>
                    <img src="<?php echo $why_image_url; ?>" alt="Why Choose Us">
                <?php else : ?>
                    <div class="webdesign-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="webdesign-page-info-text animate-slide-right">
                <?php if ($why_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $why_content)); ?>
                <?php else : ?>
                    <p>We don't just design websites – we create digital experiences that help your business grow. Our approach combines creativity with strategy to deliver results you can measure.</p>
                    <p>Every project starts with understanding your business goals. We then craft a design that not only looks incredible but guides visitors towards conversion.</p>
                    <p>We believe in collaboration. You'll be involved at every stage, from initial concepts to the final launch. Your vision, brought to life by our expertise.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($why_button['url']); ?>" class="cta-button"><?php echo esc_html($why_button['title']); ?></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 2 (Simpler, no features)
// ============================================
$long_cta2_label = $has_acf ? get_field('webdesign_long_cta2_label') : '';
$long_cta2_heading_line1 = $has_acf ? get_field('webdesign_long_cta2_heading_line1') : '';
$long_cta2_heading_line2 = $has_acf ? get_field('webdesign_long_cta2_heading_line2') : '';
$long_cta2_text = $has_acf ? get_field('webdesign_long_cta2_text') : '';
$long_cta2_primary_button = $has_acf ? hd_link(get_field('webdesign_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('webdesign_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Get a Free Quote', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="webdesign-page-longcta webdesign-page-longcta-2" data-section-theme="light">
    <div class="webdesign-page-longcta-container">
        <div class="webdesign-page-longcta-content animate-fade-in">
            <span class="webdesign-page-longcta-label"><?php echo $long_cta2_label ? esc_html($long_cta2_label) : 'FREE CONSULTATION'; ?></span>
            <h2 class="webdesign-page-longcta-heading">
                <span class="black-text"><?php echo $long_cta2_heading_line1 ? esc_html($long_cta2_heading_line1) : 'Ready to Transform'; ?></span><br>
                <span class="highlight-text-italic"><?php echo $long_cta2_heading_line2 ? esc_html($long_cta2_heading_line2) : 'Your Online Presence?'; ?></span>
            </h2>
            <p class="webdesign-page-longcta-text"><?php echo $long_cta2_text ? wp_kses_post($long_cta2_text) : 'Book a free consultation to discuss your project. We\'ll review your current website, understand your goals, and show you exactly how we can help you succeed online.'; ?></p>
            <div class="webdesign-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="webdesign-page-longcta-btn webdesign-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="webdesign-page-longcta-btn webdesign-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS
// ============================================
$process_label = $has_acf ? (get_field('webdesign_process_label') ?: 'How We Work') : 'How We Work';
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_process_heading') : '', 'Our Design <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_process_subheading') : '', 'A proven methodology that delivers stunning results every time');
$process_steps = $has_acf ? get_field('webdesign_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Discovery & Research', 'description' => 'We start by understanding your business, goals, target audience, and competitors to inform our design strategy.'],
        ['title' => 'Wireframes & Concepts', 'description' => 'We create detailed wireframes and design concepts, giving you a clear vision of your new website before development begins.'],
        ['title' => 'Design & Development', 'description' => 'Our designers and developers work together to bring your website to life with pixel-perfect precision.'],
        ['title' => 'Testing & Launch', 'description' => 'Rigorous testing ensures your website works flawlessly across all devices before we launch it to the world.'],
    ];
}
?>

<section class="webdesign-page-process" data-section-theme="light">
    <div class="webdesign-page-process-container">
        <div class="webdesign-page-process-header">
            <span class="webdesign-page-process-label"><?php echo esc_html($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="webdesign-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="webdesign-page-process-step">
                    <div class="webdesign-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="webdesign-page-process-content"><h3><?php echo esc_html($step['title'] ?? ''); ?></h3><p><?php echo esc_html($step['description'] ?? ''); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 3 - UX & Conversion
// ============================================
$ux_heading_line1 = $has_acf ? get_field('webdesign_ux_heading_line1') : '';
$ux_heading_line2 = $has_acf ? get_field('webdesign_ux_heading_line2') : '';
$ux_content = $has_acf ? get_field('webdesign_ux_content') : '';
$ux_image = $has_acf ? get_field('webdesign_ux_image') : null;
$ux_button = $has_acf ? hd_link(get_field('webdesign_ux_button')) : null;
$ux_image_url = ($ux_image && is_array($ux_image) && !empty($ux_image['url'])) ? esc_url($ux_image['url']) : '';
if (!$ux_button) $ux_button = ['url' => '#contact', 'title' => 'Improve Your UX', 'target' => '_self'];
?>

<section class="webdesign-page-info webdesign-page-info-3" data-section-theme="light">
    <div class="webdesign-page-info-container">
        <h2 class="webdesign-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo $ux_heading_line1 ? esc_html($ux_heading_line1) : 'UX That'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $ux_heading_line2 ? esc_html($ux_heading_line2) : 'Converts'; ?></span>
        </h2>
        <div class="webdesign-page-info-content">
            <div class="webdesign-page-info-text animate-slide-left">
                <?php if ($ux_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $ux_content)); ?>
                <?php else : ?>
                    <p>User experience isn't just about making things look nice – it's about creating intuitive journeys that guide visitors towards your goals.</p>
                    <p>We combine behavioural psychology, data analysis, and design best practices to create websites that naturally encourage users to take action.</p>
                    <p>From strategic placement of calls-to-action to seamless navigation flows, every element is designed with conversion in mind.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($ux_button['url']); ?>" class="cta-button"><?php echo esc_html($ux_button['title']); ?></a>
            </div>
            <div class="webdesign-page-info-image animate-slide-right">
                <?php if ($ux_image_url) : ?>
                    <img src="<?php echo $ux_image_url; ?>" alt="UX Design">
                <?php else : ?>
                    <div class="webdesign-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 3
// ============================================
$long_cta3_label = $has_acf ? get_field('webdesign_long_cta3_label') : '';
$long_cta3_heading_line1 = $has_acf ? get_field('webdesign_long_cta3_heading_line1') : '';
$long_cta3_heading_line2 = $has_acf ? get_field('webdesign_long_cta3_heading_line2') : '';
$long_cta3_text = $has_acf ? get_field('webdesign_long_cta3_text') : '';
$long_cta3_features = $has_acf ? get_field('webdesign_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? hd_link(get_field('webdesign_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? hd_link(get_field('webdesign_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Get Started Today', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="webdesign-page-longcta webdesign-page-longcta-3" data-section-theme="light">
    <div class="webdesign-page-longcta-container">
        <div class="webdesign-page-longcta-content animate-fade-in">
            <span class="webdesign-page-longcta-label"><?php echo $long_cta3_label ? esc_html($long_cta3_label) : 'WHAT\'S INCLUDED'; ?></span>
            <h2 class="webdesign-page-longcta-heading">
                <span class="black-text"><?php echo $long_cta3_heading_line1 ? esc_html($long_cta3_heading_line1) : 'Everything You Need'; ?></span><br>
                <span class="highlight-text-italic"><?php echo $long_cta3_heading_line2 ? esc_html($long_cta3_heading_line2) : 'To Succeed Online'; ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="webdesign-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="webdesign-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="webdesign-page-longcta-feature">
                            <div class="webdesign-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? wp_kses_post($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="webdesign-page-longcta-feature-text"><h4><?php echo esc_html($feature['title'] ?? ''); ?></h4><p><?php echo esc_html($feature['description'] ?? ''); ?></p></div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="webdesign-page-longcta-feature"><div class="webdesign-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="webdesign-page-longcta-feature-text"><h4>SSL Security</h4><p>Free SSL certificate for secure browsing</p></div></div>
                    <div class="webdesign-page-longcta-feature"><div class="webdesign-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div><div class="webdesign-page-longcta-feature-text"><h4>Mobile First</h4><p>Designed for mobile users from the ground up</p></div></div>
                    <div class="webdesign-page-longcta-feature"><div class="webdesign-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><div class="webdesign-page-longcta-feature-text"><h4>Ongoing Support</h4><p>Continued support after your website goes live</p></div></div>
                <?php endif; ?>
            </div>
            <div class="webdesign-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta3_primary_button['url']); ?>" class="webdesign-page-longcta-btn webdesign-page-longcta-btn-primary"><span><?php echo esc_html($long_cta3_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta3_secondary_button['url']); ?>" class="webdesign-page-longcta-btn webdesign-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta3_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// RESULTS / PORTFOLIO
// ============================================
$results_label = $has_acf ? (get_field('webdesign_results_label') ?: 'Our Work') : 'Our Work';
$results_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_results_heading') : '', 'Recent <span class="highlight-text-italic">Projects</span>');
$results_subheading = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_results_subheading') : '', 'See how we\'ve helped businesses transform their online presence');
$results = $has_acf ? get_field('webdesign_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'Professional Services', 'title' => 'Law Firm Website', 'description' => 'Modern, trustworthy design that increased enquiries by 180%.', 'metric1_value' => '+180%', 'metric1_label' => 'Enquiries', 'metric2_value' => '2.5x', 'metric2_label' => 'Time on Site', 'image' => null],
        ['industry' => 'E-commerce', 'title' => 'Fashion Boutique', 'description' => 'Stunning e-commerce experience with seamless checkout flow.', 'metric1_value' => '+220%', 'metric1_label' => 'Sales', 'metric2_value' => '45%', 'metric2_label' => 'Lower Bounce', 'image' => null],
        ['industry' => 'Healthcare', 'title' => 'Private Clinic', 'description' => 'Clean, accessible design that builds patient confidence.', 'metric1_value' => '+300%', 'metric1_label' => 'Bookings', 'metric2_value' => '4.9★', 'metric2_label' => 'User Rating', 'image' => null],
    ];
}
?>

<section class="webdesign-page-results" data-section-theme="light">
    <div class="webdesign-page-results-container">
        <div class="webdesign-page-results-header">
            <span class="webdesign-page-results-label"><?php echo esc_html($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="webdesign-page-results-grid">
            <?php foreach ($results as $result) : 
                $result_image = null;
                if (!empty($result['image']) && is_array($result['image']) && !empty($result['image']['url'])) {
                    $result_image = esc_url($result['image']['url']);
                }
            ?>
                <div class="webdesign-page-result-card">
                    <div class="webdesign-page-result-image">
                        <?php if ($result_image) : ?>
                            <img src="<?php echo $result_image; ?>" alt="<?php echo esc_attr($result['title'] ?? 'Project'); ?>">
                        <?php else : ?>
                            <div class="webdesign-page-result-placeholder"><span><?php echo esc_html(substr($result['title'] ?? 'P', 0, 1)); ?></span></div>
                        <?php endif; ?>
                    </div>
                    <div class="webdesign-page-result-content">
                        <span class="webdesign-page-result-industry"><?php echo esc_html($result['industry'] ?? ''); ?></span>
                        <h3><?php echo esc_html($result['title'] ?? ''); ?></h3>
                        <p><?php echo esc_html($result['description'] ?? ''); ?></p>
                        <div class="webdesign-page-result-metrics">
                            <div class="webdesign-page-result-metric"><span class="webdesign-page-result-metric-value"><?php echo esc_html($result['metric1_value'] ?? ''); ?></span><span class="webdesign-page-result-metric-label"><?php echo esc_html($result['metric1_label'] ?? ''); ?></span></div>
                            <div class="webdesign-page-result-metric"><span class="webdesign-page-result-metric-value"><?php echo esc_html($result['metric2_value'] ?? ''); ?></span><span class="webdesign-page-result-metric-label"><?php echo esc_html($result['metric2_label'] ?? ''); ?></span></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// FAQ
// ============================================
$faq_label = $has_acf ? (get_field('webdesign_faq_label') ?: 'FAQ') : 'FAQ';
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdesign_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('webdesign_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How long does it take to design a website?', 'answer' => 'Most website projects take between 6-12 weeks depending on complexity. Simple brochure sites can be completed in 4-6 weeks, while larger e-commerce or custom projects may take 12-16 weeks.'],
        ['question' => 'What\'s included in the web design cost?', 'answer' => 'Our packages include custom design, responsive development, basic SEO setup, content management system training, and 30 days of post-launch support. Hosting and ongoing maintenance are available as add-ons.'],
        ['question' => 'Do you design WordPress websites?', 'answer' => 'Yes! We specialise in custom WordPress development. We build bespoke themes that are fast, secure, and easy for you to manage. We also work with other platforms like Shopify for e-commerce.'],
        ['question' => 'Will my website be mobile-friendly?', 'answer' => 'Absolutely. Every website we design is fully responsive and optimised for all devices. We actually design mobile-first to ensure the best experience for the majority of users.'],
        ['question' => 'Can I update the website myself?', 'answer' => 'Yes! We build all our websites with user-friendly content management systems. We also provide training so you feel confident making updates, and we\'re always here if you need help.'],
    ];
}
?>

<section class="webdesign-page-faq" data-section-theme="light">
    <div class="webdesign-page-faq-container">
        <div class="webdesign-page-faq-header">
            <span class="webdesign-page-faq-label"><?php echo esc_html($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="webdesign-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="webdesign-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="webdesign-page-faq-question" aria-expanded="false"><span><?php echo esc_html($faq['question'] ?? ''); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></button>
                    <div class="webdesign-page-faq-answer"><p><?php echo wp_kses_post($faq['answer'] ?? ''); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Long CTA Section - Before Reviews -->
<section class="long-cta-section" data-section-theme="light">
  <div class="long-cta-container">
    <div class="long-cta-content animate-fade-in">
      <span class="long-cta-label">READY TO GROW?</span>

      <h2 class="long-cta-heading">
        <span class="black-text">Let's Build Something</span><br>
        <span class="highlight-text-italic">Amazing Together</span>
      </h2>

      <div class="long-cta-features">
        <div class="long-cta-feature">
          <div class="long-cta-feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
              <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
          </div>
          <div class="long-cta-feature-text">
            <h4>Proven Results</h4>
            <p>Data-driven strategies that deliver measurable ROI</p>
          </div>
        </div>

        <div class="long-cta-feature">
          <div class="long-cta-feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
          <div class="long-cta-feature-text">
            <h4>Dedicated Team</h4>
            <p>Personal account managers who truly understand your business</p>
          </div>
        </div>

        <div class="long-cta-feature">
          <div class="long-cta-feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <polyline points="12 6 12 12 16 14" />
            </svg>
          </div>
          <div class="long-cta-feature-text">
            <h4>Fast Turnaround</h4>
            <p>Quick response times and efficient project delivery</p>
          </div>
        </div>
      </div>

      <div class="long-cta-buttons">
        <a href="#contact" class="long-cta-btn long-cta-btn-primary">
          <span>Start Your Project</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </a>

        <a href="tel:01275792114" class="long-cta-btn long-cta-btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
          </svg>
          <span>Call Us: 01275 792 114</span>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- Reviews Section -->
<section class="reviews-section" data-section-theme="light">
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
          <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>

      <div class="carousel-track-container">
        <div class="carousel-track">

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#4285f4;">M</div>
              <div class="reviewer-info">
                <h4>Mark D.</h4>
                <p class="review-date">2025-01-20</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Absolutely blown away by the design they created for our new website. It perfectly captures our brand and has significantly improved our conversion rate.</p>
          </div>

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#34a853;">E</div>
              <div class="reviewer-info">
                <h4>Emma S.</h4>
                <p class="review-date">2025-02-10</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Professional, creative, and incredibly easy to work with. They took our vague ideas and turned them into a stunning website that we're proud to show off.</p>
          </div>

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#fbbc05;">R</div>
              <div class="reviewer-info">
                <h4>Richard P.</h4>
                <p class="review-date">2025-03-05</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">The team went above and beyond. Not only does our website look amazing, but they also made sure it was optimised for SEO and conversions. Highly recommend!</p>
          </div>

        </div>
      </div>

      <button class="carousel-nav next" aria-label="Next review">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>
    </div>
  </div>
</section>

<?php get_footer(); ?>