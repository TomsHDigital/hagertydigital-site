<!-- HEADER.PHP LOADED -->

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<?php
// Hard-coded values from your original HTML (no ACF)
$brand_name = 'Hagerty Digital';

$logo_light = 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/logo.png';
$logo_dark  = 'https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/logoblack.png';

$phone_raw   = '01275792114';
$phone_label = '01275 792 114';
$email       = 'hello@hagertydigital.com';

$address_lines = [
  'Hagerty Digital Ltd',
  '88 High Street',
  'Nailsea, Bristol, BS48 1AS',
];

// ============================================
// MENU SLIDESHOW IMAGES - ACF Repeater
// Field name: menu_slideshow_images (Options page)
// Sub-fields: image (Image), link (Link)
// ============================================
$menu_slideshow_images = [];
if (function_exists('get_field')) {
    $slideshow_data = get_field('menu_slideshow_images', 'option');
    if ($slideshow_data && is_array($slideshow_data)) {
        $menu_slideshow_images = $slideshow_data;
    }
}

// Helper to support ACF link sub-field returning either array OR string URL
if (!function_exists('hd_get_link')) {
    function hd_get_link($link) {
      $out = [
        'url'    => '#',
        'target' => '_self',
      ];

      if (is_array($link)) {
        if (!empty($link['url']))    $out['url'] = $link['url'];
        if (!empty($link['target'])) $out['target'] = $link['target'];
        return $out;
      }

      if (is_string($link) && $link !== '') {
        $out['url'] = $link;
        return $out;
      }

      return $out;
    }
}
?>

<!-- HEADER - LOOM STYLE FLOATING NAV -->
<header class="site-header" id="siteHeader">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
    <img
      src="<?php echo esc_url($logo_light); ?>"
      alt="<?php echo esc_attr($brand_name); ?>"
      id="header-logo"
      loading="eager"
      decoding="async"
    >
  </a>

  <button class="hamburger" id="hamburgerBtn" aria-label="Open menu" aria-controls="menuOverlay" aria-expanded="false">
    <span></span>
    <span></span>
    <span></span>
  </button>
</header>

