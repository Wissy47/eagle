<?php get_header() ?>
</div>
<section class="who_section layout_padding">
    <div class="container">
        <div class="row">
            
            <?php if (have_posts()):
                while (have_posts()):
                    the_post();
                    ?>

            <div class="col-md-5">
                <div class="img-box">
                    <?= the_post_thumbnail("full") ?>
                    <!-- <img src="/assets/images/who-img.jpg" alt=""> -->
                </div>
            </div>
            <div class="col-md-7">
               
                        <div class="detail-box">
                            <div class="heading_container">
                                <h2><?php the_title(); ?> </h2>
                            <?php endwhile;?>
                    </div>
                    <div>
              <a href="<?=the_permalink()?>">
                Read More
              </a>
            </div>
                </div>
            </div>
            <?php else: ?>
                <p>!Sorry no posts here</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- end who section -->




<?php get_footer() ?>