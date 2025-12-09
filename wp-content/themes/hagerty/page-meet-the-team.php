<?php
/**
 * Template Name: Meet The Team
 * 
 * Custom page template for the Meet The Team page
 * Fruitful-inspired design with video support
 */

get_header();

// ============================================
// HERO SECTION ACF FIELDS
// ============================================
$hero_heading_line_1  = function_exists('get_field') ? get_field('mtt_hero_heading_line_1') : '';
$hero_heading_line_2  = function_exists('get_field') ? get_field('mtt_hero_heading_line_2') : '';
$hero_video           = function_exists('get_field') ? get_field('mtt_hero_video') : '';
$hero_poster          = function_exists('get_field') ? get_field('mtt_hero_poster') : '';

// ============================================
// INTRO SECTION ACF FIELDS
// ============================================
$intro_heading        = function_exists('get_field') ? get_field('mtt_intro_heading') : '';
$intro_text           = function_exists('get_field') ? get_field('mtt_intro_text') : '';

// ============================================
// TEAM MEMBERS ACF FIELDS (Repeater)
// ============================================
$team_members         = function_exists('get_field') ? get_field('mtt_team_members') : [];

// ============================================
// JOIN THE TEAM ACF FIELDS
// ============================================
$join_heading         = function_exists('get_field') ? get_field('mtt_join_heading') : '';
$join_text            = function_exists('get_field') ? get_field('mtt_join_text') : '';
$join_button_text     = function_exists('get_field') ? get_field('mtt_join_button_text') : '';
$join_button_link     = function_exists('get_field') ? get_field('mtt_join_button_link') : '';
$join_image           = function_exists('get_field') ? get_field('mtt_join_image') : '';

// ============================================
// CTA SECTION ACF FIELDS
// ============================================
$cta_heading          = function_exists('get_field') ? get_field('mtt_cta_heading') : '';
$cta_text             = function_exists('get_field') ? get_field('mtt_cta_text') : '';
$cta_button_text      = function_exists('get_field') ? get_field('mtt_cta_button_text') : '';
$cta_button_link      = function_exists('get_field') ? get_field('mtt_cta_button_link') : '';
?>

<!-- Hero Section -->
<section class="mtt-hero" data-section-theme="dark">
  <div class="mtt-hero-bg">
    <?php
      // ACF fields (correct names)
      $mtt_hero_video  = get_field('mtt_hero_video');
      $mtt_hero_poster = get_field('mtt_hero_poster');

      // WYSIWYG headings (HTML allowed)
      $mtt_line1_raw = get_field('mtt_hero_heading_line_1');
      $mtt_line2_raw = get_field('mtt_hero_heading_line_2');

      // NEW: WYSIWYG description (HTML allowed)
      $mtt_desc_raw  = get_field('mtt_hero_description');

      // Apply WP editor formatting and unwrap <p>...</p>
      $mtt_line1 = !empty($mtt_line1_raw) ? apply_filters('the_content', $mtt_line1_raw) : 'Meet The';
      $mtt_line2 = !empty($mtt_line2_raw) ? apply_filters('the_content', $mtt_line2_raw) : 'Team';
      $mtt_desc  = !empty($mtt_desc_raw)  ? apply_filters('the_content', $mtt_desc_raw)  : '';

      // Remove wrapping <p>...</p> added by WYSIWYG (only if it's the outer wrapper)
      $mtt_line1 = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($mtt_line1));
      $mtt_line2 = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($mtt_line2));
      $mtt_desc  = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($mtt_desc));
    ?>

    <?php if (!empty($mtt_hero_video)) : ?>
      <video class="mtt-hero-video"
             autoplay
             muted
             loop
             playsinline
             <?php if (!empty($mtt_hero_poster)) : ?>poster="<?php echo esc_url($mtt_hero_poster['url']); ?>"<?php endif; ?>>
        <source src="<?php echo esc_url($mtt_hero_video['url']); ?>"
                type="<?php echo esc_attr($mtt_hero_video['mime_type']); ?>">
      </video>
    <?php else : ?>
      <div class="mtt-hero-fallback"></div>
    <?php endif; ?>
    <div class="mtt-hero-overlay"></div>
  </div>

  <div class="mtt-hero-content">
    <div class="mtt-hero-text animate-fade-in">
      <span class="mtt-hero-label">Our Team</span>

      <h1 class="mtt-hero-title">
        <?php echo $mtt_line1; ?>
        <br>
        <?php echo $mtt_line2; ?>
      </h1>

      <?php if (!empty($mtt_desc)) : ?>
        <div class="mtt-hero-description">
          <?php echo $mtt_desc; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>



