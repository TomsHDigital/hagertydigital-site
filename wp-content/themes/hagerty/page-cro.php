<?php
/**
 * Template Name: CRO Services
 * All classes prefixed with cro-page- for independent styling
 * Background pattern: #f8f8f8 → #ffffff alternating from stats
 */

get_header();

$has_acf = function_exists('get_field');

// ============================================
// HELPER FUNCTIONS
// ============================================
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
// - cro_hero_label (WYSIWYG)
// - cro_hero_heading_line_1 (WYSIWYG)
// - cro_hero_heading_line_2 (WYSIWYG)
// - cro_hero_description (WYSIWYG)
// - cro_hero_background_type (Select: none/image/video)
// - cro_hero_background_image (Image)
// - cro_hero_background_video_mp4 (File)
// - cro_hero_background_video_webm (File)
// - cro_hero_background_video_poster (Image)
// - cro_hero_background_overlay_opacity (Number)
// - cro_hero_primary_button (Link)
// - cro_hero_secondary_button (Link)
// ============================================
$hero_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_hero_label') : '', 'Conversion Rate Optimisation');
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('cro_hero_heading_line_1') : '', 'Turn Visitors Into');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('cro_hero_heading_line_2') : '', '<span class="highlight-text-italic">Customers</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('cro_hero_description') : '', 'Data-driven CRO strategies that transform your website into a high-performing conversion machine, maximising the value of every visitor.');

$hero_bg_type = $has_acf ? (get_field('cro_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('cro_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('cro_hero_background_video_mp4') : null;
$hero_bg_video_webm = $has_acf ? get_field('cro_hero_background_video_webm') : null;
$hero_bg_video_poster = $has_acf ? get_field('cro_hero_background_video_poster') : null;
$hero_bg_overlay = $has_acf ? get_field('cro_hero_background_overlay_opacity') : '';
$hero_bg_overlay = ($hero_bg_overlay === '' || $hero_bg_overlay === null) ? 0.5 : floatval($hero_bg_overlay);
if ($hero_bg_overlay < 0) $hero_bg_overlay = 0;
if ($hero_bg_overlay > 1) $hero_bg_overlay = 1;

$hero_primary_btn = $has_acf ? hd_link(get_field('cro_hero_primary_button')) : null;
$hero_secondary_btn = $has_acf ? hd_link(get_field('cro_hero_secondary_button')) : null;

if (!$hero_primary_btn) $hero_primary_btn = ['url' => '#contact', 'title' => 'Get Your Free Audit', 'target' => '_self'];
if (!$hero_secondary_btn) $hero_secondary_btn = ['url' => '#services', 'title' => 'Our Services', 'target' => '_self'];

$hero_image_url = ($hero_bg_image && is_array($hero_bg_image) && !empty($hero_bg_image['url'])) ? esc_url($hero_bg_image['url']) : '';
$hero_video_poster_url = ($hero_bg_video_poster && is_array($hero_bg_video_poster) && !empty($hero_bg_video_poster['url'])) ? esc_url($hero_bg_video_poster['url']) : '';
$hero_video_mp4_url = ($hero_bg_video_mp4 && is_array($hero_bg_video_mp4) && !empty($hero_bg_video_mp4['url'])) ? esc_url($hero_bg_video_mp4['url']) : '';
$hero_video_webm_url = ($hero_bg_video_webm && is_array($hero_bg_video_webm) && !empty($hero_bg_video_webm['url'])) ? esc_url($hero_bg_video_webm['url']) : '';

$has_hero_media = ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) || ($hero_bg_type === 'image' && $hero_image_url);
$hero_text_class = $has_hero_media ? 'has-media' : '';
?>

<!-- HERO SECTION -->
<section class="cro-page-hero" data-section-theme="dark">
  <div class="cro-page-hero-bg">
    <?php if ($hero_bg_type === 'video' && ($hero_video_mp4_url || $hero_video_webm_url)) : ?>
      <video autoplay muted loop playsinline class="cro-page-hero-video" <?php echo $hero_video_poster_url ? 'poster="' . $hero_video_poster_url . '"' : ''; ?>>
        <?php if ($hero_video_webm_url) : ?><source src="<?php echo $hero_video_webm_url; ?>" type="video/webm"><?php endif; ?>
        <?php if ($hero_video_mp4_url) : ?><source src="<?php echo $hero_video_mp4_url; ?>" type="video/mp4"><?php endif; ?>
      </video>
    <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
      <img src="<?php echo $hero_image_url; ?>" alt="CRO Services" class="cro-page-hero-image">
    <?php endif; ?>
    <div class="cro-page-hero-overlay" style="background: linear-gradient(135deg, rgba(26, 26, 30, <?php echo $hero_bg_overlay; ?>) 0%, rgba(26, 26, 30, <?php echo max(0, $hero_bg_overlay - 0.25); ?>) 100%);"></div>
  </div>

  <div class="cro-page-hero-content">
    <div class="cro-page-hero-text animate-fade-in <?php echo $hero_text_class; ?>">
      <span class="cro-page-hero-label"><?php echo wp_kses_post($hero_label); ?></span>

      <h1>
        <?php echo wp_kses_post($hero_line1); ?>
        <br>
        <?php echo wp_kses_post($hero_line2); ?>
      </h1>

      <p class="cro-page-hero-description">
        <?php echo wp_kses_post($hero_desc); ?>
      </p>

      <a href="<?php echo $hero_primary_btn['url']; ?>" target="<?php echo $hero_primary_btn['target']; ?>" class="cta-btn">
        <span><?php echo $hero_primary_btn['title']; ?></span>
      </a>
    </div>
  </div>

  <!-- Decorative Shapes -->
  <div class="cro-page-hero-shapes">
    <div class="cro-page-shape cro-page-shape-1"></div>
    <div class="cro-page-shape cro-page-shape-2"></div>
  </div>
</section>

<?php
// ============================================
// STATS SECTION - Background: #f8f8f8
// ACF Fields:
// - cro_stats (Repeater)
//   - number (WYSIWYG)
//   - label (WYSIWYG)
// ============================================
$stats = $has_acf ? get_field('cro_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '127%', 'label' => 'Average Conversion Lift'],
        ['number' => '£3.2M+', 'label' => 'Revenue Generated'],
        ['number' => '500+', 'label' => 'Tests Completed'],
        ['number' => '89%', 'label' => 'Client Retention'],
    ];
}
?>

