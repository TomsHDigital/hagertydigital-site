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

// HERO
$hero_label = $has_acf ? (get_field('ppc_hero_label') ?: 'Pay-Per-Click Advertising') : 'Pay-Per-Click Advertising';
$hero_line1 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_hero_heading_line_1') : '', 'Instant Visibility');
$hero_line2 = hd_wysiwyg_or_default($has_acf ? get_field('ppc_hero_heading_line_2') : '', '<span class="highlight-text-italic">Measurable Results</span>');
$hero_desc  = hd_wysiwyg_or_default($has_acf ? get_field('ppc_hero_description') : '', 'PPC really is for every business and it can really help you get new customers in the short and long term. You spend money to make money.');

$hero_bg_type = $has_acf ? (get_field('ppc_hero_background_type') ?: 'none') : 'none';
$hero_bg_image = $has_acf ? get_field('ppc_hero_background_image') : null;
$hero_bg_video_mp4 = $has_acf ? get_field('ppc_hero_background_video_mp4') : '';
$hero_bg_video_webm = $has_acf ? get_field('ppc_hero_background_video_webm') : '';
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

$has_hero_media = ($hero_bg_type === 'video' && ($hero_bg_video_mp4 || $hero_bg_video_webm)) || ($hero_bg_type === 'image' && $hero_image_url);
$hero_text_class = $has_hero_media ? 'has-media' : '';
?>