<!-- Intro Section -->
<section class="mtt-intro" data-section-theme="light">
    <div class="mtt-intro-container animate-fade-in">
        <h2><?php echo $intro_heading ? esc_html($intro_heading) : 'Guides that help you grow'; ?></h2>
        <?php 
        // Strip any HTML tags from intro text to prevent rendering issues
        $clean_intro_text = $intro_text ? wp_strip_all_tags($intro_text) : 'Our dedicated team of digital experts are here to help your business thrive. Get to know the people behind Hagerty Digital.';
        ?>
        <p><?php echo esc_html($clean_intro_text); ?></p>
    </div>
</section>

<!-- Team Grid Section -->
<section class="mtt-team-grid" data-section-theme="light">
    <div class="mtt-team-container">
        
        <!-- Mouse Following Tooltip -->
        <div class="mtt-cursor-tooltip" id="mttCursorTooltip">
            <span id="mttTooltipText">More about</span>
        </div>

        <?php if ($team_members && is_array($team_members)) : ?>
            
            <?php
            // Add "Join the Team" as a virtual card at the end
            $all_cards = $team_members;
            $total_cards = count($all_cards);
            
            // Split into rows of 3
            $rows = array_chunk($all_cards, 3);
            ?>

            <?php foreach ($rows as $row_index => $row) : ?>
                <div class="mtt-team-row mtt-row-3">
                    <?php foreach ($row as $card_index => $member) : 
                        $global_index = ($row_index * 3) + $card_index;
                    ?>
                        <div class="mtt-team-card" 
                             data-member-id="<?php echo $global_index; ?>"
                             data-member-name="<?php echo esc_attr($member['name']); ?>">
                            <div class="mtt-card-media">
                                <?php if (!empty($member['photo'])) : ?>
                                    <img src="<?php echo esc_url($member['photo']['url']); ?>" 
                                         alt="<?php echo esc_attr($member['name']); ?>"
                                         class="mtt-card-image">
                                <?php endif; ?>
                                <?php if (!empty($member['video'])) : ?>
                                    <video class="mtt-card-video" 
                                           src="<?php echo esc_url($member['video']['url']); ?>"
                                           muted 
                                           loop 
                                           playsinline
                                           preload="metadata"></video>
                                <?php endif; ?>
                            </div>
                            <div class="mtt-card-info">
                                <h3 class="mtt-card-name"><?php echo esc_html($member['name']); ?></h3>
                                <p class="mtt-card-title"><?php echo esc_html($member['title']); ?></p>
                                <?php if (!empty($member['tags']) && is_array($member['tags'])) : ?>
                                    <div class="mtt-card-tags">
                                        <?php foreach ($member['tags'] as $tag) : ?>
                                            <span class="mtt-tag">
                                                <?php if (!empty($tag['emoji'])) : ?>
                                                    <span class="mtt-tag-emoji"><?php echo esc_html($tag['emoji']); ?></span>
                                                <?php endif; ?>
                                                <?php echo esc_html($tag['label']); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        <?php else : ?>
            <!-- Fallback: Static team cards when no ACF data -->
            <div class="mtt-team-row mtt-row-2">
                <div class="mtt-team-card" data-member-id="0" data-member-name="Sam">
                    <div class="mtt-card-media">
                        <div class="mtt-card-placeholder"></div>
                    </div>
                    <div class="mtt-card-info">
                        <h3 class="mtt-card-name">Sam Hagerty</h3>
                        <p class="mtt-card-title">CEO</p>
                        <div class="mtt-card-tags">
                            <span class="mtt-tag"><span class="mtt-tag-emoji">🎯</span> top g</span>
                        </div>
                    </div>
                </div>
                <div class="mtt-team-card" data-member-id="1" data-member-name="Elliot">
                    <div class="mtt-card-media">
                        <div class="mtt-card-placeholder"></div>
                    </div>
                    <div class="mtt-card-info">
                        <h3 class="mtt-card-name">Elliot Hagerty</h3>
                        <p class="mtt-card-title">CEO</p>
                        <div class="mtt-card-tags">
                            <span class="mtt-tag"><span class="mtt-tag-emoji">🎯</span> top g</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mtt-team-row mtt-row-2">
                <div class="mtt-team-card" data-member-id="2" data-member-name="Rob">
                    <div class="mtt-card-media">
                        <div class="mtt-card-placeholder"></div>
                    </div>
                    <div class="mtt-card-info">
                        <h3 class="mtt-card-name">Rob James</h3>
                        <p class="mtt-card-title">Head Of Marketing</p>
                        <div class="mtt-card-tags">
                            <span class="mtt-tag"><span class="mtt-tag-emoji">🍇</span> hates grapes</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mtt-team-row mtt-row-4">
                <div class="mtt-team-card" data-member-id="3" data-member-name="Alf">
                    <div class="mtt-card-media">
                        <div class="mtt-card-placeholder"></div>
                    </div>
                    <div class="mtt-card-info">
                        <h3 class="mtt-card-name">Alf</h3>
                        <p class="mtt-card-title">Designer</p>
                        <div class="mtt-card-tags">
                            <span class="mtt-tag"><span class="mtt-tag-emoji">🎨</span> Creative</span>
                        </div>
                    </div>
                </div>
                <div class="mtt-team-card" data-member-id="4" data-member-name="Tom">
                    <div class="mtt-card-media">
                        <div class="mtt-card-placeholder"></div>
                    </div>
                    <div class="mtt-card-info">
                        <h3 class="mtt-card-name">Tom</h3>
                        <p class="mtt-card-title">Developer</p>
                        <div class="mtt-card-tags">
                            <span class="mtt-tag"><span class="mtt-tag-emoji">⚡</span> Efficient</span>
                        </div>
                    </div>
                </div>
                <div class="mtt-team-card" data-member-id="5" data-member-name="Jessica">
                    <div class="mtt-card-media">
                        <div class="mtt-card-placeholder"></div>
                    </div>
                    <div class="mtt-card-info">
                        <h3 class="mtt-card-name">Jessica</h3>
                        <p class="mtt-card-title">Marketing</p>
                        <div class="mtt-card-tags">
                            <span class="mtt-tag"><span class="mtt-tag-emoji">📈</span> Growth</span>
                        </div>
                    </div>
                </div>
                <div class="mtt-team-card" data-member-id="6" data-member-name="Max">
                    <div class="mtt-card-media">
                        <div class="mtt-card-placeholder"></div>
                    </div>
                    <div class="mtt-card-info">
                        <h3 class="mtt-card-name">Max</h3>
                        <p class="mtt-card-title">SEO Specialist</p>
                        <div class="mtt-card-tags">
                            <span class="mtt-tag"><span class="mtt-tag-emoji">🔍</span> Detailed</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Join The Team Banner Section -->
