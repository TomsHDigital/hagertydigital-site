<?php
/**
 * Template Name: Who We Are
 * 
 * Custom page template for the Who We Are page
 * A people-focused page showcasing the team and company culture
 */

get_header();

// ============================================
// HERO SECTION ACF FIELDS
// ============================================
$wwa_hero_label           = function_exists('get_field') ? get_field('wwa_hero_label') : '';
$wwa_hero_heading_line_1  = function_exists('get_field') ? get_field('wwa_hero_heading_line_1') : '';
$wwa_hero_heading_line_2  = function_exists('get_field') ? get_field('wwa_hero_heading_line_2') : '';
$wwa_hero_description     = function_exists('get_field') ? get_field('wwa_hero_description') : '';
$wwa_hero_video           = function_exists('get_field') ? get_field('wwa_hero_video') : '';
$wwa_hero_image           = function_exists('get_field') ? get_field('wwa_hero_image') : '';
$wwa_hero_overlay_color   = function_exists('get_field') ? get_field('wwa_hero_overlay_color') : '';
$wwa_hero_overlay_opacity = function_exists('get_field') ? get_field('wwa_hero_overlay_opacity') : '';
$wwa_hero_button_text     = function_exists('get_field') ? get_field('wwa_hero_button_text') : '';
$wwa_hero_button_link     = function_exists('get_field') ? get_field('wwa_hero_button_link') : '';

// ============================================
// TEAM MOSAIC SECTION ACF FIELDS
// ============================================
$wwa_mosaic_heading_line_1  = function_exists('get_field') ? get_field('wwa_mosaic_heading_line_1') : '';
$wwa_mosaic_heading_line_2  = function_exists('get_field') ? get_field('wwa_mosaic_heading_line_2') : '';
$wwa_mosaic_description     = function_exists('get_field') ? get_field('wwa_mosaic_description') : '';
$wwa_mosaic_images          = function_exists('get_field') ? get_field('wwa_mosaic_images') : [];

// ============================================
// MISSION & VISION SECTION ACF FIELDS
// ============================================
$wwa_mission_label          = function_exists('get_field') ? get_field('wwa_mission_label') : '';
$wwa_mission_heading        = function_exists('get_field') ? get_field('wwa_mission_heading') : '';
$wwa_mission_text           = function_exists('get_field') ? get_field('wwa_mission_text') : '';
$wwa_mission_image          = function_exists('get_field') ? get_field('wwa_mission_image') : '';
$wwa_vision_label           = function_exists('get_field') ? get_field('wwa_vision_label') : '';
$wwa_vision_heading         = function_exists('get_field') ? get_field('wwa_vision_heading') : '';
$wwa_vision_text            = function_exists('get_field') ? get_field('wwa_vision_text') : '';
$wwa_vision_image           = function_exists('get_field') ? get_field('wwa_vision_image') : '';

// ============================================
// LEADERSHIP TEAM SECTION ACF FIELDS
// ============================================
$wwa_leaders_label          = function_exists('get_field') ? get_field('wwa_leaders_label') : '';
$wwa_leaders_heading_line_1 = function_exists('get_field') ? get_field('wwa_leaders_heading_line_1') : '';
$wwa_leaders_heading_line_2 = function_exists('get_field') ? get_field('wwa_leaders_heading_line_2') : '';
$wwa_leaders_description    = function_exists('get_field') ? get_field('wwa_leaders_description') : '';
$wwa_leaders                = function_exists('get_field') ? get_field('wwa_leaders') : [];

// ============================================
// CULTURE SECTION ACF FIELDS
// ============================================
$wwa_culture_label          = function_exists('get_field') ? get_field('wwa_culture_label') : '';
$wwa_culture_heading_line_1 = function_exists('get_field') ? get_field('wwa_culture_heading_line_1') : '';
$wwa_culture_heading_line_2 = function_exists('get_field') ? get_field('wwa_culture_heading_line_2') : '';
$wwa_culture_description    = function_exists('get_field') ? get_field('wwa_culture_description') : '';
$wwa_culture_values         = function_exists('get_field') ? get_field('wwa_culture_values') : [];
$wwa_culture_gallery        = function_exists('get_field') ? get_field('wwa_culture_gallery') : [];

