//jquery onload

jQuery(document).ready(function($) {
    $(".owl-carousel").owlCarousel({
      loop: true,
      margin: 0,
      navText: [],
      center: true,
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        1000: {
          items: 3
        }
      }
    });

    $(document).on("submit", "#subscriber", function (e) {
      e.preventDefault();
      let form = this;
      let formData = $(this).serialize() +
        `&action=eagle_subscribe_form_action&_ajax_nonce=${ajaxObj.nonce}`;

      // Change ajax url value to your domain
      let ajaxurl = ajaxObj.ajax_url; // "<?php echo home_url() ?>/wp-admin/admin-ajax.php";

      // Send ajax
      $.post(ajaxurl, formData, function (response) {
        $("#sub-success").html(response.data);
        form.reset();
        console.log(response);
        // location.reload();
      }).fail(function (error) {
        let errorText = error.responseJSON?.data || error.responseText;
        $("#sub-error").html(error.statusText + " : " + errorText);
      });
    });

    $("#sub-email, input").on("focus", function () {
      $("#sub-error").html("");
      $("#contact-error").html("");
    });


    $(document).on("submit", "#contact-form", function (e) {
      e.preventDefault();
      let form = this;
      let formData =
        $(this).serialize() +
        `&action=eagle_contact_form_action&_ajax_nonce=${ajaxObj.nonce}`;

      // Change ajax url value to your domain
      let ajaxurl = ajaxObj.ajax_url; // "<?php echo home_url() ?>/wp-admin/admin-ajax.php";

      // Send ajax
      $.post(ajaxurl, formData, function (response) {
        $("#contact-success").html(response.data);
        form.reset();
        $("#contact-form").hide();
      }).fail(function (error) {
        let errorText = error.responseJSON?.data || error.responseText;
        $("#contact-error").html(error.statusText + " : " + errorText);
      });
    });

});