<section class="cro-page-stats" data-section-theme="light">
    <div class="cro-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="cro-page-stat-item">
                <span class="cro-page-stat-number"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['number'] ?? '', '')); ?></span>
                <span class="cro-page-stat-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($stat['label'] ?? '', '')); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 1 - What is CRO? - Background: #ffffff
// ACF Fields:
// - cro_what_is_heading_line1 (WYSIWYG)
// - cro_what_is_heading_line2 (WYSIWYG)
// - cro_what_is_content (WYSIWYG)
// - cro_what_is_image (Image)
// - cro_what_is_button (Link)
// ============================================
$what_is_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('cro_what_is_heading_line1') : '', 'What is');
$what_is_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('cro_what_is_heading_line2') : '', 'CRO?');
$what_is_content = $has_acf ? get_field('cro_what_is_content') : '';
$what_is_image = $has_acf ? get_field('cro_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('cro_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="cro-page-info cro-page-info-1" data-section-theme="light">
    <div class="cro-page-info-container">
        <h2 class="cro-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($what_is_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($what_is_heading_line2); ?></span>
        </h2>
        <div class="cro-page-info-content">
            <div class="cro-page-info-text animate-slide-left">
                <?php if ($what_is_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $what_is_content)); ?>
                <?php else : ?>
                    <p>CRO stands for Conversion Rate Optimisation. It's the systematic process of increasing the percentage of website visitors who take a desired action – whether that's making a purchase, filling out a form, or signing up for a newsletter.</p>
                    <p>Unlike other marketing channels that focus on driving more traffic, CRO maximises the value of the traffic you already have. It's about working smarter, not harder.</p>
                    <p>Through data analysis, user research, A/B testing, and continuous optimisation, we identify and remove barriers that prevent your visitors from converting, turning more of your existing traffic into paying customers.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($what_is_button['url']); ?>" target="<?php echo esc_attr($what_is_button['target']); ?>" class="cta-button"><?php echo esc_html($what_is_button['title']); ?></a>
            </div>
            <div class="cro-page-info-image animate-slide-right">
                <?php if ($what_is_image_url) : ?>
                    <img src="<?php echo $what_is_image_url; ?>" alt="What is CRO">
                <?php else : ?>
                    <div class="cro-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 1 - Background: #f8f8f8