// ============================================
// FULL TEAM GRID SECTION ACF FIELDS
// ============================================
$wwa_team_label             = function_exists('get_field') ? get_field('wwa_team_label') : '';
$wwa_team_heading_line_1    = function_exists('get_field') ? get_field('wwa_team_heading_line_1') : '';
$wwa_team_heading_line_2    = function_exists('get_field') ? get_field('wwa_team_heading_line_2') : '';
$wwa_team_description       = function_exists('get_field') ? get_field('wwa_team_description') : '';
$wwa_team_members           = function_exists('get_field') ? get_field('wwa_team_members') : [];

// ============================================
// STATS SECTION ACF FIELDS
// ============================================
$wwa_stats_heading          = function_exists('get_field') ? get_field('wwa_stats_heading') : '';
$wwa_stats_description      = function_exists('get_field') ? get_field('wwa_stats_description') : '';
$wwa_stats_items            = function_exists('get_field') ? get_field('wwa_stats_items') : [];

// ============================================
// JOIN TEAM SECTION ACF FIELDS
// ============================================
$wwa_join_label             = function_exists('get_field') ? get_field('wwa_join_label') : '';
$wwa_join_heading_line_1    = function_exists('get_field') ? get_field('wwa_join_heading_line_1') : '';
$wwa_join_heading_line_2    = function_exists('get_field') ? get_field('wwa_join_heading_line_2') : '';
$wwa_join_description       = function_exists('get_field') ? get_field('wwa_join_description') : '';
$wwa_join_benefits          = function_exists('get_field') ? get_field('wwa_join_benefits') : [];
$wwa_join_button_text       = function_exists('get_field') ? get_field('wwa_join_button_text') : '';
$wwa_join_button_link       = function_exists('get_field') ? get_field('wwa_join_button_link') : '';
$wwa_join_image             = function_exists('get_field') ? get_field('wwa_join_image') : '';

// Helper function for WYSIWYG content
function wwa_wysiwyg($content, $default = '') {
    $text = !empty($content) ? $content : $default;
    $text = apply_filters('the_content', $text);
    // Remove wrapping <p> tags for inline usage
    $text = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($text));
    return $text;
}

// Overlay styles
$overlay_color = !empty($wwa_hero_overlay_color) ? $wwa_hero_overlay_color : '#000000';
$overlay_opacity = !empty($wwa_hero_overlay_opacity) ? floatval($wwa_hero_overlay_opacity) / 100 : 0.5;
?>

<!-- =============================================
     WHO WE ARE - HERO SECTION
     ============================================= -->
