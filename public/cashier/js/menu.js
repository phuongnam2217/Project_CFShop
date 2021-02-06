$(document).ready(function () {
    $('body').on('click', '.category__link', function () {
        let id = $(this).attr('data-category-id');
        $.ajax({
            type: 'GET',
            url: "orders" + "/" + id,
            success: function (response) {
                $('#product-category-list').html(response.view);
            },
            error: function (xhr) {
                alert('Error !');
            }
        })
    });

    //Search
    $('#searcher').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/orders/search",
            data: $('#searcher').serialize(),
            success: function (response) {
                $('#product-category-list').html(response.view);
            },
            error: function (xhr) {
                alert("Error !");
            }
        })
    });

    //Chọn bàn
    $('body').on('click', '.detailProduct', function () {
        let id = $(this).attr('table-id');

    });
})