// ACF Fields:
// - cro_long_cta1_label (WYSIWYG)
// - cro_long_cta1_heading_line1 (WYSIWYG)
// - cro_long_cta1_heading_line2 (WYSIWYG)
// - cro_long_cta1_text (WYSIWYG)
// - cro_long_cta1_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - cro_long_cta1_primary_button (Link)
// - cro_long_cta1_secondary_button (Link)
// ============================================
$long_cta1_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta1_label') : '', 'READY TO CONVERT?');
$long_cta1_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta1_heading_line1') : '', 'Let\'s Maximise Your');
$long_cta1_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta1_heading_line2') : '', 'Conversion Rate');
$long_cta1_text = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta1_text') : '', '');
$long_cta1_features = $has_acf ? get_field('cro_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('cro_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('cro_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Optimising', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="cro-page-longcta cro-page-longcta-1" data-section-theme="light">
    <div class="cro-page-longcta-container">
        <div class="cro-page-longcta-content animate-fade-in">
            <span class="cro-page-longcta-label"><?php echo wp_kses_post($long_cta1_label); ?></span>
            <h2 class="cro-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta1_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta1_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="cro-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="cro-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="cro-page-longcta-feature">
                            <div class="cro-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="cro-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="cro-page-longcta-feature"><div class="cro-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div><div class="cro-page-longcta-feature-text"><h4>Data-Driven Testing</h4><p>Every decision backed by rigorous A/B testing and analytics</p></div></div>
                    <div class="cro-page-longcta-feature"><div class="cro-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div><div class="cro-page-longcta-feature-text"><h4>Quick Wins & Long-Term Growth</h4><p>Balance immediate improvements with sustainable conversion strategies</p></div></div>
                    <div class="cro-page-longcta-feature"><div class="cro-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><div class="cro-page-longcta-feature-text"><h4>Dedicated CRO Team</h4><p>Expert analysts focused solely on improving your conversion rates</p></div></div>
                <?php endif; ?>
            </div>
            <div class="cro-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta1_primary_button['url']); ?>" class="cro-page-longcta-btn cro-page-longcta-btn-primary"><span><?php echo esc_html($long_cta1_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta1_secondary_button['url']); ?>" class="cro-page-longcta-btn cro-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta1_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// SERVICES SECTION - Background: #ffffff
// ACF Fields:
// - cro_services_label (WYSIWYG)
// - cro_services_heading (WYSIWYG)
// - cro_services_subheading (WYSIWYG)
// - cro_services (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - icon_svg (Textarea)
// ============================================
$services_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_services_label') : '', 'What We Offer');
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('cro_services_heading') : '', 'Our CRO <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('cro_services_subheading') : '', 'Comprehensive conversion optimisation solutions to maximise your website performance');
$services = $has_acf ? get_field('cro_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'A/B Testing', 'description' => 'Scientifically test different versions of your pages to find what converts best.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>'],
        ['title' => 'User Research', 'description' => 'Understand your visitors through heatmaps, session recordings, and surveys.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'],
        ['title' => 'Landing Page Optimisation', 'description' => 'Transform your landing pages into high-converting assets.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>'],
        ['title' => 'Funnel Analysis', 'description' => 'Identify and fix drop-off points in your conversion funnel.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"/></svg>'],
    ];
}
?>

<section class="cro-page-services" id="services" data-section-theme="light">
    <div class="cro-page-services-container">
        <div class="cro-page-services-header">
            <span class="cro-page-services-label"><?php echo wp_kses_post($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="cro-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="cro-page-service-card">
                    <div class="cro-page-service-icon"><?php echo hd_svg_output($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($service['title'] ?? '', '')); ?></h3>
                    <p><?php echo wp_kses_post(hd_wysiwyg_or_default($service['description'] ?? '', '')); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// ============================================
// INFO SECTION 2 - Why Different (Reversed) - Background: #f8f8f8
// ACF Fields:
// - cro_why_different_heading_line1 (WYSIWYG)
// - cro_why_different_heading_line2 (WYSIWYG)
// - cro_why_different_content (WYSIWYG)
// - cro_why_different_image (Image)
// - cro_why_different_button (Link)
// ============================================
$why_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('cro_why_different_heading_line1') : '', 'Why We\'re');
$why_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('cro_why_different_heading_line2') : '', 'Different');
$why_content = $has_acf ? get_field('cro_why_different_content') : '';
$why_image = $has_acf ? get_field('cro_why_different_image') : null;
$why_button = $has_acf ? hd_link(get_field('cro_why_different_button')) : null;
$why_image_url = ($why_image && is_array($why_image) && !empty($why_image['url'])) ? esc_url($why_image['url']) : '';
if (!$why_button) $why_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="cro-page-info cro-page-info-2" data-section-theme="light">
    <div class="cro-page-info-container">
        <h2 class="cro-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($why_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($why_heading_line2); ?></span>
        </h2>
        <div class="cro-page-info-content cro-page-info-reversed">
            <div class="cro-page-info-image animate-slide-left">
                <?php if ($why_image_url) : ?>
                    <img src="<?php echo $why_image_url; ?>" alt="Why We're Different">
                <?php else : ?>
                    <div class="cro-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                <?php endif; ?>
            </div>
            <div class="cro-page-info-text animate-slide-right">
                <?php if ($why_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $why_content)); ?>
                <?php else : ?>
                    <p>We don't believe in guesswork. Every recommendation we make is backed by data, user research, and proven testing methodologies.</p>
                    <p>Our CRO approach is holistic – we look at the entire user journey, not just individual pages. We understand that true conversion optimisation requires understanding your customers at every touchpoint.</p>
                    <p>We work as an extension of your team, providing full transparency into our process and results. You'll always know exactly what we're testing, why, and what we've learned.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($why_button['url']); ?>" class="cta-button"><?php echo esc_html($why_button['title']); ?></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 2 - Background: #ffffff