<section class="wwa-hero" data-section-theme="dark">
  <div class="wwa-hero-bg">
    <?php if (!empty($wwa_hero_video)) : ?>
      <video autoplay muted loop playsinline class="wwa-hero-video">
        <source src="<?php echo esc_url($wwa_hero_video['url']); ?>" type="video/mp4">
      </video>
    <?php elseif (!empty($wwa_hero_image)) : ?>
      <img src="<?php echo esc_url($wwa_hero_image['url']); ?>" alt="Who We Are" class="wwa-hero-image">
    <?php else : ?>
      <div class="wwa-hero-gradient"></div>
    <?php endif; ?>
    <div class="wwa-hero-overlay" style="background: <?php echo esc_attr($overlay_color); ?>; opacity: <?php echo esc_attr($overlay_opacity); ?>;"></div>
  </div>

  <div class="wwa-hero-content">
    <div class="wwa-hero-text">
      <span class="wwa-hero-label animate-fade-in"><?php echo !empty($wwa_hero_label) ? esc_html($wwa_hero_label) : 'Who We Are'; ?></span>
      
      <h1 class="wwa-hero-title">
        <span class="wwa-hero-line wwa-hero-line-1 animate-slide-up">
          <?php echo wwa_wysiwyg($wwa_hero_heading_line_1, 'The People Behind'); ?>
        </span>
        <span class="wwa-hero-line wwa-hero-line-2 animate-slide-up" style="animation-delay: 0.2s;">
          <?php echo wwa_wysiwyg($wwa_hero_heading_line_2, '<em>Your Digital Success</em>'); ?>
        </span>
      </h1>
      
      <div class="wwa-hero-description animate-fade-in" style="animation-delay: 0.4s;">
        <?php echo wwa_wysiwyg($wwa_hero_description, 'Meet the passionate team of digital experts dedicated to transforming your business and driving exceptional results.'); ?>
      </div>

      <a href="<?php echo !empty($wwa_hero_button_link) ? esc_url($wwa_hero_button_link) : '#team-mosaic'; ?>" 
         class="wwa-hero-btn animate-scale-in" style="animation-delay: 0.6s;">
        <span><?php echo !empty($wwa_hero_button_text) ? esc_html($wwa_hero_button_text) : 'Meet Our Team'; ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 5v14M5 12l7 7 7-7"/>
        </svg>
      </a>
    </div>

    <!-- Floating Team Avatars -->
    <div class="wwa-hero-avatars">
      <?php if (!empty($wwa_mosaic_images) && is_array($wwa_mosaic_images)) : ?>
        <?php $avatar_count = 0; ?>
        <?php foreach ($wwa_mosaic_images as $img) : ?>
          <?php if ($avatar_count >= 7) break; ?>
          <div class="wwa-hero-avatar animate-float" style="animation-delay: <?php echo $avatar_count * 0.12; ?>s;">
            <img src="<?php echo esc_url($img['image']['url']); ?>" alt="Team Member">
          </div>
          <?php $avatar_count++; ?>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="wwa-hero-avatar animate-float"><div class="wwa-avatar-placeholder"></div></div>
        <div class="wwa-hero-avatar animate-float" style="animation-delay: 0.12s;"><div class="wwa-avatar-placeholder"></div></div>
        <div class="wwa-hero-avatar animate-float" style="animation-delay: 0.24s;"><div class="wwa-avatar-placeholder"></div></div>
        <div class="wwa-hero-avatar animate-float" style="animation-delay: 0.36s;"><div class="wwa-avatar-placeholder"></div></div>
        <div class="wwa-hero-avatar animate-float" style="animation-delay: 0.48s;"><div class="wwa-avatar-placeholder"></div></div>
        <div class="wwa-hero-avatar animate-float" style="animation-delay: 0.60s;"><div class="wwa-avatar-placeholder"></div></div>
        <div class="wwa-hero-avatar animate-float" style="animation-delay: 0.72s;"><div class="wwa-avatar-placeholder"></div></div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Scroll Indicator -->
  <div class="wwa-hero-scroll">
    <div class="wwa-scroll-mouse">
      <div class="wwa-scroll-wheel"></div>
    </div>
    <span>Scroll to explore</span>
  </div>
</section>


<!-- =============================================
     TEAM MOSAIC SECTION
     ============================================= -->
<section class="wwa-mosaic-section" id="team-mosaic" data-section-theme="light">
  <div class="wwa-mosaic-container">
    <div class="wwa-mosaic-header animate-fade-in">
      <h2 class="wwa-mosaic-heading">
        <span class="black-text"><?php echo wwa_wysiwyg($wwa_mosaic_heading_line_1, 'Real People,'); ?></span><br>
        <span class="highlight-text-italic"><?php echo wwa_wysiwyg($wwa_mosaic_heading_line_2, 'Real Results'); ?></span>
      </h2>
      <div class="wwa-mosaic-description">
        <?php echo wwa_wysiwyg($wwa_mosaic_description, "We're not just an agency – we're a team of individuals who genuinely care about your success. Every face you see here is someone ready to go the extra mile for your business."); ?>
      </div>
    </div>

    <div class="wwa-mosaic-grid">
      <?php if (!empty($wwa_mosaic_images) && is_array($wwa_mosaic_images)) : ?>
        <?php foreach ($wwa_mosaic_images as $index => $img) : ?>
          <div class="wwa-mosaic-item animate-scale-in" style="animation-delay: <?php echo $index * 0.1; ?>s;" data-name="<?php echo esc_attr($img['name'] ?? ''); ?>">
            <div class="wwa-mosaic-image">
              <img src="<?php echo esc_url($img['image']['url']); ?>" alt="<?php echo esc_attr($img['name'] ?? 'Team Member'); ?>">
              <div class="wwa-mosaic-overlay">
                <?php if (!empty($img['name'])) : ?>
                  <span class="wwa-mosaic-name"><?php echo esc_html($img['name']); ?></span>
                <?php endif; ?>
                <?php if (!empty($img['role'])) : ?>
                  <span class="wwa-mosaic-role"><?php echo esc_html($img['role']); ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <!-- Default placeholders -->
        <?php for ($i = 0; $i < 9; $i++) : ?>
          <div class="wwa-mosaic-item animate-scale-in" style="animation-delay: <?php echo $i * 0.1; ?>s;">
            <div class="wwa-mosaic-image">
              <div class="wwa-mosaic-placeholder"></div>
            </div>
          </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- =============================================
     MISSION & VISION SECTION
     ============================================= -->
