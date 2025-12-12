<?php
/**
 * Template Name: Digital Strategy
 * All classes prefixed with ds-page- for independent styling
 */

get_header();

$has_acf = function_exists('get_field');

// Helpers
if (!function_exists('ds_strip_wrapping_p')) {
    function ds_strip_wrapping_p($html) {
        if (!$html) return '';
        return preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($html));
    }
}

if (!function_exists('ds_wysiwyg_or_default')) {
    function ds_wysiwyg_or_default($field_value, $default_html) {
        $val = $field_value ? apply_filters('the_content', $field_value) : $default_html;
        return ds_strip_wrapping_p($val);
    }
}

if (!function_exists('ds_link')) {
    function ds_link($link_field) {
        if (!$link_field || !is_array($link_field) || empty($link_field['url'])) return null;
        return [
            'url'    => esc_url($link_field['url']),
            'title'  => !empty($link_field['title']) ? esc_html($link_field['title']) : 'Learn more',
            'target' => !empty($link_field['target']) ? esc_attr($link_field['target']) : '_self',
        ];
    }
}

// SVG Output Helper - allows all SVG elements and attributes
if (!function_exists('ds_svg_output')) {
    function ds_svg_output($svg_string) {
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
// - ds_hero_label (WYSIWYG)
// - ds_hero_heading_line_1 (WYSIWYG)
// - ds_hero_heading_line_2 (WYSIWYG)
// - ds_hero_description (WYSIWYG)
// - ds_hero_background_type (Select: none, image, video)
// - ds_hero_background_image (Image)
// - ds_hero_background_video_mp4 (File)
// - ds_hero_background_video_webm (File)
// - ds_hero_background_video_poster (Image)
// - ds_hero_background_overlay_opacity (Number)
// - ds_hero_primary_button (Link)
// - ds_hero_secondary_button (Link)
// ============================================
$hero_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_hero_label') : '', 'Digital Strategy');
$hero_line1 = ds_wysiwyg_or_default($has_acf ? get_field('ds_hero_heading_line_1') : '', 'Strategic Digital');
$hero_line2 = ds_wysiwyg_or_default($has_acf ? get_field('ds_hero_heading_line_2') : '', '<span class="highlight-text-italic">Marketing</span>');
$hero_desc  = ds_wysiwyg_or_default($has_acf ? get_field('ds_hero_description') : '', 'Get all your digital ducks in a row with a consistent and robust strategy that sets up your online marketing to produce the results you want to see.');

$hero_bg_type = $has_acf ? (get_field('ds_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('ds_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('ds_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('ds_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('ds_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('ds_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? ds_link(get_field('ds_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? ds_link(get_field('ds_hero_secondary_button')) : null;

if (!$hero_primary_btn) $hero_primary_btn = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
if (!$hero_secondary_btn) $hero_secondary_btn = ['url' => '#services', 'title' => 'Our Services', 'target' => '_self'];

$hero_image_url = ($hero_bg_image && is_array($hero_bg_image) && !empty($hero_bg_image['url'])) ? esc_url($hero_bg_image['url']) : '';
$hero_video_poster_url = ($hero_bg_video_poster && is_array($hero_bg_video_poster) && !empty($hero_bg_video_poster['url'])) ? esc_url($hero_bg_video_poster['url']) : '';

$hero_video_mp4_url = ($hero_bg_video_mp4 && is_array($hero_bg_video_mp4) && !empty($hero_bg_video_mp4['url'])) ? esc_url($hero_bg_video_mp4['url']) : '';
$hero_video_webm_url = ($hero_bg_video_webm && is_array($hero_bg_video_webm) && !empty($hero_bg_video_webm['url'])) ? esc_url($hero_bg_video_webm['url']) : '';

$has_hero_media = ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) || ($hero_bg_type === 'image' && $hero_image_url);
$hero_text_class = $has_hero_media ? 'has-media' : '';
?>

<!-- HERO -->
<section class="ds-page-hero" data-section-theme="dark">
  <div class="ds-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="ds-page-hero-video">
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="Digital Strategy Services" class="ds-page-hero-image">
    <?php endif; ?>
    <div class="ds-page-hero-overlay"></div>
  </div>

  <div class="ds-page-hero-content">
    <div class="ds-page-hero-text animate-fade-in">
      <span class="ds-page-hero-label"><?php echo wp_kses_post($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="ds-page-hero-description">
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
// - ds_stats (Repeater)
//   - number (WYSIWYG)
//   - label (WYSIWYG)
// ============================================
$stats = $has_acf ? get_field('ds_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '200%', 'label' => 'Average ROI Increase'],
        ['number' => '50+', 'label' => 'Strategies Delivered'],
        ['number' => '£3M+', 'label' => 'Revenue Generated'],
        ['number' => '95%', 'label' => 'Client Retention'],
    ];
}
?>

<section class="ds-page-stats" data-section-theme="light">
    <div class="ds-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="ds-page-stat-item">
                <span class="ds-page-stat-number"><?php echo wp_kses_post(ds_wysiwyg_or_default($stat['number'] ?? '', '')); ?></span>
                <span class="ds-page-stat-label"><?php echo wp_kses_post(ds_wysiwyg_or_default($stat['label'] ?? '', '')); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is Digital Strategy?
// ACF Fields:
// - ds_what_is_heading_line1 (WYSIWYG)
// - ds_what_is_heading_line2 (WYSIWYG)
// - ds_what_is_content (WYSIWYG)
// - ds_what_is_image (Image)
// - ds_what_is_button (Link)
// ============================================
$what_is_heading_line1 = ds_wysiwyg_or_default($has_acf ? get_field('ds_what_is_heading_line1') : '', 'What is');
$what_is_heading_line2 = ds_wysiwyg_or_default($has_acf ? get_field('ds_what_is_heading_line2') : '', 'Digital Strategy?');
$what_is_content = $has_acf ? get_field('ds_what_is_content') : '';
$what_is_image = $has_acf ? get_field('ds_what_is_image') : null;
$what_is_button = $has_acf ? ds_link(get_field('ds_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="ds-page-info ds-page-info-1" data-section-theme="light">
    <div class="ds-page-info-container">
        <h2 class="ds-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($what_is_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($what_is_heading_line2); ?></span>
        </h2>
        <div class="ds-page-info-content">
            <div class="ds-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>Digital strategy is the blueprint that guides all your online marketing efforts. It's a comprehensive plan that aligns your business goals with the right digital channels, tactics, and technologies to reach your target audience effectively.</p>
                    <p>Without a solid strategy, digital marketing becomes a series of disconnected activities that waste time and money. With the right strategy, every piece of content, every campaign, and every pound spent works together towards measurable business outcomes.</p>
                    <p>Our strategic approach ensures your digital presence is cohesive, targeted, and designed for sustainable growth.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="ds-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is Digital Strategy">
                <?php else : ?>
                    <div class="ds-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1
// ACF Fields:
// - ds_long_cta1_label (WYSIWYG)
// - ds_long_cta1_heading_line1 (WYSIWYG)
// - ds_long_cta1_heading_line2 (WYSIWYG)
// - ds_long_cta1_text (WYSIWYG)
// - ds_long_cta1_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - ds_long_cta1_primary_button (Link)
// - ds_long_cta1_secondary_button (Link)
// ============================================
$long_cta1_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta1_label') : '', 'READY TO GROW?');
$long_cta1_heading_line1 = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta1_heading_line1') : '', 'Let\'s Build Your');
$long_cta1_heading_line2 = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta1_heading_line2') : '', 'Digital Roadmap');
$long_cta1_text = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta1_text') : '', '');
$long_cta1_features = $has_acf ? get_field('ds_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? ds_link(get_field('ds_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? ds_link(get_field('ds_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Strategy', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ds-page-longcta ds-page-longcta-1" data-section-theme="light">
    <div class="ds-page-longcta-container">
        <div class="ds-page-longcta-content animate-fade-in">
            <span class="ds-page-longcta-label"><?php echo wp_kses_post($long_cta1_label); ?></span>
            <h2 class="ds-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta1_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta1_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="ds-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="ds-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="ds-page-longcta-feature">
                            <div class="ds-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? ds_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="ds-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(ds_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(ds_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="ds-page-longcta-feature"><div class="ds-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div><div class="ds-page-longcta-feature-text"><h4>Data-Driven Approach</h4><p>Every decision backed by research and analytics</p></div></div>
                    <div class="ds-page-longcta-feature"><div class="ds-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div><div class="ds-page-longcta-feature-text"><h4>Clear Reporting</h4><p>Monthly reports that track progress and ROI</p></div></div>
                    <div class="ds-page-longcta-feature"><div class="ds-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><div class="ds-page-longcta-feature-text"><h4>Expert Team</h4><p>Specialists in every digital marketing discipline</p></div></div>
                <?php endif; ?>
            </div>
            <div class="ds-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="ds-page-longcta-btn ds-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="ds-page-longcta-btn ds-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES SECTION - RECTANGLES
// ACF Fields:
// - ds_services_label (WYSIWYG)
// - ds_services_heading (WYSIWYG)
// - ds_services_subheading (WYSIWYG)
// - ds_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$services_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_services_label') : '', 'What We Offer');
$services_heading = ds_wysiwyg_or_default($has_acf ? get_field('ds_services_heading') : '', 'Our Digital <span class="highlight-text-italic">Services</span>');
$services_subheading = ds_wysiwyg_or_default($has_acf ? get_field('ds_services_subheading') : '', 'Comprehensive digital marketing solutions tailored to your business goals');
$services = $has_acf ? get_field('ds_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'SEO', 'description' => 'Dominate search results and drive organic traffic with data-driven optimisation strategies.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>'],
        ['title' => 'PPC', 'description' => 'Maximise ROI with targeted paid advertising across Google, Bing, and social platforms.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>'],
        ['title' => 'Email Marketing', 'description' => 'Nurture leads and drive conversions with automated, personalised email campaigns.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>'],
        ['title' => 'Social Media', 'description' => 'Build brand awareness and engage your audience across all social platforms.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>'],
    ];
}
?>

<section class="ds-page-services" id="services" data-section-theme="light">
    <div class="ds-page-services-container">
        <div class="ds-page-services-header">
            <span class="ds-page-services-label"><?php echo wp_kses_post($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="ds-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="ds-page-service-card">
                    <div class="ds-page-service-icon"><?php echo ds_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(ds_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(ds_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - Why Choose Us (Reversed)
// ACF Fields:
// - ds_why_choose_heading_line1 (WYSIWYG)
// - ds_why_choose_heading_line2 (WYSIWYG)
// - ds_why_choose_content (WYSIWYG)
// - ds_why_choose_image (Image)
// - ds_why_choose_button (Link)
// ============================================
$why_heading_line1 = ds_wysiwyg_or_default($has_acf ? get_field('ds_why_choose_heading_line1') : '', 'Why Choose');
$why_heading_line2 = ds_wysiwyg_or_default($has_acf ? get_field('ds_why_choose_heading_line2') : '', 'Us?');
$why_content = $has_acf ? get_field('ds_why_choose_content') : '';
$why_image = $has_acf ? get_field('ds_why_choose_image') : null;
$why_button = $has_acf ? ds_link(get_field('ds_why_choose_button')) : null;
$why_image_url = ($why_image && is_array($why_image) && !empty($why_image['url'])) ? esc_url($why_image['url']) : '';
if (!$why_button) $why_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="ds-page-info ds-page-info-2" data-section-theme="light">
    <div class="ds-page-info-container">
        <h2 class="ds-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($why_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($why_heading_line2); ?></span>
        </h2>
        <div class="ds-page-info-content ds-page-info-reversed">
            <div class="ds-page-info-image animate-slide-left">
                <?php if ($why_image_url) : ?>
                    <img src="<?php echo $why_image_url; ?>" alt="Why Choose Us">
                <?php else : ?>
                    <div class="ds-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="ds-page-info-text animate-slide-right">
                <?php if ($why_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $why_content)); ?>
                <?php else : ?>
                    <p>Because we don't believe in one-size-fits-all solutions. Every business is unique, and your digital strategy should reflect that. We take the time to understand your goals, your audience, and your competitive landscape.</p>
                    <p>We won't baffle you with jargon or hide behind complicated reports. When we talk about your digital marketing, we use language you understand and focus on metrics that matter to your business.</p>
                    <p>Our integrated approach means all your digital channels work together seamlessly, maximising your investment and delivering measurable results.</p>
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
// - ds_long_cta2_label (WYSIWYG)
// - ds_long_cta2_heading_line1 (WYSIWYG)
// - ds_long_cta2_heading_line2 (WYSIWYG)
// - ds_long_cta2_text (WYSIWYG)
// - ds_long_cta2_primary_button (Link)
// - ds_long_cta2_secondary_button (Link)
// ============================================
$long_cta2_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta2_label') : '', 'LET\'S TALK');
$long_cta2_heading_line1 = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta2_heading_line1') : '', 'Ready to Transform');
$long_cta2_heading_line2 = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta2_heading_line2') : '', 'Your Digital Presence?');
$long_cta2_text = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta2_text') : '', 'Get in touch for a free consultation and discover how we can help grow your business online.');
$long_cta2_primary_button = $has_acf ? ds_link(get_field('ds_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? ds_link(get_field('ds_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Book a Call', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ds-page-longcta ds-page-longcta-2" data-section-theme="light">
    <div class="ds-page-longcta-container">
        <div class="ds-page-longcta-content animate-fade-in">
            <span class="ds-page-longcta-label"><?php echo wp_kses_post($long_cta2_label); ?></span>
            <h2 class="ds-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta2_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta2_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta2_text) : ?><p class="ds-page-longcta-text"><?php echo wp_kses_post($long_cta2_text); ?></p><?php endif; ?>
            <div class="ds-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="ds-page-longcta-btn ds-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="ds-page-longcta-btn ds-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS SECTION
// ACF Fields:
// - ds_process_label (WYSIWYG)
// - ds_process_heading (WYSIWYG)
// - ds_process_subheading (WYSIWYG)
// - ds_process_steps (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// ============================================
$process_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_process_label') : '', 'How We Work');
$process_heading = ds_wysiwyg_or_default($has_acf ? get_field('ds_process_heading') : '', 'Our Strategic <span class="highlight-text-italic">Process</span>');
$process_subheading = ds_wysiwyg_or_default($has_acf ? get_field('ds_process_subheading') : '', 'A proven methodology that delivers consistent results');
$process_steps = $has_acf ? get_field('ds_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Discovery & Audit', 'description' => 'We dive deep into your business, analysing your current digital presence, competitors, and market opportunities.'],
        ['title' => 'Strategy Development', 'description' => 'Based on our findings, we create a bespoke digital strategy aligned with your business goals and budget.'],
        ['title' => 'Implementation', 'description' => 'Our team executes the strategy across all channels, from SEO and PPC to content and social media.'],
        ['title' => 'Optimise & Scale', 'description' => 'We continuously monitor performance, refine our approach, and scale what works to maximise your ROI.'],
    ];
}
?>

<section class="ds-page-process" data-section-theme="light">
    <div class="ds-page-process-container">
        <div class="ds-page-process-header">
            <span class="ds-page-process-label"><?php echo wp_kses_post($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="ds-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="ds-page-process-step">
                    <div class="ds-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="ds-page-process-content">
                        <h3><?php echo wp_kses_post(ds_wysiwyg_or_default($step['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(ds_wysiwyg_or_default($step['description'] ?? '', '')); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 3 - Integrated Approach
// ACF Fields:
// - ds_integrated_heading_line1 (WYSIWYG)
// - ds_integrated_heading_line2 (WYSIWYG)
// - ds_integrated_content (WYSIWYG)
// - ds_integrated_image (Image)
// - ds_integrated_button (Link)
// ============================================
$integrated_heading_line1 = ds_wysiwyg_or_default($has_acf ? get_field('ds_integrated_heading_line1') : '', 'Integrated');
$integrated_heading_line2 = ds_wysiwyg_or_default($has_acf ? get_field('ds_integrated_heading_line2') : '', 'Approach');
$integrated_content = $has_acf ? get_field('ds_integrated_content') : '';
$integrated_image = $has_acf ? get_field('ds_integrated_image') : null;
$integrated_button = $has_acf ? ds_link(get_field('ds_integrated_button')) : null;
$integrated_image_url = ($integrated_image && is_array($integrated_image) && !empty($integrated_image['url'])) ? esc_url($integrated_image['url']) : '';
if (!$integrated_button) $integrated_button = ['url' => '#contact', 'title' => 'Learn More', 'target' => '_self'];
?>

<section class="ds-page-info ds-page-info-3" data-section-theme="light">
    <div class="ds-page-info-container">
        <h2 class="ds-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($integrated_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($integrated_heading_line2); ?></span>
        </h2>
        <div class="ds-page-info-content">
            <div class="ds-page-info-text animate-slide-left">
                <?php if ($integrated_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $integrated_content)); ?>
                <?php else : ?>
                    <p>True digital success comes from an integrated approach where all channels work together. Your SEO supports your content marketing, your social media amplifies your PPC, and your email nurtures leads from every source.</p>
                    <p>We don't work in silos. Our team collaborates across disciplines to ensure every touchpoint in your customer journey is optimised for conversion.</p>
                    <p>The result? A cohesive digital presence that delivers consistent messaging and maximises your return on every marketing pound spent.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($integrated_button['url']); ?>" class="cta-button"><?php echo esc_html($integrated_button['title']); ?></a>
            </div>
            <div class="ds-page-info-image animate-slide-right">
                <?php if ($integrated_image_url) : ?>
                    <img src="<?php echo $integrated_image_url; ?>" alt="Integrated Approach">
                <?php else : ?>
                    <div class="ds-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 3 (With features)
// ACF Fields:
// - ds_long_cta3_label (WYSIWYG)
// - ds_long_cta3_heading_line1 (WYSIWYG)
// - ds_long_cta3_heading_line2 (WYSIWYG)
// - ds_long_cta3_text (WYSIWYG)
// - ds_long_cta3_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - ds_long_cta3_primary_button (Link)
// - ds_long_cta3_secondary_button (Link)
// ============================================
$long_cta3_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta3_label') : '', 'PROVEN RESULTS');
$long_cta3_heading_line1 = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta3_heading_line1') : '', 'Ready to Dominate');
$long_cta3_heading_line2 = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta3_heading_line2') : '', 'Your Market?');
$long_cta3_text = ds_wysiwyg_or_default($has_acf ? get_field('ds_long_cta3_text') : '', '');
$long_cta3_features = $has_acf ? get_field('ds_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? ds_link(get_field('ds_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? ds_link(get_field('ds_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Start Growing Today', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ds-page-longcta ds-page-longcta-3" data-section-theme="light">
    <div class="ds-page-longcta-container">
        <div class="ds-page-longcta-content animate-fade-in">
            <span class="ds-page-longcta-label"><?php echo wp_kses_post($long_cta3_label); ?></span>
            <h2 class="ds-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta3_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta3_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="ds-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="ds-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="ds-page-longcta-feature">
                            <div class="ds-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? ds_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="ds-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(ds_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(ds_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="ds-page-longcta-feature"><div class="ds-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></div><div class="ds-page-longcta-feature-text"><h4>No Long-Term Contracts</h4><p>We believe in earning your business every month</p></div></div>
                    <div class="ds-page-longcta-feature"><div class="ds-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div><div class="ds-page-longcta-feature-text"><h4>Transparent Reporting</h4><p>Monthly reports you can actually understand</p></div></div>
                    <div class="ds-page-longcta-feature"><div class="ds-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="ds-page-longcta-feature-text"><h4>Full Transparency</h4><p>You own everything we create for you</p></div></div>
                <?php endif; ?>
            </div>
            <div class="ds-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta3_primary_button['url']); ?>" class="ds-page-longcta-btn ds-page-longcta-btn-primary"><span><?php echo esc_html($long_cta3_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta3_secondary_button['url']); ?>" class="ds-page-longcta-btn ds-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta3_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// RESULTS SECTION
// ACF Fields:
// - ds_results_label (WYSIWYG)
// - ds_results_heading (WYSIWYG)
// - ds_results_subheading (WYSIWYG)
// - ds_results (Repeater)
//   - industry (WYSIWYG)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - metric1_value (WYSIWYG)
//   - metric1_label (WYSIWYG)
//   - metric2_value (WYSIWYG)
//   - metric2_label (WYSIWYG)
//   - image (Image)
// ============================================
$results_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_results_label') : '', 'Case Studies');
$results_heading = ds_wysiwyg_or_default($has_acf ? get_field('ds_results_heading') : '', 'Real <span class="highlight-text-italic">Results</span>');
$results_subheading = ds_wysiwyg_or_default($has_acf ? get_field('ds_results_subheading') : '', 'See how we\'ve helped businesses like yours achieve remarkable growth');
$results = $has_acf ? get_field('ds_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'E-commerce', 'title' => 'Online Retailer', 'description' => 'Developed integrated strategy combining SEO, PPC and email that tripled their online revenue.', 'metric1_value' => '+300%', 'metric1_label' => 'Revenue', 'metric2_value' => '+180%', 'metric2_label' => 'Traffic', 'image' => null],
        ['industry' => 'Professional Services', 'title' => 'B2B SaaS Company', 'description' => 'Created multi-channel approach that transformed their digital presence and lead generation.', 'metric1_value' => '+250%', 'metric1_label' => 'Leads', 'metric2_value' => '-40%', 'metric2_label' => 'CPA', 'image' => null],
        ['industry' => 'Healthcare', 'title' => 'Private Clinic', 'description' => 'Built comprehensive local strategy that made them the go-to provider in their region.', 'metric1_value' => '#1', 'metric1_label' => 'Local Ranking', 'metric2_value' => '+400%', 'metric2_label' => 'Enquiries', 'image' => null],
    ];
}
?>

<section class="ds-page-results" data-section-theme="light">
    <div class="ds-page-results-container">
        <div class="ds-page-results-header">
            <span class="ds-page-results-label"><?php echo wp_kses_post($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="ds-page-results-grid">
            <?php foreach ($results as $result) : 
                $result_image = null;
                if (!empty($result['image']) && is_array($result['image']) && !empty($result['image']['url'])) {
                    $result_image = esc_url($result['image']['url']);
                }
            ?>
                <div class="ds-page-result-card">
                    <div class="ds-page-result-image">
                        <?php if ($result_image) : ?>
                            <img src="<?php echo $result_image; ?>" alt="<?php echo esc_attr(strip_tags($result['title'] ?? 'Case Study')); ?>">
                        <?php else : ?>
                            <div class="ds-page-result-placeholder"><span><?php echo esc_html(substr(strip_tags($result['title'] ?? 'C'), 0, 1)); ?></span></div>
                        <?php endif; ?>
                    </div>
                    <div class="ds-page-result-content">
                        <span class="ds-page-result-industry"><?php echo wp_kses_post(ds_wysiwyg_or_default($result['industry'] ?? '', '')); ?></span>
                        <h3><?php echo wp_kses_post(ds_wysiwyg_or_default($result['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(ds_wysiwyg_or_default($result['description'] ?? '', '')); ?></p>
                        <div class="ds-page-result-metrics">
                            <div class="ds-page-result-metric">
                                <span class="ds-page-result-metric-value"><?php echo wp_kses_post(ds_wysiwyg_or_default($result['metric1_value'] ?? '', '')); ?></span>
                                <span class="ds-page-result-metric-label"><?php echo wp_kses_post(ds_wysiwyg_or_default($result['metric1_label'] ?? '', '')); ?></span>
                            </div>
                            <div class="ds-page-result-metric">
                                <span class="ds-page-result-metric-value"><?php echo wp_kses_post(ds_wysiwyg_or_default($result['metric2_value'] ?? '', '')); ?></span>
                                <span class="ds-page-result-metric-label"><?php echo wp_kses_post(ds_wysiwyg_or_default($result['metric2_label'] ?? '', '')); ?></span>
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
// - ds_faq_label (WYSIWYG)
// - ds_faq_heading (WYSIWYG)
// - ds_faqs (Repeater)
//   - question (WYSIWYG)
//   - answer (WYSIWYG)
// ============================================
$faq_label = ds_wysiwyg_or_default($has_acf ? get_field('ds_faq_label') : '', 'FAQ');
$faq_heading = ds_wysiwyg_or_default($has_acf ? get_field('ds_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('ds_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'What is included in a digital strategy?', 'answer' => 'Our digital strategies typically include market analysis, competitor research, channel recommendations, content planning, budget allocation, KPI setting, and an implementation roadmap tailored to your business goals.'],
        ['question' => 'How long does it take to see results?', 'answer' => 'Results vary by channel. PPC can show results within days, while SEO typically takes 3-6 months. We set realistic expectations and provide regular progress updates throughout.'],
        ['question' => 'Do you work with businesses of all sizes?', 'answer' => 'Yes, we work with everyone from startups to established enterprises. Our strategies are scalable and tailored to your specific budget and growth objectives.'],
        ['question' => 'How do you measure success?', 'answer' => 'We establish clear KPIs at the start of every project and provide monthly reports tracking performance against these metrics. We focus on metrics that matter to your business, not vanity metrics.'],
        ['question' => 'What makes you different from other agencies?', 'answer' => 'We take an integrated approach where all channels work together. We\'re transparent about what we do and why, and we focus on delivering measurable business outcomes, not just marketing metrics.'],
    ];
}
?>

<section class="ds-page-faq" data-section-theme="light">
    <div class="ds-page-faq-container">
        <div class="ds-page-faq-header">
            <span class="ds-page-faq-label"><?php echo wp_kses_post($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="ds-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="ds-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="ds-page-faq-question" aria-expanded="false">
                        <span><?php echo wp_kses_post(ds_wysiwyg_or_default($faq['question'] ?? '', '')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="ds-page-faq-answer"><p><?php echo wp_kses_post(ds_wysiwyg_or_default($faq['answer'] ?? '', '')); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Long CTA Section - Before Reviews -->
<section class="long-cta-section" data-section-theme="light">
  <div class="long-cta-container">
    <div class="long-cta-content animate-fade-in">
      <span class="long-cta-label">LET'S TALK STRATEGY</span>

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