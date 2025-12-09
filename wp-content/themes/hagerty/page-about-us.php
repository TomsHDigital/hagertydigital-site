<?php
/**
 * Template Name: About Us
 * 
 * Custom page template for the About Us page
 * Inspired by Blue Frontier and Flex Digital designs
 */

get_header();

// ============================================
// HERO SECTION ACF FIELDS
// ============================================
$about_hero_heading_line_1  = function_exists('get_field') ? get_field('about_hero_heading_line_1') : '';
$about_hero_heading_line_2  = function_exists('get_field') ? get_field('about_hero_heading_line_2') : '';
$about_hero_text            = function_exists('get_field') ? get_field('about_hero_text') : '';
$about_hero_video           = function_exists('get_field') ? get_field('about_hero_video') : '';
$about_hero_image           = function_exists('get_field') ? get_field('about_hero_image') : '';

// ============================================
// WHO WE ARE SECTION ACF FIELDS
// ============================================
$who_heading_line_1         = function_exists('get_field') ? get_field('about_who_heading_line_1') : '';
$who_heading_line_2         = function_exists('get_field') ? get_field('about_who_heading_line_2') : '';
$who_text                   = function_exists('get_field') ? get_field('about_who_text') : '';
$who_image                  = function_exists('get_field') ? get_field('about_who_image') : '';

// ============================================
// OUR VALUES SECTION ACF FIELDS
// ============================================
$values_heading_line_1      = function_exists('get_field') ? get_field('about_values_heading_line_1') : '';
$values_heading_line_2      = function_exists('get_field') ? get_field('about_values_heading_line_2') : '';
$values_items               = function_exists('get_field') ? get_field('about_values_items') : [];

// ============================================
// OUR STORY/TIMELINE SECTION ACF FIELDS
// ============================================
$story_heading_line_1       = function_exists('get_field') ? get_field('about_story_heading_line_1') : '';
$story_heading_line_2       = function_exists('get_field') ? get_field('about_story_heading_line_2') : '';
$story_intro_text           = function_exists('get_field') ? get_field('about_story_intro_text') : '';
$timeline_items             = function_exists('get_field') ? get_field('about_timeline_items') : [];

// ============================================
// OUR APPROACH SECTION ACF FIELDS
// ============================================
$approach_heading_line_1    = function_exists('get_field') ? get_field('about_approach_heading_line_1') : '';
$approach_heading_line_2    = function_exists('get_field') ? get_field('about_approach_heading_line_2') : '';
$approach_items             = function_exists('get_field') ? get_field('about_approach_items') : [];

// ============================================
// TEAM TEASER SECTION ACF FIELDS
// ============================================
$team_teaser_heading        = function_exists('get_field') ? get_field('about_team_teaser_heading') : '';
$team_teaser_text           = function_exists('get_field') ? get_field('about_team_teaser_text') : '';
$team_teaser_images         = function_exists('get_field') ? get_field('about_team_teaser_images') : [];
$team_teaser_button_text    = function_exists('get_field') ? get_field('about_team_teaser_button_text') : '';
$team_teaser_button_link    = function_exists('get_field') ? get_field('about_team_teaser_button_link') : '';

// ============================================
// WHY CHOOSE US SECTION ACF FIELDS
// ============================================
$why_heading_line_1         = function_exists('get_field') ? get_field('about_why_heading_line_1') : '';
$why_heading_line_2         = function_exists('get_field') ? get_field('about_why_heading_line_2') : '';
$why_text                   = function_exists('get_field') ? get_field('about_why_text') : '';
$why_features               = function_exists('get_field') ? get_field('about_why_features') : [];

// ============================================
// STATS SECTION ACF FIELDS
// ============================================
$stats_heading              = function_exists('get_field') ? get_field('about_stats_heading') : '';
$stats_items                = function_exists('get_field') ? get_field('about_stats_items') : [];

// ============================================
// CTA SECTION ACF FIELDS
// ============================================
$cta_heading_line_1         = function_exists('get_field') ? get_field('about_cta_heading_line_1') : '';
$cta_heading_line_2         = function_exists('get_field') ? get_field('about_cta_heading_line_2') : '';
$cta_text                   = function_exists('get_field') ? get_field('about_cta_text') : '';
$cta_button_text            = function_exists('get_field') ? get_field('about_cta_button_text') : '';
$cta_button_link            = function_exists('get_field') ? get_field('about_cta_button_link') : '';