<section class="wwa-mission-section" data-section-theme="light">
  <div class="wwa-mission-container">
    
    <!-- Mission Block -->
    <div class="wwa-mission-block wwa-mission-left">
      <div class="wwa-mission-content animate-slide-left">
        <span class="wwa-section-label"><?php echo !empty($wwa_mission_label) ? esc_html($wwa_mission_label) : 'Our Mission'; ?></span>
        <h2 class="wwa-mission-heading">
          <?php echo wwa_wysiwyg($wwa_mission_heading, 'Empowering businesses to <em>thrive digitally</em>'); ?>
        </h2>
        <div class="wwa-mission-text">
          <?php echo wwa_wysiwyg($wwa_mission_text, "We exist to help ambitious businesses unlock their digital potential. Through innovative strategies, cutting-edge technology, and genuine partnership, we transform challenges into opportunities for growth."); ?>
        </div>
      </div>
      <div class="wwa-mission-image animate-slide-right">
        <?php if (!empty($wwa_mission_image)) : ?>
          <img src="<?php echo esc_url($wwa_mission_image['url']); ?>" alt="Our Mission">
        <?php else : ?>
          <div class="wwa-mission-image-placeholder"></div>
        <?php endif; ?>
        <div class="wwa-mission-image-accent"></div>
      </div>
    </div>

    <!-- Vision Block -->
    <div class="wwa-mission-block wwa-mission-right">
      <div class="wwa-mission-image animate-slide-left">
        <?php if (!empty($wwa_vision_image)) : ?>
          <img src="<?php echo esc_url($wwa_vision_image['url']); ?>" alt="Our Vision">
        <?php else : ?>
          <div class="wwa-mission-image-placeholder"></div>
        <?php endif; ?>
        <div class="wwa-mission-image-accent wwa-accent-right"></div>
      </div>
      <div class="wwa-mission-content animate-slide-right">
        <span class="wwa-section-label"><?php echo !empty($wwa_vision_label) ? esc_html($wwa_vision_label) : 'Our Vision'; ?></span>
        <h2 class="wwa-mission-heading">
          <?php echo wwa_wysiwyg($wwa_vision_heading, 'Building the <em>future of digital</em> together'); ?>
        </h2>
        <div class="wwa-mission-text">
          <?php echo wwa_wysiwyg($wwa_vision_text, "We envision a world where every business, regardless of size, has access to world-class digital marketing expertise. We're building that future one partnership at a time."); ?>
        </div>
      </div>
    </div>

  </div>
</section>


<!-- =============================================
     LEADERSHIP TEAM SECTION
     ============================================= -->
