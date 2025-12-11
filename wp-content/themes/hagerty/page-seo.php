<?php
/**
 * Template Name: SEO Services
 * All classes prefixed with seo-page- for independent styling
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
// - seo_hero_label (WYSIWYG)
// - seo_hero_heading_line_1 (WYSIWYG)
// - seo_hero_heading_line_2 (WYSIWYG)
// - seo_hero_description (WYSIWYG)
// - seo_hero_background_type (Select: none, image, video)
// - seo_hero_background_image (Image)
// - seo_hero_background_video_mp4 (File)
// - seo_hero_background_video_webm (File)
// - seo_hero_background_video_poster (Image)
// - seo_hero_background_overlay_opacity (Number)
// - seo_hero_primary_button (Link)
// - seo_hero_secondary_button (Link)
// ============================================
$hero_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_hero_label') : '', 'Search Engine Optimisation');
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('seo_hero_heading_line_1') : '', 'Dominate Search');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('seo_hero_heading_line_2') : '', '<span class="highlight-text-italic">Drive Growth</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('seo_hero_description') : '', 'Data-driven SEO strategies that increase your visibility, drive qualified traffic, and deliver measurable ROI for your business.');

$hero_bg_type = $has_acf ? (get_field('seo_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('seo_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('seo_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('seo_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('seo_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('seo_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? hd_link(get_field('seo_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? hd_link(get_field('seo_hero_secondary_button')) : null;

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
<section class="seo-page-hero" data-section-theme="dark">
  <div class="seo-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="seo-page-hero-video">
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="SEO Services" class="seo-page-hero-image">
    <?php endif; ?>
    <div class="seo-page-hero-overlay"></div>
  </div>

  <div class="seo-page-hero-content">
    <div class="seo-page-hero-text animate-fade-in">
      <span class="seo-page-hero-label"><?php echo wp_kses_post($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="seo-page-hero-description">
        <?php echo wp_kses_post($hero_desc); ?>
      </p>

      <a href="<?php echo $hero_primary_btn['url']; ?>" target="<?php echo $hero_primary_btn['target']; ?>" class="cta-btn">
        <span><?php echo $hero_primary_btn['title']; ?></span>
      </a>
    </div>
  </div>

  <!-- Decorative Shapes -->
  <div class="seo-page-hero-shapes">
    <div class="seo-page-shape seo-page-shape-1"></div>
    <div class="seo-page-shape seo-page-shape-2"></div>
  </div>
</section>

<?php
// ============================================
// STATS SECTION
// ACF Fields:
// - seo_stats (Repeater)
//   - number (WYSIWYG)
//   - label (WYSIWYG)
// ============================================
$stats = $has_acf ? get_field('seo_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '150%', 'label' => 'Average Traffic Increase'],
        ['number' => 'Top 10', 'label' => 'Rankings Achieved'],
        ['number' => '£2.5M+', 'label' => 'Revenue Generated'],
        ['number' => '50+', 'label' => 'Happy Clients'],
    ];
}
?>

<section class="seo-page-stats" data-section-theme="light">
    <div class="seo-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="seo-page-stat-item">
                <span class="seo-page-stat-number"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['number'] ?? '', '')); ?></span>
                <span class="seo-page-stat-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['label'] ?? '', '')); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is SEO?
// ACF Fields:
// - seo_what_is_heading_line1 (WYSIWYG)
// - seo_what_is_heading_line2 (WYSIWYG)
// - seo_what_is_content (WYSIWYG)
// - seo_what_is_image (Image)
// - seo_what_is_button (Link)
// ============================================
$what_is_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('seo_what_is_heading_line1') : '', 'What is');
$what_is_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('seo_what_is_heading_line2') : '', 'SEO?');
$what_is_content = $has_acf ? get_field('seo_what_is_content') : '';
$what_is_image = $has_acf ? get_field('seo_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('seo_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="seo-page-info seo-page-info-1" data-section-theme="light">
    <div class="seo-page-info-container">
        <h2 class="seo-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($what_is_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($what_is_heading_line2); ?></span>
        </h2>
        <div class="seo-page-info-content">
            <div class="seo-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>SEO stands for Search Engine Optimisation. It is a set of processes and techniques used to improve your website's visibility in search engines like Google and Bing. Basically, getting your website to that magical number one spot on Google. Which isn't easy.</p>
                    <p>SEO is not a quick fix and it can take months for you to see any visible impact. However, with SEO you get a kind of snowballing effect. At first the results are quite small, but as you continue with SEO it gets bigger and bigger and bigger.</p>
                    <p>So the more snow you put in at the start, the more snow you get at the end. A long-term but extremely cost-effective marketing strategy.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="seo-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is SEO">
                <?php else : ?>
                    <div class="seo-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1
// ACF Fields:
// - seo_long_cta1_label (WYSIWYG)
// - seo_long_cta1_heading_line1 (WYSIWYG)
// - seo_long_cta1_heading_line2 (WYSIWYG)
// - seo_long_cta1_text (WYSIWYG)
// - seo_long_cta1_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - seo_long_cta1_primary_button (Link)
// - seo_long_cta1_secondary_button (Link)
// ============================================
$long_cta1_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta1_label') : '', 'READY TO RANK?');
$long_cta1_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta1_heading_line1') : '', 'Let\'s Get You');
$long_cta1_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta1_heading_line2') : '', 'Found Online');
$long_cta1_text = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta1_text') : '', '');
$long_cta1_features = $has_acf ? get_field('seo_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('seo_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('seo_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Project', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="seo-page-longcta seo-page-longcta-1" data-section-theme="light">
    <div class="seo-page-longcta-container">
        <div class="seo-page-longcta-content animate-fade-in">
            <span class="seo-page-longcta-label"><?php echo wp_kses_post($long_cta1_label); ?></span>
            <h2 class="seo-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta1_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta1_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="seo-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="seo-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="seo-page-longcta-feature">
                            <div class="seo-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="seo-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="seo-page-longcta-feature"><div class="seo-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></div><div class="seo-page-longcta-feature-text"><h4>Research-Led Strategy</h4><p>Every campaign starts with comprehensive keyword and competitor analysis</p></div></div>
                    <div class="seo-page-longcta-feature"><div class="seo-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div><div class="seo-page-longcta-feature-text"><h4>Transparent Reporting</h4><p>Monthly reports that actually make sense, showing real business impact</p></div></div>
                    <div class="seo-page-longcta-feature"><div class="seo-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><div class="seo-page-longcta-feature-text"><h4>Dedicated Team</h4><p>Your own account manager who truly understands your business goals</p></div></div>
                <?php endif; ?>
            </div>
            <div class="seo-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="seo-page-longcta-btn seo-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="seo-page-longcta-btn seo-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES SECTION
// ACF Fields:
// - seo_services_label (WYSIWYG)
// - seo_services_heading (WYSIWYG)
// - seo_services_subheading (WYSIWYG)
// - seo_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$services_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_services_label') : '', 'What We Offer');
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('seo_services_heading') : '', 'Our SEO <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('seo_services_subheading') : '', 'Comprehensive search engine optimisation solutions tailored to your business goals');
$services = $has_acf ? get_field('seo_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'Technical SEO', 'description' => 'Ensure your website is fully optimised for search engine crawlers and indexing.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>'],
        ['title' => 'On-Page SEO', 'description' => 'Optimise every element of your pages to rank higher for target keywords.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>'],
        ['title' => 'Link Building', 'description' => 'Build authority through strategic, high-quality backlink acquisition.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>'],
        ['title' => 'Local SEO', 'description' => 'Dominate local search results and attract customers in your area.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>'],
    ];
}
?>

<section class="seo-page-services" id="services" data-section-theme="light">
    <div class="seo-page-services-container">
        <div class="seo-page-services-header">
            <span class="seo-page-services-label"><?php echo wp_kses_post($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="seo-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="seo-page-service-card">
                    <div class="seo-page-service-icon"><?php echo hd_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(hd_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - Why Different (Reversed)
// ACF Fields:
// - seo_why_different_heading_line1 (WYSIWYG)
// - seo_why_different_heading_line2 (WYSIWYG)
// - seo_why_different_content (WYSIWYG)
// - seo_why_different_image (Image)
// - seo_why_different_button (Link)
// ============================================
$why_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('seo_why_different_heading_line1') : '', 'Why Are We');
$why_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('seo_why_different_heading_line2') : '', 'Different?');
$why_content = $has_acf ? get_field('seo_why_different_content') : '';
$why_image = $has_acf ? get_field('seo_why_different_image') : null;
$why_button = $has_acf ? hd_link(get_field('seo_why_different_button')) : null;
$why_image_url = ($why_image && is_array($why_image) && !empty($why_image['url'])) ? esc_url($why_image['url']) : '';
if (!$why_button) $why_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="seo-page-info seo-page-info-2" data-section-theme="light">
    <div class="seo-page-info-container">
        <h2 class="seo-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($why_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($why_heading_line2); ?></span>
        </h2>
        <div class="seo-page-info-content seo-page-info-reversed">
            <div class="seo-page-info-image animate-slide-left">
                <?php if ($why_image_url) : ?>
                    <img src="<?php echo $why_image_url; ?>" alt="Why We're Different">
                <?php else : ?>
                    <div class="seo-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="seo-page-info-text animate-slide-right">
                <?php if ($why_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $why_content)); ?>
                <?php else : ?>
                    <p>Because we want to help you. Not by just improving your rankings or increasing your website traffic, but by talking to you and explaining everything we do.</p>
                    <p>We won't confuse you by using SEO technical terms like most other agencies. When we talk about SEO we will use terminology that you understand.</p>
                    <p>When creating new pages or writing content for your website, we will talk to you. We will tell you why we have done it, our reasoning behind it and how it will benefit your business.</p>
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
// - seo_long_cta2_label (WYSIWYG)
// - seo_long_cta2_heading_line1 (WYSIWYG)
// - seo_long_cta2_heading_line2 (WYSIWYG)
// - seo_long_cta2_text (WYSIWYG)
// - seo_long_cta2_primary_button (Link)
// - seo_long_cta2_secondary_button (Link)
// ============================================
$long_cta2_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta2_label') : '', 'FREE SEO AUDIT');
$long_cta2_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta2_heading_line1') : '', 'Discover Your Website\'s');
$long_cta2_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta2_heading_line2') : '', 'True Potential');
$long_cta2_text = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta2_text') : '', 'Get a comprehensive analysis of your website\'s SEO performance. We\'ll identify opportunities, uncover issues, and show you exactly how to improve your search visibility.');
$long_cta2_primary_button = $has_acf ? hd_link(get_field('seo_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('seo_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Get Your Free Audit', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="seo-page-longcta seo-page-longcta-2" data-section-theme="light">
    <div class="seo-page-longcta-container">
        <div class="seo-page-longcta-content animate-fade-in">
            <span class="seo-page-longcta-label"><?php echo wp_kses_post($long_cta2_label); ?></span>
            <h2 class="seo-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta2_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta2_heading_line2); ?></span>
            </h2>
            <p class="seo-page-longcta-text"><?php echo wp_kses_post($long_cta2_text); ?></p>
            <div class="seo-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="seo-page-longcta-btn seo-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="seo-page-longcta-btn seo-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS SECTION
// ACF Fields:
// - seo_process_label (WYSIWYG)
// - seo_process_heading (WYSIWYG)
// - seo_process_subheading (WYSIWYG)
// - seo_process_steps (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// ============================================
$process_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_process_label') : '', 'How We Work');
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('seo_process_heading') : '', 'Our SEO <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('seo_process_subheading') : '', 'A proven methodology that delivers consistent results');
$process_steps = $has_acf ? get_field('seo_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Discovery & Audit', 'description' => 'We start with a comprehensive audit of your current SEO performance, analysing your website, competitors, and market opportunities.'],
        ['title' => 'Strategy Development', 'description' => 'Based on our findings, we create a bespoke SEO strategy aligned with your business goals.'],
        ['title' => 'Implementation', 'description' => 'Our team executes the strategy across technical SEO, on-page optimisation, content creation, and link building.'],
        ['title' => 'Monitor & Optimise', 'description' => 'We continuously monitor performance, analyse results, and refine our approach to ensure sustained growth.'],
    ];
}
?>

<section class="seo-page-process" data-section-theme="light">
    <div class="seo-page-process-container">
        <div class="seo-page-process-header">
            <span class="seo-page-process-label"><?php echo wp_kses_post($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="seo-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="seo-page-process-step">
                    <div class="seo-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="seo-page-process-content">
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
// INFO SECTION 3 - SEO Audits
// ACF Fields:
// - seo_audits_heading_line1 (WYSIWYG)
// - seo_audits_heading_line2 (WYSIWYG)
// - seo_audits_content (WYSIWYG)
// - seo_audits_image (Image)
// - seo_audits_button (Link)
// ============================================
$audits_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('seo_audits_heading_line1') : '', 'SEO');
$audits_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('seo_audits_heading_line2') : '', 'Audits');
$audits_content = $has_acf ? get_field('seo_audits_content') : '';
$audits_image = $has_acf ? get_field('seo_audits_image') : null;
$audits_button = $has_acf ? hd_link(get_field('seo_audits_button')) : null;
$audits_image_url = ($audits_image && is_array($audits_image) && !empty($audits_image['url'])) ? esc_url($audits_image['url']) : '';
if (!$audits_button) $audits_button = ['url' => '#contact', 'title' => 'Get Your Free Audit', 'target' => '_self'];
?>

<section class="seo-page-info seo-page-info-3" data-section-theme="light">
    <div class="seo-page-info-container">
        <h2 class="seo-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($audits_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($audits_heading_line2); ?></span>
        </h2>
        <div class="seo-page-info-content">
            <div class="seo-page-info-text animate-slide-left">
                <?php if ($audits_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $audits_content)); ?>
                <?php else : ?>
                    <p>We use premium tools and extensive experience in SEO marketing to consider all aspects of your website's current performance in the search engine results pages.</p>
                    <p>It's the foundation of all our SEO work, and ensures our strategies deliver real-world results. Because if you don't know where you are, you don't know where you can get to.</p>
                    <p>Our comprehensive audits cover technical health, content quality, backlink profile, and competitive positioning.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($audits_button['url']); ?>" class="cta-button"><?php echo esc_html($audits_button['title']); ?></a>
            </div>
            <div class="seo-page-info-image animate-slide-right">
                <?php if ($audits_image_url) : ?>
                    <img src="<?php echo $audits_image_url; ?>" alt="SEO Audits">
                <?php else : ?>
                    <div class="seo-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 3
// ACF Fields:
// - seo_long_cta3_label (WYSIWYG)
// - seo_long_cta3_heading_line1 (WYSIWYG)
// - seo_long_cta3_heading_line2 (WYSIWYG)
// - seo_long_cta3_text (WYSIWYG)
// - seo_long_cta3_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - seo_long_cta3_primary_button (Link)
// - seo_long_cta3_secondary_button (Link)
// ============================================
$long_cta3_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta3_label') : '', 'PROVEN RESULTS');
$long_cta3_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta3_heading_line1') : '', 'Ready to Dominate');
$long_cta3_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta3_heading_line2') : '', 'Search Results?');
$long_cta3_text = hd_wysiwyg_or_default($has_acf ? get_field('seo_long_cta3_text') : '', '');
$long_cta3_features = $has_acf ? get_field('seo_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? hd_link(get_field('seo_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? hd_link(get_field('seo_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Start Growing Today', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="seo-page-longcta seo-page-longcta-3" data-section-theme="light">
    <div class="seo-page-longcta-container">
        <div class="seo-page-longcta-content animate-fade-in">
            <span class="seo-page-longcta-label"><?php echo wp_kses_post($long_cta3_label); ?></span>
            <h2 class="seo-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta3_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta3_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="seo-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="seo-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="seo-page-longcta-feature">
                            <div class="seo-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="seo-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="seo-page-longcta-feature"><div class="seo-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></div><div class="seo-page-longcta-feature-text"><h4>No Long-Term Contracts</h4><p>We believe in earning your business every month</p></div></div>
                    <div class="seo-page-longcta-feature"><div class="seo-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div><div class="seo-page-longcta-feature-text"><h4>Transparent Reporting</h4><p>Monthly reports you can actually understand</p></div></div>
                    <div class="seo-page-longcta-feature"><div class="seo-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="seo-page-longcta-feature-text"><h4>White-Hat Only</h4><p>Ethical practices that protect your brand</p></div></div>
                <?php endif; ?>
            </div>
            <div class="seo-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta3_primary_button['url']); ?>" class="seo-page-longcta-btn seo-page-longcta-btn-primary"><span><?php echo esc_html($long_cta3_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta3_secondary_button['url']); ?>" class="seo-page-longcta-btn seo-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta3_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// RESULTS SECTION
// ACF Fields:
// - seo_results_label (WYSIWYG)
// - seo_results_heading (WYSIWYG)
// - seo_results_subheading (WYSIWYG)
// - seo_results (Repeater)
//   - industry (WYSIWYG)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - metric1_value (WYSIWYG)
//   - metric1_label (WYSIWYG)
//   - metric2_value (WYSIWYG)
//   - metric2_label (WYSIWYG)
//   - image (Image)
// ============================================
$results_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_results_label') : '', 'Case Studies');
$results_heading = hd_wysiwyg_or_default($has_acf ? get_field('seo_results_heading') : '', 'Real <span class="highlight-text-italic">Results</span>');
$results_subheading = hd_wysiwyg_or_default($has_acf ? get_field('seo_results_subheading') : '', 'See how we\'ve helped businesses like yours achieve remarkable growth');
$results = $has_acf ? get_field('seo_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'E-commerce', 'title' => 'Online Retailer', 'description' => 'Increased organic traffic by 250% within 12 months.', 'metric1_value' => '+250%', 'metric1_label' => 'Traffic', 'metric2_value' => '+180%', 'metric2_label' => 'Revenue', 'image' => null],
        ['industry' => 'Professional Services', 'title' => 'Law Firm', 'description' => 'Achieved page one rankings for 50+ competitive keywords.', 'metric1_value' => '50+', 'metric1_label' => 'Page 1 Rankings', 'metric2_value' => '+300%', 'metric2_label' => 'Leads', 'image' => null],
        ['industry' => 'Healthcare', 'title' => 'Private Clinic', 'description' => 'Became the top-ranked provider in their region.', 'metric1_value' => '#1', 'metric1_label' => 'Local Ranking', 'metric2_value' => '+400%', 'metric2_label' => 'Enquiries', 'image' => null],
    ];
}
?>

<section class="seo-page-results" data-section-theme="light">
    <div class="seo-page-results-container">
        <div class="seo-page-results-header">
            <span class="seo-page-results-label"><?php echo wp_kses_post($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="seo-page-results-grid">
            <?php foreach ($results as $result) : 
                $result_image = null;
                if (!empty($result['image']) && is_array($result['image']) && !empty($result['image']['url'])) {
                    $result_image = esc_url($result['image']['url']);
                }
            ?>
                <div class="seo-page-result-card">
                    <div class="seo-page-result-image">
                        <?php if ($result_image) : ?>
                            <img src="<?php echo $result_image; ?>" alt="<?php echo esc_attr(strip_tags($result['title'] ?? 'Case Study')); ?>">
                        <?php else : ?>
                            <div class="seo-page-result-placeholder"><span><?php echo esc_html(substr(strip_tags($result['title'] ?? 'C'), 0, 1)); ?></span></div>
                        <?php endif; ?>
                    </div>
                    <div class="seo-page-result-content">
                        <span class="seo-page-result-industry"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['industry'] ?? '', '')); ?></span>
                        <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($result['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(hd_wysiwyg_or_default($result['description'] ?? '', '')); ?></p>
                        <div class="seo-page-result-metrics">
                            <div class="seo-page-result-metric">
                                <span class="seo-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_value'] ?? '', '')); ?></span>
                                <span class="seo-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_label'] ?? '', '')); ?></span>
                            </div>
                            <div class="seo-page-result-metric">
                                <span class="seo-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_value'] ?? '', '')); ?></span>
                                <span class="seo-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_label'] ?? '', '')); ?></span>
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
// - seo_faq_label (WYSIWYG)
// - seo_faq_heading (WYSIWYG)
// - seo_faqs (Repeater)
//   - question (WYSIWYG)
//   - answer (WYSIWYG)
// ============================================
$faq_label = hd_wysiwyg_or_default($has_acf ? get_field('seo_faq_label') : '', 'FAQ');
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('seo_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('seo_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How long does SEO take to work?', 'answer' => 'SEO is a long-term strategy. Significant results typically take 6-12 months depending on competition level and scope of work.'],
        ['question' => 'What\'s included in your SEO services?', 'answer' => 'Technical audits, on-page optimisation, content strategy, link building, local SEO, and ongoing monitoring with monthly reports.'],
        ['question' => 'How do you measure SEO success?', 'answer' => 'We track organic traffic, keyword rankings, conversion rates, and revenue generated with clear monthly reports.'],
        ['question' => 'Do you guarantee first page rankings?', 'answer' => 'No ethical SEO agency can guarantee specific rankings. We guarantee transparent, white-hat practices and data-driven improvements.'],
        ['question' => 'How much does SEO cost?', 'answer' => 'Investment varies based on goals and competition. We offer flexible packages starting from £500/month.'],
    ];
}
?>

<section class="seo-page-faq" data-section-theme="light">
    <div class="seo-page-faq-container">
        <div class="seo-page-faq-header">
            <span class="seo-page-faq-label"><?php echo wp_kses_post($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="seo-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="seo-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="seo-page-faq-question" aria-expanded="false">
                        <span><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['question'] ?? '', '')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="seo-page-faq-answer"><p><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['answer'] ?? '', '')); ?></p></div>
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