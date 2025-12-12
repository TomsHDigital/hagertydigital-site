<?php
/**
 * Template Name: Testimonials
 * 
 * Custom page template for the Testimonials page
 * Inspired by Loom Digital and Hagerty Digital design patterns
 * All classes prefixed with testimonials-page- for independent styling
 */

get_header();

$has_acf = function_exists('get_field');

// Helpers
if (!function_exists('testimonials_strip_wrapping_p')) {
    function testimonials_strip_wrapping_p($html) {
        if (!$html) return '';
        return preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($html));
    }
}

if (!function_exists('testimonials_wysiwyg_or_default')) {
    function testimonials_wysiwyg_or_default($field_value, $default_html) {
        $val = $field_value ? apply_filters('the_content', $field_value) : $default_html;
        return testimonials_strip_wrapping_p($val);
    }
}

if (!function_exists('testimonials_link')) {
    function testimonials_link($link_field) {
        if (!$link_field || !is_array($link_field) || empty($link_field['url'])) return null;
        return [
            'url'    => esc_url($link_field['url']),
            'title'  => !empty($link_field['title']) ? esc_html($link_field['title']) : 'Learn more',
            'target' => !empty($link_field['target']) ? esc_attr($link_field['target']) : '_self',
        ];
    }
}

// ============================================
// HERO SECTION ACF FIELDS
// ============================================
$hero_label             = $has_acf ? get_field('testimonials_hero_label') : '';
$hero_heading_line_1    = $has_acf ? get_field('testimonials_hero_heading_line_1') : '';
$hero_heading_line_2    = $has_acf ? get_field('testimonials_hero_heading_line_2') : '';
$hero_text              = $has_acf ? get_field('testimonials_hero_text') : '';
$hero_video             = $has_acf ? get_field('testimonials_hero_video') : '';
$hero_image             = $has_acf ? get_field('testimonials_hero_image') : '';
$hero_overlay_enabled   = $has_acf ? get_field('testimonials_hero_overlay_enabled') : true;
$hero_overlay_opacity   = $has_acf ? get_field('testimonials_hero_overlay_opacity') : 70;
$hero_overlay_color     = $has_acf ? get_field('testimonials_hero_overlay_color') : '#000000';

// Ensure overlay opacity is a valid number between 0-100
$hero_overlay_opacity = is_numeric($hero_overlay_opacity) ? max(0, min(100, intval($hero_overlay_opacity))) : 70;

// ============================================
// FEATURED TESTIMONIAL SECTION ACF FIELDS
// ============================================
$featured_client_logo       = $has_acf ? get_field('testimonials_featured_client_logo') : '';
$featured_client_image      = $has_acf ? get_field('testimonials_featured_client_image') : '';
$featured_quote             = $has_acf ? get_field('testimonials_featured_quote') : '';
$featured_author_name       = $has_acf ? get_field('testimonials_featured_author_name') : '';
$featured_author_role       = $has_acf ? get_field('testimonials_featured_author_role') : '';
$featured_case_study_link   = $has_acf ? get_field('testimonials_featured_case_study_link') : '';

// ============================================
// STATS SECTION ACF FIELDS
// ============================================
$stats_heading_line_1   = $has_acf ? get_field('testimonials_stats_heading_line_1') : '';
$stats_heading_line_2   = $has_acf ? get_field('testimonials_stats_heading_line_2') : '';
$stats_items            = $has_acf ? get_field('testimonials_stats_items') : [];

// ============================================
// TESTIMONIALS GRID SECTION ACF FIELDS
// ============================================
$grid_heading_line_1    = $has_acf ? get_field('testimonials_grid_heading_line_1') : '';
$grid_heading_line_2    = $has_acf ? get_field('testimonials_grid_heading_line_2') : '';
$grid_intro_text        = $has_acf ? get_field('testimonials_grid_intro_text') : '';
$testimonials_grid      = $has_acf ? get_field('testimonials_grid_items') : [];

// ============================================
// CLIENT LOGOS SECTION ACF FIELDS
// ============================================
$logos_heading_line_1   = $has_acf ? get_field('testimonials_logos_heading_line_1') : '';
$logos_heading_line_2   = $has_acf ? get_field('testimonials_logos_heading_line_2') : '';
$client_logos           = $has_acf ? get_field('testimonials_client_logos') : [];

