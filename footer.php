<!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact eagle_footer_section_address">
            <h5>
              <?= esc_html__(get_theme_mod("eagle_footer_section_title")); ?>
            </h5>
            <div>
              <div class="img-box">
                <img src="<?= get_template_directory_uri() ?>/assets/images/location-white.png" width="18px" alt="">
              </div>
              <p>
                <?= esc_html__(get_theme_mod("eagle_footer_section_address")); ?>
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="<?= get_template_directory_uri() ?>/assets/images/telephone-white.png" width="12px" alt="">
              </div>
              <p>
              <?= esc_html__(get_theme_mod("eagle_footer_section_phone")); ?>
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="<?= get_template_directory_uri() ?>/assets/images/envelope-white.png" width="18px" alt="">
              </div>
              <p>
                <?= esc_html__(get_theme_mod("eagle_footer_section_email")); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-widget-area">
            <?php if (is_active_sidebar('footer-widget')): ?>
              <?php dynamic_sidebar('footer-widget'); ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info_insta">
            <h5>
              Instagram
            </h5>
            <div class="insta_container">
              <div>
                <a href="">
                  <div class="insta-box b-1">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/insta.png" alt="">
                  </div>
                </a>
                <a href="">
                  <div class="insta-box b-2">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/insta.png" alt="">
                  </div>
                </a>
              </div>

              <div>
                <a href="">
                  <div class="insta-box b-3">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/insta.png" alt="">
                  </div>
                </a>
                <a href="">
                  <div class="insta-box b-4">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/insta.png" alt="">
                  </div>
                </a>
              </div>
              <div>
                <a href="">
                  <div class="insta-box b-3">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/insta.png" alt="">
                  </div>
                </a>
                <a href="">
                  <div class="insta-box b-4">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/insta.png" alt="">
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_form ">
            <h5>
              Newsletter
            </h5>
            <form action="">
              <input type="email" placeholder="Enter your email">
              <button>
                Subscribe
              </button>
            </form>
            <div class="social_box">
              <a href="">
                <img src="<?=get_template_directory_uri() ?>/assets/images/fb.png" alt="">
              </a>
              <a href="">
                <img src="<?=get_template_directory_uri() ?>/assets/images/twitter.png" alt="">
              </a>
              <a href="">
                <img src="<?=get_template_directory_uri() ?>/assets/images/linkedin.png" alt="">
              </a>
              <a href="">
                <img src="<?=get_template_directory_uri() ?>/assets/images/youtube.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

<!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; 2020 All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <!-- <script type="text/javascript" src="">
  </script> -->
  <!-- owl carousel script 
    -->
  <?php wp_footer() ?>
  <script type="text/javascript">
    
  </script>
  <!-- end owl carousel script -->

</body>

</html>