<section class="wwa-leaders-section" data-section-theme="light">
  <div class="wwa-leaders-container">
    <div class="wwa-leaders-header animate-fade-in">
      <span class="wwa-section-label"><?php echo !empty($wwa_leaders_label) ? esc_html($wwa_leaders_label) : 'Leadership'; ?></span>
      <h2 class="wwa-leaders-heading">
        <span class="black-text"><?php echo wwa_wysiwyg($wwa_leaders_heading_line_1, 'Meet Our'); ?></span><br>
        <span class="highlight-text-italic"><?php echo wwa_wysiwyg($wwa_leaders_heading_line_2, 'Leadership Team'); ?></span>
      </h2>
      <div class="wwa-leaders-description">
        <?php echo wwa_wysiwyg($wwa_leaders_description, 'The visionaries driving our agency forward with passion, expertise, and an unwavering commitment to client success.'); ?>
      </div>
    </div>

    <div class="wwa-leaders-grid">
      <?php if (!empty($wwa_leaders) && is_array($wwa_leaders)) : ?>
        <?php foreach ($wwa_leaders as $index => $leader) : ?>
          <div class="wwa-leader-card animate-slide-up" style="animation-delay: <?php echo $index * 0.15; ?>s;" data-leader-id="<?php echo $index; ?>">
            <div class="wwa-leader-image-wrap">
              <?php if (!empty($leader['photo'])) : ?>
                <img src="<?php echo esc_url($leader['photo']['url']); ?>" alt="<?php echo esc_attr($leader['name']); ?>" class="wwa-leader-image">
              <?php endif; ?>
              <?php if (!empty($leader['video'])) : ?>
                <video class="wwa-leader-video" src="<?php echo esc_url($leader['video']['url']); ?>" muted loop playsinline preload="metadata"></video>
              <?php endif; ?>
              <div class="wwa-leader-social">
                <?php if (!empty($leader['linkedin'])) : ?>
                  <a href="<?php echo esc_url($leader['linkedin']); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                      <rect x="2" y="9" width="4" height="12"/>
                      <circle cx="4" cy="4" r="2"/>
                    </svg>
                  </a>
                <?php endif; ?>
                <?php if (!empty($leader['email'])) : ?>
                  <a href="mailto:<?php echo esc_attr($leader['email']); ?>" aria-label="Email">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                      <polyline points="22,6 12,13 2,6"/>
                    </svg>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <div class="wwa-leader-info">
              <h3 class="wwa-leader-name"><?php echo esc_html($leader['name'] ?? 'Team Leader'); ?></h3>
              <p class="wwa-leader-title"><?php echo esc_html($leader['title'] ?? 'Position'); ?></p>
              <div class="wwa-leader-bio">
                <?php echo wwa_wysiwyg($leader['bio'] ?? '', 'A brief bio about this team member and their role.'); ?>
              </div>
              <button class="wwa-leader-expand-btn" data-leader-id="<?php echo $index; ?>">
                <span>Read more</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <!-- Default leader cards -->
        <?php for ($i = 0; $i < 3; $i++) : ?>
          <div class="wwa-leader-card animate-slide-up" style="animation-delay: <?php echo $i * 0.15; ?>s;">
            <div class="wwa-leader-image-wrap">
              <div class="wwa-leader-placeholder"></div>
            </div>
            <div class="wwa-leader-info">
              <h3 class="wwa-leader-name">Team Leader</h3>
              <p class="wwa-leader-title">Position</p>
              <div class="wwa-leader-bio">A brief bio about this team member.</div>
            </div>
          </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- =============================================
     CULTURE & VALUES SECTION
     ============================================= -->
<section class="wwa-culture-section" data-section-theme="light">
  <div class="wwa-culture-container">
    <div class="wwa-culture-header animate-fade-in">
      <span class="wwa-section-label"><?php echo !empty($wwa_culture_label) ? esc_html($wwa_culture_label) : 'Our Culture'; ?></span>
      <h2 class="wwa-culture-heading">
        <span class="black-text"><?php echo wwa_wysiwyg($wwa_culture_heading_line_1, 'What Makes Us'); ?></span><br>
        <span class="highlight-text-italic"><?php echo wwa_wysiwyg($wwa_culture_heading_line_2, 'Different'); ?></span>
      </h2>
      <div class="wwa-culture-description">
        <?php echo wwa_wysiwyg($wwa_culture_description, "Our culture is built on collaboration, innovation, and a genuine passion for helping our clients succeed. Here's what drives us every day."); ?>
      </div>
    </div>

    <div class="wwa-culture-content">
      <!-- Values Cards -->
      <div class="wwa-values-grid">
        <?php if (!empty($wwa_culture_values) && is_array($wwa_culture_values)) : ?>
          <?php foreach ($wwa_culture_values as $index => $value) : ?>
            <div class="wwa-value-card animate-slide-up" style="animation-delay: <?php echo $index * 0.1; ?>s;">
              <div class="wwa-value-icon">
                <?php if (!empty($value['icon'])) : ?>
                  <?php echo $value['icon']; ?>
                <?php else : ?>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                  </svg>
                <?php endif; ?>
              </div>
              <h4 class="wwa-value-title"><?php echo esc_html($value['title'] ?? 'Value'); ?></h4>
              <div class="wwa-value-text">
                <?php echo wwa_wysiwyg($value['description'] ?? '', 'Description of this core value.'); ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <!-- Default values -->
          <?php 
          $default_values = [
            ['title' => 'Collaboration', 'desc' => 'We work together as one team with our clients.'],
            ['title' => 'Innovation', 'desc' => 'We constantly push boundaries and explore new ideas.'],
            ['title' => 'Integrity', 'desc' => 'We do what we say and say what we mean.'],
            ['title' => 'Excellence', 'desc' => 'We strive for the highest quality in everything we do.'],
          ];
          foreach ($default_values as $index => $val) : ?>
            <div class="wwa-value-card animate-slide-up" style="animation-delay: <?php echo $index * 0.1; ?>s;">
              <div class="wwa-value-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                  <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
              </div>
              <h4 class="wwa-value-title"><?php echo esc_html($val['title']); ?></h4>
              <div class="wwa-value-text"><?php echo esc_html($val['desc']); ?></div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Culture Gallery -->
      <div class="wwa-culture-gallery">
        <?php if (!empty($wwa_culture_gallery) && is_array($wwa_culture_gallery)) : ?>
          <?php foreach ($wwa_culture_gallery as $index => $img) : ?>
            <div class="wwa-gallery-item animate-scale-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
              <img src="<?php echo esc_url($img['image']['url']); ?>" alt="<?php echo esc_attr($img['caption'] ?? 'Culture photo'); ?>">
              <?php if (!empty($img['caption'])) : ?>
                <span class="wwa-gallery-caption"><?php echo esc_html($img['caption']); ?></span>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <?php for ($i = 0; $i < 4; $i++) : ?>
            <div class="wwa-gallery-item animate-scale-in" style="animation-delay: <?php echo $i * 0.1; ?>s;">
              <div class="wwa-gallery-placeholder"></div>
            </div>
          <?php endfor; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<!-- =============================================
     FULL TEAM GRID SECTION
     ============================================= -->