// ============================================
// VIDEO TESTIMONIALS SECTION ACF FIELDS
// ============================================
$video_heading_line_1   = $has_acf ? get_field('testimonials_video_heading_line_1') : '';
$video_heading_line_2   = $has_acf ? get_field('testimonials_video_heading_line_2') : '';
$video_intro_text       = $has_acf ? get_field('testimonials_video_intro_text') : '';
$video_testimonials     = $has_acf ? get_field('testimonials_video_items') : [];

// ============================================
// FULL TESTIMONIALS CAROUSEL ACF FIELDS
// ============================================
$carousel_heading_line_1 = $has_acf ? get_field('testimonials_carousel_heading_line_1') : '';
$carousel_heading_line_2 = $has_acf ? get_field('testimonials_carousel_heading_line_2') : '';
$carousel_testimonials   = $has_acf ? get_field('testimonials_carousel_items') : [];

// ============================================
// CTA SECTION ACF FIELDS
// ============================================
$cta_label              = $has_acf ? get_field('testimonials_cta_label') : '';
$cta_heading_line_1     = $has_acf ? get_field('testimonials_cta_heading_line_1') : '';
$cta_heading_line_2     = $has_acf ? get_field('testimonials_cta_heading_line_2') : '';
$cta_text               = $has_acf ? get_field('testimonials_cta_text') : '';
$cta_button_text        = $has_acf ? get_field('testimonials_cta_button_text') : '';
$cta_button_link        = $has_acf ? get_field('testimonials_cta_button_link') : '';
$cta_features           = $has_acf ? get_field('testimonials_cta_features') : [];

// Default testimonials data for demo
$default_testimonials = [
    [
        'quote' => 'Recently went self-employed and was feeling a bit overwhelmed with where to start on the marketing side. Hagerty Digital have been absolutely brilliant, not only did they help me make the most of my (very limited) marketing budget, but they also recommended systems and tools to help streamline how I run the business day-to-day. Genuinely can\'t recommend them enough. Super helpful, honest advice from a team who really know their stuff.',
        'author_name' => 'Sophie Crockett',
        'author_role' => 'Business Owner',
        'rating' => 5
    ],
    [
        'quote' => 'Hagerty Digital are incredibly knowledgeable when it comes to website development and digital marketing. Their expertise, professionalism, and support have been outstanding throughout. I wouldn\'t recommend anyone else — they\'re the team to trust if you want results.',
        'author_name' => 'Libby Jordan',
        'author_role' => 'Marketing Manager',
        'rating' => 5
    ],
    [
        'quote' => 'I can confidently say Hagerty Digital are the best in class when it comes to digital marketing and lead generation. What sets Hagerty Digital apart is their exceptional expertise in navigating the ever-evolving digital landscape. They effectively utilise a multi-channel approach, combining SEO, social media marketing, and targeted email campaigns to drive results.',
        'author_name' => 'Liam Murphy',
        'author_role' => 'CEO',
        'rating' => 5
    ],
    [
        'quote' => 'Had a fabulous experience with Hagerty Digital. Rob, Tom, Elliot, Alfie, Sam and Max are a group of strapping lads. Couldn\'t recommend their services more, top notch boys! Five stars from me no question.',
        'author_name' => 'John Westcott',
        'author_role' => 'Business Owner',
        'rating' => 5
    ],
    [
        'quote' => 'First class at everything they do! Tom was fantastic at getting to understand my business and build me a brilliant website keeping me updated throughout the whole process with frequent and detailed updates. Cannot recommend these guys enough!',
        'author_name' => 'Joe Hyett',
        'author_role' => 'Director',
        'rating' => 5
    ],
    [
        'quote' => 'Fantastic Company! Built my companies website in a very quick timeframe and have been helping my business generate leads ever since! Would highly recommend. Elliot, Sam, Alfie, Tom and Rob have all been a pleasure to deal with.',
        'author_name' => 'Tom Humus',
        'author_role' => 'Business Owner',
        'rating' => 5
    ],
    [
        'quote' => 'These guys are the best in the lead generation game! Have worked with them for over two years and the results have been outstanding! An absolute pleasure to work with and we highly recommend!',
        'author_name' => 'Mark Thompson',
        'author_role' => 'Sales Director',
        'rating' => 5
    ],
    [
        'quote' => 'I have used Hagerty Digital for over 7 years for website design and lead optimisation. They are experts in their field and can honestly say they make a massive impact on increased sales revenue.',
        'author_name' => 'Sarah Williams',
        'author_role' => 'Managing Director',
        'rating' => 5
    ],
    [
        'quote' => 'I am so happy with the website Hagerty Digital has built for my company! Since day one, all my questions were answered, all the requests actioned and have been kept updated throughout! I will definitely use them again.',
        'author_name' => 'Emma Richardson',
        'author_role' => 'Founder',
        'rating' => 5
    ],
    [
        'quote' => 'Hagerty Digital take the stress out of digital performance and lead gen. Websites, PPC, SEO, email marketing – they cover it all. Results-driven, data-led, and genuinely easy to work with. I\'ve passed them on to a few people already, and they\'ve all been pleased with the results.',
        'author_name' => 'David Clarke',
        'author_role' => 'Operations Manager',
        'rating' => 5
    ],
    [
        'quote' => 'Was a pleasure to work with Hagerty Digital, we were quickly on the same page with the type of theme I was going for. Produced lots of brilliant edited footage. Great communication, would highly recommend.',
        'author_name' => 'James Mitchell',
        'author_role' => 'Creative Director',
        'rating' => 5
    ],
    [
        'quote' => 'Lead generation specialists, if you are looking to acquire new business Hagerty Digital are best in the business, not a typical marketing agency - they \'will\' deliver - highly recommended.',
        'author_name' => 'Richard Brown',
        'author_role' => 'CEO',
        'rating' => 5
    ]
];

