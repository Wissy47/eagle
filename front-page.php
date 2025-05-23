<?php get_header(); ?>

    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <?php $repeater_data = get_post_meta(get_the_ID(), 'hero_slider_repeater_data', true);
          if (!empty($repeater_data)):
          ?>
          <ol class="carousel-indicators">
            <?php foreach ($repeater_data as $key => $data): 
              $active = '';
              if ($key == 0) {
                $active = 'active';
              }
            ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$key?>" class="<?=$active?>"></li>
            <?php endforeach; endif;?>
          </ol>
           <div class="carousel-inner">
          <?php
          if (!empty($repeater_data)):
            foreach ($repeater_data as $key => $data):
              $active = '';
              if ($key == 0) {
                $active = 'active';
              }
          ?>
         
            <div class="carousel-item <?=$active?>">
              <div class="row">
                <div class="col">
                  <div class="detail-box">
                    <div>
                      <h2>
                       <?=$data['top_heading']?>
                      </h2>
                      <h1>
                        <?= $data['major_heading'] ?>
                      </h1>
                      <p>
                        <?= $data['paragraph'] ?>
                      </p>
                      <div class="">
                        <a href="<?= $data['button_url'] ?>">
                          <?= $data['button_text'] ?>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          <?php endforeach; endif; ?>
          </div>
        </div>

      </div>
    </section>
    <!-- end slider section -->
  </div>
  <!-- do section -->

  <section class="do_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          What we do
        </h2>
        <p>
          <?=the_content()?>
        </p>
      </div>
      <div class="do_container">
        <div class="box arrow-start arrow_bg">
          <div class="img-box">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/d-1.png" alt="">
          </div>
          <div class="detail-box">
            <h6>
              Marketing
            </h6>
          </div>
        </div>
        <div class="box arrow-middle arrow_bg">
          <div class="img-box">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/d-2.png" alt="">
          </div>
          <div class="detail-box">
            <h6>
              Development
            </h6>
          </div>
        </div>
        <div class="box arrow-middle arrow_bg">
          <div class="img-box">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/d-3.png" alt="">
          </div>
          <div class="detail-box">
            <h6>
              Html5
            </h6>
          </div>
        </div>
        <div class="box arrow-end arrow_bg">
          <div class="img-box">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/d-4.png" alt="">
          </div>
          <div class="detail-box">
            <h6>
              Css
            </h6>
          </div>
        </div>
        <div class="box ">
          <div class="img-box">
            <img src="<?php echo get_template_directory_uri()?>/assets/images/d-5.png" alt="">
          </div>
          <div class="detail-box">
            <h6>
              Wordpress
            </h6>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- end do section -->

<!-- client section -->
  <section class="client_section">
    <div class="container">
      <div class="heading_container">
        <h2>
          WHAT CUSTOMERS SAY
        </h2>
      </div>
      <div class="carousel-wrap ">
        <div class="owl-carousel">

        <?php $review_sliders = get_option("review_slider_repeater_field") ?>  
        <?php if (!empty($review_sliders)): ?> 
        <?php foreach ($review_sliders as $key => $slider): ?>  
          <div class="item">
            <div class="box">
              <div class="img-box">
                <img src="<?= wp_get_attachment_url((int) $slider['image_id']) ?>" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  <?=$slider['heading']?> <br>
                  <span>
                    <?= $slider['sub_heading'] ?>
                  </span>
                </h5>
                <img src="<?php echo get_template_directory_uri()?>/assets/images/quote.png" alt="">
                <p>
                  <?=$slider['paragraph'] ?>
                </p>
              </div>
            </div>
          </div>
          <!-- Item end -->
          <?php endforeach; endif; ?>  
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->

  <!-- target section -->
  <section class="target_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="detail-box">
            <h2 class="eagle_metric_first_value_text">
              <?=esc_html__(get_theme_mod("eagle_metric_first_value_text"));?>
            </h2>
            <h5 class="eagle_metric_first_desc_value_text">
            <?= esc_html__(get_theme_mod("eagle_metric_first_desc_value_text")); ?>
            </h5>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="detail-box">
            <h2 class="eagle_metric_second_value_text">
              <?= esc_html__(get_theme_mod("eagle_metric_second_value_text")); ?>
            </h2>
            <h5 class="eagle_metric_second_desc_value_text">
              <?= esc_html__(get_theme_mod("eagle_metric_second_desc_value_text")); ?>
            </h5>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="detail-box">
            <h2 class="eagle_metric_third_value_text">
              <?= esc_html__(get_theme_mod("eagle_metric_third_value_text")); ?>
            </h2>
            <h5 class="eagle_metric_third_desc_value_text">
            <?= esc_html__(get_theme_mod("eagle_metric_third_desc_value_text")); ?>
            </h5>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="detail-box">
            <h2 class="eagle_metric_forth_value_text">
            <?= esc_html__(get_theme_mod("eagle_metric_forth_value_text")); ?>
            </h2>
            <h5 class="eagle_metric_forth_desc_value_text">
              <?= esc_html__(get_theme_mod("eagle_metric_forth_desc_value_text")); ?>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end target section -->




<?php get_footer(); ?>