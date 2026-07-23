$(function () {

    // Read CSRF token from the meta tag set in the layout
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Set it globally so every $.ajax call includes it automatically
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': csrfToken }
    });

    /**
     * Format a number as a USD currency string.
     * Matches the Currency::format() helper on the server.
     */
    function formatCurrency(amount) {
        return '$' + parseFloat(amount).toFixed(2);
    }

    /**
     * Recalculate the cart total by summing every visible row's price × qty.
     */
    function recalculateTotal() {
        var total = 0;

        $('.item-quantity').each(function () {
            var qty   = parseInt($(this).val(), 10) || 0;
            var price = parseFloat($(this).data('price')) || 0;
            total += qty * price;
        });

        $('#cart-total').text(formatCurrency(total));
        $('#cart-total-pay').text(formatCurrency(total));
    }

    // ─── Quantity update ────────────────────────────────────────────────────────

    var debounceTimer;

    $(document).on('change', '.item-quantity', function () {
        var $input   = $(this);
        var cartId   = $input.data('id');
        var price    = parseFloat($input.data('price')) || 0;
        var quantity = parseInt($input.val(), 10);

        // Enforce minimum of 1
        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            $input.val(1);
        }

        // Optimistic UI: update subtotal & total immediately
        $('.item-subtotal[data-id="' + cartId + '"]').text(formatCurrency(price * quantity));
        recalculateTotal();

        // Debounce so rapid typing doesn't flood the server
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            $.ajax({
                url: '/cart/' + cartId,
                method: 'PUT',
                data: { quantity: quantity },
                success: function (response) {
                    if (!response.success) {
                        console.error('Cart update returned failure:', response);
                    }
                },
                error: function (xhr) {
                    console.error('Cart update failed:', xhr.responseText);
                    alert('Could not update quantity. Please try again.');
                }
            });
        }, 400);
    });

    // ─── Remove item ────────────────────────────────────────────────────────────

    $(document).on('click', '.remove-item', function () {
        var $btn   = $(this);
        var cartId = $btn.data('id');

        // Find the row wrapping this button
        var $row = $btn.closest('.cart-single-list');

        // Disable the button immediately to prevent double-clicks
        $btn.css('pointer-events', 'none').css('opacity', '0.4');

        $.ajax({
            url: '/cart/' + cartId,
            method: 'DELETE',
            success: function (response) {
                if (response.success) {
                    // Fade out and remove the row from the DOM
                    $row.fadeOut(250, function () {
                        $(this).remove();
                        recalculateTotal();

                        // If no rows remain, show the empty-cart message
                        if ($('.cart-single-list').length === 0) {
                            $('.cart-list-head').append(
                                '<div class="text-center py-5" id="empty-cart-msg">' +
                                '<h4>Your cart is empty.</h4></div>'
                            );
                            // Hide the totals block too
                            $('.total-amount').fadeOut(200);
                        }
                    });
                } else {
                    $btn.css('pointer-events', '').css('opacity', '');
                    alert('Could not remove item. Please try again.');
                }
            },
            error: function (xhr) {
                console.error('Cart remove failed:', xhr.responseText);
                $btn.css('pointer-events', '').css('opacity', '');
                alert('Could not remove item. Please try again.');
            }
        });
    });

});
