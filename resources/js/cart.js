console.log("Cart loaded");
$('.item-quantity').on('change', function () {

    let input = $(this);
    let id = input.data('id');
    let quantity = input.val();

    $.ajax({
        url: '/cart/' + id,
        type: 'PATCH',

        data: {
            _token: csrf_token,
            quantity: quantity
        },

        success: function (response) {
            console.log('Updated Successfully');
        },

        error: function () {
            alert('Update failed');
        }
    });

});
/*(function ($) {

    $('.item-quantity').on('change', function (e) {

        $.ajax({
            url: "/cart/" + $(this).data('id'), //data-id
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            }
        });
    });

    $('.remove-item').on('click', function (e) {

        let id = $(this).data('id');
        $.ajax({
            url: "/cart/" + id, //data-id
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                $(`#${id}`).remove();
            }
        });
    });

    $('.add-to-cart').on('click', function (e) {

        $.ajax({
            url: "/cart",
            method: 'post',
            data: {
                product_id: $(this).data('id'),
                quantity: $(this).data('quantity'),
                _token: csrf_token
            },
            success: response => {
                alert('product added')
            }
        });
    });

})(jQuery);
*/
