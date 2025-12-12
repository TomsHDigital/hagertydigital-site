<?php
/**
 * Template Name: Automation Services
 * All classes prefixed with auto-page- for independent styling
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
// - auto_hero_label (WYSIWYG)
// - auto_hero_heading_line_1 (WYSIWYG)
// - auto_hero_heading_line_2 (WYSIWYG)
// - auto_hero_description (WYSIWYG)
// - auto_hero_background_type (Select: none, image, video)
// - auto_hero_background_image (Image)
// - auto_hero_background_video_mp4 (File)
// - auto_hero_background_video_webm (File)
// - auto_hero_background_video_poster (Image)
// - auto_hero_background_overlay_opacity (Number)
// - auto_hero_primary_button (Link)
// - auto_hero_secondary_button (Link)
// ============================================
$hero_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_hero_label') : '', 'Marketing Automation');
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('auto_hero_heading_line_1') : '', 'Automate Your');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('auto_hero_heading_line_2') : '', '<span class="highlight-text-italic">Growth</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('auto_hero_description') : '', 'Streamline your marketing workflows, nurture leads automatically, and scale your business with intelligent automation solutions.');

$hero_bg_type = $has_acf ? (get_field('auto_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('auto_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('auto_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('auto_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('auto_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('auto_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? hd_link(get_field('auto_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? hd_link(get_field('auto_hero_secondary_button')) : null;

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
<section class="auto-page-hero" data-section-theme="dark">
  <div class="auto-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="auto-page-hero-video">
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="Automation Services" class="auto-page-hero-image">
    <?php endif; ?>
    <div class="auto-page-hero-overlay"></div>
  </div>

  <div class="auto-page-hero-content">
    <div class="auto-page-hero-text animate-fade-in">
      <span class="auto-page-hero-label"><?php echo wp_kses_post($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="auto-page-hero-description">
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
// ACF Fields:
// - auto_stats (Repeater)
//   - number (WYSIWYG)
//   - label (WYSIWYG)
// ============================================
$stats = $has_acf ? get_field('auto_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '85%', 'label' => 'Time Saved on Tasks'],
        ['number' => '300%', 'label' => 'Lead Nurture Improvement'],
        ['number' => '£1.8M+', 'label' => 'Revenue Automated'],
        ['number' => '40+', 'label' => 'Integrations Available'],
    ];
}
?>

<section class="auto-page-stats" data-section-theme="light">
    <div class="auto-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="auto-page-stat-item">
                <span class="auto-page-stat-number"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['number'] ?? '', '')); ?></span>
                <span class="auto-page-stat-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['label'] ?? '', '')); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is Automation?
// ACF Fields:
// - auto_what_is_heading_line1 (WYSIWYG)
// - auto_what_is_heading_line2 (WYSIWYG)
// - auto_what_is_content (WYSIWYG)
// - auto_what_is_image (Image)
// - auto_what_is_button (Link)
// ============================================
$what_is_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('auto_what_is_heading_line1') : '', 'What is');
$what_is_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('auto_what_is_heading_line2') : '', 'Automation?');
$what_is_content = $has_acf ? get_field('auto_what_is_content') : '';
$what_is_image = $has_acf ? get_field('auto_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('auto_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="auto-page-info auto-page-info-1" data-section-theme="light">
    <div class="auto-page-info-container">
        <h2 class="auto-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($what_is_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($what_is_heading_line2); ?></span>
        </h2>
        <div class="auto-page-info-content">
            <div class="auto-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>Marketing automation uses software and technology to streamline repetitive marketing tasks, allowing you to focus on strategy and creativity. It's like having a tireless team member who works 24/7.</p>
                    <p>From email sequences to lead scoring, social media scheduling to customer journey mapping, automation handles the heavy lifting while you concentrate on growing your business.</p>
                    <p>The result? Consistent communication, better lead nurturing, and significantly improved conversion rates—all without burning out your team.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="auto-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is Automation">
                <?php else : ?>
                    <div class="auto-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1
// ACF Fields:
// - auto_long_cta1_label (WYSIWYG)
// - auto_long_cta1_heading_line1 (WYSIWYG)
// - auto_long_cta1_heading_line2 (WYSIWYG)
// - auto_long_cta1_text (WYSIWYG)
// - auto_long_cta1_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - auto_long_cta1_primary_button (Link)
// - auto_long_cta1_secondary_button (Link)
// ============================================
$long_cta1_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta1_label') : '', 'READY TO AUTOMATE?');
$long_cta1_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta1_heading_line1') : '', 'Let\'s Streamline');
$long_cta1_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta1_heading_line2') : '', 'Your Workflows');
$long_cta1_text = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta1_text') : '', '');
$long_cta1_features = $has_acf ? get_field('auto_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('auto_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('auto_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Project', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="auto-page-longcta auto-page-longcta-1" data-section-theme="light">
    <div class="auto-page-longcta-container">
        <div class="auto-page-longcta-content animate-fade-in">
            <span class="auto-page-longcta-label"><?php echo wp_kses_post($long_cta1_label); ?></span>
            <h2 class="auto-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta1_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta1_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="auto-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="auto-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="auto-page-longcta-feature">
                            <div class="auto-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="auto-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="auto-page-longcta-feature"><div class="auto-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg></div><div class="auto-page-longcta-feature-text"><h4>Custom Workflows</h4><p>Tailored automation sequences designed for your specific business needs</p></div></div>
                    <div class="auto-page-longcta-feature"><div class="auto-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div><div class="auto-page-longcta-feature-text"><h4>Real-Time Analytics</h4><p>Track performance and optimise your automations with detailed insights</p></div></div>
                    <div class="auto-page-longcta-feature"><div class="auto-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><div class="auto-page-longcta-feature-text"><h4>Dedicated Support</h4><p>Your own automation specialist who understands your business goals</p></div></div>
                <?php endif; ?>
            </div>
            <div class="auto-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="auto-page-longcta-btn auto-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="auto-page-longcta-btn auto-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES SECTION
// ACF Fields:
// - auto_services_label (WYSIWYG)
// - auto_services_heading (WYSIWYG)
// - auto_services_subheading (WYSIWYG)
// - auto_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$services_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_services_label') : '', 'What We Offer');
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('auto_services_heading') : '', 'Our Automation <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('auto_services_subheading') : '', 'Comprehensive automation solutions to streamline your marketing and sales operations');
$services = $has_acf ? get_field('auto_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'Email Automation', 'description' => 'Automated email sequences that nurture leads and convert customers on autopilot.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>'],
        ['title' => 'CRM Integration', 'description' => 'Seamlessly connect your tools and centralise customer data for better insights.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
        ['title' => 'Lead Scoring', 'description' => 'Automatically identify and prioritise your hottest leads for sales follow-up.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>'],
        ['title' => 'Workflow Automation', 'description' => 'Custom workflows that eliminate repetitive tasks and boost team productivity.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg>'],
    ];
}
?>

<section class="auto-page-services" id="services" data-section-theme="light">
    <div class="auto-page-services-container">
        <div class="auto-page-services-header">
            <span class="auto-page-services-label"><?php echo wp_kses_post($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="auto-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="auto-page-service-card">
                    <div class="auto-page-service-icon"><?php echo hd_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(hd_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - Why Automate (Reversed)
// ACF Fields:
// - auto_why_automate_heading_line1 (WYSIWYG)
// - auto_why_automate_heading_line2 (WYSIWYG)
// - auto_why_automate_content (WYSIWYG)
// - auto_why_automate_image (Image)
// - auto_why_automate_button (Link)
// ============================================
$why_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('auto_why_automate_heading_line1') : '', 'Why');
$why_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('auto_why_automate_heading_line2') : '', 'Automate?');
$why_content = $has_acf ? get_field('auto_why_automate_content') : '';
$why_image = $has_acf ? get_field('auto_why_automate_image') : null;
$why_button = $has_acf ? hd_link(get_field('auto_why_automate_button')) : null;
$why_image_url = ($why_image && is_array($why_image) && !empty($why_image['url'])) ? esc_url($why_image['url']) : '';
if (!$why_button) $why_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="auto-page-info auto-page-info-2" data-section-theme="light">
    <div class="auto-page-info-container">
        <h2 class="auto-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($why_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($why_heading_line2); ?></span>
        </h2>
        <div class="auto-page-info-content auto-page-info-reversed">
            <div class="auto-page-info-image animate-slide-left">
                <?php if ($why_image_url) : ?>
                    <img src="<?php echo $why_image_url; ?>" alt="Why Automate">
                <?php else : ?>
                    <div class="auto-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="auto-page-info-text animate-slide-right">
                <?php if ($why_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $why_content)); ?>
                <?php else : ?>
                    <p>Manual marketing is time-consuming, inconsistent, and difficult to scale. Automation changes the game by ensuring every lead gets the right message at the right time.</p>
                    <p>Your competitors are already automating. Without it, you're leaving money on the table and burning out your team with repetitive tasks that machines can handle better.</p>
                    <p>We build automation systems that free up your team to focus on what humans do best: strategy, creativity, and building genuine relationships with customers.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($why_button['url']); ?>" class="cta-button"><?php echo esc_html($why_button['title']); ?></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 2 (Simpler, no features)
// ACF Fields:
// - auto_long_cta2_label (WYSIWYG)
// - auto_long_cta2_heading_line1 (WYSIWYG)
// - auto_long_cta2_heading_line2 (WYSIWYG)
// - auto_long_cta2_text (WYSIWYG)
// - auto_long_cta2_primary_button (Link)
// - auto_long_cta2_secondary_button (Link)
// ============================================
$long_cta2_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta2_label') : '', 'SCALE YOUR BUSINESS');
$long_cta2_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta2_heading_line1') : '', 'Work Smarter');
$long_cta2_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta2_heading_line2') : '', 'Not Harder');
$long_cta2_text = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta2_text') : '', 'Let automation handle the repetitive tasks while you focus on strategy and growth.');
$long_cta2_primary_button = $has_acf ? hd_link(get_field('auto_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('auto_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Get Started', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="auto-page-longcta auto-page-longcta-2" data-section-theme="light">
    <div class="auto-page-longcta-container">
        <div class="auto-page-longcta-content animate-fade-in">
            <span class="auto-page-longcta-label"><?php echo wp_kses_post($long_cta2_label); ?></span>
            <h2 class="auto-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta2_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta2_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta2_text) : ?><p class="auto-page-longcta-text"><?php echo wp_kses_post($long_cta2_text); ?></p><?php endif; ?>
            <div class="auto-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="auto-page-longcta-btn auto-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="auto-page-longcta-btn auto-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS SECTION
// ACF Fields:
// - auto_process_label (WYSIWYG)
// - auto_process_heading (WYSIWYG)
// - auto_process_subheading (WYSIWYG)
// - auto_process_steps (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// ============================================
$process_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_process_label') : '', 'How We Work');
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('auto_process_heading') : '', 'Our Automation <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('auto_process_subheading') : '', 'A structured approach to building automation that delivers real results');
$process_steps = $has_acf ? get_field('auto_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Discovery & Mapping', 'description' => 'We analyse your current workflows, identify automation opportunities, and map out your customer journey to find the biggest wins.'],
        ['title' => 'Strategy & Design', 'description' => 'Based on our findings, we design custom automation workflows aligned with your business goals and customer needs.'],
        ['title' => 'Build & Integrate', 'description' => 'Our team builds your automations, connects your tools, and ensures everything works seamlessly together.'],
        ['title' => 'Test & Optimise', 'description' => 'We continuously monitor performance, A/B test variations, and refine your automations for maximum impact.'],
    ];
}
?>

<section class="auto-page-process" data-section-theme="light">
    <div class="auto-page-process-container">
        <div class="auto-page-process-header">
            <span class="auto-page-process-label"><?php echo wp_kses_post($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="auto-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="auto-page-process-step">
                    <div class="auto-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="auto-page-process-content">
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
// INFO SECTION 3 - Tools & Integrations
// ACF Fields:
// - auto_tools_heading_line1 (WYSIWYG)
// - auto_tools_heading_line2 (WYSIWYG)
// - auto_tools_content (WYSIWYG)
// - auto_tools_image (Image)
// - auto_tools_button (Link)
// ============================================
$tools_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('auto_tools_heading_line1') : '', 'Tools &');
$tools_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('auto_tools_heading_line2') : '', 'Integrations');
$tools_content = $has_acf ? get_field('auto_tools_content') : '';
$tools_image = $has_acf ? get_field('auto_tools_image') : null;
$tools_button = $has_acf ? hd_link(get_field('auto_tools_button')) : null;
$tools_image_url = ($tools_image && is_array($tools_image) && !empty($tools_image['url'])) ? esc_url($tools_image['url']) : '';
if (!$tools_button) $tools_button = ['url' => '#contact', 'title' => 'Discuss Your Stack', 'target' => '_self'];
?>

<section class="auto-page-info auto-page-info-3" data-section-theme="light">
    <div class="auto-page-info-container">
        <h2 class="auto-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($tools_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($tools_heading_line2); ?></span>
        </h2>
        <div class="auto-page-info-content">
            <div class="auto-page-info-text animate-slide-left">
                <?php if ($tools_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $tools_content)); ?>
                <?php else : ?>
                    <p>We work with all the leading automation platforms and can integrate with virtually any tool in your marketing stack. HubSpot, Mailchimp, ActiveCampaign, Zapier—you name it.</p>
                    <p>Already have tools you love? Great. We'll make them work harder for you. Starting fresh? We'll recommend the right platforms based on your needs and budget.</p>
                    <p>Our platform-agnostic approach means we always choose the best solution for you, not the one that pays us the biggest commission.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($tools_button['url']); ?>" class="cta-button"><?php echo esc_html($tools_button['title']); ?></a>
            </div>
            <div class="auto-page-info-image animate-slide-right">
                <?php if ($tools_image_url) : ?>
                    <img src="<?php echo $tools_image_url; ?>" alt="Tools & Integrations">
                <?php else : ?>
                    <div class="auto-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 3
// ACF Fields:
// - auto_long_cta3_label (WYSIWYG)
// - auto_long_cta3_heading_line1 (WYSIWYG)
// - auto_long_cta3_heading_line2 (WYSIWYG)
// - auto_long_cta3_text (WYSIWYG)
// - auto_long_cta3_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - auto_long_cta3_primary_button (Link)
// - auto_long_cta3_secondary_button (Link)
// ============================================
$long_cta3_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta3_label') : '', 'PROVEN RESULTS');
$long_cta3_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta3_heading_line1') : '', 'Ready to');
$long_cta3_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta3_heading_line2') : '', 'Automate?');
$long_cta3_text = hd_wysiwyg_or_default($has_acf ? get_field('auto_long_cta3_text') : '', '');
$long_cta3_features = $has_acf ? get_field('auto_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? hd_link(get_field('auto_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? hd_link(get_field('auto_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Start Automating Today', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="auto-page-longcta auto-page-longcta-3" data-section-theme="light">
    <div class="auto-page-longcta-container">
        <div class="auto-page-longcta-content animate-fade-in">
            <span class="auto-page-longcta-label"><?php echo wp_kses_post($long_cta3_label); ?></span>
            <h2 class="auto-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta3_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta3_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="auto-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="auto-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="auto-page-longcta-feature">
                            <div class="auto-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="auto-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="auto-page-longcta-feature"><div class="auto-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></div><div class="auto-page-longcta-feature-text"><h4>No Long-Term Contracts</h4><p>We believe in earning your business every month</p></div></div>
                    <div class="auto-page-longcta-feature"><div class="auto-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div><div class="auto-page-longcta-feature-text"><h4>Transparent Reporting</h4><p>Monthly reports you can actually understand</p></div></div>
                    <div class="auto-page-longcta-feature"><div class="auto-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="auto-page-longcta-feature-text"><h4>Full Ownership</h4><p>You own all automations and data we create</p></div></div>
                <?php endif; ?>
            </div>
            <div class="auto-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta3_primary_button['url']); ?>" class="auto-page-longcta-btn auto-page-longcta-btn-primary"><span><?php echo esc_html($long_cta3_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta3_secondary_button['url']); ?>" class="auto-page-longcta-btn auto-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta3_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// RESULTS SECTION
// ACF Fields:
// - auto_results_label (WYSIWYG)
// - auto_results_heading (WYSIWYG)
// - auto_results_subheading (WYSIWYG)
// - auto_results (Repeater)
//   - industry (WYSIWYG)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - metric1_value (WYSIWYG)
//   - metric1_label (WYSIWYG)
//   - metric2_value (WYSIWYG)
//   - metric2_label (WYSIWYG)
//   - image (Image)
// ============================================
$results_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_results_label') : '', 'Case Studies');
$results_heading = hd_wysiwyg_or_default($has_acf ? get_field('auto_results_heading') : '', 'Real <span class="highlight-text-italic">Results</span>');
$results_subheading = hd_wysiwyg_or_default($has_acf ? get_field('auto_results_subheading') : '', 'See how automation has transformed businesses like yours');
$results = $has_acf ? get_field('auto_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'E-commerce', 'title' => 'Online Retailer', 'description' => 'Automated abandoned cart recovery generating £50k additional revenue.', 'metric1_value' => '+£50k', 'metric1_label' => 'Recovered Revenue', 'metric2_value' => '85%', 'metric2_label' => 'Time Saved', 'image' => null],
        ['industry' => 'B2B Services', 'title' => 'Consulting Firm', 'description' => 'Lead nurturing sequences that tripled qualified appointments.', 'metric1_value' => '300%', 'metric1_label' => 'More Appointments', 'metric2_value' => '+45%', 'metric2_label' => 'Close Rate', 'image' => null],
        ['industry' => 'SaaS', 'title' => 'Software Company', 'description' => 'Onboarding automation that reduced churn by 40%.', 'metric1_value' => '-40%', 'metric1_label' => 'Churn Rate', 'metric2_value' => '+60%', 'metric2_label' => 'Activation', 'image' => null],
    ];
}
?>

<section class="auto-page-results" data-section-theme="light">
    <div class="auto-page-results-container">
        <div class="auto-page-results-header">
            <span class="auto-page-results-label"><?php echo wp_kses_post($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="auto-page-results-grid">
            <?php foreach ($results as $result) : 
                $result_image = null;
                if (!empty($result['image']) && is_array($result['image']) && !empty($result['image']['url'])) {
                    $result_image = esc_url($result['image']['url']);
                }
            ?>
                <div class="auto-page-result-card">
                    <div class="auto-page-result-image">
                        <?php if ($result_image) : ?>
                            <img src="<?php echo $result_image; ?>" alt="<?php echo esc_attr(strip_tags($result['title'] ?? 'Case Study')); ?>">
                        <?php else : ?>
                            <div class="auto-page-result-placeholder"><span><?php echo esc_html(substr(strip_tags($result['title'] ?? 'C'), 0, 1)); ?></span></div>
                        <?php endif; ?>
                    </div>
                    <div class="auto-page-result-content">
                        <span class="auto-page-result-industry"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['industry'] ?? '', '')); ?></span>
                        <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($result['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(hd_wysiwyg_or_default($result['description'] ?? '', '')); ?></p>
                        <div class="auto-page-result-metrics">
                            <div class="auto-page-result-metric">
                                <span class="auto-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_value'] ?? '', '')); ?></span>
                                <span class="auto-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_label'] ?? '', '')); ?></span>
                            </div>
                            <div class="auto-page-result-metric">
                                <span class="auto-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_value'] ?? '', '')); ?></span>
                                <span class="auto-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_label'] ?? '', '')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// FAQ SECTION
// ACF Fields:
// - auto_faq_label (WYSIWYG)
// - auto_faq_heading (WYSIWYG)
// - auto_faqs (Repeater)
//   - question (WYSIWYG)
//   - answer (WYSIWYG)
// ============================================
$faq_label = hd_wysiwyg_or_default($has_acf ? get_field('auto_faq_label') : '', 'FAQ');
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('auto_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('auto_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How long does it take to set up automation?', 'answer' => 'Basic automations can be live within 2-4 weeks. More complex, multi-channel workflows typically take 6-8 weeks to fully implement and test.'],
        ['question' => 'What platforms do you work with?', 'answer' => 'We work with all major platforms including HubSpot, Mailchimp, ActiveCampaign, Klaviyo, Zapier, Make, and can integrate with virtually any tool via API.'],
        ['question' => 'Will automation feel impersonal to my customers?', 'answer' => 'Not at all. Well-designed automation actually improves personalisation by delivering the right message to the right person at the right time—something humans can\'t do at scale.'],
        ['question' => 'How much does automation cost?', 'answer' => 'Costs vary based on complexity and platform fees. We offer packages starting from £750/month and always provide clear ROI projections.'],
        ['question' => 'Do I need technical skills to manage automations?', 'answer' => 'No. We build user-friendly systems and provide full training. Most clients can make simple updates themselves, and we\'re always here for more complex changes.'],
    ];
}
?>

<section class="auto-page-faq" data-section-theme="light">
    <div class="auto-page-faq-container">
        <div class="auto-page-faq-header">
            <span class="auto-page-faq-label"><?php echo wp_kses_post($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="auto-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="auto-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="auto-page-faq-question" aria-expanded="false">
                        <span><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['question'] ?? '', '')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="auto-page-faq-answer"><p><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['answer'] ?? '', '')); ?></p></div>
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

          <div class="review-card">
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
          <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>
    </div>
  </div>
</section>

<?php get_footer(); ?>