// Use default if no ACF data
if (empty($testimonials_grid)) {
    $testimonials_grid = $default_testimonials;
}
if (empty($carousel_testimonials)) {
    $carousel_testimonials = $default_testimonials;
}

// Google colors for avatar backgrounds
$google_colors = ['#4285f4', '#34a853', '#fbbc05', '#ea4335', '#9c27b0', '#00bcd4', '#ff5722', '#607d8b'];
?>

<!-- Testimonials Hero Section -->
<section class="testimonials-page-hero" data-section-theme="dark">
  <div class="testimonials-page-hero-bg">
    <?php if (!empty($hero_video)) : ?>
      <video autoplay muted loop playsinline class="testimonials-page-hero-video">
        <source src="<?php echo esc_url($hero_video['url']); ?>" type="video/mp4">
      </video>
    <?php elseif (!empty($hero_image)) : ?>
      <img src="<?php echo esc_url($hero_image['url']); ?>" alt="Client Testimonials" class="testimonials-page-hero-image">
    <?php else : ?>
      <div class="testimonials-page-hero-gradient"></div>
    <?php endif; ?>
    
    <?php if ($hero_overlay_enabled !== false) : 
      // Convert hex color to RGB for rgba
      $hex = ltrim($hero_overlay_color, '#');
      if (strlen($hex) == 3) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
      }
      $r = hexdec(substr($hex, 0, 2));
      $g = hexdec(substr($hex, 2, 2));
      $b = hexdec(substr($hex, 4, 2));
      $opacity_decimal = $hero_overlay_opacity / 100;
    ?>
      <div class="testimonials-page-hero-overlay" style="background: linear-gradient(180deg, rgba(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>,<?php echo $opacity_decimal * 0.6; ?>) 0%, rgba(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>,<?php echo $opacity_decimal; ?>) 100%);"></div>
    <?php endif; ?>
  </div>

  <div class="testimonials-page-hero-content">
    <div class="testimonials-page-hero-text animate-fade-in">
      <span class="testimonials-page-hero-label">
        <?php echo !empty($hero_label) ? esc_html($hero_label) : 'Client Testimonials'; ?>
      </span>

      <?php
        $hero_line1_raw = !empty($hero_heading_line_1) ? $hero_heading_line_1 : 'See why teams';
        $hero_line2_raw = !empty($hero_heading_line_2) ? $hero_heading_line_2 : 'choose us';

        $hero_line1 = apply_filters('the_content', $hero_line1_raw);
        $hero_line2 = apply_filters('the_content', $hero_line2_raw);

        $hero_line1 = testimonials_strip_wrapping_p($hero_line1);
        $hero_line2 = testimonials_strip_wrapping_p($hero_line2);

        $hero_desc_raw = !empty($hero_text) ? $hero_text : 'We love building long-lasting and genuine relationships with marketing teams and business owners. Hear what our clients have to say about working with us.';
        $hero_desc = apply_filters('the_content', $hero_desc_raw);
        $hero_desc = testimonials_strip_wrapping_p($hero_desc);
      ?>

      <h1>
        <?php echo $hero_line1; ?>
        <br>
        <span class="highlight-text-italic"><?php echo $hero_line2; ?></span>
      </h1>

      <p class="testimonials-page-hero-description">
        <?php echo $hero_desc; ?>
      </p>

      <div class="testimonials-page-hero-rating animate-slide-up">
        <div class="testimonials-page-rating-stars">
          <span class="star">★</span>
          <span class="star">★</span>
          <span class="star">★</span>
          <span class="star">★</span>
          <span class="star">★</span>
        </div>
        <span class="testimonials-page-rating-text">5.0 Rating on Google</span>
      </div>

      <a href="#featured-testimonial" class="testimonials-page-hero-cta">
        <span>Read Our Reviews</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 5v14M5 12l7 7 7-7"/>
        </svg>
      </a>
    </div>
  </div>

  <!-- Floating testimonial cards in hero -->
  <div class="testimonials-page-hero-floating">
    <div class="testimonials-page-floating-card testimonials-page-floating-card-1 animate-float-1">
      <div class="testimonials-page-floating-stars">★★★★★</div>
      <p>"Absolutely brilliant team!"</p>
    </div>
    <div class="testimonials-page-floating-card testimonials-page-floating-card-2 animate-float-2">
      <div class="testimonials-page-floating-stars">★★★★★</div>
      <p>"Best in class!"</p>
    </div>
    <div class="testimonials-page-floating-card testimonials-page-floating-card-3 animate-float-3">
      <div class="testimonials-page-floating-stars">★★★★★</div>
      <p>"Highly recommended!"</p>
    </div>
  </div>