<section class="wwa-team-section" id="full-team" data-section-theme="light">
  <div class="wwa-team-container">
    <div class="wwa-team-header animate-fade-in">
      <span class="wwa-section-label"><?php echo !empty($wwa_team_label) ? esc_html($wwa_team_label) : 'The Team'; ?></span>
      <h2 class="wwa-team-heading">
        <span class="black-text"><?php echo wwa_wysiwyg($wwa_team_heading_line_1, 'Everyone You Will'); ?></span><br>
        <span class="highlight-text-italic"><?php echo wwa_wysiwyg($wwa_team_heading_line_2, 'Be Working With'); ?></span>
      </h2>
      <div class="wwa-team-description">
        <?php echo wwa_wysiwyg($wwa_team_description, "Get to know the talented individuals who will be bringing your digital vision to life. Hover over any photo to learn more."); ?>
      </div>
    </div>

    <!-- Team Grid with Hover Effects -->
    <div class="wwa-team-grid">
      <?php if (!empty($wwa_team_members) && is_array($wwa_team_members)) : ?>
        <?php foreach ($wwa_team_members as $index => $member) : ?>
          <div class="wwa-team-member animate-scale-in" 
               style="animation-delay: <?php echo ($index % 8) * 0.08; ?>s;"
               data-member-id="<?php echo $index; ?>">
            <div class="wwa-member-photo">
              <?php if (!empty($member['photo'])) : ?>
                <img src="<?php echo esc_url($member['photo']['url']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
              <?php endif; ?>
              <?php if (!empty($member['video'])) : ?>
                <video class="wwa-member-video" src="<?php echo esc_url($member['video']['url']); ?>" muted loop playsinline preload="metadata"></video>
              <?php endif; ?>
            </div>
            <div class="wwa-member-overlay">
              <h4 class="wwa-member-name"><?php echo esc_html($member['name'] ?? 'Team Member'); ?></h4>
              <p class="wwa-member-title"><?php echo esc_html($member['title'] ?? 'Position'); ?></p>
              <?php if (!empty($member['fun_fact'])) : ?>
                <span class="wwa-member-fact"><?php echo esc_html($member['fun_fact']); ?></span>
              <?php endif; ?>
              <div class="wwa-member-social">
                <?php if (!empty($member['linkedin'])) : ?>
                  <a href="<?php echo esc_url($member['linkedin']); ?>" target="_blank" rel="noopener">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                      <rect x="2" y="9" width="4" height="12"/>
                      <circle cx="4" cy="4" r="2"/>
                    </svg>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <?php for ($i = 0; $i < 9; $i++) : ?>
          <div class="wwa-team-member animate-scale-in" style="animation-delay: <?php echo $i * 0.08; ?>s;">
            <div class="wwa-member-photo">
              <div class="wwa-member-placeholder"></div>
            </div>
            <div class="wwa-member-overlay">
              <h4 class="wwa-member-name">Team Member</h4>
              <p class="wwa-member-title">Position</p>
            </div>
          </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>

    <div class="wwa-team-cta animate-fade-in">
      <a href="/meet-the-team" class="wwa-team-btn">
        <span>View Full Team Profiles</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </a>
    </div>
  </div>