<!-- Full Screen Menu Overlay - Light Theme -->
<div class="menu-overlay" id="menuOverlay" aria-hidden="true">
  <button class="menu-close-btn" id="menuCloseBtn" aria-label="Close menu">&times;</button>

  <div class="menu-content">
    <div class="menu-logo">
      <img
        src="<?php echo esc_url($logo_dark); ?>"
        alt="<?php echo esc_attr($brand_name); ?>"
        loading="lazy"
        decoding="async"
      >
    </div>

    <!-- Desktop Menu Grid -->
    <div class="menu-grid">
      <div class="menu-column">
        <a href="/about-us" class="menu-column-heading-link"><h3>Who We Are</h3></a>
        <ul>
          <li><a href="/about-us">About Us</a></li>
          <li><a href="/meet-the-team">Meet The Team</a></li>
          <li><a href="#careers">Careers</a></li>
        </ul>
      </div>

      <div class="menu-column">
        <a href="/services" class="menu-column-heading-link"><h3>What We Do</h3></a>
        <ul>
          <li><a href="/ppc">PPC</a></li>
          <li><a href="/seo">SEO</a></li>
          <li><a href="/web-design">Web Design</a></li>
          <li><a href="/web-development">Web Development</a></li>
          <li><a href="/cro">CRO</a></li>
          <li><a href="/email-marketing">Email Marketing</a></li>
          <li><a href="/digital-strategy">Digital Strategy</a></li>
          <li><a href="/automation">Automation</a></li>
        </ul>
      </div>

      <div class="menu-column">
        <a href="/case-studies" class="menu-column-heading-link"><h3>Our Work</h3></a>
        <ul>
          <li><a href="/case-studies">Case Studies</a></li>
          <li><a href="/testimonials">Client Testimonials</a></li>
          <li><a href="/news">News</a></li>
        </ul>
      </div>

      <div class="menu-column contact-column">
        <h3>Get in touch</h3>
        <ul>
          <li><a href="/contact">Contact Us</a></li>
          <li><a href="tel:<?php echo esc_attr($phone_raw); ?>"><?php echo esc_html($phone_label); ?></a></li>
          <li><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
        </ul>

        <div class="menu-address">
          <h4>Visit our studio</h4>
          <p>
            <?php echo esc_html($address_lines[0]); ?><br>
            <?php echo esc_html($address_lines[1]); ?><br>
            <?php echo esc_html($address_lines[2]); ?>
          </p>
        </div>
      </div>
    </div>

    <!-- Menu Banner Slideshow - Full Width Below Menu -->
    <?php if (!empty($menu_slideshow_images)) : ?>
    <div class="menu-banner-slideshow" id="menuBannerSlideshow">
      <div class="menu-banner-track">
        <?php foreach ($menu_slideshow_images as $index => $slide) : 
          $slide_image_url = isset($slide['image']['url']) ? esc_url($slide['image']['url']) : '';
          $link = hd_get_link($slide['link'] ?? null);
          $slide_link_url = esc_url($link['url']);
          $slide_link_target = esc_attr($link['target']);
          if (!$slide_image_url) continue;
        ?>
          <a href="<?php echo $slide_link_url; ?>" target="<?php echo $slide_link_target; ?>" class="menu-banner-slide <?php echo $index === 0 ? 'active' : ''; ?>">
            <img src="<?php echo $slide_image_url; ?>" alt="Featured">
          </a>
        <?php endforeach; ?>
      </div>
      <div class="menu-banner-nav">
        <button class="menu-banner-prev" aria-label="Previous slide">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </button>
        <div class="menu-banner-dots" id="menuBannerDots">
          <?php foreach ($menu_slideshow_images as $index => $slide) : 
            if (empty($slide['image']['url'])) continue;
          ?>
            <button class="menu-banner-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" aria-label="Go to slide <?php echo $index + 1; ?>"></button>
          <?php endforeach; ?>
        </div>
        <button class="menu-banner-next" aria-label="Next slide">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 18l6-6-6-6"/>
          </svg>
        </button>
      </div>
    </div>
    <?php endif; ?>

    <!-- Mobile Menu -->
    <div class="menu-mobile">
      <div class="menu-mobile-item">
        <div class="menu-mobile-header">
          <span>Who We Are</span>
          <span class="menu-arrow">▼</span>
        </div>
        <div class="menu-mobile-submenu">
          <a href="/about-us">About Us</a>
          <a href="/meet-the-team">Meet The Team</a>
          <a href="/careers">Careers</a>
        </div>
      </div>

      <div class="menu-mobile-item">
        <div class="menu-mobile-header">
          <span>What We Do</span>
          <span class="menu-arrow">▼</span>
        </div>
        <div class="menu-mobile-submenu">
          <a href="/ppc">PPC</a>
          <a href="/seo">SEO</a>
          <a href="/web-design">Web Design</a>
          <a href="/web-development">Web Development</a>
          <a href="/cro">CRO</a>
          <a href="/email-marketing">Email Marketing</a>
          <a href="/digital-strategy">Digital Strategy</a>
          <a href="/automation">Automation</a>
        </div>
      </div>

      <div class="menu-mobile-item">
        <div class="menu-mobile-header">
          <span>Our Work</span>
          <span class="menu-arrow">▼</span>
        </div>
        <div class="menu-mobile-submenu">
          <a href="/case-studies">Case Studies</a>
          <a href="/testimonials">Client Testimonials</a>
          <a href="/news">News</a>
        </div>
      </div>

      <a href="/contact" class="menu-mobile-link">Contact Us</a>

      <!-- Mobile Menu Banner Slideshow -->
      <?php if (!empty($menu_slideshow_images)) : ?>
      <div class="menu-mobile-banner-slideshow" id="menuMobileBannerSlideshow">
        <?php foreach ($menu_slideshow_images as $index => $slide) : 
          $slide_image_url = isset($slide['image']['url']) ? esc_url($slide['image']['url']) : '';
          $link = hd_get_link($slide['link'] ?? null);
          $slide_link_url = esc_url($link['url']);
          $slide_link_target = esc_attr($link['target']);
          if (!$slide_image_url) continue;
        ?>
          <a href="<?php echo $slide_link_url; ?>" target="<?php echo $slide_link_target; ?>" class="menu-slideshow-slide <?php echo $index === 0 ? 'active' : ''; ?>">
            <img src="<?php echo $slide_image_url; ?>" alt="Featured">
          </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <div class="menu-mobile-contact">
        <h4>Get in touch</h4>
        <a href="tel:<?php echo esc_attr($phone_raw); ?>"><?php echo esc_html($phone_label); ?></a>
        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>

        <p style="margin-top: 20px;">
          <?php echo esc_html($address_lines[0]); ?><br>
          <?php echo esc_html($address_lines[1]); ?><br>
          <?php echo esc_html($address_lines[2]); ?>
        </p>
      </div>
    </div>

  </div>
</div>

<main id="siteMain">