</section>


<!-- Featured Testimonial Section -->
<section class="testimonials-page-featured" id="featured-testimonial" data-section-theme="light">
  <div class="testimonials-page-featured-container">
    
    <div class="testimonials-page-featured-content">
      <div class="testimonials-page-featured-image animate-slide-right">
        <?php if (!empty($featured_client_image)) : ?>
          <img src="<?php echo esc_url($featured_client_image['url']); ?>" alt="Featured Client">
        <?php else : ?>
          <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&h=700&fit=crop" alt="Featured Client">
        <?php endif; ?>
        
        <?php if (!empty($featured_client_logo)) : ?>
          <div class="testimonials-page-featured-logo">
            <img src="<?php echo esc_url($featured_client_logo['url']); ?>" alt="Client Logo">
          </div>
        <?php endif; ?>
      </div>

      <div class="testimonials-page-featured-text animate-slide-left">
        <div class="testimonials-page-featured-quote-mark">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>
        </div>
        
        <?php
          $featured_quote_raw = !empty($featured_quote) ? $featured_quote : 'Absolutely fantastic company to work with, full of positivity, energy, great ideas and above all they have year on year helped grow my online business beyond any levels that any of us could have ever imagined. Hagerty Digital are like an extended part of our team, friends, colleagues and teammates.';
          $featured_quote_html = apply_filters('the_content', $featured_quote_raw);
          $featured_quote_html = testimonials_strip_wrapping_p($featured_quote_html);
        ?>
        
        <blockquote class="testimonials-page-featured-quote">
          <?php echo $featured_quote_html; ?>
        </blockquote>

        <div class="testimonials-page-featured-author">
          <div class="testimonials-page-featured-author-info">
            <h4><?php echo !empty($featured_author_name) ? esc_html($featured_author_name) : 'Sophie Crockett'; ?></h4>
            <p><?php echo !empty($featured_author_role) ? esc_html($featured_author_role) : 'Business Owner'; ?></p>
          </div>
          
          <?php 
            $case_study_link = testimonials_link($featured_case_study_link);
            if ($case_study_link) : 
          ?>
            <a href="<?php echo $case_study_link['url']; ?>" target="<?php echo $case_study_link['target']; ?>" class="testimonials-page-featured-cta">
              <span>View Case Study</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Stats Section -->