// ACF Fields:
// - cro_long_cta2_label (WYSIWYG)
// - cro_long_cta2_heading_line1 (WYSIWYG)
// - cro_long_cta2_heading_line2 (WYSIWYG)
// - cro_long_cta2_text (WYSIWYG)
// - cro_long_cta2_primary_button (Link)
// - cro_long_cta2_secondary_button (Link)
// ============================================
$long_cta2_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta2_label') : '', 'FREE CRO AUDIT');
$long_cta2_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta2_heading_line1') : '', 'Discover Your Website\'s');
$long_cta2_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta2_heading_line2') : '', 'Hidden Potential');
$long_cta2_text = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta2_text') : '', 'Get a comprehensive analysis of your website\'s conversion performance. We\'ll identify quick wins, major opportunities, and a roadmap to higher conversions.');
$long_cta2_primary_button = $has_acf ? hd_link(get_field('cro_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('cro_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Get Your Free Audit', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="cro-page-longcta cro-page-longcta-2" data-section-theme="light">
    <div class="cro-page-longcta-container">
        <div class="cro-page-longcta-content animate-fade-in">
            <span class="cro-page-longcta-label"><?php echo wp_kses_post($long_cta2_label); ?></span>
            <h2 class="cro-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta2_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta2_heading_line2); ?></span>
            </h2>
            <p class="cro-page-longcta-text"><?php echo wp_kses_post($long_cta2_text); ?></p>
            <div class="cro-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="cro-page-longcta-btn cro-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="cro-page-longcta-btn cro-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// PROCESS SECTION - Background: #f8f8f8
// ACF Fields:
// - cro_process_label (WYSIWYG)
// - cro_process_heading (WYSIWYG)
// - cro_process_subheading (WYSIWYG)
// - cro_process_steps (Repeater)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// ============================================
$process_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_process_label') : '', 'How We Work');
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('cro_process_heading') : '', 'Our CRO <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('cro_process_subheading') : '', 'A proven methodology that delivers consistent, measurable improvements');
$process_steps = $has_acf ? get_field('cro_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Research & Analysis', 'description' => 'We dive deep into your analytics, user behaviour data, and competitive landscape to understand exactly where opportunities lie.'],
        ['title' => 'Hypothesis Development', 'description' => 'Based on our research, we create data-backed hypotheses about what changes will drive the biggest conversion improvements.'],
        ['title' => 'Test Implementation', 'description' => 'We design and implement rigorous A/B tests, ensuring statistical validity and clean test environments.'],
        ['title' => 'Analyse & Iterate', 'description' => 'We analyse test results, document learnings, and use insights to inform the next round of optimisations for continuous improvement.'],
    ];
}
?>