// ============================================
// REVIEWS SECTION ACF FIELDS (reuse from homepage)
// ============================================
$reviews_heading_line_1     = function_exists('get_field') ? get_field('reviews_heading_line_1') : '';
$reviews_heading_line_2     = function_exists('get_field') ? get_field('reviews_heading_line_2') : '';
$reviews_count_text         = function_exists('get_field') ? get_field('reviews_count_text') : '';
$reviews_platform_logo      = function_exists('get_field') ? get_field('reviews_platform_logo') : '';
$reviews_items              = function_exists('get_field') ? get_field('reviews_items') : [];
?>
<!-- About Hero Section -->
<section class="about-hero" data-section-theme="dark">
  <div class="about-hero-bg">
    <?php if (!empty($about_hero_video)) : ?>
      <video autoplay muted loop playsinline class="about-hero-video">
        <source src="<?php echo esc_url($about_hero_video['url']); ?>" type="video/mp4">
      </video>
    <?php elseif (!empty($about_hero_image)) : ?>
      <img src="<?php echo esc_url($about_hero_image['url']); ?>" alt="About Hagerty Digital" class="about-hero-image">
    <?php endif; ?>
    <div class="about-hero-overlay"></div>
  </div>

  <div class="about-hero-content">
    <div class="about-hero-text animate-fade-in">
      <span class="about-hero-label">About Us</span>

      <?php
        // Treat these as WYSIWYG (HTML allowed)
        $hero_line1_raw = !empty($about_hero_heading_line_1) ? $about_hero_heading_line_1 : 'We believe in the power of';
        $hero_line2_raw = !empty($about_hero_heading_line_2) ? $about_hero_heading_line_2 : 'digital creativity';

        // Apply WP editor formatting
        $hero_line1 = apply_filters('the_content', $hero_line1_raw);
        $hero_line2 = apply_filters('the_content', $hero_line2_raw);

        // Remove outer <p> wrappers so it behaves nicely inside an <h1>
        $hero_line1 = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($hero_line1));
        $hero_line2 = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($hero_line2));

        // Description: if you want this WYSIWYG too, output as WYSIWYG
        $about_desc_raw = !empty($about_hero_text)
          ? $about_hero_text
          : 'Your trusted digital partners for search marketing, branding and web development.';

        $about_desc = apply_filters('the_content', $about_desc_raw);
        $about_desc = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($about_desc));
      ?>

      <h1>
        <?php echo $hero_line1; ?>
        <br>
        <?php echo $hero_line2; ?>
      </h1>

      <p class="about-hero-description">
        <?php echo $about_desc; ?>
      </p>

      <a href="#who-we-are" class="cta-btn">
        <span>Learn More</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 5v14M5 12l7 7 7-7"/>
        </svg>
      </a>
    </div>
  </div>

</section>


<!-- Who We Are Section -->
<section class="about-who-section" id="who-we-are" data-section-theme="light">
  <div class="about-who-container">
    <div class="about-who-content">
      <div class="about-who-text animate-slide-left">
        <span class="section-label">Who We Are</span>

        <h2 class="about-who-heading">
          <span class="black-text">
            <?php echo !empty($who_heading_line_1) ? esc_html($who_heading_line_1) : 'A Bristol-based agency'; ?>
          </span><br>
          <span class="highlight-text-italic">
            <?php echo !empty($who_heading_line_2) ? esc_html($who_heading_line_2) : 'with global ambition'; ?>
          </span>
        </h2>

        <div class="about-who-description">
          <?php
            /**
             * WYSIWYG-safe output:
             * - Do NOT use esc_html() on WYSIWYG content (it will print literal <p> tags).
             * - Use the_content filter so WordPress formats embeds/shortcodes, etc.
             * - Then whitelist safe HTML.
             */
            if (!empty($who_text)) {
              $who_text_formatted = apply_filters('the_content', $who_text);
              echo wp_kses_post($who_text_formatted);
            } else {
              ?>
              <p>At Hagerty Digital, we're more than just a digital marketing agency – we're your strategic partners in growth. Founded with a passion for helping businesses succeed online, we combine creativity with data-driven strategies to deliver results that matter.</p>
              <p>Our team of experts specialises in SEO, PPC, web design, and digital marketing, working collaboratively with clients across the UK and beyond to transform their digital presence.</p>
              <?php
            }
          ?>
        </div>

        <a href="#our-values" class="cta-btn">
          <span>Discover Our Values</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </a>
      </div>

      <div class="about-who-image animate-slide-right">
        <?php if (!empty($who_image) && !empty($who_image['url'])) : ?>
          <img
            src="<?php echo esc_url($who_image['url']); ?>"
            alt="<?php echo esc_attr(!empty($who_image['alt']) ? $who_image['alt'] : 'Hagerty Digital Team'); ?>"
            loading="lazy"
            decoding="async"
          >
        <?php else : ?>
          <img
            src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/about-team.jpg'); ?>"
            alt="Hagerty Digital Team"
            loading="lazy"
            decoding="async"
          >
        <?php endif; ?>

        <div class="about-who-image-accent" aria-hidden="true"></div>
      </div>
    </div>
  </div>
