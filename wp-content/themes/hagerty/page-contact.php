<?php
/**
 * Template Name: Contact Us
 * 
 * Custom page template for the Contact Us page
 * Features: Hero with video/image, Contact form, Calendly booking, Interactive map
 */

get_header();

// ============================================
// HERO SECTION ACF FIELDS
// ============================================
$contact_hero_label             = function_exists('get_field') ? get_field('contact_hero_label') : '';
$contact_hero_heading_line_1    = function_exists('get_field') ? get_field('contact_hero_heading_line_1') : '';
$contact_hero_heading_line_2    = function_exists('get_field') ? get_field('contact_hero_heading_line_2') : '';
$contact_hero_text              = function_exists('get_field') ? get_field('contact_hero_text') : '';
$contact_hero_video             = function_exists('get_field') ? get_field('contact_hero_video') : '';
$contact_hero_image             = function_exists('get_field') ? get_field('contact_hero_image') : '';

// ============================================
// CONTACT FORM SECTION ACF FIELDS
// ============================================
$contact_form_heading_line_1    = function_exists('get_field') ? get_field('contact_form_heading_line_1') : '';
$contact_form_heading_line_2    = function_exists('get_field') ? get_field('contact_form_heading_line_2') : '';
$contact_form_text              = function_exists('get_field') ? get_field('contact_form_text') : '';
$contact_form_shortcode         = function_exists('get_field') ? get_field('contact_form_shortcode') : '';

// ============================================
// BOOKING SECTION ACF FIELDS
// ============================================
$booking_heading_line_1         = function_exists('get_field') ? get_field('contact_booking_heading_line_1') : '';
$booking_heading_line_2         = function_exists('get_field') ? get_field('contact_booking_heading_line_2') : '';
$booking_text                   = function_exists('get_field') ? get_field('contact_booking_text') : '';
$calendly_url                   = function_exists('get_field') ? get_field('contact_calendly_url') : '';

// ============================================
// CONTACT INFO SECTION ACF FIELDS
// ============================================
$info_heading_line_1            = function_exists('get_field') ? get_field('contact_info_heading_line_1') : '';
$info_heading_line_2            = function_exists('get_field') ? get_field('contact_info_heading_line_2') : '';
$info_text                      = function_exists('get_field') ? get_field('contact_info_text') : '';
$contact_address                = function_exists('get_field') ? get_field('contact_address') : '';
$contact_email                  = function_exists('get_field') ? get_field('contact_email') : '';
$contact_phone                  = function_exists('get_field') ? get_field('contact_phone') : '';
$contact_whatsapp               = function_exists('get_field') ? get_field('contact_whatsapp') : '';

// ============================================
// MAP SECTION ACF FIELDS
// ============================================
$map_heading_line_1             = function_exists('get_field') ? get_field('contact_map_heading_line_1') : '';
$map_heading_line_2             = function_exists('get_field') ? get_field('contact_map_heading_line_2') : '';
$map_latitude                   = function_exists('get_field') ? get_field('contact_map_latitude') : '';
$map_longitude                  = function_exists('get_field') ? get_field('contact_map_longitude') : '';
$map_zoom                       = function_exists('get_field') ? get_field('contact_map_zoom') : '';
$google_maps_api_key            = function_exists('get_field') ? get_field('contact_google_maps_api_key', 'option') : '';

// ============================================
// FAQ SECTION ACF FIELDS
// ============================================
$faq_heading_line_1             = function_exists('get_field') ? get_field('contact_faq_heading_line_1') : '';
$faq_heading_line_2             = function_exists('get_field') ? get_field('contact_faq_heading_line_2') : '';
$faq_text                       = function_exists('get_field') ? get_field('contact_faq_text') : '';
$faq_items                      = function_exists('get_field') ? get_field('contact_faq_items') : [];

// ============================================
// CTA SECTION ACF FIELDS
// ============================================
$cta_heading_line_1             = function_exists('get_field') ? get_field('contact_cta_heading_line_1') : '';
$cta_heading_line_2             = function_exists('get_field') ? get_field('contact_cta_heading_line_2') : '';
$cta_text                       = function_exists('get_field') ? get_field('contact_cta_text') : '';
$cta_button_text                = function_exists('get_field') ? get_field('contact_cta_button_text') : '';
$cta_button_link                = function_exists('get_field') ? get_field('contact_cta_button_link') : '';

