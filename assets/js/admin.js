// jQuery(document).ready(function($) {

//             var index = $(".custom-repeater-row").length;
//             $('#add-row').click(function (e) {
//                 e.preventDefault();
//                 var row = '<div class="custom-repeater-row">' +
//                     '<input type="text" name="custom_repeater_data[' + index + '][field_name]" value="">' +
//                     '<button class="remove-row">Remove</button>' +
//                     '</div>';
//                 $('#custom-repeater-container').append(row);
//                 index++;
//             });
//             $(document).on('click', '.remove-row', function (e) {
//                 e.preventDefault();
//                 $(this).closest('.custom-repeater-row').remove();
//             });
//         });