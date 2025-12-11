<?php
/**
 * Template Name: Web Development Services
 * All classes prefixed with webdev-page- for independent styling
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
// - webdev_hero_label (WYSIWYG)
// - webdev_hero_heading_line_1 (WYSIWYG)
// - webdev_hero_heading_line_2 (WYSIWYG)
// - webdev_hero_description (WYSIWYG)
// - webdev_hero_background_type (Select: none, image, video)
// - webdev_hero_background_image (Image)
// - webdev_hero_background_video_mp4 (File)
// - webdev_hero_background_video_webm (File)
// - webdev_hero_background_video_poster (Image)
// - webdev_hero_background_overlay_opacity (Number)
// - webdev_hero_primary_button (Link)
// - webdev_hero_secondary_button (Link)
// ============================================
$hero_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_hero_label') : '', 'Web Development');
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_hero_heading_line_1') : '', 'Build Powerful');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_hero_heading_line_2') : '', '<span class="highlight-text-italic">Digital Experiences</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('webdev_hero_description') : '', 'Custom web development solutions that deliver performance, scalability, and exceptional user experiences for your business.');

$hero_bg_type = $has_acf ? (get_field('webdev_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('webdev_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('webdev_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('webdev_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('webdev_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('webdev_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? hd_link(get_field('webdev_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? hd_link(get_field('webdev_hero_secondary_button')) : null;

if (!$hero_primary_btn) $hero_primary_btn = ['url' => '#contact', 'title' => 'Start Your Project', 'target' => '_self'];
if (!$hero_secondary_btn) $hero_secondary_btn = ['url' => '#services', 'title' => 'Our Services', 'target' => '_self'];

$hero_image_url = ($hero_bg_image && is_array($hero_bg_image) && !empty($hero_bg_image['url'])) ? esc_url($hero_bg_image['url']) : '';
$hero_video_poster_url = ($hero_bg_video_poster && is_array($hero_bg_video_poster) && !empty($hero_bg_video_poster['url'])) ? esc_url($hero_bg_video_poster['url']) : '';

$hero_video_mp4_url = ($hero_bg_video_mp4 && is_array($hero_bg_video_mp4) && !empty($hero_bg_video_mp4['url'])) ? esc_url($hero_bg_video_mp4['url']) : '';
$hero_video_webm_url = ($hero_bg_video_webm && is_array($hero_bg_video_webm) && !empty($hero_bg_video_webm['url'])) ? esc_url($hero_bg_video_webm['url']) : '';

$has_hero_media = ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) || ($hero_bg_type === 'image' && $hero_image_url);
$hero_text_class = $has_hero_media ? 'has-media' : '';
?>

<!-- HERO -->
<section class="webdev-page-hero" data-section-theme="dark">
  <div class="webdev-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="webdev-page-hero-video">
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="Web Development Services" class="webdev-page-hero-image">
    <?php endif; ?>
    <div class="webdev-page-hero-overlay"></div>
  </div>

  <div class="webdev-page-hero-content">
    <div class="webdev-page-hero-text animate-fade-in">
      <span class="webdev-page-hero-label"><?php echo wp_kses_post($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="webdev-page-hero-description">
        <?php echo wp_kses_post($hero_desc); ?>
      </p>

      <a href="<?php echo $hero_primary_btn['url']; ?>" target="<?php echo $hero_primary_btn['target']; ?>" class="cta-btn">
        <span><?php echo $hero_primary_btn['title']; ?></span>
      </a>
    </div>
  </div>

  <!-- Decorative Shapes -->
  <div class="webdev-page-hero-shapes">
    <div class="webdev-page-shape webdev-page-shape-1"></div>
    <div class="webdev-page-shape webdev-page-shape-2"></div>
  </div>
</section>

<?php
// ============================================
// STATS SECTION
// ACF Fields:
// - webdev_stats (Repeater)
//   - number (WYSIWYG)
//   - label (WYSIWYG)
// ============================================
$stats = $has_acf ? get_field('webdev_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '200+', 'label' => 'Websites Launched'],
        ['number' => '99.9%', 'label' => 'Uptime Guaranteed'],
        ['number' => '50ms', 'label' => 'Average Load Time'],
        ['number' => '100%', 'label' => 'Client Satisfaction'],
    ];
}
?>

<section class="webdev-page-stats" data-section-theme="light">
    <div class="webdev-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="webdev-page-stat-item">
                <span class="webdev-page-stat-number"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['number'] ?? '', '')); ?></span>
                <span class="webdev-page-stat-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['label'] ?? '', '')); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is Web Development?
// ACF Fields:
// - webdev_what_is_heading_line1 (WYSIWYG)
// - webdev_what_is_heading_line2 (WYSIWYG)
// - webdev_what_is_content (WYSIWYG)
// - webdev_what_is_image (Image)
// - webdev_what_is_button (Link)
// ============================================
$what_is_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_what_is_heading_line1') : '', 'What is');
$what_is_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_what_is_heading_line2') : '', 'Web Development?');
$what_is_content = $has_acf ? get_field('webdev_what_is_content') : '';
$what_is_image = $has_acf ? get_field('webdev_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('webdev_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="webdev-page-info webdev-page-info-1" data-section-theme="light">
    <div class="webdev-page-info-container">
        <h2 class="webdev-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($what_is_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($what_is_heading_line2); ?></span>
        </h2>
        <div class="webdev-page-info-content">
            <div class="webdev-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>Web development is the art and science of building websites and web applications that work seamlessly across all devices and browsers. It encompasses everything from simple static pages to complex web-based applications.</p>
                    <p>At Hagerty Digital, we don't just write code – we architect digital solutions that solve real business problems. Our development process focuses on performance, security, and user experience.</p>
                    <p>Whether you need a WordPress site, a custom web application, or an e-commerce platform, we build solutions that grow with your business.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="webdev-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is Web Development">
                <?php else : ?>
                    <div class="webdev-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1
// ACF Fields:
// - webdev_long_cta1_label (WYSIWYG)
// - webdev_long_cta1_heading_line1 (WYSIWYG)
// - webdev_long_cta1_heading_line2 (WYSIWYG)
// - webdev_long_cta1_text (WYSIWYG)
// - webdev_long_cta1_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - webdev_long_cta1_primary_button (Link)
// - webdev_long_cta1_secondary_button (Link)
// ============================================
$long_cta1_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta1_label') : '', 'CUSTOM SOLUTIONS');
$long_cta1_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta1_heading_line1') : '', 'Built for Performance');
$long_cta1_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta1_heading_line2') : '', 'Designed for Growth');
$long_cta1_text = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta1_text') : '', '');
$long_cta1_features = $has_acf ? get_field('webdev_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('webdev_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('webdev_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Project', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="webdev-page-longcta webdev-page-longcta-1" data-section-theme="light">
    <div class="webdev-page-longcta-container">
        <div class="webdev-page-longcta-content animate-fade-in">
            <span class="webdev-page-longcta-label"><?php echo wp_kses_post($long_cta1_label); ?></span>
            <h2 class="webdev-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta1_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta1_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="webdev-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="webdev-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="webdev-page-longcta-feature">
                            <div class="webdev-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="webdev-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="webdev-page-longcta-feature"><div class="webdev-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div><div class="webdev-page-longcta-feature-text"><h4>Responsive Design</h4><p>Websites that look perfect on every device, from mobile to desktop</p></div></div>
                    <div class="webdev-page-longcta-feature"><div class="webdev-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div><div class="webdev-page-longcta-feature-text"><h4>Lightning Fast</h4><p>Optimised code and infrastructure for blazing-fast load times</p></div></div>
                    <div class="webdev-page-longcta-feature"><div class="webdev-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="webdev-page-longcta-feature-text"><h4>Secure & Reliable</h4><p>Enterprise-grade security with 99.9% uptime guarantee</p></div></div>
                <?php endif; ?>
            </div>
            <div class="webdev-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="webdev-page-longcta-btn webdev-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="webdev-page-longcta-btn webdev-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES SECTION
// ACF Fields:
// - webdev_services_label (WYSIWYG)
// - webdev_services_heading (WYSIWYG)
// - webdev_services_subheading (WYSIWYG)
// - webdev_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$services_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_services_label') : '', 'What We Offer');
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdev_services_heading') : '', 'Our Development <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('webdev_services_subheading') : '', 'Comprehensive web development solutions tailored to your business needs');
$services = $has_acf ? get_field('webdev_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'WordPress Development', 'description' => 'Custom themes, plugins, and integrations built to your exact specifications.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>'],
        ['title' => 'Custom Web Applications', 'description' => 'Bespoke applications designed to streamline your business processes.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>'],
        ['title' => 'E-commerce Solutions', 'description' => 'WooCommerce and Shopify stores that convert visitors into customers.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>'],
        ['title' => 'API Development', 'description' => 'RESTful APIs and integrations that connect your systems seamlessly.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>'],
    ];
}
?>

<section class="webdev-page-services" id="services" data-section-theme="light">
    <div class="webdev-page-services-container">
        <div class="webdev-page-services-header">
            <span class="webdev-page-services-label"><?php echo wp_kses_post($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="webdev-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="webdev-page-service-card">
                    <div class="webdev-page-service-icon"><?php echo hd_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(hd_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - Why Choose Us (Reversed)
// ACF Fields:
// - webdev_why_different_heading_line1 (WYSIWYG)
// - webdev_why_different_heading_line2 (WYSIWYG)
// - webdev_why_different_content (WYSIWYG)
// - webdev_why_different_image (Image)
// - webdev_why_different_button (Link)
// ============================================
$why_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_why_different_heading_line1') : '', 'Why Choose');
$why_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_why_different_heading_line2') : '', 'Hagerty Digital?');
$why_content = $has_acf ? get_field('webdev_why_different_content') : '';
$why_image = $has_acf ? get_field('webdev_why_different_image') : null;
$why_button = $has_acf ? hd_link(get_field('webdev_why_different_button')) : null;
$why_image_url = ($why_image && is_array($why_image) && !empty($why_image['url'])) ? esc_url($why_image['url']) : '';
if (!$why_button) $why_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="webdev-page-info webdev-page-info-2" data-section-theme="light">
    <div class="webdev-page-info-container">
        <h2 class="webdev-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($why_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($why_heading_line2); ?></span>
        </h2>
        <div class="webdev-page-info-content webdev-page-info-reversed">
            <div class="webdev-page-info-image animate-slide-left">
                <?php if ($why_image_url) : ?>
                    <img src="<?php echo $why_image_url; ?>" alt="Why Choose Us">
                <?php else : ?>
                    <div class="webdev-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="webdev-page-info-text animate-slide-right">
                <?php if ($why_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $why_content)); ?>
                <?php else : ?>
                    <p>We don't just build websites – we craft digital experiences that drive real business results. Our team combines technical expertise with creative problem-solving to deliver solutions that exceed expectations.</p>
                    <p>Every project starts with understanding your goals. We take the time to learn your business, your audience, and your vision before writing a single line of code.</p>
                    <p>From initial concept to ongoing support, we're with you every step of the way. Our transparent process keeps you informed and in control throughout the development journey.</p>
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
// - webdev_long_cta2_label (WYSIWYG)
// - webdev_long_cta2_heading_line1 (WYSIWYG)
// - webdev_long_cta2_heading_line2 (WYSIWYG)
// - webdev_long_cta2_text (WYSIWYG)
// - webdev_long_cta2_primary_button (Link)
// - webdev_long_cta2_secondary_button (Link)
// ============================================
$long_cta2_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta2_label') : '', 'FREE CONSULTATION');
$long_cta2_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta2_heading_line1') : '', 'Ready to Build');
$long_cta2_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta2_heading_line2') : '', 'Something Amazing?');
$long_cta2_text = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta2_text') : '', 'Let\'s discuss your project. We\'ll provide a detailed proposal outlining timeline, technology stack, and investment required to bring your vision to life.');
$long_cta2_primary_button = $has_acf ? hd_link(get_field('webdev_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('webdev_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Get a Free Quote', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="webdev-page-longcta webdev-page-longcta-2" data-section-theme="light">
    <div class="webdev-page-longcta-container">
        <div class="webdev-page-longcta-content animate-fade-in">
            <span class="webdev-page-longcta-label"><?php echo wp_kses_post($long_cta2_label); ?></span>
            <h2 class="webdev-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta2_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta2_heading_line2); ?></span>
            </h2>
            <p class="webdev-page-longcta-text"><?php echo wp_kses_post($long_cta2_text); ?></p>
            <div class="webdev-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="webdev-page-longcta-btn webdev-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="webdev-page-longcta-btn webdev-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS SECTION
// ACF Fields:
// - webdev_process_label (WYSIWYG)
// - webdev_process_heading (WYSIWYG)
// - webdev_process_subheading (WYSIWYG)
// - webdev_process_steps (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// ============================================
$process_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_process_label') : '', 'How We Work');
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdev_process_heading') : '', 'Our Development <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('webdev_process_subheading') : '', 'A proven methodology that delivers consistent, high-quality results');
$process_steps = $has_acf ? get_field('webdev_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Discovery & Planning', 'description' => 'We start by understanding your business, goals, and requirements. This phase includes stakeholder interviews, technical research, and project scoping.'],
        ['title' => 'Design & Prototyping', 'description' => 'Our designers create wireframes and visual mockups for your approval. You\'ll see exactly how your site will look before development begins.'],
        ['title' => 'Development & Testing', 'description' => 'Our developers bring the designs to life with clean, efficient code. Rigorous testing ensures everything works perfectly across all devices.'],
        ['title' => 'Launch & Support', 'description' => 'We handle deployment, provide training, and offer ongoing maintenance to keep your site secure, fast, and up-to-date.'],
    ];
}
?>

<section class="webdev-page-process" data-section-theme="light">
    <div class="webdev-page-process-container">
        <div class="webdev-page-process-header">
            <span class="webdev-page-process-label"><?php echo wp_kses_post($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="webdev-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="webdev-page-process-step">
                    <div class="webdev-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="webdev-page-process-content">
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
// INFO SECTION 3 - Technologies
// ACF Fields:
// - webdev_tech_heading_line1 (WYSIWYG)
// - webdev_tech_heading_line2 (WYSIWYG)
// - webdev_tech_content (WYSIWYG)
// - webdev_tech_image (Image)
// - webdev_tech_button (Link)
// ============================================
$tech_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_tech_heading_line1') : '', 'Our');
$tech_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_tech_heading_line2') : '', 'Tech Stack');
$tech_content = $has_acf ? get_field('webdev_tech_content') : '';
$tech_image = $has_acf ? get_field('webdev_tech_image') : null;
$tech_button = $has_acf ? hd_link(get_field('webdev_tech_button')) : null;
$tech_image_url = ($tech_image && is_array($tech_image) && !empty($tech_image['url'])) ? esc_url($tech_image['url']) : '';
if (!$tech_button) $tech_button = ['url' => '#contact', 'title' => 'Discuss Your Stack', 'target' => '_self'];
?>

<section class="webdev-page-info webdev-page-info-3" data-section-theme="light">
    <div class="webdev-page-info-container">
        <h2 class="webdev-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($tech_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($tech_heading_line2); ?></span>
        </h2>
        <div class="webdev-page-info-content">
            <div class="webdev-page-info-text animate-slide-left">
                <?php if ($tech_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $tech_content)); ?>
                <?php else : ?>
                    <p>We work with modern, battle-tested technologies that ensure your project is built on a solid foundation. From WordPress and PHP to React and Node.js, we choose the right tools for each unique challenge.</p>
                    <p>Our expertise spans content management systems, e-commerce platforms, custom frameworks, and cloud infrastructure. We're technology-agnostic – we recommend what's best for your specific needs.</p>
                    <p>Whether you need a simple brochure site or a complex web application, our technical versatility means we can deliver exactly what you need.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($tech_button['url']); ?>" class="cta-button"><?php echo esc_html($tech_button['title']); ?></a>
            </div>
            <div class="webdev-page-info-image animate-slide-right">
                <?php if ($tech_image_url) : ?>
                    <img src="<?php echo $tech_image_url; ?>" alt="Our Tech Stack">
                <?php else : ?>
                    <div class="webdev-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 3
// ACF Fields:
// - webdev_long_cta3_label (WYSIWYG)
// - webdev_long_cta3_heading_line1 (WYSIWYG)
// - webdev_long_cta3_heading_line2 (WYSIWYG)
// - webdev_long_cta3_text (WYSIWYG)
// - webdev_long_cta3_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - webdev_long_cta3_primary_button (Link)
// - webdev_long_cta3_secondary_button (Link)
// ============================================
$long_cta3_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta3_label') : '', 'WHY WAIT?');
$long_cta3_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta3_heading_line1') : '', 'Your Next Website');
$long_cta3_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta3_heading_line2') : '', 'Starts Here');
$long_cta3_text = hd_wysiwyg_or_default($has_acf ? get_field('webdev_long_cta3_text') : '', '');
$long_cta3_features = $has_acf ? get_field('webdev_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? hd_link(get_field('webdev_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? hd_link(get_field('webdev_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Get Started Today', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="webdev-page-longcta webdev-page-longcta-3" data-section-theme="light">
    <div class="webdev-page-longcta-container">
        <div class="webdev-page-longcta-content animate-fade-in">
            <span class="webdev-page-longcta-label"><?php echo wp_kses_post($long_cta3_label); ?></span>
            <h2 class="webdev-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta3_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta3_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="webdev-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="webdev-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="webdev-page-longcta-feature">
                            <div class="webdev-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="webdev-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="webdev-page-longcta-feature"><div class="webdev-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></div><div class="webdev-page-longcta-feature-text"><h4>No Hidden Costs</h4><p>Transparent pricing with detailed quotes upfront</p></div></div>
                    <div class="webdev-page-longcta-feature"><div class="webdev-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><div class="webdev-page-longcta-feature-text"><h4>On-Time Delivery</h4><p>We stick to deadlines and keep you informed throughout</p></div></div>
                    <div class="webdev-page-longcta-feature"><div class="webdev-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg></div><div class="webdev-page-longcta-feature-text"><h4>Ongoing Support</h4><p>We're here to help long after your site launches</p></div></div>
                <?php endif; ?>
            </div>
            <div class="webdev-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta3_primary_button['url']); ?>" class="webdev-page-longcta-btn webdev-page-longcta-btn-primary"><span><?php echo esc_html($long_cta3_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta3_secondary_button['url']); ?>" class="webdev-page-longcta-btn webdev-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta3_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// RESULTS SECTION
// ACF Fields:
// - webdev_results_label (WYSIWYG)
// - webdev_results_heading (WYSIWYG)
// - webdev_results_subheading (WYSIWYG)
// - webdev_results (Repeater)
//   - industry (WYSIWYG)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - metric1_value (WYSIWYG)
//   - metric1_label (WYSIWYG)
//   - metric2_value (WYSIWYG)
//   - metric2_label (WYSIWYG)
//   - image (Image)
// ============================================
$results_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_results_label') : '', 'Case Studies');
$results_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdev_results_heading') : '', 'Real <span class="highlight-text-italic">Results</span>');
$results_subheading = hd_wysiwyg_or_default($has_acf ? get_field('webdev_results_subheading') : '', 'See how we\'ve helped businesses transform their digital presence');
$results = $has_acf ? get_field('webdev_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'E-commerce', 'title' => 'Fashion Retailer', 'description' => 'Custom WooCommerce build with 200% conversion improvement.', 'metric1_value' => '+200%', 'metric1_label' => 'Conversions', 'metric2_value' => '1.2s', 'metric2_label' => 'Load Time', 'image' => null],
        ['industry' => 'Professional Services', 'title' => 'Architecture Firm', 'description' => 'Portfolio website with immersive project showcases.', 'metric1_value' => '+180%', 'metric1_label' => 'Enquiries', 'metric2_value' => '45%', 'metric2_label' => 'Lower Bounce', 'image' => null],
        ['industry' => 'Technology', 'title' => 'SaaS Platform', 'description' => 'Custom web application with advanced user dashboard.', 'metric1_value' => '10k+', 'metric1_label' => 'Active Users', 'metric2_value' => '99.9%', 'metric2_label' => 'Uptime', 'image' => null],
    ];
}
?>

<section class="webdev-page-results" data-section-theme="light">
    <div class="webdev-page-results-container">
        <div class="webdev-page-results-header">
            <span class="webdev-page-results-label"><?php echo wp_kses_post($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="webdev-page-results-grid">
            <?php foreach ($results as $result) : 
                $result_image = null;
                if (!empty($result['image']) && is_array($result['image']) && !empty($result['image']['url'])) {
                    $result_image = esc_url($result['image']['url']);
                }
            ?>
                <div class="webdev-page-result-card">
                    <div class="webdev-page-result-image">
                        <?php if ($result_image) : ?>
                            <img src="<?php echo $result_image; ?>" alt="<?php echo esc_attr(strip_tags($result['title'] ?? 'Case Study')); ?>">
                        <?php else : ?>
                            <div class="webdev-page-result-placeholder"><span><?php echo esc_html(substr(strip_tags($result['title'] ?? 'C'), 0, 1)); ?></span></div>
                        <?php endif; ?>
                    </div>
                    <div class="webdev-page-result-content">
                        <span class="webdev-page-result-industry"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['industry'] ?? '', '')); ?></span>
                        <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($result['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(hd_wysiwyg_or_default($result['description'] ?? '', '')); ?></p>
                        <div class="webdev-page-result-metrics">
                            <div class="webdev-page-result-metric">
                                <span class="webdev-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_value'] ?? '', '')); ?></span>
                                <span class="webdev-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_label'] ?? '', '')); ?></span>
                            </div>
                            <div class="webdev-page-result-metric">
                                <span class="webdev-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_value'] ?? '', '')); ?></span>
                                <span class="webdev-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_label'] ?? '', '')); ?></span>
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
// - webdev_faq_label (WYSIWYG)
// - webdev_faq_heading (WYSIWYG)
// - webdev_faqs (Repeater)
//   - question (WYSIWYG)
//   - answer (WYSIWYG)
// ============================================
$faq_label = hd_wysiwyg_or_default($has_acf ? get_field('webdev_faq_label') : '', 'FAQ');
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('webdev_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('webdev_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How long does it take to build a website?', 'answer' => 'Timeline depends on complexity. A simple brochure site takes 4-6 weeks, while complex applications can take 3-6 months. We\'ll provide a detailed timeline during our discovery phase.'],
        ['question' => 'What platforms do you develop on?', 'answer' => 'We specialise in WordPress, WooCommerce, Shopify, and custom PHP/JavaScript applications. We recommend the best platform based on your specific requirements.'],
        ['question' => 'Do you provide ongoing maintenance?', 'answer' => 'Yes! We offer comprehensive maintenance packages including security updates, backups, performance monitoring, and content updates to keep your site running smoothly.'],
        ['question' => 'How much does web development cost?', 'answer' => 'Projects typically range from £3,000 for simple sites to £50,000+ for complex applications. We provide detailed quotes after understanding your requirements.'],
        ['question' => 'Will I be able to update the site myself?', 'answer' => 'Absolutely. We build all sites with user-friendly content management systems and provide training so you can make updates independently.'],
    ];
}
?>

<section class="webdev-page-faq" data-section-theme="light">
    <div class="webdev-page-faq-container">
        <div class="webdev-page-faq-header">
            <span class="webdev-page-faq-label"><?php echo wp_kses_post($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="webdev-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="webdev-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="webdev-page-faq-question" aria-expanded="false">
                        <span><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['question'] ?? '', '')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="webdev-page-faq-answer"><p><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['answer'] ?? '', '')); ?></p></div>
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
                <h4>Michael T.</h4>
                <p class="review-date">2025-01-20</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Hagerty Digital built our e-commerce site from scratch. The attention to detail and technical expertise was outstanding. Our sales have increased by 150% since launch.</p>
          </div>

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#34a853;">E</div>
              <div class="reviewer-info">
                <h4>Emma W.</h4>
                <p class="review-date">2025-02-08</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Professional, responsive, and genuinely invested in our success. They took our outdated website and transformed it into something we're truly proud of.</p>
          </div>

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#fbbc05;">D</div>
              <div class="reviewer-info">
                <h4>David K.</h4>
                <p class="review-date">2025-03-05</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">The custom web application they developed has streamlined our entire business. What used to take hours now takes minutes. Highly recommended!</p>
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