// Helper function for WYSIWYG content
function contact_wysiwyg($content, $fallback = '') {
    $output = !empty($content) ? $content : $fallback;
    $output = apply_filters('the_content', $output);
    $output = preg_replace('#^\s*<p[^>]*>|</p>\s*$#i', '', trim($output));
    return $output;
}
?>

<!-- Contact Hero Section -->
<section class="contact-hero" data-section-theme="dark">
  <div class="contact-hero-bg">
    <?php if (!empty($contact_hero_video)) : ?>
      <video autoplay muted loop playsinline class="contact-hero-video">
        <source src="<?php echo esc_url($contact_hero_video['url']); ?>" type="video/mp4">
      </video>
    <?php elseif (!empty($contact_hero_image)) : ?>
      <img src="<?php echo esc_url($contact_hero_image['url']); ?>" alt="Contact Hagerty Digital" class="contact-hero-image">
    <?php else : ?>
      <div class="contact-hero-gradient"></div>
    <?php endif; ?>
    <div class="contact-hero-overlay"></div>
  </div>

  <!-- Animated floating shapes -->
  <div class="contact-hero-shapes">
    <div class="contact-hero-shape contact-hero-shape-1"></div>
    <div class="contact-hero-shape contact-hero-shape-2"></div>
    <div class="contact-hero-shape contact-hero-shape-3"></div>
  </div>

  <div class="contact-hero-content">
    <div class="contact-hero-text animate-fade-in">
      <span class="contact-hero-label">
        <?php echo !empty($contact_hero_label) ? esc_html($contact_hero_label) : 'Get In Touch'; ?>
      </span>

      <h1>
        <span class="contact-hero-line-1">
          <?php echo contact_wysiwyg($contact_hero_heading_line_1, "Let's Start a"); ?>
        </span>
        <br>
        <span class="contact-hero-line-2 highlight-text-italic">
          <?php echo contact_wysiwyg($contact_hero_heading_line_2, 'Conversation'); ?>
        </span>
      </h1>

      <p class="contact-hero-description">
        <?php echo contact_wysiwyg($contact_hero_text, "Share your project details and we'll be in touch to discuss how we can help transform your digital presence."); ?>
      </p>

      <div class="contact-hero-buttons">
        <a href="#contact-form" class="contact-hero-btn contact-hero-btn-primary">
          <span>Send Message</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 5v14M5 12l7 7 7-7"/>
          </svg>
        </a>
        <a href="#calendly" class="contact-hero-btn contact-hero-btn-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          <span>Book a Call</span>
        </a>
      </div>
    </div>

    <!-- Scroll indicator -->
    <div class="contact-hero-scroll">
      <div class="contact-hero-scroll-line"></div>
      <span>Scroll</span>
    </div>
  </div>
</section>


