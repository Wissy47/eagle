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
            <?php if (is_active_sidebar('footer-widget-2')): ?>
              <?php dynamic_sidebar('footer-widget-2'); ?>
            <?php endif; ?>
            </form>
            <div class="social_box">
              <?php $fb = get_theme_mod("eagle_footer_social_facebook") ?>
              <?php $fb_added = $fb==""? "fade":""; ?>
              <a href="<?=esc_attr__($fb)?>" class="<?=$fb_added?>">
                <img src="<?=get_template_directory_uri() ?>/assets/images/fb.png" alt="">
              </a>
              <?php $tw = get_theme_mod("eagle_footer_social_twitter") ?>
              <?php $tw_added = $tw == "" ? "fade" : ""; ?>
              <a href="<?= esc_attr__($tw) ?>" class="<?= $tw_added ?>">
                <img src="<?=get_template_directory_uri() ?>/assets/images/twitter.png" alt="">
              </a>
              <?php $lk = get_theme_mod("eagle_footer_social_linkedin") ?>
              <?php $lk_added = $lk == "" ? "fade" : ""; ?>
              <a href="<?= esc_attr__($lk) ?>" class="<?= $lk_added ?>">
                <img src="<?=get_template_directory_uri() ?>/assets/images/linkedin.png" alt="">
              </a>
              <?php $yt = get_theme_mod("eagle_footer_social_youtube") ?>
              <?php $yt_added = $yt == "" ? "fade" : ""; ?>
              <a href="<?= esc_attr__($yt) ?>" class="<?= $yt_added ?>">
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