<section class="testimonials-page-stats" data-section-theme="light" style="background: #f8f8f8;">
  <div class="testimonials-page-stats-container">
    
    <div class="testimonials-page-stats-header animate-fade-in">
      <?php
        $stats_line1_raw = !empty($stats_heading_line_1) ? $stats_heading_line_1 : 'We Are Proud Of';
        $stats_line2_raw = !empty($stats_heading_line_2) ? $stats_heading_line_2 : 'Our Track Record';
        $stats_line1 = apply_filters('the_content', $stats_line1_raw);
        $stats_line2 = apply_filters('the_content', $stats_line2_raw);
        $stats_line1 = testimonials_strip_wrapping_p($stats_line1);
        $stats_line2 = testimonials_strip_wrapping_p($stats_line2);
      ?>
      <h2 class="testimonials-page-stats-heading">
        <span class="black-text"><?php echo $stats_line1; ?></span>
        <br>
        <span class="highlight-text-italic"><?php echo $stats_line2; ?></span>
      </h2>
    </div>

    <div class="testimonials-page-stats-grid">
      <?php if (!empty($stats_items)) : ?>
        <?php foreach ($stats_items as $index => $stat) : ?>
          <div class="testimonials-page-stat-item animate-scale-in" style="animation-delay: <?php echo $index * 0.1; ?>s">
            <div class="testimonials-page-stat-number">
              <span class="testimonials-page-counter" data-target="<?php echo esc_attr($stat['number']); ?>" data-suffix="<?php echo esc_attr($stat['suffix'] ?? ''); ?>">0</span><?php echo esc_html($stat['suffix'] ?? ''); ?>
            </div>
            <div class="testimonials-page-stat-label">
              <?php echo esc_html($stat['label']); ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="testimonials-page-stat-item animate-scale-in">
          <div class="testimonials-page-stat-number">
            <span class="testimonials-page-counter" data-target="27">0</span>
          </div>
          <div class="testimonials-page-stat-label">5-Star Reviews</div>
        </div>
        <div class="testimonials-page-stat-item animate-scale-in" style="animation-delay: 0.1s">
          <div class="testimonials-page-stat-number">
            <span class="testimonials-page-counter" data-target="7">0</span>+
          </div>
          <div class="testimonials-page-stat-label">Years Experience</div>
        </div>
        <div class="testimonials-page-stat-item animate-scale-in" style="animation-delay: 0.2s">
          <div class="testimonials-page-stat-number">
            <span class="testimonials-page-counter" data-target="95">0</span>%
          </div>
          <div class="testimonials-page-stat-label">Client Retention</div>
        </div>
        <div class="testimonials-page-stat-item animate-scale-in" style="animation-delay: 0.3s">
          <div class="testimonials-page-stat-number">
            <span class="testimonials-page-counter" data-target="200">0</span>+
          </div>
          <div class="testimonials-page-stat-label">Projects Delivered</div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- Testimonials Grid Section - Masonry Layout -->
