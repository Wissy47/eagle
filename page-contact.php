<?php get_header() ?>

</div>

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container">

      <div class="heading_container">
        <h2>
          Request A Call Back
        </h2>
      </div>
      <div class="">
        <div class="">
          <div class="row">
            <div class="col-md-9 mx-auto">
              <div class="contact-form">
                <p id="contact-error" class="text-center text-danger"></p>
              <p id="contact-success" class="text-center text-success"></p>
                <form id="contact-form">
                  <div>
                    <input type="text" name="name" placeholder="Full Name ">
                  </div>
                  <div>
                    <input type="text" name="phone" placeholder="Phone Number">
                  </div>
                  <div>
                    <input type="email" name="email" placeholder="Email Address">
                  </div>
                  <div>
                    <input type="text" name="message" placeholder="Message" class="input_message">
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn_on-hover">
                      Send
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="map_img-box">
        <img src="<?=get_template_directory_uri()?>/assets/images/map-img.png" alt="">
      </div>
    </div>
  </section>


  <!-- end contact section -->
<?php get_footer() ?>