<!-- Contact Form Section -->
<section class="contact-form-section" id="contact-form" data-section-theme="light" style="background: #ffffff;">
  <div class="contact-form-container">
    <div class="contact-form-grid">
      <!-- Left: Contact Info Cards -->
      <div class="contact-form-info animate-slide-left">
        <span class="section-label">Contact Details</span>

        <h2 class="contact-form-heading">
          <span class="black-text">
            <?php echo contact_wysiwyg($contact_form_heading_line_1, "Let's talk about"); ?>
          </span><br>
          <span class="highlight-text-italic">
            <?php echo contact_wysiwyg($contact_form_heading_line_2, 'your project'); ?>
          </span>
        </h2>

        <div class="contact-form-description">
          <?php echo contact_wysiwyg($contact_form_text, "Share your details and we'll be in touch to arrange a time to chat about how we can help grow your business."); ?>
        </div>

        <!-- Contact Cards -->
        <div class="contact-info-cards">
          <div class="contact-info-card animate-fade-up" style="animation-delay: 0.1s;">
            <div class="contact-info-card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
            </div>
            <div class="contact-info-card-content">
              <h4>Visit Our Office</h4>
              <div class="contact-info-card-text">
                <?php 
                  if (!empty($contact_address)) {
                    echo contact_wysiwyg($contact_address);
                  } else {
                    echo 'Unit S2, Temple 1852<br>Temple Campus, Lower Approach Rd<br>Bristol, BS1 6QA';
                  }
                ?>
              </div>
            </div>
          </div>

          <div class="contact-info-card animate-fade-up" style="animation-delay: 0.2s;">
            <div class="contact-info-card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
            </div>
            <div class="contact-info-card-content">
              <h4>Email Us</h4>
              <?php 
                $email = !empty($contact_email) ? $contact_email : 'hello@hagertydigital.co.uk';
              ?>
              <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-info-card-link"><?php echo esc_html($email); ?></a>
            </div>
          </div>

          <div class="contact-info-card animate-fade-up" style="animation-delay: 0.3s;">
            <div class="contact-info-card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
            </div>
            <div class="contact-info-card-content">
              <h4>Call Us</h4>
              <?php 
                $phone = !empty($contact_phone) ? $contact_phone : '0117 256 5466';
                $phone_raw = preg_replace('/[^0-9]/', '', $phone);
              ?>
              <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="contact-info-card-link"><?php echo esc_html($phone); ?></a>
            </div>
          </div>

          <?php if (!empty($contact_whatsapp)) : ?>
          <div class="contact-info-card contact-info-card-whatsapp animate-fade-up" style="animation-delay: 0.4s;">
            <div class="contact-info-card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
              </svg>
            </div>
            <div class="contact-info-card-content">
              <h4>WhatsApp</h4>
              <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $contact_whatsapp)); ?>" target="_blank" class="contact-info-card-link">Message us on WhatsApp</a>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <!-- Social links -->
        <div class="contact-social-links">
          <a href="#" class="contact-social-link" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
              <rect x="2" y="9" width="4" height="12"/>
              <circle cx="4" cy="4" r="2"/>
            </svg>
          </a>
          <a href="#" class="contact-social-link" aria-label="Twitter/X">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
          </a>
          <a href="#" class="contact-social-link" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
            </svg>
          </a>
          <a href="#" class="contact-social-link" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Right: Contact Form -->
      <div class="contact-form-wrapper animate-slide-right">
        <div class="contact-form-box">
          <div class="contact-form-box-header">
            <div class="contact-form-box-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
              </svg>
            </div>
            <h3>Send us a message</h3>
          </div>
          
          <?php if (!empty($contact_form_shortcode)) : ?>
            <?php echo do_shortcode($contact_form_shortcode); ?>
          <?php else : ?>
            <!-- Default contact form -->
            <form class="contact-page-form" id="contactPageForm">
              <div class="contact-form-row">
                <div class="contact-form-group">
                  <label for="contact_name">Your Name *</label>
                  <input type="text" id="contact_name" name="name" required placeholder="John Smith">
                </div>
                <div class="contact-form-group">
                  <label for="contact_email">Email Address *</label>
                  <input type="email" id="contact_email" name="email" required placeholder="john@company.com">
                </div>
              </div>
              
              <div class="contact-form-row">
                <div class="contact-form-group">
                  <label for="contact_company">Company</label>
                  <input type="text" id="contact_company" name="company" placeholder="Your Company">
                </div>
                <div class="contact-form-group">
                  <label for="contact_phone">Phone Number</label>
                  <input type="tel" id="contact_phone" name="phone" placeholder="+44 1234 567890">
                </div>
              </div>
              
              <div class="contact-form-group contact-form-group-full">
                <label for="contact_service">What can we help with?</label>
                <select id="contact_service" name="service">
                  <option value="">Select a service...</option>
                  <option value="seo">SEO</option>
                  <option value="ppc">PPC</option>
                  <option value="web-design">Web Design</option>
                  <option value="web-development">Web Development</option>
                  <option value="cro">CRO</option>
                  <option value="email-marketing">Email Marketing</option>
                  <option value="digital-strategy">Digital Strategy</option>
                  <option value="automation">Automation</option>
                  <option value="other">Other</option>
                </select>
              </div>
              
              <div class="contact-form-group contact-form-group-full">
                <label for="contact_message">Your Message *</label>
                <textarea id="contact_message" name="message" required rows="5" placeholder="Tell us about your project..."></textarea>
              </div>
              
              <button type="submit" class="contact-form-submit">
                <span>Send Message</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="22" y1="2" x2="11" y2="13"/>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
              </button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Calendly Booking Section -->