<section class="cro-page-process" data-section-theme="light">
    <div class="cro-page-process-container">
        <div class="cro-page-process-header">
            <span class="cro-page-process-label"><?php echo wp_kses_post($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="cro-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="cro-page-process-step">
                    <div class="cro-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="cro-page-process-content">
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
// INFO SECTION 3 - CRO Tools & Technology - Background: #ffffff
// ACF Fields:
// - cro_tools_heading_line1 (WYSIWYG)
// - cro_tools_heading_line2 (WYSIWYG)
// - cro_tools_content (WYSIWYG)
// - cro_tools_image (Image)
// - cro_tools_button (Link)
// ============================================
$tools_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('cro_tools_heading_line1') : '', 'Tools &');
$tools_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('cro_tools_heading_line2') : '', 'Technology');
$tools_content = $has_acf ? get_field('cro_tools_content') : '';
$tools_image = $has_acf ? get_field('cro_tools_image') : null;
$tools_button = $has_acf ? hd_link(get_field('cro_tools_button')) : null;
$tools_image_url = ($tools_image && is_array($tools_image) && !empty($tools_image['url'])) ? esc_url($tools_image['url']) : '';
if (!$tools_button) $tools_button = ['url' => '#contact', 'title' => 'Learn More', 'target' => '_self'];
?>

<section class="cro-page-info cro-page-info-3" data-section-theme="light">
    <div class="cro-page-info-container">
        <h2 class="cro-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo wp_kses_post($tools_heading_line1); ?></span><br>
            <span class="highlight-text-italic"><?php echo wp_kses_post($tools_heading_line2); ?></span>
        </h2>
        <div class="cro-page-info-content">
            <div class="cro-page-info-text animate-slide-left">
                <?php if ($tools_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $tools_content)); ?>
                <?php else : ?>
                    <p>We use industry-leading tools to gather insights, run tests, and measure results. From heatmaps and session recordings to advanced A/B testing platforms.</p>
                    <p>Our tech stack includes Google Optimize, VWO, Hotjar, Crazy Egg, and Google Analytics 4 – giving us the full picture of how users interact with your site.</p>
                    <p>But tools are only as good as the people using them. Our team combines technical expertise with creative problem-solving to turn data into actionable insights.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($tools_button['url']); ?>" class="cta-button"><?php echo esc_html($tools_button['title']); ?></a>
            </div>
            <div class="cro-page-info-image animate-slide-right">
                <?php if ($tools_image_url) : ?>
                    <img src="<?php echo $tools_image_url; ?>" alt="CRO Tools">
                <?php else : ?>
                    <div class="cro-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// LONG CTA 3 - Background: #f8f8f8
