<?php get_header()?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
     

</div>


  <!-- work section -->
  <section class="work_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
            <?=the_title()?>
        </h2>
        <p>
         <?=the_content();?>
        </p>
      </div>
      <div class="work_container layout_padding2">
        <div class="box b-1">
          <img src="<?=get_template_directory_uri()?>/assets/images/w-1.png" alt="">
        </div>
        <div class="box b-2">
          <img src="<?= get_template_directory_uri() ?>/assets/images/w-2.png" alt="">

        </div>
        <div class="box b-3">
          <img src="<?= get_template_directory_uri() ?>/assets/images/w-3.png" alt="">

        </div>
        <div class="box b-4">
          <img src="<?= get_template_directory_uri() ?>/assets/images/w-4.png" alt="">

        </div>
      </div>
    </div>
  </section>
<?php
endwhile; else: 
?>
<p>!Sorry no posts here</p>
<?php
 endif; 
 ?>

  <!-- end work section -->




<?php get_footer(); ?>
