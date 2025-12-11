<?php
/**
 * Template Name: Email Marketing Services
 * All classes prefixed with email-page- for independent styling
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

// SVG Output Helper - allows all SVG elements and attributes
if (!function_exists('hd_svg_output')) {
    function hd_svg_output($svg_string) {
        if (empty($svg_string)) return '';
        
        $allowed_svg = array(
            'svg' => array(
                'xmlns' => true,
                'viewbox' => true,
                'width' => true,
                'height' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'stroke-linecap' => true,
                'stroke-linejoin' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'preserveaspectratio' => true,
                'x' => true,
                'y' => true,
                'role' => true,
                'aria-hidden' => true,
                'aria-label' => true,
                'focusable' => true,
            ),
            'path' => array(
                'd' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'stroke-linecap' => true,
                'stroke-linejoin' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'circle' => array(
                'cx' => true,
                'cy' => true,
                'r' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'rect' => array(
                'x' => true,
                'y' => true,
                'width' => true,
                'height' => true,
                'rx' => true,
                'ry' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'line' => array(
                'x1' => true,
                'y1' => true,
                'x2' => true,
                'y2' => true,
                'stroke' => true,
                'stroke-width' => true,
                'stroke-linecap' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'polyline' => array(
                'points' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'stroke-linecap' => true,
                'stroke-linejoin' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'polygon' => array(
                'points' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'ellipse' => array(
                'cx' => true,
                'cy' => true,
                'rx' => true,
                'ry' => true,
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'g' => array(
                'fill' => true,
                'stroke' => true,
                'stroke-width' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
                'opacity' => true,
            ),
            'defs' => array(),
            'clippath' => array(
                'id' => true,
            ),
            'mask' => array(
                'id' => true,
            ),
            'use' => array(
                'href' => true,
                'xlink:href' => true,
                'x' => true,
                'y' => true,
                'width' => true,
                'height' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
            ),
            'text' => array(
                'x' => true,
                'y' => true,
                'dx' => true,
                'dy' => true,
                'text-anchor' => true,
                'font-family' => true,
                'font-size' => true,
                'font-weight' => true,
                'fill' => true,
                'class' => true,
                'id' => true,
                'style' => true,
                'transform' => true,
            ),
            'tspan' => array(
                'x' => true,
                'y' => true,
                'dx' => true,
                'dy' => true,
                'class' => true,
                'id' => true,
                'style' => true,
            ),
            'lineargradient' => array(
                'id' => true,
                'x1' => true,
                'y1' => true,
                'x2' => true,
                'y2' => true,
                'gradientunits' => true,
                'gradienttransform' => true,
            ),
            'radialgradient' => array(
                'id' => true,
                'cx' => true,
                'cy' => true,
                'r' => true,
                'fx' => true,
                'fy' => true,
                'gradientunits' => true,
                'gradienttransform' => true,
            ),
            'stop' => array(
                'offset' => true,
                'stop-color' => true,
                'stop-opacity' => true,
                'style' => true,
            ),
        );
        
        return wp_kses($svg_string, $allowed_svg);
    }
}

// ============================================
// HERO SECTION
// ACF Fields:
// - email_hero_label (WYSIWYG)
// - email_hero_heading_line_1 (WYSIWYG)
// - email_hero_heading_line_2 (WYSIWYG)
// - email_hero_description (WYSIWYG)
// - email_hero_background_type (Select: none, image, video)
// - email_hero_background_image (Image)
// - email_hero_background_video_mp4 (File)
// - email_hero_background_video_webm (File)
// - email_hero_background_video_poster (Image)
// - email_hero_background_overlay_opacity (Number)
// - email_hero_primary_button (Link)
// - email_hero_secondary_button (Link)
// ============================================
$hero_label = hd_wysiwyg_or_default($has_acf ? get_field('email_hero_label') : '', 'Email Marketing');
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('email_hero_heading_line_1') : '', 'Emails That');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('email_hero_heading_line_2') : '', '<span class="highlight-text-italic">Convert</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('email_hero_description') : '', 'Strategic email marketing campaigns that nurture leads, drive sales, and keep your brand top of mind with your customers.');

$hero_bg_type = $has_acf ? (get_field('email_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('email_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('email_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('email_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('email_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('email_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? hd_link(get_field('email_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? hd_link(get_field('email_hero_secondary_button')) : null;

if (!$hero_primary_btn) $hero_primary_btn = ['url' => '#contact', 'title' => 'Get Started', 'target' => '_self'];
if (!$hero_secondary_btn) $hero_secondary_btn = ['url' => '#services', 'title' => 'Our Services', 'target' => '_self'];

$hero_image_url = ($hero_bg_image && is_array($hero_bg_image) && !empty($hero_bg_image['url'])) ? esc_url($hero_bg_image['url']) : '';
$hero_video_poster_url = ($hero_bg_video_poster && is_array($hero_bg_video_poster) && !empty($hero_bg_video_poster['url'])) ? esc_url($hero_bg_video_poster['url']) : '';

$hero_video_mp4_url = ($hero_bg_video_mp4 && is_array($hero_bg_video_mp4) && !empty($hero_bg_video_mp4['url'])) ? esc_url($hero_bg_video_mp4['url']) : '';
$hero_video_webm_url = ($hero_bg_video_webm && is_array($hero_bg_video_webm) && !empty($hero_bg_video_webm['url'])) ? esc_url($hero_bg_video_webm['url']) : '';

$has_hero_media = ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) || ($hero_bg_type === 'image' && $hero_image_url);
$hero_text_class = $has_hero_media ? 'has-media' : '';
?>

<!-- HERO -->
<section class="email-page-hero" data-section-theme="dark">
  <div class="email-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="email-page-hero-video">
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="Email Marketing Services" class="email-page-hero-image">
    <?php endif; ?>
    <div class="email-page-hero-overlay"></div>
  </div>

  <div class="email-page-hero-content">
    <div class="email-page-hero-text animate-fade-in">
      <span class="email-page-hero-label"><?php echo wp_kses_post($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="email-page-hero-description">
        <?php echo wp_kses_post($hero_desc); ?>
      </p>

      <a href="<?php echo $hero_primary_btn['url']; ?>" target="<?php echo $hero_primary_btn['target']; ?>" class="cta-btn">
        <span><?php echo $hero_primary_btn['title']; ?></span>
      </a>
    </div>
  </div>

  <!-- Decorative Shapes -->
  <div class="email-page-hero-shapes">
    <div class="email-page-shape email-page-shape-1"></div>
    <div class="email-page-shape email-page-shape-2"></div>
  </div>
</section>

<?php
// ============================================
// STATS SECTION (Background: #f8f8f8)
// ACF Fields:
// - email_stats (Repeater)
//   - number (WYSIWYG)
//   - label (WYSIWYG)
// ============================================
$stats = $has_acf ? get_field('email_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '42:1', 'label' => 'Average ROI'],
        ['number' => '320%', 'label' => 'Revenue Increase'],
        ['number' => '45%', 'label' => 'Higher Open Rates'],
        ['number' => '100+', 'label' => 'Campaigns Sent'],
    ];
}
?>

<section class="email-page-stats" data-section-theme="light">
    <div class="email-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="email-page-stat-item">
                <span class="email-page-stat-number"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['number'] ?? '', '')); ?></span>
                <span class="email-page-stat-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['label'] ?? '', '')); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is Email Marketing? (Background: white)
// ACF Fields:
// - email_what_is_heading_line1 (WYSIWYG)
// - email_what_is_heading_line2 (WYSIWYG)
// - email_what_is_content (WYSIWYG)
// - email_what_is_image (Image)
// - email_what_is_button (Link)
// ============================================
$what_is_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('email_what_is_heading_line1') : '', 'What is');
$what_is_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('email_what_is_heading_line2') : '', 'Email Marketing?');
$what_is_content = $has_acf ? get_field('email_what_is_content') : '';
$what_is_image = $has_acf ? get_field('email_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('email_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="email-page-info email-page-info-1" data-section-theme="light">
    <div class="email-page-info-container">
        <h2 class="email-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($what_is_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($what_is_heading_line2); ?></span>
        </h2>
        <div class="email-page-info-content">
            <div class="email-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>Email is a great way to keep in touch and in the minds of your customers. Email is not only used to sell, it can be a great tool to tell your clients about company news, tips or advice or seasonal promotions.</p>
                    <p>We can help plan, design, write and send your email campaigns – so you don't have to lift a finger unless you want to.</p>
                    <p>Email marketing consistently delivers the highest ROI of any digital marketing channel when done correctly.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="email-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is Email Marketing">
                <?php else : ?>
                    <div class="email-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1 (Background: #f8f8f8)
// ACF Fields:
// - email_long_cta1_label (WYSIWYG)
// - email_long_cta1_heading_line1 (WYSIWYG)
// - email_long_cta1_heading_line2 (WYSIWYG)
// - email_long_cta1_text (WYSIWYG)
// - email_long_cta1_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - email_long_cta1_primary_button (Link)
// - email_long_cta1_secondary_button (Link)
// ============================================
$long_cta1_label = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta1_label') : '', 'READY TO CONNECT?');
$long_cta1_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta1_heading_line1') : '', 'Emails That');
$long_cta1_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta1_heading_line2') : '', 'Actually Convert');
$long_cta1_text = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta1_text') : '', '');
$long_cta1_features = $has_acf ? get_field('email_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('email_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('email_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Campaign', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="email-page-longcta email-page-longcta-1" data-section-theme="light">
    <div class="email-page-longcta-container">
        <div class="email-page-longcta-content animate-fade-in">
            <span class="email-page-longcta-label"><?php echo wp_kses_post($long_cta1_label); ?></span>
            <h2 class="email-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta1_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta1_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="email-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="email-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="email-page-longcta-feature">
                            <div class="email-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="email-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="email-page-longcta-feature"><div class="email-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div><div class="email-page-longcta-feature-text"><h4>Targeted Campaigns</h4><p>Reach the right audience with the right message at the right time</p></div></div>
                    <div class="email-page-longcta-feature"><div class="email-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div><div class="email-page-longcta-feature-text"><h4>Measurable Results</h4><p>Track opens, clicks, conversions and ROI with detailed analytics</p></div></div>
                    <div class="email-page-longcta-feature"><div class="email-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><div class="email-page-longcta-feature-text"><h4>Automated Flows</h4><p>Set up once, engage customers automatically throughout their journey</p></div></div>
                <?php endif; ?>
            </div>
            <div class="email-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="email-page-longcta-btn email-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="email-page-longcta-btn email-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES SECTION (Background: white)
// ACF Fields:
// - email_services_label (WYSIWYG)
// - email_services_heading (WYSIWYG)
// - email_services_subheading (WYSIWYG)
// - email_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$services_label = hd_wysiwyg_or_default($has_acf ? get_field('email_services_label') : '', 'What We Offer');
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('email_services_heading') : '', 'Email Marketing <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('email_services_subheading') : '', 'Comprehensive email solutions to engage your audience and drive conversions');
$services = $has_acf ? get_field('email_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'Campaign Strategy', 'description' => 'Data-driven email strategies tailored to your business goals and audience segments.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>'],
        ['title' => 'Email Design', 'description' => 'Beautiful, responsive email templates that look great on every device and inbox.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>'],
        ['title' => 'Marketing Automation', 'description' => 'Automated email flows that nurture leads and engage customers at every stage.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="15" y1="15" x2="21" y2="21"/><line x1="4" y1="4" x2="9" y2="9"/></svg>'],
        ['title' => 'List Management', 'description' => 'Grow and maintain healthy email lists with proper segmentation and hygiene.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
    ];
}
?>

<section class="email-page-services" id="services" data-section-theme="light">
    <div class="email-page-services-container">
        <div class="email-page-services-header">
            <span class="email-page-services-label"><?php echo wp_kses_post($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="email-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="email-page-service-card">
                    <div class="email-page-service-icon"><?php echo hd_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(hd_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - Emails That Sell (Background: #f8f8f8, Reversed)
// ACF Fields:
// - email_sells_heading_line1 (WYSIWYG)
// - email_sells_heading_line2 (WYSIWYG)
// - email_sells_content (WYSIWYG)
// - email_sells_image (Image)
// - email_sells_button (Link)
// ============================================
$sells_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('email_sells_heading_line1') : '', 'Emails That');
$sells_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('email_sells_heading_line2') : '', 'Sell');
$sells_content = $has_acf ? get_field('email_sells_content') : '';
$sells_image = $has_acf ? get_field('email_sells_image') : null;
$sells_button = $has_acf ? hd_link(get_field('email_sells_button')) : null;
$sells_image_url = ($sells_image && is_array($sells_image) && !empty($sells_image['url'])) ? esc_url($sells_image['url']) : '';
if (!$sells_button) $sells_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="email-page-info email-page-info-2" data-section-theme="light">
    <div class="email-page-info-container">
        <h2 class="email-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($sells_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($sells_heading_line2); ?></span>
        </h2>
        <div class="email-page-info-content email-page-info-reversed">
            <div class="email-page-info-image animate-slide-left">
                <?php if ($sells_image_url) : ?>
                    <img src="<?php echo $sells_image_url; ?>" alt="Emails That Sell">
                <?php else : ?>
                    <div class="email-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="email-page-info-text animate-slide-right">
                <?php if ($sells_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $sells_content)); ?>
                <?php else : ?>
                    <p>A popular use for email marketing is selling, whether that be selling specific products, or selling services. All this can be done through targeted email campaigns.</p>
                    <p>With the right email strategy, you could be sending emails to the right audience, on the right day and the right time – to get those sales rolling in.</p>
                    <p>We craft compelling copy and eye-catching designs that drive action and boost your bottom line.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($sells_button['url']); ?>" class="cta-button"><?php echo esc_html($sells_button['title']); ?></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS SECTION (Background: white)
// ACF Fields:
// - email_process_label (WYSIWYG)
// - email_process_heading (WYSIWYG)
// - email_process_subheading (WYSIWYG)
// - email_process_steps (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// ============================================
$process_label = hd_wysiwyg_or_default($has_acf ? get_field('email_process_label') : '', 'How We Work');
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('email_process_heading') : '', 'Our Email <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('email_process_subheading') : '', 'A proven methodology that delivers consistent results');
$process_steps = $has_acf ? get_field('email_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Strategy & Planning', 'description' => 'We start by understanding your goals, audience, and current email performance to develop a comprehensive strategy.'],
        ['title' => 'Design & Content', 'description' => 'Our team creates beautiful, on-brand email templates and compelling copy that resonates with your audience.'],
        ['title' => 'Setup & Integration', 'description' => 'We configure your email platform, set up automation workflows, and integrate with your existing systems.'],
        ['title' => 'Launch & Optimise', 'description' => 'We deploy campaigns, monitor performance, and continuously optimise based on data-driven insights.'],
    ];
}
?>

<section class="email-page-process" data-section-theme="light">
    <div class="email-page-process-container">
        <div class="email-page-process-header">
            <span class="email-page-process-label"><?php echo wp_kses_post($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="email-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="email-page-process-step">
                    <div class="email-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="email-page-process-content">
                        <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($step['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(hd_wysiwyg_or_default($step['description'] ?? '', '')); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 3 - Automation (Background: #f8f8f8)
// ACF Fields:
// - email_automation_heading_line1 (WYSIWYG)
// - email_automation_heading_line2 (WYSIWYG)
// - email_automation_content (WYSIWYG)
// - email_automation_image (Image)
// - email_automation_button (Link)
// ============================================
$automation_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('email_automation_heading_line1') : '', 'Ask Us About');
$automation_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('email_automation_heading_line2') : '', 'Automation');
$automation_content = $has_acf ? get_field('email_automation_content') : '';
$automation_image = $has_acf ? get_field('email_automation_image') : null;
$automation_button = $has_acf ? hd_link(get_field('email_automation_button')) : null;
$automation_image_url = ($automation_image && is_array($automation_image) && !empty($automation_image['url'])) ? esc_url($automation_image['url']) : '';
if (!$automation_button) $automation_button = ['url' => '#contact', 'title' => 'Learn More', 'target' => '_self'];
?>

<section class="email-page-info email-page-info-3" data-section-theme="light">
    <div class="email-page-info-container">
        <h2 class="email-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($automation_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($automation_heading_line2); ?></span>
        </h2>
        <div class="email-page-info-content">
            <div class="email-page-info-text animate-slide-left">
                <?php if ($automation_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $automation_content)); ?>
                <?php else : ?>
                    <p>We can help you fully automate your email marketing, making sure your customers are engaged with your brand no matter where they are in their journey.</p>
                    <p>From abandoned cart flows to RFM lead nurturing, email automation can unlock huge opportunities for both e-commerce and service based businesses.</p>
                    <p>Setup the flows, reap the rewards! Our automation experts will help you create intelligent workflows that work around the clock.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($automation_button['url']); ?>" class="cta-button"><?php echo esc_html($automation_button['title']); ?></a>
            </div>
            <div class="email-page-info-image animate-slide-right">
                <?php if ($automation_image_url) : ?>
                    <img src="<?php echo $automation_image_url; ?>" alt="Email Automation">
                <?php else : ?>
                    <div class="email-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"/><line x1="4" y1="20" x2="21" y2="3"/><polyline points="21 16 21 21 16 21"/><line x1="15" y1="15" x2="21" y2="21"/><line x1="4" y1="4" x2="9" y2="9"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// ADDITIONAL SERVICES SECTION (Background: white)
// ACF Fields:
// - email_additional_services_label (WYSIWYG)
// - email_additional_services_heading (WYSIWYG)
// - email_additional_services_subheading (WYSIWYG)
// - email_additional_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$additional_services_label = hd_wysiwyg_or_default($has_acf ? get_field('email_additional_services_label') : '', 'More Services');
$additional_services_heading = hd_wysiwyg_or_default($has_acf ? get_field('email_additional_services_heading') : '', 'Types of <span class="highlight-text-italic">Campaigns</span>');
$additional_services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('email_additional_services_subheading') : '', 'We deliver a range of email campaigns tailored to your specific needs');
$additional_services = $has_acf ? get_field('email_additional_services') : [];
if (!$additional_services || !is_array($additional_services) || empty($additional_services)) {
    $additional_services = [
        ['title' => 'Welcome Series', 'description' => 'Automated sequences that introduce new subscribers to your brand and set the tone for your relationship.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>'],
        ['title' => 'Abandoned Cart', 'description' => 'Recover lost sales with timely reminders to customers who left items in their shopping cart.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>'],
        ['title' => 'Newsletters', 'description' => 'Regular updates that keep your audience engaged with news, tips, and valuable content.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>'],
        ['title' => 'Promotional Campaigns', 'description' => 'Targeted campaigns for sales, launches, and special offers that drive immediate action.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>'],
        ['title' => 'Re-engagement', 'description' => 'Win back inactive subscribers with targeted campaigns designed to rekindle their interest.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>'],
        ['title' => 'Transactional Emails', 'description' => 'Order confirmations, shipping updates, and receipts that enhance customer experience.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>'],
    ];
}
?>

<section class="email-page-services email-page-services-alt" id="campaign-types" data-section-theme="light">
    <div class="email-page-services-container">
        <div class="email-page-services-header">
            <span class="email-page-services-label"><?php echo wp_kses_post($additional_services_label); ?></span>
            <h2><?php echo wp_kses_post($additional_services_heading); ?></h2>
            <p><?php echo wp_kses_post($additional_services_subheading); ?></p>
        </div>
        <div class="email-page-services-grid email-page-services-grid-6">
            <?php foreach (array_slice($additional_services, 0, 6) as $service) : ?>
                <div class="email-page-service-card">
                    <div class="email-page-service-icon"><?php echo hd_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(hd_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// FAQ SECTION (Background: #f8f8f8)
// ACF Fields:
// - email_faq_label (WYSIWYG)
// - email_faq_heading (WYSIWYG)
// - email_faqs (Repeater)
//   - question (WYSIWYG)
//   - answer (WYSIWYG)
// ============================================
$faq_label = hd_wysiwyg_or_default($has_acf ? get_field('email_faq_label') : '', 'FAQ');
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('email_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('email_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How quickly can I expect to see results from email marketing?', 'answer' => 'Email marketing can show immediate results for well-targeted campaigns. You\'ll see open rates and click data within hours of sending. For broader business impact like increased sales and customer retention, expect to see meaningful results within 2-3 months of consistent effort.'],
        ['question' => 'What email platforms do you work with?', 'answer' => 'We work with all major email marketing platforms including Klaviyo, Mailchimp, HubSpot, ActiveCampaign, and many others. We\'ll recommend the best platform for your needs or work with your existing setup.'],
        ['question' => 'How often should I send emails to my list?', 'answer' => 'This depends on your industry and audience. We typically recommend starting with weekly or bi-weekly emails and adjusting based on engagement metrics. Quality always trumps quantity – it\'s better to send fewer, more valuable emails than to overwhelm your subscribers.'],
        ['question' => 'Can you help grow my email list?', 'answer' => 'Absolutely! We can help you implement lead magnets, optimise sign-up forms, create landing pages, and develop strategies to grow your list with engaged, quality subscribers who are genuinely interested in your offering.'],
        ['question' => 'What\'s included in your email marketing services?', 'answer' => 'Our services typically include strategy development, email design and copywriting, list management, automation setup, A/B testing, performance reporting, and ongoing optimisation. We can customise our services to match your specific needs and budget.'],
    ];
}
?>

<section class="email-page-faq" data-section-theme="light">
    <div class="email-page-faq-container">
        <div class="email-page-faq-header">
            <span class="email-page-faq-label"><?php echo wp_kses_post($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="email-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="email-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="email-page-faq-question" aria-expanded="false">
                        <span><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['question'] ?? '', '')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="email-page-faq-answer"><p><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['answer'] ?? '', '')); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php
// ============================================
// LONG CTA 2 - Final CTA (Background: white)
// ACF Fields:
// - email_long_cta2_label (WYSIWYG)
// - email_long_cta2_heading_line1 (WYSIWYG)
// - email_long_cta2_heading_line2 (WYSIWYG)
// - email_long_cta2_text (WYSIWYG)
// - email_long_cta2_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - email_long_cta2_primary_button (Link)
// - email_long_cta2_secondary_button (Link)
// ============================================
$long_cta2_label = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta2_label') : '', 'READY TO GROW?');
$long_cta2_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta2_heading_line1') : '', 'Let\'s Build Something');
$long_cta2_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta2_heading_line2') : '', 'Amazing Together');
$long_cta2_text = hd_wysiwyg_or_default($has_acf ? get_field('email_long_cta2_text') : '', '');
$long_cta2_features = $has_acf ? get_field('email_long_cta2_features') : [];
$long_cta2_primary_button = $has_acf ? hd_link(get_field('email_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('email_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Start Your Project', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="email-page-longcta email-page-longcta-2" data-section-theme="light">
    <div class="email-page-longcta-container">
        <div class="email-page-longcta-content animate-fade-in">
            <span class="email-page-longcta-label"><?php echo wp_kses_post($long_cta2_label); ?></span>
            <h2 class="email-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta2_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta2_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta2_text) : ?><p class="email-page-longcta-text"><?php echo wp_kses_post($long_cta2_text); ?></p><?php endif; ?>
            <div class="email-page-longcta-features">
                <?php if ($long_cta2_features && is_array($long_cta2_features)) : ?>
                    <?php foreach ($long_cta2_features as $feature) : ?>
                        <div class="email-page-longcta-feature">
                            <div class="email-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="email-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="email-page-longcta-feature"><div class="email-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div><div class="email-page-longcta-feature-text"><h4>Proven Results</h4><p>Data-driven strategies that deliver measurable ROI</p></div></div>
                    <div class="email-page-longcta-feature"><div class="email-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><div class="email-page-longcta-feature-text"><h4>Dedicated Team</h4><p>Personal account managers who truly understand your business</p></div></div>
                    <div class="email-page-longcta-feature"><div class="email-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><div class="email-page-longcta-feature-text"><h4>Fast Turnaround</h4><p>Quick response times and efficient project delivery</p></div></div>
                <?php endif; ?>
            </div>
            <div class="email-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="email-page-longcta-btn email-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="email-page-longcta-btn email-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
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
              <div class="reviewer-avatar" style="background:#4285f4;">S</div>
              <div class="reviewer-info">
                <h4>Sophie C.</h4>
                <p class="review-date">2025-01-15</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Hagerty Digital have been absolutely brilliant. Super helpful, honest advice from a team who really know their stuff.</p>
          </div>

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#34a853;">L</div>
              <div class="reviewer-info">
                <h4>Libby J.</h4>
                <p class="review-date">2025-02-10</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Incredibly knowledgeable when it comes to digital marketing. Their expertise and professionalism have been outstanding.</p>
          </div>

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#fbbc05;">T</div>
              <div class="reviewer-info">
                <h4>Tom H.</h4>
                <p class="review-date">2025-03-01</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Fantastic Company! Have been helping my business generate leads ever since! Would highly recommend.</p>
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