<section class="mtt-join-banner" data-section-theme="dark">
    <div class="mtt-join-banner-content">
        <div class="mtt-join-banner-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="M8 12h8"/>
                <path d="M12 8v8"/>
            </svg>
        </div>
        <div class="mtt-join-banner-text">
            <h3><?php echo $join_heading ? esc_html($join_heading) : 'Want this to be your face?'; ?></h3>
            <p><?php echo $join_text ? esc_html($join_text) : 'Join our growing team of digital experts.'; ?></p>
        </div>
        <a href="<?php echo $join_button_link ? esc_url($join_button_link) : '/careers'; ?>" class="mtt-join-banner-btn">
            <?php echo $join_button_text ? esc_html($join_button_text) : 'View Careers'; ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
                <path d="m12 5 7 7-7 7"/>
            </svg>
        </a>
    </div>
</section>

<!-- Team Member Modal -->
<div class="mtt-modal" id="mttModal">
    <div class="mtt-modal-content">
        <button class="mtt-modal-close" aria-label="Close modal">&times;</button>
        <div class="mtt-modal-grid">
            <div class="mtt-modal-media">
                <img src="" alt="" class="mtt-modal-image" id="mttModalImage">
                <video class="mtt-modal-video" id="mttModalVideo" muted loop playsinline></video>
            </div>
            <div class="mtt-modal-info">
                <h3 id="mttModalName"></h3>
                <p class="mtt-modal-title" id="mttModalTitle"></p>
                <div class="mtt-modal-bio" id="mttModalBio"></div>
                <div class="mtt-modal-socials">
                    <a href="#" aria-label="LinkedIn" id="mttModalLinkedIn" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 50 50">
                            <path fill="currentColor" d="M20.832 19.793c1.718 0 3.437 0 5.21 0 .051 1.235.051 1.235.102 2.5.242-.312.484-.621.73-.937 1.183-1.184 2.48-1.559 4.121-1.59 1.723.027 3.32.524 4.601 1.719 1.528 1.64 1.922 3.757 1.914 5.917 0 .11 0 .22 0 .332 0 .36 0 .72 0 1.079 0 .25 0 .5-.004.754-.004.656-.004 1.312-.004 1.969 0 .793-.004 1.582-.004 2.371 0 1.199-.004 2.394-.004 3.594-1.719 0-3.438 0-5.208 0-.004-.739-.008-1.477-.008-2.235-.004-.469-.008-.937-.012-1.406-.004-.746-.008-1.488-.012-2.23 0-.602-.004-1.2-.008-1.801-.004-.227-.004-.457-.004-.684.02-2.11.02-2.11-.91-3.961-.82-.781-1.636-.957-2.734-.949-.723.07-1.277.371-1.77.902-.593.727-.75 1.414-.746 2.336 0 .11-.004.219-.004.328-.004.36-.004.715-.004 1.075 0 .246-.004.496-.004.746-.004.652-.008 1.304-.008 1.957-.004.785-.008 1.57-.016 2.351-.004 1.192-.008 2.379-.012 3.571-1.719 0-3.438 0-5.208 0 0-5.844 0-11.688 0-17.707z"/>
                            <path fill="currentColor" d="M12.5 19.793c1.719 0 3.438 0 5.207 0 0 5.844 0 11.688 0 17.707-1.719 0-3.438 0-5.207 0 0-5.844 0-11.688 0-17.707z"/>
                            <path fill="currentColor" d="M16.457 12.77c.605.421 1.046 1.003 1.25 1.71.097.789.003 1.5-.415 2.187-.507.582-1.097.992-1.882 1.074-.848.031-1.438-.055-2.071-.633-.609-.645-.851-1.227-.886-2.109.023-.719.183-1.165.683-1.688.942-.875 2.125-1.164 3.321-.54z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Email" id="mttModalEmail">
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
// Prepare team data for JavaScript
$mttTeamData = [];