<!-- HERO -->
<section class="ppc-page-hero <?php echo esc_attr($hero_text_class); ?>" data-section-theme="light">
    <?php if ($has_hero_media) : ?>
    <div class="ppc-page-hero-bg" aria-hidden="true">
        <?php if ($hero_bg_type === 'video' && ($hero_bg_video_mp4 || $hero_bg_video_webm)) : ?>
            <video class="ppc-page-hero-bg-video" autoplay muted playsinline loop <?php echo $hero_video_poster_url ? 'poster="' . $hero_video_poster_url . '"' : ''; ?>>
                <?php if ($hero_bg_video_webm) : ?><source src="<?php echo esc_url($hero_bg_video_webm); ?>" type="video/webm"><?php endif; ?>
                <?php if ($hero_bg_video_mp4) : ?><source src="<?php echo esc_url($hero_bg_video_mp4); ?>" type="video/mp4"><?php endif; ?>
            </video>
        <?php elseif ($hero_bg_type === 'image' && $hero_image_url) : ?>
            <div class="ppc-page-hero-bg-image" style="background-image:url('<?php echo $hero_image_url; ?>');"></div>
        <?php endif; ?>
        <div class="ppc-page-hero-bg-overlay" style="opacity: <?php echo esc_attr($hero_bg_overlay); ?>;"></div>
    </div>
    <?php endif; ?>

    <div class="ppc-page-hero-content">
        <span class="ppc-page-hero-label"><?php echo esc_html($hero_label); ?></span>
        <h1><?php echo wp_kses_post($hero_line1); ?><br><?php echo wp_kses_post($hero_line2); ?></h1>
        <p class="ppc-page-hero-description"><?php echo wp_kses_post($hero_desc); ?></p>
        <div class="ppc-page-hero-buttons">
            <a href="<?php echo $hero_primary_btn['url']; ?>" target="<?php echo $hero_primary_btn['target']; ?>" class="cta-btn"><?php echo $hero_primary_btn['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></a>
            <a href="<?php echo $hero_secondary_btn['url']; ?>" target="<?php echo $hero_secondary_btn['target']; ?>" class="cta-btn-outline-dark"><?php echo $hero_secondary_btn['title']; ?></a>
        </div>
    </div>
</section>

<?php
// STATS
$stats = $has_acf ? get_field('ppc_stats') : [];
if (!$stats || !is_array($stats) || empty($stats)) {
    $stats = [
        ['number' => '500%', 'label' => 'Average ROAS'],
        ['number' => '£5M+', 'label' => 'Ad Spend Managed'],
        ['number' => '10K+', 'label' => 'Conversions Generated'],
        ['number' => '50+', 'label' => 'Happy Clients'],
    ];
}
?>

<section class="ppc-page-stats" data-section-theme="light">
    <div class="ppc-page-stats-container">
        <?php foreach ($stats as $stat) : ?>
            <div class="ppc-page-stat-item">
                <span class="ppc-page-stat-number"><?php echo esc_html($stat['number'] ?? ''); ?></span>
                <span class="ppc-page-stat-label"><?php echo esc_html($stat['label'] ?? ''); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
// INFO SECTION 1 - What is PPC?
$what_is_heading_line1 = $has_acf ? get_field('ppc_what_is_heading_line1') : '';
$what_is_heading_line2 = $has_acf ? get_field('ppc_what_is_heading_line2') : '';
$what_is_content = $has_acf ? get_field('ppc_what_is_content') : '';
$what_is_image = $has_acf ? get_field('ppc_what_is_image') : null;
$what_is_button = $has_acf ? hd_link(get_field('ppc_what_is_button')) : null;
$what_is_image_url = ($what_is_image && is_array($what_is_image) && !empty($what_is_image['url'])) ? esc_url($what_is_image['url']) : '';
if (!$what_is_button) $what_is_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="ppc-page-info ppc-page-info-1" data-section-theme="light">
    <div class="ppc-page-info-container">
        <h2 class="ppc-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo $what_is_heading_line1 ? esc_html($what_is_heading_line1) : 'What is'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $what_is_heading_line2 ? esc_html($what_is_heading_line2) : 'PPC?'; ?></span>
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
                    <div class="ppc-page-info-placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// LONG CTA 1
$long_cta1_label = $has_acf ? get_field('ppc_long_cta1_label') : '';
$long_cta1_heading_line1 = $has_acf ? get_field('ppc_long_cta1_heading_line1') : '';
$long_cta1_heading_line2 = $has_acf ? get_field('ppc_long_cta1_heading_line2') : '';
$long_cta1_text = $has_acf ? get_field('ppc_long_cta1_text') : '';
$long_cta1_features = $has_acf ? get_field('ppc_long_cta1_features') : [];
$long_cta1_primary_button = $has_acf ? hd_link(get_field('ppc_long_cta1_primary_button')) : null;
$long_cta1_secondary_button = $has_acf ? hd_link(get_field('ppc_long_cta1_secondary_button')) : null;
if (!$long_cta1_primary_button) $long_cta1_primary_button = ['url' => '#contact', 'title' => 'Start Your Campaign', 'target' => '_self'];
if (!$long_cta1_secondary_button) $long_cta1_secondary_button = ['url' => 'tel:01onal275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ppc-page-longcta ppc-page-longcta-1" data-section-theme="light">
    <div class="ppc-page-longcta-container">
        <div class="ppc-page-longcta-content animate-fade-in">
            <span class="ppc-page-longcta-label"><?php echo $long_cta1_label ? esc_html($long_cta1_label) : 'READY TO ADVERTISE?'; ?></span>
            <h2 class="ppc-page-longcta-heading">
                <span class="black-text"><?php echo $long_cta1_heading_line1 ? esc_html($long_cta1_heading_line1) : 'Drive Immediate'; ?></span><br>
                <span class="highlight-text-italic"><?php echo $long_cta1_heading_line2 ? esc_html($long_cta1_heading_line2) : 'Qualified Traffic'; ?></span>
            </h2>
            <?php if ($long_cta1_text) : ?><p class="ppc-page-longcta-text"><?php echo wp_kses_post($long_cta1_text); ?></p><?php endif; ?>
            <div class="ppc-page-longcta-features">
                <?php if ($long_cta1_features && is_array($long_cta1_features)) : ?>
                    <?php foreach ($long_cta1_features as $feature) : ?>
                        <div class="ppc-page-longcta-feature">
                            <div class="ppc-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? wp_kses_post($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="ppc-page-longcta-feature-text"><h4><?php echo esc_html($feature['title'] ?? ''); ?></h4><p><?php echo esc_html($feature['description'] ?? ''); ?></p></div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Instant Results</h4><p>Start driving traffic to your website the moment your campaign goes live</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>You Control the Budget</h4><p>Set your own spend limits and only pay for actual clicks</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Measurable ROI</h4><p>Track every click, conversion, and pound spent with complete transparency</p></div></div>
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
// SERVICES
$services_label = $has_acf ? (get_field('ppc_services_label') ?: 'What We Offer') : 'What We Offer';
$services_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_services_heading') : '', 'Our PPC <span class="highlight-text-italic">Services</span>');
$services_subheading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_services_subheading') : '', 'Comprehensive paid advertising solutions across all major platforms');
$services = $has_acf ? get_field('ppc_services') : [];
if (!$services || !is_array($services) || empty($services)) {
    $services = [
        ['title' => 'Google Ads', 'description' => 'Search, Display, Shopping, and YouTube campaigns that reach customers at the moment they\'re looking for you.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>'],
        ['title' => 'Social Media Ads', 'description' => 'Facebook, Instagram, LinkedIn and TikTok advertising that targets your ideal audience with precision.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>'],
        ['title' => 'Remarketing', 'description' => 'Re-engage visitors who\'ve shown interest in your products or services with tailored follow-up campaigns.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>'],
        ['title' => 'Shopping Campaigns', 'description' => 'E-commerce focused campaigns that showcase your products directly in search results and drive sales.', 'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>'],
    ];
}
?>

<section class="ppc-page-services" id="services" data-section-theme="light">
    <div class="ppc-page-services-container">
        <div class="ppc-page-services-header">
            <span class="ppc-page-services-label"><?php echo esc_html($services_label); ?></span>
            <h2><?php echo wp_kses_post($services_heading); ?></h2>
            <p><?php echo wp_kses_post($services_subheading); ?></p>
        </div>
        <div class="ppc-page-services-grid">
            <?php foreach (array_slice($services, 0, 4) as $service) : ?>
                <div class="ppc-page-service-card">
                    <div class="ppc-page-service-icon"><?php echo wp_kses_post($service['icon_svg'] ?? ''); ?></div>
                    <h3><?php echo esc_html($service['title'] ?? ''); ?></h3>
                    <p><?php echo esc_html($service['description'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// INFO SECTION 2 - How Much Does PPC Cost? (Reversed)
$cost_heading_line1 = $has_acf ? get_field('ppc_cost_heading_line1') : '';
$cost_heading_line2 = $has_acf ? get_field('ppc_cost_heading_line2') : '';
$cost_content = $has_acf ? get_field('ppc_cost_content') : '';
$cost_image = $has_acf ? get_field('ppc_cost_image') : null;
$cost_button = $has_acf ? hd_link(get_field('ppc_cost_button')) : null;
$cost_image_url = ($cost_image && is_array($cost_image) && !empty($cost_image['url'])) ? esc_url($cost_image['url']) : '';
if (!$cost_button) $cost_button = ['url' => '#contact', 'title' => 'Get a Quote', 'target' => '_self'];
?>

<section class="ppc-page-info ppc-page-info-2" data-section-theme="light">
    <div class="ppc-page-info-container">
        <h2 class="ppc-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo $cost_heading_line1 ? esc_html($cost_heading_line1) : 'How Much Does'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $cost_heading_line2 ? esc_html($cost_heading_line2) : 'PPC Cost?'; ?></span>
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
                    <p>Advertising spend should be seen as an investment in your growth, not a cost to the company. With our team of certified PPC experts managing your campaign you can focus on running your business.</p>
                <?php endif; ?>
                <a href="<?php echo esc_url($cost_button['url']); ?>" class="cta-button"><?php echo esc_html($cost_button['title']); ?></a>
            </div>
        </div>
    </div>
</section>

<?php
// LONG CTA 2 (Simpler, no features)
$long_cta2_label = $has_acf ? get_field('ppc_long_cta2_label') : '';
$long_cta2_heading_line1 = $has_acf ? get_field('ppc_long_cta2_heading_line1') : '';
$long_cta2_heading_line2 = $has_acf ? get_field('ppc_long_cta2_heading_line2') : '';
$long_cta2_text = $has_acf ? get_field('ppc_long_cta2_text') : '';
$long_cta2_primary_button = $has_acf ? hd_link(get_field('ppc_long_cta2_primary_button')) : null;
$long_cta2_secondary_button = $has_acf ? hd_link(get_field('ppc_long_cta2_secondary_button')) : null;
if (!$long_cta2_primary_button) $long_cta2_primary_button = ['url' => '#contact', 'title' => 'Get Your Free Audit', 'target' => '_self'];
if (!$long_cta2_secondary_button) $long_cta2_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ppc-page-longcta ppc-page-longcta-2" data-section-theme="light">
    <div class="ppc-page-longcta-container">
        <div class="ppc-page-longcta-content animate-fade-in">
            <span class="ppc-page-longcta-label"><?php echo $long_cta2_label ? esc_html($long_cta2_label) : 'FREE PPC AUDIT'; ?></span>
            <h2 class="ppc-page-longcta-heading">
                <span class="black-text"><?php echo $long_cta2_heading_line1 ? esc_html($long_cta2_heading_line1) : 'See How Your Ads'; ?></span><br>
                <span class="highlight-text-italic"><?php echo $long_cta2_heading_line2 ? esc_html($long_cta2_heading_line2) : 'Could Perform Better'; ?></span>
            </h2>
            <p class="ppc-page-longcta-text"><?php echo $long_cta2_text ? wp_kses_post($long_cta2_text) : 'Get a comprehensive analysis of your current PPC campaigns. We\'ll identify wasted spend, missed opportunities, and show you exactly how to improve your return on ad spend.'; ?></p>
            <div class="ppc-page-longcta-buttons">
                <a href="<?php echo esc_url($long_cta2_primary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-primary"><span><?php echo esc_html($long_cta2_primary_button['title']); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                <a href="<?php echo esc_url($long_cta2_secondary_button['url']); ?>" class="ppc-page-longcta-btn ppc-page-longcta-btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg><span><?php echo esc_html($long_cta2_secondary_button['title']); ?></span></a>
            </div>
        </div>
    </div>
</section>

<?php
// PROCESS
$process_label = $has_acf ? (get_field('ppc_process_label') ?: 'How We Work') : 'How We Work';
$process_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_process_heading') : '', 'Our PPC <span class="highlight-text-italic">Process</span>');
$process_subheading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_process_subheading') : '', 'A proven methodology that maximises your return on ad spend');
$process_steps = $has_acf ? get_field('ppc_process_steps') : [];
if (!$process_steps || !is_array($process_steps) || empty($process_steps)) {
    $process_steps = [
        ['title' => 'Discovery & Research', 'description' => 'We analyse your business, competitors, and target audience to identify the best opportunities for your campaigns.'],
        ['title' => 'Campaign Setup', 'description' => 'We build your campaigns from the ground up with optimised ad copy, targeting, and bid strategies.'],
        ['title' => 'Launch & Monitor', 'description' => 'Your campaigns go live and we monitor performance closely, making adjustments in real-time.'],
        ['title' => 'Optimise & Scale', 'description' => 'We continuously refine your campaigns based on data, scaling what works and cutting what doesn\'t.'],
    ];
}
?>

<section class="ppc-page-process" data-section-theme="light">
    <div class="ppc-page-process-container">
        <div class="ppc-page-process-header">
            <span class="ppc-page-process-label"><?php echo esc_html($process_label); ?></span>
            <h2><?php echo wp_kses_post($process_heading); ?></h2>
            <p><?php echo wp_kses_post($process_subheading); ?></p>
        </div>
        <div class="ppc-page-process-timeline">
            <?php foreach ($process_steps as $index => $step) : ?>
                <div class="ppc-page-process-step">
                    <div class="ppc-page-process-number"><?php echo esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></div>
                    <div class="ppc-page-process-content"><h3><?php echo esc_html($step['title'] ?? ''); ?></h3><p><?php echo esc_html($step['description'] ?? ''); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// INFO SECTION 3 - What Makes Us Different
$different_heading_line1 = $has_acf ? get_field('ppc_different_heading_line1') : '';
$different_heading_line2 = $has_acf ? get_field('ppc_different_heading_line2') : '';
$different_content = $has_acf ? get_field('ppc_different_content') : '';
$different_image = $has_acf ? get_field('ppc_different_image') : null;
$different_button = $has_acf ? hd_link(get_field('ppc_different_button')) : null;
$different_image_url = ($different_image && is_array($different_image) && !empty($different_image['url'])) ? esc_url($different_image['url']) : '';
if (!$different_button) $different_button = ['url' => '#contact', 'title' => 'Get in Touch', 'target' => '_self'];
?>

<section class="ppc-page-info ppc-page-info-3" data-section-theme="light">
    <div class="ppc-page-info-container">
        <h2 class="ppc-page-info-heading animate-fade-in">
            <span class="black-text"><?php echo $different_heading_line1 ? esc_html($different_heading_line1) : 'What Makes Us'; ?></span><br>
            <span class="highlight-text-italic"><?php echo $different_heading_line2 ? esc_html($different_heading_line2) : 'Different?'; ?></span>
        </h2>
        <div class="ppc-page-info-content">
            <div class="ppc-page-info-text animate-slide-left">
                <?php if ($different_content) : ?>
                    <?php echo wp_kses_post(apply_filters('the_content', $different_content)); ?>
                <?php else : ?>
                    <p>We want to help you understand what PPC is and that it should not just be used as a quick fix, but as a long term plan that will help your business grow.</p>
                    <p>Everything we do, from creating new campaigns, all the way through to new landing pages, we will explain to you our decisions and why making those changes will benefit your business.</p>
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
// LONG CTA 3
$long_cta3_label = $has_acf ? get_field('ppc_long_cta3_label') : '';
$long_cta3_heading_line1 = $has_acf ? get_field('ppc_long_cta3_heading_line1') : '';
$long_cta3_heading_line2 = $has_acf ? get_field('ppc_long_cta3_heading_line2') : '';
$long_cta3_text = $has_acf ? get_field('ppc_long_cta3_text') : '';
$long_cta3_features = $has_acf ? get_field('ppc_long_cta3_features') : [];
$long_cta3_primary_button = $has_acf ? hd_link(get_field('ppc_long_cta3_primary_button')) : null;
$long_cta3_secondary_button = $has_acf ? hd_link(get_field('ppc_long_cta3_secondary_button')) : null;
if (!$long_cta3_primary_button) $long_cta3_primary_button = ['url' => '#contact', 'title' => 'Start Your Campaign', 'target' => '_self'];
if (!$long_cta3_secondary_button) $long_cta3_secondary_button = ['url' => 'tel:01275792114', 'title' => 'Call Us: 01275 792 114', 'target' => '_self'];
?>

<section class="ppc-page-longcta ppc-page-longcta-3" data-section-theme="light">
    <div class="ppc-page-longcta-container">
        <div class="ppc-page-longcta-content animate-fade-in">
            <span class="ppc-page-longcta-label"><?php echo $long_cta3_label ? esc_html($long_cta3_label) : 'CERTIFIED EXPERTS'; ?></span>
            <h2 class="ppc-page-longcta-heading">
                <span class="black-text"><?php echo $long_cta3_heading_line1 ? esc_html($long_cta3_heading_line1) : 'Ready to Maximise'; ?></span><br>
                <span class="highlight-text-italic"><?php echo $long_cta3_heading_line2 ? esc_html($long_cta3_heading_line2) : 'Your Ad Spend?'; ?></span>
            </h2>
            <?php if ($long_cta3_text) : ?><p class="ppc-page-longcta-text"><?php echo wp_kses_post($long_cta3_text); ?></p><?php endif; ?>
            <div class="ppc-page-longcta-features">
                <?php if ($long_cta3_features && is_array($long_cta3_features)) : ?>
                    <?php foreach ($long_cta3_features as $feature) : ?>
                        <div class="ppc-page-longcta-feature">
                            <div class="ppc-page-longcta-feature-icon"><?php echo !empty($feature['icon_svg']) ? wp_kses_post($feature['icon_svg']) : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>'; ?></div>
                            <div class="ppc-page-longcta-feature-text"><h4><?php echo esc_html($feature['title'] ?? ''); ?></h4><p><?php echo esc_html($feature['description'] ?? ''); ?></p></div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Google Certified</h4><p>Our team holds Google Ads certifications across all campaign types</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>Transparent Reporting</h4><p>Weekly and monthly reports you can actually understand</p></div></div>
                    <div class="ppc-page-longcta-feature"><div class="ppc-page-longcta-feature-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div class="ppc-page-longcta-feature-text"><h4>No Hidden Fees</h4><p>Clear pricing with no surprises or additional charges</p></div></div>
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
// RESULTS
$results_label = $has_acf ? (get_field('ppc_results_label') ?: 'Case Studies') : 'Case Studies';
$results_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_results_heading') : '', 'Real <span class="highlight-text-italic">Results</span>');
$results_subheading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_results_subheading') : '', 'See how we\'ve helped businesses maximise their return on ad spend');
$results = $has_acf ? get_field('ppc_results') : [];
if (!$results || !is_array($results) || empty($results)) {
    $results = [
        ['industry' => 'E-commerce', 'title' => 'My Reusable', 'description' => 'Scaled from £5k to £50k monthly ad spend while maintaining 5x ROAS.', 'metric1_value' => '500%', 'metric1_label' => 'ROAS', 'metric2_value' => '+800%', 'metric2_label' => 'Revenue'],
        ['industry' => 'Services', 'title' => 'LaserX', 'description' => 'Reduced cost per lead by 60% while increasing overall lead volume.', 'metric1_value' => '-60%', 'metric1_label' => 'Cost Per Lead', 'metric2_value' => '+200%', 'metric2_label' => 'Leads'],
        ['industry' => 'Automotive', 'title' => 'Severnside Campervans', 'description' => 'Generated over 500 qualified enquiries in the first 6 months.', 'metric1_value' => '500+', 'metric1_label' => 'Enquiries', 'metric2_value' => '£3.20', 'metric2_label' => 'Cost Per Click'],
    ];
}
?>

<section class="ppc-page-results" data-section-theme="light">
    <div class="ppc-page-results-container">
        <div class="ppc-page-results-header">
            <span class="ppc-page-results-label"><?php echo esc_html($results_label); ?></span>
            <h2><?php echo wp_kses_post($results_heading); ?></h2>
            <p><?php echo wp_kses_post($results_subheading); ?></p>
        </div>
        <div class="ppc-page-results-grid">
            <?php foreach ($results as $result) : ?>
                <div class="ppc-page-result-card">
                    <div class="ppc-page-result-image"><div class="ppc-page-result-placeholder"><span><?php echo esc_html(substr($result['title'] ?? 'C', 0, 1)); ?></span></div></div>
                    <div class="ppc-page-result-content">
                        <span class="ppc-page-result-industry"><?php echo esc_html($result['industry'] ?? ''); ?></span>
                        <h3><?php echo esc_html($result['title'] ?? ''); ?></h3>
                        <p><?php echo esc_html($result['description'] ?? ''); ?></p>
                        <div class="ppc-page-result-metrics">
                            <div class="ppc-page-result-metric"><span class="ppc-page-result-metric-value"><?php echo esc_html($result['metric1_value'] ?? ''); ?></span><span class="ppc-page-result-metric-label"><?php echo esc_html($result['metric1_label'] ?? ''); ?></span></div>
                            <div class="ppc-page-result-metric"><span class="ppc-page-result-metric-value"><?php echo esc_html($result['metric2_value'] ?? ''); ?></span><span class="ppc-page-result-metric-label"><?php echo esc_html($result['metric2_label'] ?? ''); ?></span></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// FAQ
$faq_label = $has_acf ? (get_field('ppc_faq_label') ?: 'FAQ') : 'FAQ';
$faq_heading = hd_wysiwyg_or_default($has_acf ? get_field('ppc_faq_heading') : '', 'Frequently Asked <span class="highlight-text-italic">Questions</span>');
$faqs = $has_acf ? get_field('ppc_faqs') : [];
if (!$faqs || !is_array($faqs) || empty($faqs)) {
    $faqs = [
        ['question' => 'How quickly will I see results from PPC?', 'answer' => 'Unlike SEO, PPC delivers immediate results. You can start driving traffic the moment your campaigns go live.'],
        ['question' => 'What platforms do you advertise on?', 'answer' => 'We manage campaigns across Google Ads, Microsoft Ads, Facebook, Instagram, LinkedIn, TikTok, and more.'],
        ['question' => 'How much should I spend on PPC?', 'answer' => 'Budget depends on your goals and industry. We\'ll help you find the right spend level to achieve your objectives.'],
        ['question' => 'What\'s included in your management fee?', 'answer' => 'Campaign setup, ongoing optimisation, A/B testing, competitor analysis, and regular reporting with actionable insights.'],
        ['question' => 'Do you require long-term contracts?', 'answer' => 'No. We work on a month-to-month basis because we believe in earning your business through results.'],
    ];
}
?>

<section class="ppc-page-faq" data-section-theme="light">
    <div class="ppc-page-faq-container">
        <div class="ppc-page-faq-header">
            <span class="ppc-page-faq-label"><?php echo esc_html($faq_label); ?></span>
            <h2><?php echo wp_kses_post($faq_heading); ?></h2>
        </div>
        <div class="ppc-page-faq-list">
            <?php foreach ($faqs as $index => $faq) : ?>
                <div class="ppc-page-faq-item" data-faq-index="<?php echo $index; ?>">
                    <button class="ppc-page-faq-question" aria-expanded="false"><span><?php echo esc_html($faq['question'] ?? ''); ?></span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg></button>
                    <div class="ppc-page-faq-answer"><p><?php echo wp_kses_post($faq['answer'] ?? ''); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    
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