<section class="testimonials-page-grid-section" data-section-theme="light">
  <div class="testimonials-page-grid-container">
    
    <div class="testimonials-page-grid-header animate-fade-in">
      <?php
        $grid_line1_raw = !empty($grid_heading_line_1) ? $grid_heading_line_1 : 'What Our Clients';
        $grid_line2_raw = !empty($grid_heading_line_2) ? $grid_heading_line_2 : 'Say About Us';
        $grid_line1 = apply_filters('the_content', $grid_line1_raw);
        $grid_line2 = apply_filters('the_content', $grid_line2_raw);
        $grid_line1 = testimonials_strip_wrapping_p($grid_line1);
        $grid_line2 = testimonials_strip_wrapping_p($grid_line2);
        
        $grid_intro_raw = !empty($grid_intro_text) ? $grid_intro_text : 'We place a high value on trustworthiness, decency, and capability. Hear directly from the businesses we\'ve helped grow.';
        $grid_intro_html = apply_filters('the_content', $grid_intro_raw);
        $grid_intro_html = testimonials_strip_wrapping_p($grid_intro_html);
      ?>
      <h2 class="testimonials-page-grid-heading">
        <span class="black-text"><?php echo $grid_line1; ?></span>
        <br>
        <span class="highlight-text-italic"><?php echo $grid_line2; ?></span>
      </h2>
      <p class="testimonials-page-grid-intro"><?php echo $grid_intro_html; ?></p>
    </div>

    <div class="testimonials-page-masonry">
      <?php foreach ($testimonials_grid as $index => $testimonial) : 
        $color = $google_colors[$index % count($google_colors)];
        $name = isset($testimonial['author_name']) ? $testimonial['author_name'] : 'Client';
        $initial = strtoupper(substr($name, 0, 1));
        $delay = ($index % 4) * 0.1;
      ?>
        <div class="testimonials-page-masonry-card animate-fade-in" style="animation-delay: <?php echo $delay; ?>s">
          <div class="testimonials-page-masonry-card-inner">
            <!-- Front -->
            <div class="testimonials-page-masonry-front">
              <div class="testimonials-page-card-header">
                <?php if (!empty($testimonial['client_logo'])) : ?>
                  <img src="<?php echo esc_url($testimonial['client_logo']['url']); ?>" alt="Client Logo" class="testimonials-page-card-logo">
                <?php endif; ?>
                <div class="testimonials-page-card-rating">
                  <?php 
                    $rating = isset($testimonial['rating']) ? intval($testimonial['rating']) : 5;
                    for ($i = 0; $i < $rating; $i++) : 
                  ?>
                    <span class="star">★</span>
                  <?php endfor; ?>
                </div>
              </div>
              
              <?php
                $quote_raw = isset($testimonial['quote']) ? $testimonial['quote'] : '';
                $quote_html = apply_filters('the_content', $quote_raw);
                $quote_html = testimonials_strip_wrapping_p($quote_html);
              ?>
              <blockquote class="testimonials-page-card-quote">
                <?php echo $quote_html; ?>
              </blockquote>
              
              <div class="testimonials-page-card-author">
                <?php if (!empty($testimonial['author_image'])) : ?>
                  <img src="<?php echo esc_url($testimonial['author_image']['url']); ?>" alt="<?php echo esc_attr($name); ?>" class="testimonials-page-author-avatar">
                <?php else : ?>
                  <div class="testimonials-page-author-avatar testimonials-page-author-initial" style="background: <?php echo $color; ?>">
                    <?php echo $initial; ?>
                  </div>
                <?php endif; ?>
                <div class="testimonials-page-author-info">
                  <h4><?php echo esc_html($name); ?></h4>
                  <p><?php echo isset($testimonial['author_role']) ? esc_html($testimonial['author_role']) : ''; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="testimonials-page-grid-cta animate-fade-in">
      <a href="https://www.google.com/search?q=hagerty+digital+reviews" target="_blank" rel="noopener noreferrer" class="testimonials-page-google-btn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
          <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
          <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
          <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
          <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
        </svg>
        <span>See All Google Reviews</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="arrow">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  </div>
</section>


<!-- Client Logos Section -->
<section class="testimonials-page-logos" data-section-theme="light" style="background: #f8f8f8;">
  <div class="testimonials-page-logos-container">
    
    <div class="testimonials-page-logos-header animate-fade-in">
      <?php
        $logos_line1_raw = !empty($logos_heading_line_1) ? $logos_heading_line_1 : 'Who We\'ve';
        $logos_line2_raw = !empty($logos_heading_line_2) ? $logos_heading_line_2 : 'Helped';
        $logos_line1 = apply_filters('the_content', $logos_line1_raw);
        $logos_line2 = apply_filters('the_content', $logos_line2_raw);
        $logos_line1 = testimonials_strip_wrapping_p($logos_line1);
        $logos_line2 = testimonials_strip_wrapping_p($logos_line2);
      ?>
      <h2 class="testimonials-page-logos-heading">
        <span class="black-text"><?php echo $logos_line1; ?></span>
        <span class="highlight-text-italic"><?php echo $logos_line2; ?></span>
      </h2>
    </div>

    <div class="testimonials-page-logos-marquee">
      <div class="testimonials-page-logos-track">
        <?php if (!empty($client_logos)) : ?>
          <?php foreach ($client_logos as $logo) : ?>
            <div class="testimonials-page-logo-item">
              <img src="<?php echo esc_url($logo['logo']['url']); ?>" alt="<?php echo esc_attr($logo['logo']['alt'] ?? 'Client Logo'); ?>">
            </div>
          <?php endforeach; ?>
          <!-- Duplicate for seamless loop -->
          <?php foreach ($client_logos as $logo) : ?>
            <div class="testimonials-page-logo-item">
              <img src="<?php echo esc_url($logo['logo']['url']); ?>" alt="<?php echo esc_attr($logo['logo']['alt'] ?? 'Client Logo'); ?>">
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <!-- Default logos -->
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/vileda-logo-1.png" alt="Vileda"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/isgus-logo-copy.png" alt="ISGUS"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/severnside-logo.png" alt="Severnside"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/micro-white.png" alt="Micro"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/clearvision-logo.png" alt="Clearvision"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2024/04/culligan-logo-white.png" alt="Culligan"></div>
          <!-- Duplicate for loop -->
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/vileda-logo-1.png" alt="Vileda"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/isgus-logo-copy.png" alt="ISGUS"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/severnside-logo.png" alt="Severnside"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/micro-white.png" alt="Micro"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/clearvision-logo.png" alt="Clearvision"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2023/12/myr-logo.png" alt="MYR"></div>
          <div class="testimonials-page-logo-item"><img src="https://hagertydigital.co.uk/wp-content/uploads/2024/04/culligan-logo-white.png" alt="Culligan"></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- Video Testimonials Section -->
