
jQuery(document).ready(function ($) {
    let index = $(".hero_slider-repeater-row").length;
    $("#add-hero-slider-row").click(function (e) {
      e.preventDefault();
      var row = `<div class="hero_slider-repeater-row">
                <input type="text" name="hero_slider_repeater_data[${index}][top_heading]" placeholder="Top Heading" value="">
                <input type="text" name="hero_slider_repeater_data[${index}][major_heading]" placeholder="Major Heading" value="">
                <input type="text" name="hero_slider_repeater_data[${index}][paragraph]" placeholder="Paragraph" value="">
                <input type="text" name="hero_slider_repeater_data[${index}][button_text]" placeholder="Button text" value="">
                <input type="text" name="hero_slider_repeater_data[${index}][button_url]" placeholder="Button URL" value="">
                <button class="remove-row">Remove</button>
            </div>`;
      $("#hero_slider-repeater-container").append(row);
      index++;
    });
    $(document).on('click', '.remove-row', function (e) {
        e.preventDefault();
        $(this).closest('.hero_slider-repeater-row').remove();
        $(this).closest(".review_slider-repeater-row").remove();
    });
/**
 * Review Slider
 */
    $('#add-review-slider-row').click(function (e) {
        let index = $(".review_slider-repeater-row").length;
        e.preventDefault();
        let row = `<div class="review_slider-repeater-row">
                    <div style="margin-bottom:5px; margin-top:10px">
                            <input type="hidden" name="review_slider_repeater_field[${index}][image_id]" value="" class="image-id">
                            <img src="" width="100" style="display:none;">
                            <button class="upload-image-button button">Upload Image</button>
                        </div>
                        <input type="text" name="review_slider_repeater_field[${index}][heading]" placeholder="Heading" value="">
                        <input type="text" name="review_slider_repeater_field[${index}][sub_heading]" placeholder="Sub heading" value="">
                        <input type="text" name="review_slider_repeater_field[${index}][paragraph]" placeholder="Paragraph" value="">
                        <button class="remove-row button">Remove</button>
                        </div>`;
        $('#review_slider-repeater-container').append(row);
        index++;
    });
    $(document).on('click', '.upload-image-button', function (e) {
        e.preventDefault();
        var button = $(this);
        var imageFrame = wp.media({
                title: 'Select Image',
                multiple: false
            });
        imageFrame.on('select', function () {
            var attachment = imageFrame.state().get('selection').first().toJSON();
            button.siblings('.image-id').val(attachment.id);
            button.siblings('img').attr('src', attachment.url).show();
        });
        imageFrame.open();
    });
});