// ACF Fields:
// - cro_long_cta3_label (WYSIWYG)
// - cro_long_cta3_heading_line1 (WYSIWYG)
// - cro_long_cta3_heading_line2 (WYSIWYG)
// - cro_long_cta3_text (WYSIWYG)
// - cro_long_cta3_features (Repeater)
//   - icon_svg (Textarea)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
// - cro_long_cta3_primary_button (Link)
// - cro_long_cta3_secondary_button (Link)
// ============================================
$long_cta3_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta3_label') : '', 'PROVEN RESULTS');
$long_cta3_heading_line1 = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta3_heading_line1') : '', 'Ready to Boost Your');
$long_cta3_heading_line2 = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta3_heading_line2') : '', 'Conversions?');
$long_cta3_text = hd_wysiwyg_or_default($has_acf ? get_field('cro_long_cta3_text') : '', '');
$long_cta3_features = $has_acf ? get_field('cro_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? hd_link(get_field('cro_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? hd_link(get_field('cro_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Start Converting More', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="cro-page-longcta cro-page-longcta-3" data-section-theme="light">
    <div class="cro-page-longcta-container">
        <div class="cro-page-longcta-content animate-fade-in">
            <span class="cro-page-longcta-label"><?php echo wp_kses_post($long_cta3_label); ?></span>
            <h2 class="cro-page-longcta-heading">
                <span class="black-text"><?php echo wp_kses_post($long_cta3_heading_line1); ?></span><br>
                <span class="highlight-text-italic"><?php echo wp_kses_post($long_cta3_heading_line2); ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="cro-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="cro-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="cro-page-longcta-feature">
                            <div class="cro-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? hd_svg_output($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="cro-page-longcta-feature-text">
                                <h4><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['title'] ?? '', '')); ?></h4>
                                <p><?php echo wp_kses_post(hd_wysiwyg_or_default($feature['description'] ?? '', '')); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="cro-page-longcta-feature"><div class="cro-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></div><div class="cro-page-longcta-feature-text"><h4>No Long-Term Contracts</h4><p>We earn your business with results, not contracts</p></div></div>
                    <div class="cro-page-longcta-feature"><div class="cro-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div><div class="cro-page-longcta-feature-text"><h4>Transparent Reporting</h4><p>Clear reports showing exactly what we're testing and results achieved</p></div></div>
                    <div class="cro-page-longcta-feature"><div class="cro-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div class="cro-page-longcta-feature-text"><h4>Revenue Focused</h4><p>Everything we do is measured against your bottom line</p></div></div>
                <?php endif; ?>
            </div>
            <div class="cro-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta3_primary_button['url']); ?>" class="cro-page-longcta-btn cro-page-longcta-btn-primary"><span><?php echo esc_html($long_cta3_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta3_secondary_button['url']); ?>" class="cro-page-longcta-btn cro-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta3_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// ============================================
// RESULTS SECTION - Background: #ffffff
// ACF Fields:
// - cro_results_label (WYSIWYG)
// - cro_results_heading (WYSIWYG)
// - cro_results_subheading (WYSIWYG)
// - cro_results (Repeater)
//   - industry (WYSIWYG)
//   - title (WYSIWYG)
//   - description (WYSIWYG)
//   - metric1_value (WYSIWYG)
//   - metric1_label (WYSIWYG)
//   - metric2_value (WYSIWYG)
//   - metric2_label (WYSIWYG)
//   - image (Image)
// ============================================
$results_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_results_label') : '', 'Case Studies');
$results_heading = hd_wysiwyg_or_default($has_acf ? get_field('cro_results_heading') : '', 'Real <span class="highlight-text-italic">Results</span>');
$results_subheading = hd_wysiwyg_or_default($has_acf ? get_field('cro_results_subheading') : '', 'See how we\'ve helped businesses dramatically improve their conversion rates');
$results = $has_acf ? get_field('cro_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'E-commerce', 'title' => 'Fashion Retailer', 'description' => 'Redesigned checkout flow resulting in significant uplift in completed purchases.', 'metric1_value' => '+68%', 'metric1_label' => 'Conversion Rate', 'metric2_value' => '+£420K', 'metric2_label' => 'Annual Revenue', 'image' => null],
        ['industry' => 'SaaS', 'title' => 'B2B Software', 'description' => 'Optimised trial signup funnel leading to more qualified leads.', 'metric1_value' => '+127%', 'metric1_label' => 'Trial Signups', 'metric2_value' => '+89%', 'metric2_label' => 'Trial to Paid', 'image' => null],
        ['industry' => 'Lead Generation', 'title' => 'Financial Services', 'description' => 'A/B tested landing pages to dramatically increase form submissions.', 'metric1_value' => '+156%', 'metric1_label' => 'Form Fills', 'metric2_value' => '-43%', 'metric2_label' => 'Cost Per Lead', 'image' => null],
    ];
}
?>