<?php if (!empty($video_testimonials)) : ?>
<section class="testimonials-page-video-section" data-section-theme="light">
  <div class="testimonials-page-video-container">
    
    <div class="testimonials-page-video-header animate-fade-in">
      <?php
        $video_line1_raw = !empty($video_heading_line_1) ? $video_heading_line_1 : 'Hear From';
        $video_line2_raw = !empty($video_heading_line_2) ? $video_heading_line_2 : 'Our Clients';
        $video_line1 = apply_filters('the_content', $video_line1_raw);
        $video_line2 = apply_filters('the_content', $video_line2_raw);
        $video_line1 = testimonials_strip_wrapping_p($video_line1);
        $video_line2 = testimonials_strip_wrapping_p($video_line2);
        
        $video_intro_raw = !empty($video_intro_text) ? $video_intro_text : 'Watch our clients share their experiences working with Hagerty Digital.';
        $video_intro_html = apply_filters('the_content', $video_intro_raw);
        $video_intro_html = testimonials_strip_wrapping_p($video_intro_html);
      ?>
      <h2 class="testimonials-page-video-heading">
        <span class="black-text"><?php echo $video_line1; ?></span>
        <br>
        <span class="highlight-text-italic"><?php echo $video_line2; ?></span>
      </h2>
      <p class="testimonials-page-video-intro"><?php echo $video_intro_html; ?></p>
    </div>

    <div class="testimonials-page-video-grid">
      <?php foreach ($video_testimonials as $index => $video) : ?>
        <div class="testimonials-page-video-card animate-scale-in" style="animation-delay: <?php echo $index * 0.15; ?>s">
          <div class="testimonials-page-video-thumbnail" data-video-url="<?php echo esc_url($video['video_url']); ?>">
            <?php if (!empty($video['thumbnail'])) : ?>
              <img src="<?php echo esc_url($video['thumbnail']['url']); ?>" alt="<?php echo esc_attr($video['client_name'] ?? 'Video Testimonial'); ?>">
            <?php endif; ?>
            <div class="testimonials-page-video-play">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M8 5v14l11-7z"/>
              </svg>
            </div>
            <div class="testimonials-page-video-overlay"></div>
          </div>
          <div class="testimonials-page-video-info">
            <h4><?php echo esc_html($video['client_name'] ?? ''); ?></h4>
            <p><?php echo esc_html($video['client_company'] ?? ''); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Second Featured Quote - Full Width -->
<section class="testimonials-page-full-quote" data-section-theme="dark">
  <div class="testimonials-page-full-quote-bg">
    <div class="testimonials-page-full-quote-pattern"></div>
  </div>
  <div class="testimonials-page-full-quote-container">
    <div class="testimonials-page-full-quote-content animate-fade-in">
      <div class="testimonials-page-full-quote-mark">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
      </div>
      <blockquote>
        Despite being an outsourced agency, they truly feel like part of the team. Very specialist, very knowledgeable, and have been able to take our digital marketing to the next level.
      </blockquote>
      <div class="testimonials-page-full-quote-author">
        <div class="testimonials-page-full-quote-stars">★★★★★</div>
        <h4>Mark Thompson</h4>
        <p>Sales Director</p>
      </div>
    </div>
  </div>