<section class="contact-booking-section" id="calendly" data-section-theme="light" style="background: #f8f8f8;">
  <div class="contact-booking-container">
    <div class="contact-booking-header animate-fade-in">
      <span class="section-label">Book a Call</span>
      
      <h2 class="contact-booking-heading">
        <span class="black-text">
          <?php echo contact_wysiwyg($booking_heading_line_1, 'Or you can book'); ?>
        </span><br>
        <span class="highlight-text-italic">
          <?php echo contact_wysiwyg($booking_heading_line_2, 'a call'); ?>
        </span>
      </h2>
      
      <p class="contact-booking-description">
        <?php echo contact_wysiwyg($booking_text, 'Select a date and time that works for you.'); ?>
      </p>
    </div>

    <div class="contact-booking-widget animate-scale-in">
      <div class="contact-calendly-wrapper">
        <?php 
          $calendly_embed_url = !empty($calendly_url) 
            ? $calendly_url 
            : 'https://calendly.com/hagertydigital/15min?embed_domain=hagertydigital.co.uk&embed_type=Inline&hide_event_details=1&hide_gdpr_banner=1';
        ?>
        <div class="calendly-inline-widget" 
             data-url="<?php echo esc_url($calendly_embed_url); ?>" 
             style="min-width:320px;height:700px;">
        </div>
        <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
      </div>
    </div>
  </div>
</section>


<!-- Interactive Map Section -->
<section class="contact-map-section" data-section-theme="light" style="background: #ffffff;">
  <div class="contact-map-container">
    <div class="contact-map-header animate-fade-in">
      <span class="section-label">Find Us</span>
      
      <h2 class="contact-map-heading">
        <span class="black-text">
          <?php echo contact_wysiwyg($map_heading_line_1, 'Visit our'); ?>
        </span><br>
        <span class="highlight-text-italic">
          <?php echo contact_wysiwyg($map_heading_line_2, 'Bristol office'); ?>
        </span>
      </h2>
    </div>

    <div class="contact-map-wrapper animate-scale-in">
      <div class="contact-map-card">
        <!-- Info overlay on map -->
        <div class="contact-map-info-overlay">
          <div class="contact-map-info-card">
            <div class="contact-map-info-logo">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo-dark.png" alt="Hagerty Digital" onerror="this.style.display='none'">
              <span class="contact-map-info-name">Hagerty Digital</span>
            </div>
            <div class="contact-map-info-address">
              <?php 
                if (!empty($contact_address)) {
                  echo contact_wysiwyg($contact_address);
                } else {
                  echo 'Temple 1852, Temple Campus<br>Redcliffe, Bristol BS1 6QA';
                }
              ?>
            </div>
            <div class="contact-map-info-rating">
              <div class="contact-map-stars">★★★★★</div>
              <span>5.0</span>
              <a href="https://g.page/r/CQxxx" target="_blank" class="contact-map-reviews">27 reviews</a>
            </div>
            <a href="https://www.google.com/maps/dir//Temple+1852,+Temple+Campus,+Lower+Approach+Rd,+Bristol+BS1+6QA" 
               target="_blank" 
               class="contact-map-directions-btn">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="3 11 22 2 13 21 11 13 3 11"/>
              </svg>
              Get Directions
            </a>
          </div>
        </div>

        <!-- Interactive Map -->
        <div class="contact-map-interactive" id="contactMap">
          <!-- Fallback to Google Maps embed if no API key -->
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2486.1642898553395!2d-2.5891661!3d51.4487843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48718e7a9e6f7c45%3A0x5f6ef91f55f9bc21!2sTemple%201852!5e0!3m2!1sen!2suk!4v1702389600000!5m2!1sen!2suk"
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

      <!-- Quick contact cards below map -->
      <div class="contact-map-quick-links">
        <a href="https://www.google.com/maps/dir//Temple+1852,+Temple+Campus,+Lower+Approach+Rd,+Bristol+BS1+6QA" 
           target="_blank" 
           class="contact-quick-link animate-fade-up" style="animation-delay: 0.1s;">
          <div class="contact-quick-link-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
            </svg>
          </div>
          <div class="contact-quick-link-text">
            <strong>Navigate</strong>
            <span>Open in Google Maps</span>
          </div>
        </a>

        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $contact_phone ?: '01172565466')); ?>" 
           class="contact-quick-link animate-fade-up" style="animation-delay: 0.2s;">
          <div class="contact-quick-link-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
          </div>
          <div class="contact-quick-link-text">
            <strong>Call Us</strong>
            <span><?php echo esc_html($contact_phone ?: '0117 256 5466'); ?></span>
          </div>
        </a>

        <a href="mailto:<?php echo esc_attr($contact_email ?: 'hello@hagertydigital.co.uk'); ?>" 
           class="contact-quick-link animate-fade-up" style="animation-delay: 0.3s;">
          <div class="contact-quick-link-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
          </div>
          <div class="contact-quick-link-text">
            <strong>Email</strong>
            <span><?php echo esc_html($contact_email ?: 'hello@hagertydigital.co.uk'); ?></span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- FAQ Section -->