<section class="cro-page-results" data-section-theme="light">
    <div class="cro-page-results-container">
        <div class="cro-page-results-header">
            <span class="cro-page-results-label"><?php echo wp_kses_post($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="cro-page-results-grid">
            <?php foreach ($results as $result) : 
                $result_image = null;
                if (!empty($result['image']) && is_array($result['image']) && !empty($result['image']['url'])) {
                    $result_image = esc_url($result['image']['url']);
                }
            ?>
                <div class="cro-page-result-card">
                    <div class="cro-page-result-image">
                        <?php if ($result_image) : ?>
                            <img src="<?php echo $result_image; ?>" alt="<?php echo esc_attr(strip_tags($result['title'] ?? 'Case Study')); ?>">
                        <?php else : ?>
                            <div class="cro-page-result-placeholder"><span><?php echo esc_html(substr(strip_tags($result['title'] ?? 'C'), 0, 1)); ?></span></div>
                        <?php endif; ?>
                    </div>
                    <div class="cro-page-result-content">
                        <span class="cro-page-result-industry"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['industry'] ?? '', '')); ?></span>
                        <h3><?php echo wp_kses_post(hd_wysiwyg_or_default($result['title'] ?? '', '')); ?></h3>
                        <p><?php echo wp_kses_post(hd_wysiwyg_or_default($result['description'] ?? '', '')); ?></p>
                        <div class="cro-page-result-metrics">
                            <div class="cro-page-result-metric">
                                <span class="cro-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_value'] ?? '', '')); ?></span>
                                <span class="cro-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric1_label'] ?? '', '')); ?></span>
                            </div>
                            <div class="cro-page-result-metric">
                                <span class="cro-page-result-metric-value"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_value'] ?? '', '')); ?></span>
                                <span class="cro-page-result-metric-label"><?php echo wp_kses_post(hd_wysiwyg_or_default($result['metric2_label'] ?? '', '')); ?></span>
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
// FAQ SECTION - Background: #f8f8f8
// ACF Fields:
// - cro_faq_label (WYSIWYG)
// - cro_faq_heading (WYSIWYG)
// - cro_faqs (Repeater)
//   - question (WYSIWYG)
//   - answer (WYSIWYG)
// ============================================
$faq_label = hd_wysiwyg_or_default($has_acf ? get_field('cro_faq_label') : '', 'FAQ');
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('cro_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('cro_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How long does it take to see CRO results?', 'answer' => 'It depends on your traffic volume. Higher traffic sites can see statistically significant results within 2-4 weeks. Lower traffic sites may take 4-8 weeks per test. However, we typically identify and implement quick wins within the first month.'],
        ['question' => 'What\'s the typical ROI from CRO?', 'answer' => 'Most clients see a 50-200% improvement in conversion rates within 6 months. Because you\'re maximising existing traffic rather than paying for new visitors, ROI is often 5-10x your investment.'],
        ['question' => 'Do I need a minimum amount of traffic?', 'answer' => 'For statistically valid A/B testing, we recommend at least 10,000 monthly visitors. However, we can still improve conversions on smaller sites through qualitative research and best-practice implementations.'],
        ['question' => 'Will CRO changes affect my SEO?', 'answer' => 'When done properly, CRO and SEO work together. We ensure all changes are SEO-friendly and often see improvements in organic performance as user experience improves.'],
        ['question' => 'What platforms do you work with?', 'answer' => 'We work with all major platforms including WordPress, Shopify, Magento, custom builds, and more. Our testing tools integrate with virtually any website.'],
    ];
}
?>

<section class="cro-page-faq" data-section-theme="light">
    <div class="cro-page-faq-container">
        <div class="cro-page-faq-header">
            <span class="cro-page-faq-label"><?php echo wp_kses_post($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="cro-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="cro-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="cro-page-faq-question" aria-expanded="false">
                        <span><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['question'] ?? '', '')); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="cro-page-faq-answer"><p><?php echo wp_kses_post(hd_wysiwyg_or_default($faq['answer'] ?? '', '')); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- Long CTA Section - Before Reviews - Background: #ffffff -->
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


<!-- Reviews Section - Background: #f8f8f8 -->
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