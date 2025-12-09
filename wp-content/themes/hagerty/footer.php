<?php
/**
 * Footer template (no ACF)
 */
?>

</main>

<!-- Global Book a Call Button -->
<div class="global-book-call" id="globalBookCall">
  <a href="#calendly" class="book-call-btn" id="bookCallBtn">
    <div class="book-call-avatar">
      <img src="https://www.hagertydigital.test:8890/wp-content/uploads/2025/12/sam.webp" alt="Sam Hagerty">
    </div>
    <div class="book-call-info">
      <span class="book-call-name">Sam Hagerty</span>
      <span class="book-call-role">Growth & Strategy</span>
    </div>
    <div class="book-call-action">
      <span>Book a call</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14"/>
        <path d="m12 5 7 7-7 7"/>
      </svg>
    </div>
  </a>
</div>

<!-- Footer Reveal Section -->
<div class="footer-reveal-wrapper">
  <footer class="site-footer" id="siteFooter">
    <div class="footer-container">
      <div class="footer-top">
        <div class="footer-brand">
          <img src="https://www.hagertydigital.test:8890/wp-content/uploads/2025/11/logo.png" alt="Hagerty Digital" class="footer-logo">
          <p class="footer-tagline">Driving digital growth for ambitious businesses across the UK and beyond.</p>

          <div class="footer-social">
            <a href="#" aria-label="Facebook">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
              </svg>
            </a>
            <a href="#" aria-label="Twitter/X">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
              </svg>
            </a>
            <a href="#" aria-label="LinkedIn">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                <rect x="2" y="9" width="4" height="12"/>
                <circle cx="4" cy="4" r="2"/>
              </svg>
            </a>
            <a href="#" aria-label="Instagram">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
              </svg>
            </a>
          </div>

          <div class="footer-ecologi">
            <a href="https://ecologi.com/hagertydigitalltd?r=65f96dc2f6b9ba4150c0f056" target="_blank" rel="noopener noreferrer" title="View our Ecologi profile">
              <img alt="We plant trees with Ecologi" src="https://api.ecologi.com/badges/trees/65f96dc2f6b9ba4150c0f056?white=true&treeOnly=true" />
            </a>
          </div>
        </div>

        <div class="footer-links">
          <div class="footer-column">
            <h4>Services</h4>
            <ul>
              <li><a href="/seo">SEO</a></li>
              <li><a href="/ppc">PPC</a></li>
              <li><a href="/web-design">Web Design</a></li>
              <li><a href="/web-development">Web Development</a></li>
              <li><a href="/digital-marketing">Digital Marketing</a></li>
            </ul>
          </div>

          <div class="footer-column">
            <h4>Company</h4>
            <ul>
              <li><a href="/about-us">About Us</a></li>
              <li><a href="/meet-the-team">Our Team</a></li>
              <li><a href="/case-studies">Case Studies</a></li>
              <li><a href="/news">News</a></li>
              <li><a href="/careers">Careers</a></li>
            </ul>
          </div>

          <div class="footer-column">
            <h4>Contact</h4>
            <ul>
              <li><a href="tel:01275792114">01275 792 114</a></li>
              <li><a href="mailto:hello@hagertydigital.com">hello@hagertydigital.com</a></li>
              <li>
                <address>
                  88 High Street<br>
                  Nailsea, Bristol<br>
                  BS48 1AS
                </address>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p class="footer-copyright">&copy; 2025 Hagerty Digital Ltd. All rights reserved.</p>
        <div class="footer-legal">
          <a href="/privacy-policy">Privacy Policy</a>
          <a href="/terms">Terms & Conditions</a>
          <a href="/cookies">Cookie Policy</a>
        </div>
      </div>
    </div>
  </footer>
</div>

<?php
// If your JS is enqueued via functions.php, this is required so WP prints it.
// If you hard-coded a <script> tag before, you should remove it and enqueue instead.
wp_footer();
?>
</body>
</html>