<section class="contact-faq-section" data-section-theme="light" style="background: #f8f8f8;">
  <div class="contact-faq-container">
    <div class="contact-faq-header animate-fade-in">
      <span class="section-label">FAQ</span>
      
      <h2 class="contact-faq-heading">
        <span class="black-text">
          <?php echo contact_wysiwyg($faq_heading_line_1, 'Frequently Asked'); ?>
        </span><br>
        <span class="highlight-text-italic">
          <?php echo contact_wysiwyg($faq_heading_line_2, 'Questions'); ?>
        </span>
      </h2>
      
      <p class="contact-faq-description">
        <?php echo contact_wysiwyg($faq_text, "Got questions? We've got answers. If you can't find what you're looking for, feel free to get in touch."); ?>
      </p>
    </div>

    <div class="contact-faq-accordion animate-fade-in">
      <?php if (!empty($faq_items) && is_array($faq_items)) : ?>
        <?php foreach ($faq_items as $index => $faq) : ?>
          <div class="contact-faq-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <button class="contact-faq-question" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>">
              <span><?php echo contact_wysiwyg($faq['question'] ?? ''); ?></span>
              <div class="contact-faq-icon">
                <span></span>
                <span></span>
              </div>
            </button>
            <div class="contact-faq-answer" <?php echo $index === 0 ? 'style="max-height: 500px;"' : ''; ?>>
              <div class="contact-faq-answer-content">
                <?php echo contact_wysiwyg($faq['answer'] ?? ''); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <!-- Default FAQ items -->
        <div class="contact-faq-item active">
          <button class="contact-faq-question" aria-expanded="true">
            <span>How quickly can you start on my project?</span>
            <div class="contact-faq-icon">
              <span></span>
              <span></span>
            </div>
          </button>
          <div class="contact-faq-answer" style="max-height: 500px;">
            <div class="contact-faq-answer-content">
              We typically begin new projects within 1-2 weeks of signing. For urgent requirements, we can often accommodate faster turnarounds. Get in touch to discuss your timeline.
            </div>
          </div>
        </div>

        <div class="contact-faq-item">
          <button class="contact-faq-question" aria-expanded="false">
            <span>What is your typical project process?</span>
            <div class="contact-faq-icon">
              <span></span>
              <span></span>
            </div>
          </button>
          <div class="contact-faq-answer">
            <div class="contact-faq-answer-content">
              Our process starts with a discovery call to understand your goals, followed by strategy development, implementation, and ongoing optimization. We keep you informed every step of the way with regular reports and check-ins.
            </div>
          </div>
        </div>

        <div class="contact-faq-item">
          <button class="contact-faq-question" aria-expanded="false">
            <span>Do you work with businesses of all sizes?</span>
            <div class="contact-faq-icon">
              <span></span>
              <span></span>
            </div>
          </button>
          <div class="contact-faq-answer">
            <div class="contact-faq-answer-content">
              Absolutely! We work with startups, SMEs, and enterprise clients alike. Our services are tailored to match your specific needs and budget, ensuring you get the best value for your investment.
            </div>
          </div>
        </div>

        <div class="contact-faq-item">
          <button class="contact-faq-question" aria-expanded="false">
            <span>What results can I expect?</span>
            <div class="contact-faq-icon">
              <span></span>
              <span></span>
            </div>
          </button>
          <div class="contact-faq-answer">
            <div class="contact-faq-answer-content">
              Results vary by service and industry, but we focus on measurable outcomes like increased traffic, leads, and conversions. We provide detailed monthly reports so you can track exactly how your campaigns are performing.
            </div>
          </div>
        </div>

        <div class="contact-faq-item">
          <button class="contact-faq-question" aria-expanded="false">
            <span>Where are you based?</span>
            <div class="contact-faq-icon">
              <span></span>
              <span></span>
            </div>
          </button>
          <div class="contact-faq-answer">
            <div class="contact-faq-answer-content">
              We're based in Bristol at Temple 1852, a creative hub in the heart of the city. However, we work with clients across the UK and internationally. Whether you prefer face-to-face meetings or virtual calls, we're flexible to suit your needs.
            </div>
          </div>
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