</section>

<!-- Our Values Section -->
<section class="about-values-section" id="our-values" data-section-theme="light">
    <div class="about-values-container">
        <div class="about-values-header animate-fade-in">
            <span class="section-label">What Drives Us</span>
            <h2 class="about-values-heading">
                <span class="black-text"><?php echo !empty($values_heading_line_1) ? esc_html($values_heading_line_1) : 'Our Core'; ?></span><br>
                <span class="highlight-text-italic"><?php echo !empty($values_heading_line_2) ? esc_html($values_heading_line_2) : 'Values'; ?></span>
            </h2>
        </div>
        
        <div class="about-values-grid">
            <?php if (!empty($values_items) && is_array($values_items)) : ?>
                <?php foreach ($values_items as $index => $value) : ?>
                    <div class="about-value-card animate-slide-up" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <div class="about-value-icon">
                            <?php if (!empty($value['icon'])) : ?>
                                <span><?php echo esc_html($value['icon']); ?></span>
                            <?php else : ?>
                                <span>✦</span>
                            <?php endif; ?>
                        </div>
                        <h3><?php echo esc_html($value['title']); ?></h3>
                        <p><?php echo esc_html($value['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default values -->
                <div class="about-value-card animate-slide-up">
                    <div class="about-value-icon"><span>🎯</span></div>
                    <h3>Transparent</h3>
                    <p>We believe in open, honest communication. You'll always know exactly what we're doing and why – no jargon, no hidden agendas.</p>
                </div>
                <div class="about-value-card animate-slide-up">
                    <div class="about-value-icon"><span>📊</span></div>
                    <h3>Strategic</h3>
                    <p>Every decision we make is backed by data and aligned with your business goals. We don't guess – we strategise.</p>
                </div>
                <div class="about-value-card animate-slide-up">
                    <div class="about-value-icon"><span>📚</span></div>
                    <h3>Educational</h3>
                    <p>We empower our clients with knowledge. Understanding the 'why' behind our strategies helps you make informed decisions.</p>
                </div>
                <div class="about-value-card animate-slide-up">
                    <div class="about-value-icon"><span>🤝</span></div>
                    <h3>Collaborative</h3>
                    <p>Your success is our success. We work as an extension of your team, building partnerships that last.</p>
                </div>
                <div class="about-value-card animate-slide-up">
                    <div class="about-value-icon"><span>🎯</span></div>
                    <h3>Goal Orientated</h3>
                    <p>We're laser-focused on delivering measurable results. Every campaign is designed to achieve your specific objectives.</p>
                </div>
                <div class="about-value-card animate-slide-up">
                    <div class="about-value-icon"><span>💡</span></div>
                    <h3>Creative</h3>
                    <p>We blend innovative thinking with proven methods to create campaigns that stand out and drive engagement.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Banner Section -->
<section class="about-cta-banner" data-section-theme="dark">
    <div class="about-cta-banner-content animate-fade-in">
        <h2>Have a project in mind?</h2>
        <p>Let's discuss how we can help you achieve your digital goals.</p>
        <a href="<?php echo home_url('/#contact'); ?>" class="cta-btn">
            <span>Get In Touch</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</section>
<!-- Our Story/Timeline Section -->
<section class="about-story-section" data-section-theme="light">
  <div class="about-story-container">
    <div class="about-story-header animate-fade-in">
      <span class="section-label">Our Journey</span>

      <h2 class="about-story-heading">
        <?php
          // These look like WYSIWYG fields in ACF, so DON'T esc_html() them (it prints <p> tags).
          // Instead: apply the_content + wp_kses_post, then strip wrapping <p> so headings stay clean.
          $line1_raw = !empty($story_heading_line_1) ? $story_heading_line_1 : 'From humble beginnings';
          $line2_raw = !empty($story_heading_line_2) ? $story_heading_line_2 : 'to bold destinations';

          $line1 = wp_kses_post(apply_filters('the_content', $line1_raw));
          $line2 = wp_kses_post(apply_filters('the_content', $line2_raw));

          // Remove automatic paragraph wrappers that WYSIWYG often adds.
          $line1 = trim(wp_strip_all_tags($line1, true));
          $line2 = trim(wp_strip_all_tags($line2, true));
        ?>
        <span class="black-text"><?php echo esc_html($line1); ?></span><br>
        <span class="highlight-text-italic"><?php echo esc_html($line2); ?></span>
      </h2>

      <p class="about-story-intro">
        <?php
          // Intro can be WYSIWYG or textarea; this will handle both safely.
          if (!empty($story_intro_text)) {
            echo wp_kses_post(apply_filters('the_content', $story_intro_text));
          } else {
            echo 'Our journey started with a simple belief: that every business deserves access to world-class digital marketing. Here&#8217;s how we&#8217;ve grown.';
          }
        ?>
      </p>
    </div>

    <div class="about-timeline">
      <?php if (!empty($timeline_items) && is_array($timeline_items)) : ?>
        <?php foreach ($timeline_items as $index => $item) : ?>
          <?php
            $year  = $item['year'] ?? '';
            $title = $item['title'] ?? '';
            $desc  = $item['description'] ?? '';
            $image = $item['image'] ?? null;

            // Description might be WYSIWYG; keep formatting but safe.
            $desc_html = '';
            if (!empty($desc)) {
              $desc_html = wp_kses_post(apply_filters('the_content', $desc));
            }
          ?>
          <div class="about-timeline-item animate-slide-up <?php echo ($index % 2 === 0) ? 'timeline-left' : 'timeline-right'; ?>">
            <div class="about-timeline-marker">
              <?php if (!empty($year)) : ?>
                <span class="about-timeline-year"><?php echo esc_html($year); ?></span>
              <?php endif; ?>
            </div>

            <div class="about-timeline-content">
              <?php if (!empty($title)) : ?>
                <h3><?php echo esc_html($title); ?></h3>
              <?php endif; ?>

              <?php if (!empty($desc_html)) : ?>
                <div class="about-timeline-description">
                  <?php echo $desc_html; ?>
                </div>
              <?php endif; ?>

              <?php if (!empty($image)) : ?>
                <div class="about-timeline-image">
                  <img 
                    src="<?php echo esc_url($image['url']); ?>" 
                    alt="<?php echo esc_attr(!empty($image['alt']) ? $image['alt'] : $title); ?>"
                    loading="lazy"
                    decoding="async"
                  >
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>

      <?php else : ?>
        <!-- Default timeline -->
        <div class="about-timeline-item animate-slide-up timeline-left">
          <div class="about-timeline-marker">
            <span class="about-timeline-year">2018</span>
          </div>
          <div class="about-timeline-content">
            <h3>The Beginning</h3>
            <p>Hagerty Digital was founded with a vision to help local businesses compete in the digital landscape.</p>
          </div>
        </div>

        <div class="about-timeline-item animate-slide-up timeline-right">
          <div class="about-timeline-marker">
            <span class="about-timeline-year">2020</span>
          </div>
          <div class="about-timeline-content">
            <h3>Growing Team</h3>
            <p>We expanded our team and capabilities, adding specialists in SEO, PPC, and web development.</p>
          </div>
        </div>

        <div class="about-timeline-item animate-slide-up timeline-left">
          <div class="about-timeline-marker">
            <span class="about-timeline-year">2022</span>
          </div>
          <div class="about-timeline-content">
            <h3>National Recognition</h3>
            <p>Our work gained recognition across the UK, with clients from Bristol to London trusting us with their digital growth.</p>
          </div>
        </div>

        <div class="about-timeline-item animate-slide-up timeline-right">
          <div class="about-timeline-marker">
            <span class="about-timeline-year">2024</span>
          </div>
          <div class="about-timeline-content">
            <h3>Looking Ahead</h3>
            <p>Today, we continue to innovate and grow, always putting our clients&#8217; success at the heart of everything we do.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- Our Approach Section -->
<section class="about-approach-section" data-section-theme="light">
    <div class="about-approach-container">
        <div class="about-approach-header animate-fade-in">
            <span class="section-label">How We Work</span>
            <h2 class="about-approach-heading">
                <span class="black-text"><?php echo !empty($approach_heading_line_1) ? esc_html($approach_heading_line_1) : 'Our'; ?></span>
                <span class="highlight-text-italic"><?php echo !empty($approach_heading_line_2) ? esc_html($approach_heading_line_2) : 'Approach'; ?></span>
            </h2>
        </div>
        
        <div class="about-approach-items">
            <?php if (!empty($approach_items) && is_array($approach_items)) : ?>
                <?php foreach ($approach_items as $index => $item) : ?>
                    <div class="about-approach-item <?php echo $index % 2 === 0 ? '' : 'approach-reversed'; ?>">
                        <div class="about-approach-image animate-slide-<?php echo $index % 2 === 0 ? 'left' : 'right'; ?>">
                            <?php if (!empty($item['image'])) : ?>
                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="about-approach-text animate-slide-<?php echo $index % 2 === 0 ? 'right' : 'left'; ?>">
                            <span class="approach-number"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></span>
                            <h3><?php echo esc_html($item['title']); ?></h3>
                            <p><?php echo esc_html($item['description']); ?></p>
                            <?php if (!empty($item['features']) && is_array($item['features'])) : ?>
                                <ul class="approach-features">
                                    <?php foreach ($item['features'] as $feature) : ?>
                                        <li><?php echo esc_html($feature['feature']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default approach items -->
                <div class="about-approach-item">
                    <div class="about-approach-image animate-slide-left">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/approach-1.jpg" alt="Discovery">
                    </div>
                    <div class="about-approach-text animate-slide-right">
                        <span class="approach-number">01</span>
                        <h3>An extension of your team</h3>
                        <p>We believe in becoming truly integrated with your business. Our team takes the time to understand your goals, challenges, and industry inside and out.</p>
                        <ul class="approach-features">
                            <li>Dedicated account manager</li>
                            <li>Regular strategy sessions</li>
                            <li>Transparent communication</li>
                        </ul>
                    </div>
                </div>
                <div class="about-approach-item approach-reversed">
                    <div class="about-approach-image animate-slide-right">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/approach-2.jpg" alt="Strategy">
                    </div>
                    <div class="about-approach-text animate-slide-left">
                        <span class="approach-number">02</span>
                        <h3>Flexibility at our core</h3>
                        <p>No two businesses are the same, which is why we create bespoke strategies tailored to your specific needs and objectives.</p>
                        <ul class="approach-features">
                            <li>Customised solutions</li>
                            <li>Scalable campaigns</li>
                            <li>Agile methodology</li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Team Teaser Section -->
<section class="about-team-teaser" data-section-theme="dark">
    <div class="about-team-teaser-container">
        <div class="about-team-teaser-content animate-fade-in">
            <span class="section-label">Our People</span>
            <h2>
                <?php echo !empty($team_teaser_heading) ? esc_html($team_teaser_heading) : 'Meet the experts behind your success'; ?>
            </h2>
            <p>
                <?php echo !empty($team_teaser_text) ? esc_html($team_teaser_text) : 'Our friendly team of specialists are always happy to help, and are dedicated to delivering great work for our clients.'; ?>
            </p>
            <a href="<?php echo !empty($team_teaser_button_link) ? esc_url($team_teaser_button_link) : home_url('/meet-the-team'); ?>" class="cta-btn">
                <span><?php echo !empty($team_teaser_button_text) ? esc_html($team_teaser_button_text) : 'Meet The Team'; ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        
        <div class="about-team-teaser-images">
            <?php if (!empty($team_teaser_images) && is_array($team_teaser_images)) : ?>
                <?php foreach ($team_teaser_images as $index => $image) : ?>
                    <div class="team-teaser-image animate-scale-in" style="animation-delay: <?php echo $index * 0.15; ?>s;">
                        <img src="<?php echo esc_url($image['image']['url']); ?>" alt="Team Member">
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Placeholder images -->
                <div class="team-teaser-image animate-scale-in"><div class="team-teaser-placeholder"></div></div>
                <div class="team-teaser-image animate-scale-in"><div class="team-teaser-placeholder"></div></div>
                <div class="team-teaser-image animate-scale-in"><div class="team-teaser-placeholder"></div></div>
                <div class="team-teaser-image animate-scale-in"><div class="team-teaser-placeholder"></div></div>
                <div class="team-teaser-image animate-scale-in"><div class="team-teaser-placeholder"></div></div>
                <div class="team-teaser-image animate-scale-in"><div class="team-teaser-placeholder"></div></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="about-why-section" data-section-theme="light">
    <div class="about-why-container">
        <div class="about-why-header animate-fade-in">
            <span class="section-label">Why Hagerty Digital</span>
            <h2 class="about-why-heading">
                <span class="black-text"><?php echo !empty($why_heading_line_1) ? esc_html($why_heading_line_1) : 'Need digital experts'; ?></span><br>
                <span class="highlight-text-italic"><?php echo !empty($why_heading_line_2) ? esc_html($why_heading_line_2) : 'in your corner?'; ?></span>
            </h2>
            <p class="about-why-intro">
                <?php echo !empty($why_text) ? esc_html($why_text) : 'We\'ve got you covered. Here\'s what makes us different.'; ?>
            </p>
        </div>
        
        <div class="about-why-features">
            <?php if (!empty($why_features) && is_array($why_features)) : ?>
                <?php foreach ($why_features as $index => $feature) : ?>
                    <div class="about-why-feature animate-slide-up" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <div class="why-feature-icon">
                            <?php if (!empty($feature['icon'])) : ?>
                                <span><?php echo esc_html($feature['icon']); ?></span>
                            <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <div class="why-feature-text">
                            <h4><?php echo esc_html($feature['title']); ?></h4>
                            <p><?php echo esc_html($feature['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default features -->
                <div class="about-why-feature animate-slide-up">
                    <div class="why-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4>Proven Track Record</h4>
                        <p>We've helped hundreds of businesses achieve their digital goals with measurable results.</p>
                    </div>
                </div>
                <div class="about-why-feature animate-slide-up">
                    <div class="why-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4>Dedicated Support</h4>
                        <p>Your own account manager who understands your business and is always just a call away.</p>
                    </div>
                </div>
                <div class="about-why-feature animate-slide-up">
                    <div class="why-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4>No Hidden Costs</h4>
                        <p>Transparent pricing with no surprises. You'll always know exactly what you're paying for.</p>
                    </div>
                </div>
                <div class="about-why-feature animate-slide-up">
                    <div class="why-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="why-feature-text">
                        <h4>Fast Turnaround</h4>
                        <p>We work efficiently without compromising on quality, delivering results when you need them.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="about-stats-section" data-section-theme="light">
    <div class="about-stats-container">
        <h2 class="about-stats-heading animate-fade-in">
            <?php echo !empty($stats_heading) ? esc_html($stats_heading) : 'Numbers that speak for themselves'; ?>
        </h2>
        
        <div class="about-stats-grid">
            <?php if (!empty($stats_items) && is_array($stats_items)) : ?>
                <?php foreach ($stats_items as $stat) : ?>
                    <div class="about-stat-item animate-scale-in">
                        <span class="about-stat-value" 
                              data-target="<?php echo esc_attr($stat['value']); ?>"
                              <?php echo !empty($stat['prefix']) ? 'data-prefix="' . esc_attr($stat['prefix']) . '"' : ''; ?>
                              <?php echo !empty($stat['suffix']) ? 'data-suffix="' . esc_attr($stat['suffix']) . '"' : ''; ?>
                              <?php echo !empty($stat['decimals']) ? 'data-decimals="' . esc_attr($stat['decimals']) . '"' : ''; ?>>
                            <?php echo esc_html($stat['prefix'] ?? ''); ?>0<?php echo esc_html($stat['suffix'] ?? ''); ?>
                        </span>
                        <span class="about-stat-label"><?php echo esc_html($stat['label']); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default stats -->
                <div class="about-stat-item animate-scale-in">
                    <span class="about-stat-value" data-target="250" data-suffix="+">0+</span>
                    <span class="about-stat-label">Projects Delivered</span>
                </div>
                <div class="about-stat-item animate-scale-in">
                    <span class="about-stat-value" data-target="98" data-suffix="%">0%</span>
                    <span class="about-stat-label">Client Retention</span>
                </div>
                <div class="about-stat-item animate-scale-in">
                    <span class="about-stat-value" data-target="5" data-decimals="1">0</span>
                    <span class="about-stat-label">Google Rating</span>
                </div>
                <div class="about-stat-item animate-scale-in">
                    <span class="about-stat-value" data-target="7" data-suffix="+">0+</span>
                    <span class="about-stat-label">Years Experience</span>
                </div>
            <?php endif; ?>
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