</section>


<!-- =============================================
     STATS SECTION
     ============================================= -->
<section class="wwa-stats-section" data-section-theme="light">
  <div class="wwa-stats-container">
    <div class="wwa-stats-header animate-fade-in">
      <h2 class="wwa-stats-heading">
        <?php echo wwa_wysiwyg($wwa_stats_heading, 'Numbers That <em>Speak</em>'); ?>
      </h2>
      <div class="wwa-stats-description">
        <?php echo wwa_wysiwyg($wwa_stats_description, "Our track record of success, measured in results that matter."); ?>
      </div>
    </div>

    <div class="wwa-stats-grid">
      <?php if (!empty($wwa_stats_items) && is_array($wwa_stats_items)) : ?>
        <?php foreach ($wwa_stats_items as $index => $stat) : ?>
          <div class="wwa-stat-item animate-scale-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
            <span class="wwa-stat-value" 
                  data-target="<?php echo esc_attr($stat['number'] ?? '0'); ?>"
                  data-suffix="<?php echo esc_attr($stat['suffix'] ?? ''); ?>"
                  data-prefix="<?php echo esc_attr($stat['prefix'] ?? ''); ?>">
              <?php echo esc_html($stat['prefix'] ?? ''); ?>0<?php echo esc_html($stat['suffix'] ?? ''); ?>
            </span>
            <span class="wwa-stat-label"><?php echo esc_html($stat['label'] ?? 'Stat'); ?></span>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <!-- Default stats -->
        <?php 
        $default_stats = [
          ['num' => '7', 'suffix' => '+', 'label' => 'Years Experience'],
          ['num' => '150', 'suffix' => '+', 'label' => 'Projects Delivered'],
          ['num' => '50', 'suffix' => '+', 'label' => 'Happy Clients'],
          ['num' => '5', 'suffix' => '', 'label' => 'Google Rating'],
        ];
        foreach ($default_stats as $index => $stat) : ?>
          <div class="wwa-stat-item animate-scale-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
            <span class="wwa-stat-value" data-target="<?php echo $stat['num']; ?>" data-suffix="<?php echo $stat['suffix']; ?>">0<?php echo $stat['suffix']; ?></span>
            <span class="wwa-stat-label"><?php echo esc_html($stat['label']); ?></span>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<!-- =============================================
     JOIN THE TEAM SECTION
     ============================================= -->
<section class="wwa-join-section" data-section-theme="light">
  <div class="wwa-join-container">
    <div class="wwa-join-content animate-slide-left">
      <span class="wwa-section-label"><?php echo !empty($wwa_join_label) ? esc_html($wwa_join_label) : 'Careers'; ?></span>
      <h2 class="wwa-join-heading">
        <span class="black-text"><?php echo wwa_wysiwyg($wwa_join_heading_line_1, 'Want to Join'); ?></span><br>
        <span class="highlight-text-italic"><?php echo wwa_wysiwyg($wwa_join_heading_line_2, 'Our Team?'); ?></span>
      </h2>
      <div class="wwa-join-description">
        <?php echo wwa_wysiwyg($wwa_join_description, "We're always looking for talented individuals who share our passion for digital excellence. Check out our current opportunities."); ?>
      </div>

      <?php if (!empty($wwa_join_benefits) && is_array($wwa_join_benefits)) : ?>
        <ul class="wwa-join-benefits">
          <?php foreach ($wwa_join_benefits as $benefit) : ?>
            <li>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
              </svg>
              <span><?php echo esc_html($benefit['benefit'] ?? 'Benefit'); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else : ?>
        <ul class="wwa-join-benefits">
          <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><span>Flexible working hours</span></li>
          <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><span>Competitive salary</span></li>
          <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><span>Learning & development budget</span></li>
          <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg><span>Regular team socials</span></li>
        </ul>
      <?php endif; ?>

      <a href="<?php echo !empty($wwa_join_button_link) ? esc_url($wwa_join_button_link) : '/careers'; ?>" class="wwa-join-btn">
        <span><?php echo !empty($wwa_join_button_text) ? esc_html($wwa_join_button_text) : 'View Open Positions'; ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </a>
    </div>

    <div class="wwa-join-image animate-slide-right">
      <?php if (!empty($wwa_join_image)) : ?>
        <img src="<?php echo esc_url($wwa_join_image['url']); ?>" alt="Join Our Team">
      <?php else : ?>
        <div class="wwa-join-image-placeholder"></div>
      <?php endif; ?>
      <div class="wwa-join-image-decoration"></div>
    </div>
  </div>
