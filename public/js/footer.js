$(document).on('click', '.btn-blue', function (event) {
    console.log($(this).data('product_id'));
    event.preventDefault();
    var button = $(this);
    $.ajax({
        type: 'GET',
        url: "/cart/add/" + $(this).data('product_id'),
        success: function (data) {
            $('.payment-basket__status__basket-value').text(data);
            button.addClass('btn-green');
            button.text('В корзине');
        }
    });
});

$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: "/cart/getcount",
        success: function (data) {
            $('.payment-basket__status__basket-value').text(data);
        }
    });
});