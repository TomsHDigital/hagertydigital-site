<?php
/**
 * Template Name: PPC Services
 * All classes prefixed with ppc-page- for independent styling
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
// - ppc_hero_label (WYSIWYG)
// - ppc_hero_heading_line_1 (WYSIWYG)
// - ppc_hero_heading_line_2 (WYSIWYG)
// - ppc_hero_description (WYSIWYG)
// - ppc_hero_background_type (Select: none, image, video)
// - ppc_hero_background_image (Image)
// - ppc_hero_background_video_mp4 (File)
// - ppc_hero_background_video_webm (File)
// - ppc_hero_background_video_poster (Image)
// - ppc_hero_background_overlay_opacity (Number)
// - ppc_hero_primary_button (Link)
// - ppc_hero_secondary_button (Link)
// ============================================
$hero_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_hero_label') : '', 'Pay-Per-Click Advertising');
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_hero_heading_line_1') : '', 'Instant Visibility');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_hero_heading_line_2') : '', '<span class="highlight-text-italic">Maximum ROI</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('ppc_hero_description') : '', 'PPC really is for every business and it can help you get new customers in the short and long term. You spend money to make money.');

$hero_bg_type = $has_acf ? (get_field('ppc_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('ppc_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('ppc_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('ppc_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('ppc_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('ppc_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? hd_link(get_field('ppc_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? hd_link(get_field('ppc_hero_secondary_button')) : null;

if (!$hero_primary_btn) $hero_primary_btn = ['url' => '#contact', 'title' => 'Get Your Free Audit', 'target' => '_self'];
if (!$hero_secondary_btn) $hero_secondary_btn = ['url' => '#services', 'title' => 'Our Services', 'target' => '_self'];

$hero_image_url = ($hero_bg_image && is_array($hero_bg_image) && !empty($hero_bg_image['url'])) ? esc_url($hero_bg_image['url']) : '';
$hero_video_poster_url = ($hero_bg_video_poster && is_array($hero_bg_video_poster) && !empty($hero_bg_video_poster['url'])) ? esc_url($hero_bg_video_poster['url']) : '';

$hero_video_mp4_url = ($hero_bg_video_mp4 && is_array($hero_bg_video_mp4) && !empty($hero_bg_video_mp4['url'])) ? esc_url($hero_bg_video_mp4['url']) : '';
$hero_video_webm_url = ($hero_bg_video_webm && is_array($hero_bg_video_webm) && !empty($hero_bg_video_webm['url'])) ? esc_url($hero_bg_video_webm['url']) : '';

$has_hero_media = ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) || ($hero_bg_type === 'image' && $hero_image_url);
$hero_text_class = $has_hero_media ? 'has-media' : '';
?>

<!-- HERO -->
<section class="ppc-page-hero" data-section-theme="dark">
  <div class="ppc-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="ppc-page-hero-video">
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="PPC Services" class="ppc-page-hero-image">
    <?php endif; ?>
    <div class="ppc-page-hero-overlay"></div>
  </div>

  <div class="ppc-page-hero-content">
    <div class="ppc-page-hero-text animate-fade-in">
      <span class="ppc-page-hero-label"><?php echo wp_kses_post($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="ppc-page-hero-description">
        <?php echo wp_kses_post($hero_desc); ?>
      </p>

      <a href="<?php echo $hero_primary_btn['url']; ?>" target="<?php echo $hero_primary_btn['target']; ?>" class="cta-btn">
        <span><?php echo $hero_primary_btn['title']; ?></span>
      </a>
    </div>
  </div>

  <!-- Decorative Shapes -->
  <div class="ppc-page-hero-shapes">
    <div class="ppc-page-shape ppc-page-shape-1"></div>
    <div class="ppc-page-shape ppc-page-shape-2"></div>
  </div>
</section>

<?php
// ============================================
// STATS SECTION
// ACF Fields:
// - ppc_stats (Repeater)
//   - number (WYSIWYG)
//   - label (WYSIWYG)
// ============================================
$stats = $has_acf ? get_field('ppc_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '500%', 'label' => 'Average ROAS'],
        ['number' => '10M+', 'label' => 'Ad Spend Managed'],
        ['number' => '£5M+', 'label' => 'Revenue Generated'],
        ['number' => '100+', 'label' => 'Active Campaigns'],
    ];
}
?>

<section class="ppc-page-stats" data-section-theme="light">
    <div class="ppc-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="ppc-page-stat-item">
                <span class="ppc-page-stat-number"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['number'] ?? '', '')); ?></span>
                <span class="ppc-page-stat-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['label'] ?? '', '')); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is PPC?
// ACF Fields:
// - ppc_what_is_heading_line1 (WYSIWYG)
// - ppc_what_is_heading_line2 (WYSIWYG)
// - ppc_what_is_content (WYSIWYG)
// - ppc_what_is_image (Image)
// - ppc_what_is_button (Link)
// ============================================
$what_is_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_what_is_heading_line1') : '', 'What is');
$what_is_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_what_is_heading_line2') : '', 'PPC?');
$what_is_content = $has_acf ? get_field('ppc_what_is_content') : '';
$what_is_image = $has_acf ? get_field('ppc_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('ppc_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="ppc-page-info ppc-page-info-1" data-section-theme="light">
    <div class="ppc-page-info-container">
        <h2 class="ppc-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($what_is_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($what_is_heading_line2); ?></span>
        </h2>
        <div class="ppc-page-info-content">
            <div class="ppc-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>PPC stands for Pay-Per-Click, and in basic terms, you pay money for every click you get through to your website.</p>
                    <p>There is a wide variety of different PPC services, with the main one being Google. Any form of paid advertising that costs you for a click, whether it's on a social platform or a search engine, is PPC.</p>
                    <p>PPC shouldn't be complicated and the way we do it, it isn't. There is a reason why almost every single search you do on Google will return an advert.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="ppc-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is PPC">
                <?php else : ?>
                    <div class="ppc-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1
// ACF Fields:
// - ppc_long_cta1_label (WYSIWYG)
// - ppc_long_cta1_heading_line1 (WYSIWYG)
// - ppc_long_cta1_heading_line2 (WYSIWYG)
// - ppc_long_cta1_text (WYSIWYG)
// - ppc_long_cta1_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - ppc_long_cta1_primary_button (Link)
// - ppc_long_cta1_secondary_button (Link)
// ============================================
$long_cta1_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta1_label') : '', 'READY TO GROW?');
$long_cta1_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta1_heading_line1') : '', 'Let\'s Drive');
$long_cta1_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta1_heading_line2') : '', 'Real Results');
$long_cta1_text = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta1_text') : '', '');
$long_cta1_features = $has_acf ? get_field('ppc_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('ppc_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('ppc_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Campaign', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ppc-page-longcta ppc-page-longcta-1" data-section-theme="light">
    <div class="ppc-page-longcta-container">
        <div class="ppc-page-longcta-content animate-fade-in">
            <span class="ppc-page-longcta-label"><?php echo wp_kses_post($long_cta1_label); ?></span>
            <h2 class="ppc-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta1_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta1_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="ppc-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="ppc-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="ppc-page-longcta-feature">
                            <div class="ppc-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="ppc-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Instant Traffic</h4><p>Start getting qualified visitors to your site within hours of launching</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Transparent Pricing</h4><p>No hidden costs - you decide exactly how much you want to spend</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Measurable Results</h4><p>Track every click, conversion and pound spent in real-time</p></div></div>
                <?php endif; ?>
            </div>
            <div class="ppc-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES SECTION
// ACF Fields:
// - ppc_services_label (WYSIWYG)
// - ppc_services_heading (WYSIWYG)
// - ppc_services_subheading (WYSIWYG)
// - ppc_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$services_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_services_label') : '', 'What We Offer');
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_services_heading') : '', 'Our PPC <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_services_subheading') : '', 'Comprehensive paid advertising solutions tailored to your business goals');
$services = $has_acf ? get_field('ppc_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'Google Ads', 'description' => 'Reach customers actively searching for your products and services on Google.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>'],
        ['title' => 'Social Media Ads', 'description' => 'Target your ideal audience on Facebook, Instagram, LinkedIn and more.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>'],
        ['title' => 'Shopping Campaigns', 'description' => 'Showcase your products directly in search results with eye-catching ads.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>'],
        ['title' => 'Remarketing', 'description' => 'Re-engage visitors who have shown interest in your business before.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>'],
    ];
}
?>

<section class="ppc-page-services" id="services" data-section-theme="light">
    <div class="ppc-page-services-container">
        <div class="ppc-page-services-header">
            <span class="ppc-page-services-label"><?php echo wp_kses_post($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="ppc-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="ppc-page-service-card">
                    <div class="ppc-page-service-icon"><?php echo hd_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(hd_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - How Much Does PPC Cost? (Reversed)
// ACF Fields:
// - ppc_cost_heading_line1 (WYSIWYG)
// - ppc_cost_heading_line2 (WYSIWYG)
// - ppc_cost_content (WYSIWYG)
// - ppc_cost_image (Image)
// - ppc_cost_button (Link)
// ============================================
$cost_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_cost_heading_line1') : '', 'How Much Does');
$cost_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_cost_heading_line2') : '', 'PPC Cost?');
$cost_content = $has_acf ? get_field('ppc_cost_content') : '';
$cost_image = $has_acf ? get_field('ppc_cost_image') : null;
$cost_button = $has_acf ? hd_link(get_field('ppc_cost_button')) : null;
$cost_image_url = ($cost_image && is_array($cost_image) && !empty($cost_image['url'])) ? esc_url($cost_image['url']) : '';
if (!$cost_button) $cost_button = ['url' => '#contact', 'title' => 'Get a Quote', 'target' => '_self'];
?>

<section class="ppc-page-info ppc-page-info-2" data-section-theme="light">
    <div class="ppc-page-info-container">
        <h2 class="ppc-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($cost_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($cost_heading_line2); ?></span>
        </h2>
        <div class="ppc-page-info-content ppc-page-info-reversed">
            <div class="ppc-page-info-image animate-slide-left">
                <?php if ($cost_image_url) : ?>
                    <img src="<?php echo $cost_image_url; ?>" alt="PPC Costs">
                <?php else : ?>
                    <div class="ppc-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="ppc-page-info-text animate-slide-right">
                <?php if ($cost_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $cost_content)); ?>
                <?php else : ?>
                    <p>We offer a transparent management fee, which is based upon your advertising budget, with absolutely no hidden costs.</p>
                    <p>You decide what you spend. We will help you find the "sweet spot" with your advertising spend; however, it is up to you how much you want to spend each month, week or day on advertising.</p>
                    <p>Our team will work with the budget that you are comfortable with to drive direct sales, leads and conversions to your website. Advertising spend should be seen as an investment in your growth, not a cost to the company.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($cost_button['url']); ?>" class="cta-button"><?php echo esc_html($cost_button['title']); ?></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 2 (Simpler, no features)
// ACF Fields:
// - ppc_long_cta2_label (WYSIWYG)
// - ppc_long_cta2_heading_line1 (WYSIWYG)
// - ppc_long_cta2_heading_line2 (WYSIWYG)
// - ppc_long_cta2_text (WYSIWYG)
// - ppc_long_cta2_primary_button (Link)
// - ppc_long_cta2_secondary_button (Link)
// ============================================
$long_cta2_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta2_label') : '', 'FREE PPC AUDIT');
$long_cta2_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta2_heading_line1') : '', 'Discover Your Campaign\'s');
$long_cta2_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta2_heading_line2') : '', 'True Potential');
$long_cta2_text = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta2_text') : '', 'Get a comprehensive analysis of your current PPC campaigns. We\'ll identify wasted spend, missed opportunities, and show you exactly how to improve your return on ad spend.');
$long_cta2_primary_button = $has_acf ? hd_link(get_field('ppc_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('ppc_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Get Your Free Audit', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ppc-page-longcta ppc-page-longcta-2" data-section-theme="light">
    <div class="ppc-page-longcta-container">
        <div class="ppc-page-longcta-content animate-fade-in">
            <span class="ppc-page-longcta-label"><?php echo wp_kses_post($long_cta2_label); ?></span>
            <h2 class="ppc-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta2_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta2_heading_line2); ?></span>
            </h2>
            <p class="ppc-page-longcta-text"><?php echo wp_kses_post($long_cta2_text); ?></p>
            <div class="ppc-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS SECTION
// ACF Fields:
// - ppc_process_label (WYSIWYG)
// - ppc_process_heading (WYSIWYG)
// - ppc_process_subheading (WYSIWYG)
// - ppc_process_steps (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// ============================================
$process_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_process_label') : '', 'How We Work');
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_process_heading') : '', 'Our PPC <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_process_subheading') : '', 'A proven methodology that maximises your return on ad spend');
$process_steps = $has_acf ? get_field('ppc_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Discovery & Strategy', 'description' => 'We start by understanding your business goals, target audience, and competition to create a winning PPC strategy.'],
        ['title' => 'Campaign Setup', 'description' => 'Our team builds your campaigns from the ground up with carefully researched keywords, compelling ad copy, and optimised landing pages.'],
        ['title' => 'Launch & Monitor', 'description' => 'We launch your campaigns and continuously monitor performance, making real-time adjustments to maximise results.'],
        ['title' => 'Optimise & Scale', 'description' => 'Through ongoing optimisation and testing, we improve performance and scale what works to drive even better results.'],
    ];
}
?>

<section class="ppc-page-process" data-section-theme="light">
    <div class="ppc-page-process-container">
        <div class="ppc-page-process-header">
            <span class="ppc-page-process-label"><?php echo wp_kses_post($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="ppc-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="ppc-page-process-step">
                    <div class="ppc-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="ppc-page-process-content">
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
// INFO SECTION 3 - What Makes Us Different?
// ACF Fields:
// - ppc_different_heading_line1 (WYSIWYG)
// - ppc_different_heading_line2 (WYSIWYG)
// - ppc_different_content (WYSIWYG)
// - ppc_different_image (Image)
// - ppc_different_button (Link)
// ============================================
$different_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_different_heading_line1') : '', 'What Makes Us');
$different_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_different_heading_line2') : '', 'Different?');
$different_content = $has_acf ? get_field('ppc_different_content') : '';
$different_image = $has_acf ? get_field('ppc_different_image') : null;
$different_button = $has_acf ? hd_link(get_field('ppc_different_button')) : null;
$different_image_url = ($different_image && is_array($different_image) && !empty($different_image['url'])) ? esc_url($different_image['url']) : '';
if (!$different_button) $different_button = ['url' => '#contact', 'title' => 'Let\'s Talk', 'target' => '_self'];
?>

<section class="ppc-page-info ppc-page-info-3" data-section-theme="light">
    <div class="ppc-page-info-container">
        <h2 class="ppc-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($different_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($different_heading_line2); ?></span>
        </h2>
        <div class="ppc-page-info-content">
            <div class="ppc-page-info-text animate-slide-left">
                <?php if ($different_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $different_content)); ?>
                <?php else : ?>
                    <p>We want to help you understand what PPC is and that it should not just be used as a quick fix, but as a long term plan that will help your business grow.</p>
                    <p>Everything we do, from creating new campaigns, all the way through to new landing pages, we will explain to you our decisions and why making those changes will benefit your business. We want to help you grow.</p>
                    <p>If you want to learn more about PPC then please feel free to give us a call. Even if it is just for a friendly chat.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($different_button['url']); ?>" class="cta-button"><?php echo esc_html($different_button['title']); ?></a>
            </div>
            <div class="ppc-page-info-image animate-slide-right">
                <?php if ($different_image_url) : ?>
                    <img src="<?php echo $different_image_url; ?>" alt="What Makes Us Different">
                <?php else : ?>
                    <div class="ppc-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 3
// ACF Fields:
// - ppc_long_cta3_label (WYSIWYG)
// - ppc_long_cta3_heading_line1 (WYSIWYG)
// - ppc_long_cta3_heading_line2 (WYSIWYG)
// - ppc_long_cta3_text (WYSIWYG)
// - ppc_long_cta3_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - ppc_long_cta3_primary_button (Link)
// - ppc_long_cta3_secondary_button (Link)
// ============================================
$long_cta3_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta3_label') : '', 'PROVEN RESULTS');
$long_cta3_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta3_heading_line1') : '', 'Ready to Maximise');
$long_cta3_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta3_heading_line2') : '', 'Your Ad Spend?');
$long_cta3_text = hd_wysiwyg_or_default($has_acf ? get_field('ppc_long_cta3_text') : '', '');
$long_cta3_features = $has_acf ? get_field('ppc_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? hd_link(get_field('ppc_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? hd_link(get_field('ppc_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Start Growing Today', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ppc-page-longcta ppc-page-longcta-3" data-section-theme="light">
    <div class="ppc-page-longcta-container">
        <div class="ppc-page-longcta-content animate-fade-in">
            <span class="ppc-page-longcta-label"><?php echo wp_kses_post($long_cta3_label); ?></span>
            <h2 class="ppc-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta3_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta3_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="ppc-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="ppc-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="ppc-page-longcta-feature">
                            <div class="ppc-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="ppc-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>No Long-Term Contracts</h4><p>We believe in earning your business every month</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Transparent Reporting</h4><p>Monthly reports you can actually understand</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Google Certified</h4><p>Our team holds Google Ads certifications</p></div></div>
                <?php endif; ?>
            </div>
            <div class="ppc-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta3_primary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-primary"><span><?php echo esc_html($long_cta3_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta3_secondary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta3_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// RESULTS/CASE STUDIES SECTION
// ACF Fields:
// - ppc_results_label (WYSIWYG)
// - ppc_results_heading (WYSIWYG)
// - ppc_results_subheading (WYSIWYG)
// - ppc_results (Repeater)
//   - industry (WYSIWYG)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - metric1_value (WYSIWYG)
//   - metric1_label (WYSIWYG)
//   - metric2_value (WYSIWYG)
//   - metric2_label (WYSIWYG)
//   - image (Image)
// ============================================
$results_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_results_label') : '', 'Case Studies');
$results_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_results_heading') : '', 'Real <span class="highlight-text-italic">Results</span>');
$results_subheading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_results_subheading') : '', 'See how we\'ve helped businesses like yours achieve remarkable growth through PPC');
$results = $has_acf ? get_field('ppc_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'E-commerce', 'title' => 'Online Retailer', 'description' => 'Achieved 500% ROAS within the first 3 months of campaign launch.', 'metric1_value' => '500%', 'metric1_label' => 'ROAS', 'metric2_value' => '+340%', 'metric2_label' => 'Revenue', 'image' => null],
        ['industry' => 'Professional Services', 'title' => 'Law Firm', 'description' => 'Reduced cost per lead by 60% while increasing lead volume.', 'metric1_value' => '-60%', 'metric1_label' => 'Cost Per Lead', 'metric2_value' => '+200%', 'metric2_label' => 'Leads', 'image' => null],
        ['industry' => 'Healthcare', 'title' => 'Private Clinic', 'description' => 'Generated consistent appointment bookings through targeted campaigns.', 'metric1_value' => '£15', 'metric1_label' => 'Cost Per Booking', 'metric2_value' => '+450%', 'metric2_label' => 'Bookings', 'image' => null],
    ];
}
?>

<section class="ppc-page-results" data-section-theme="light">
    <div class="ppc-page-results-container">
        <div class="ppc-page-results-header">
            <span class="ppc-page-results-label"><?php echo wp_kses_post($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="ppc-page-results-grid">
            <?php foreach ($results as $result) : 
                $result_image = null;
                if (!empty($result['image']) && is_array($result['image']) && !empty($result['image']['url'])) {
                    $result_image = esc_url($result['image']['url']);
                }
            ?>
                <div class="ppc-page-result-card">
                    <div class="ppc-page-result-image">
                        <?php if ($result_image) : ?>
                            <img src="<?php echo $result_image; ?>" alt="<?php echo esc_attr(strip_tags($result['title'] ?? 'Case Study')); ?>">
                        <?php else : ?>
                            <div class="ppc-page-result-placeholder"><span><?php echo esc_html(substr(strip_tags($result['title'] ?? 'C'), 0, 1)); ?></span></div>
                        <?php endif; ?>
                    </div>
                    <div class="ppc-page-result-content">
                        <span class="ppc-page-result-industry"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['industry'] ?? '', '')); ?></span>
                        <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($result['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(hd_wysiwyg_or_default($result['description'] ?? '', '')); ?></p>
                        <div class="ppc-page-result-metrics">
                            <div class="ppc-page-result-metric">
                                <span class="ppc-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_value'] ?? '', '')); ?></span>
                                <span class="ppc-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_label'] ?? '', '')); ?></span>
                            </div>
                            <div class="ppc-page-result-metric">
                                <span class="ppc-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_value'] ?? '', '')); ?></span>
                                <span class="ppc-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_label'] ?? '', '')); ?></span>
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
// - ppc_faq_label (WYSIWYG)
// - ppc_faq_heading (WYSIWYG)
// - ppc_faqs (Repeater)
//   - question (WYSIWYG)
//   - answer (WYSIWYG)
// ============================================
$faq_label = hd_wysiwyg_or_default($has_acf ? get_field('ppc_faq_label') : '', 'FAQ');
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('ppc_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How quickly will I see results from PPC?', 'answer' => 'Unlike SEO, PPC can deliver results almost immediately. You can start seeing traffic within hours of launching your campaign, with meaningful data within the first few weeks.'],
        ['question' => 'What platforms do you advertise on?', 'answer' => 'We manage campaigns across Google Ads, Microsoft Ads (Bing), Facebook, Instagram, LinkedIn, and other platforms depending on where your audience is most active.'],
        ['question' => 'How much should I budget for PPC?', 'answer' => 'Budget varies based on your industry, competition, and goals. We work with budgets of all sizes and will help you find the optimal spend to achieve your objectives.'],
        ['question' => 'Do you guarantee results?', 'answer' => 'While we cannot guarantee specific results (no ethical agency can), we guarantee transparent reporting, continuous optimisation, and a commitment to improving your ROI.'],
        ['question' => 'What\'s included in your PPC management?', 'answer' => 'Full campaign setup, keyword research, ad copywriting, landing page recommendations, bid management, A/B testing, conversion tracking, and detailed monthly reporting.'],
    ];
}
?>

<section class="ppc-page-faq" data-section-theme="light">
    <div class="ppc-page-faq-container">
        <div class="ppc-page-faq-header">
            <span class="ppc-page-faq-label"><?php echo wp_kses_post($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="ppc-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="ppc-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="ppc-page-faq-question" aria-expanded="false">
                        <span><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['question'] ?? '', '')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="ppc-page-faq-answer"><p><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['answer'] ?? '', '')); ?></p></div>
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
              <div class="reviewer-avatar" style="background:#4285f4;">S</div>
              <div class="reviewer-info">
                <h4>Sophie C.</h4>
                <p class="review-date">2025-01-15</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Recently went self-employed and was feeling a bit overwhelmed. Hagerty Digital have been absolutely brilliant, not only did they help me make the most of my marketing budget, but they also recommended systems and tools to help streamline my business.</p>
          </div>

          <div class="review-card">
            <div class="review-header">
              <div class="reviewer-avatar" style="background:#34a853;">L</div>
              <div class="reviewer-info">
                <h4>Libby J.</h4>
                <p class="review-date">2025-02-20</p>
              </div>
            </div>
            <div class="review-stars">★★★★★</div>
            <p class="review-text">Hagerty Digital are incredibly knowledgeable when it comes to website development and digital marketing. Their expertise, professionalism, and support have been outstanding throughout.</p>
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
            <p class="review-text">Fantastic Company! Built my companies website in a very quick timeframe and have been helping my business generate leads ever since! Would highly recommend.</p>
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