</section>


<!-- =============================================
     LONG CTA SECTION
     ============================================= -->
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
              <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
          </div>
          <div class="long-cta-feature-text">
            <h4>Proven Results</h4>
            <p>Data-driven strategies that deliver measurable ROI</p>
          </div>
        </div>

        <div class="long-cta-feature">
          <div class="long-cta-feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <div class="long-cta-feature-text">
            <h4>Dedicated Team</h4>
            <p>Personal account managers who truly understand your business</p>
          </div>
        </div>

        <div class="long-cta-feature">
          <div class="long-cta-feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
          </div>
          <div class="long-cta-feature-text">
            <h4>Fast Turnaround</h4>
            <p>Quick response times and efficient project delivery</p>
          </div>
        </div>
      </div>

      <div class="long-cta-buttons">
        <a href="/contact" class="long-cta-btn long-cta-btn-primary">
          <span>Start Your Project</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </a>

        <a href="tel:01275792114" class="long-cta-btn long-cta-btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
          </svg>
          <span>Call Us: 01275 792 114</span>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- =============================================
     REVIEWS SECTION
     ============================================= -->
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
          <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
          <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </div>
</section>


<!-- =============================================
     LEADER MODAL
     ============================================= -->
<div class="wwa-leader-modal" id="wwaLeaderModal">
  <div class="wwa-leader-modal-content">
    <button class="wwa-leader-modal-close" aria-label="Close modal">&times;</button>
    <div class="wwa-leader-modal-grid">
      <div class="wwa-leader-modal-image">
        <img src="" alt="" id="wwaModalImage">
      </div>
      <div class="wwa-leader-modal-info">
        <h3 id="wwaModalName"></h3>
        <p class="wwa-leader-modal-title" id="wwaModalTitle"></p>
        <div class="wwa-leader-modal-bio" id="wwaModalBio"></div>
        <div class="wwa-leader-modal-socials">
          <a href="#" aria-label="LinkedIn" id="wwaModalLinkedIn" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
              <rect x="2" y="9" width="4" height="12"/>
              <circle cx="4" cy="4" r="2"/>
            </svg>
          </a>
          <a href="#" aria-label="Email" id="wwaModalEmail">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
// Prepare leader data for JavaScript
$wwaLeaderData = [];
$allowed_bio_tags = [
  'p' => [], 'br' => [], 'strong' => [], 'b' => [], 'em' => [], 'i' => [],
  'ul' => [], 'ol' => [], 'li' => [],
  'a' => ['href' => true, 'title' => true, 'target' => true, 'rel' => true],
];

if (!empty($wwa_leaders) && is_array($wwa_leaders)) {
  foreach ($wwa_leaders as $index => $leader) {
    $raw_bio = $leader['bio'] ?? '';
    $raw_bio = html_entity_decode($raw_bio, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $bio_html = wp_kses($raw_bio, $allowed_bio_tags);
    if ($bio_html && !preg_match('/<(p|ul|ol|li|br)\b/i', $bio_html)) {
      $bio_html = wpautop($bio_html);
    }

    $wwaLeaderData[$index] = [
      'name'     => $leader['name'] ?? '',
      'title'    => $leader['title'] ?? '',
      'image'    => !empty($leader['photo']['url']) ? $leader['photo']['url'] : '',
      'bio'      => $bio_html,
      'linkedin' => $leader['linkedin'] ?? '',
      'email'    => $leader['email'] ?? '',
    ];
  }
}
?>

<script>
  window.wwaLeaderData = <?php echo wp_json_encode($wwaLeaderData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
</script>

<?php get_footer(); ?>