</section>


<!-- CTA Section -->
<section class="testimonials-page-cta" data-section-theme="light" style="background: #f8f8f8;">
  <div class="testimonials-page-cta-container">
    <div class="testimonials-page-cta-content animate-fade-in">
      <span class="testimonials-page-cta-label">
        <?php echo !empty($cta_label) ? esc_html($cta_label) : 'READY TO GROW?'; ?>
      </span>

      <?php
        $cta_line1_raw = !empty($cta_heading_line_1) ? $cta_heading_line_1 : 'Let\'s Build Something';
        $cta_line2_raw = !empty($cta_heading_line_2) ? $cta_heading_line_2 : 'Amazing Together';
        $cta_line1 = apply_filters('the_content', $cta_line1_raw);
        $cta_line2 = apply_filters('the_content', $cta_line2_raw);
        $cta_line1 = testimonials_strip_wrapping_p($cta_line1);
        $cta_line2 = testimonials_strip_wrapping_p($cta_line2);
        
        $cta_text_raw = !empty($cta_text) ? $cta_text : 'Join the businesses who trust Hagerty Digital to drive their growth. Let\'s discuss how we can help you achieve your goals.';
        $cta_text_html = apply_filters('the_content', $cta_text_raw);
        $cta_text_html = testimonials_strip_wrapping_p($cta_text_html);
      ?>

      <h2 class="testimonials-page-cta-heading">
        <span class="black-text"><?php echo $cta_line1; ?></span><br>
        <span class="highlight-text-italic"><?php echo $cta_line2; ?></span>
      </h2>

      <p class="testimonials-page-cta-text"><?php echo $cta_text_html; ?></p>

      <div class="testimonials-page-cta-features">
        <?php if (!empty($cta_features)) : ?>
          <?php foreach ($cta_features as $feature) : ?>
            <div class="testimonials-page-cta-feature">
              <div class="testimonials-page-cta-feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                  <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
              </div>
              <div class="testimonials-page-cta-feature-text">
                <h4><?php echo esc_html($feature['title']); ?></h4>
                <p><?php echo esc_html($feature['description']); ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="testimonials-page-cta-feature">
            <div class="testimonials-page-cta-feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
              </svg>
            </div>
            <div class="testimonials-page-cta-feature-text">
              <h4>Proven Results</h4>
              <p>Data-driven strategies that deliver measurable ROI</p>
            </div>
          </div>
          <div class="testimonials-page-cta-feature">
            <div class="testimonials-page-cta-feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
            <div class="testimonials-page-cta-feature-text">
              <h4>Dedicated Team</h4>
              <p>Personal account managers who truly understand your business</p>
            </div>
          </div>
          <div class="testimonials-page-cta-feature">
            <div class="testimonials-page-cta-feature-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
            </div>
            <div class="testimonials-page-cta-feature-text">
              <h4>Fast Turnaround</h4>
              <p>Quick response times and efficient project delivery</p>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <div class="testimonials-page-cta-buttons">
        <?php 
          $cta_link = testimonials_link($cta_button_link);
          $cta_btn_text = !empty($cta_button_text) ? $cta_button_text : 'Start Your Project';
        ?>
        <a href="<?php echo $cta_link ? $cta_link['url'] : '/contact'; ?>" class="testimonials-page-cta-btn testimonials-page-cta-btn-primary">
          <span><?php echo esc_html($cta_btn_text); ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </a>

        <a href="tel:01275792114" class="testimonials-page-cta-btn testimonials-page-cta-btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
          </svg>
          <span>Call Us: 01275 792 114</span>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- Video Modal -->
<div class="testimonials-page-video-modal" id="testimonialVideoModal">
  <div class="testimonials-page-video-modal-content">
    <button class="testimonials-page-video-modal-close" aria-label="Close video">&times;</button>
    <div class="testimonials-page-video-modal-wrapper">
      <iframe id="testimonialVideoIframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</div>

<?php get_footer(); ?>