$allowed_bio_tags = [
    'p'      => [],
    'br'     => [],
    'strong' => [],
    'b'      => [],
    'em'     => [],
    'i'      => [],
    'ul'     => [],
    'ol'     => [],
    'li'     => [],
    'a'      => [
        'href'   => true,
        'title'  => true,
        'target' => true,
        'rel'    => true,
    ],
];

if (!empty($team_members) && is_array($team_members)) :
    foreach ($team_members as $index => $member) :
        $id = (string) $index;

        // Process bio
        $raw_bio  = $member['bio'] ?? '';
        $raw_bio  = html_entity_decode($raw_bio, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $bio_html = wp_kses($raw_bio, $allowed_bio_tags);

        if ($bio_html && !preg_match('/<(p|ul|ol|li|br)\b/i', $bio_html)) {
            $bio_html = wpautop($bio_html);
        }

        $mttTeamData[$id] = [
            'name'     => $member['name'] ?? '',
            'title'    => $member['title'] ?? '',
            'image'    => !empty($member['photo']['url']) ? $member['photo']['url'] : '',
            'video'    => !empty($member['video']['url']) ? $member['video']['url'] : '',
            'bio'      => $bio_html,
            'linkedin' => $member['linkedin_url'] ?? '',
            'email'    => $member['email'] ?? '',
        ];
    endforeach;
endif;
?>
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


<script>
    window.mttTeamData = <?php echo wp_json_encode($mttTeamData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
</script>

<?php get_footer(); ?>