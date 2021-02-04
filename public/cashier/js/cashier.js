$(document).ready(function () {
    $('.nav-link').on('click',()=>{

    })


// Active wrap link
    const wrap_links = $('.wrap__link')

    $.each(wrap_links, function (indexInArray, valueOfElement) {
        $(valueOfElement).on('click',function () {
            $.each(wrap_links, function (indexInArray, valueOfElement) {
                $(this).removeClass('active-table');
            });
            $(this).addClass('active-table');
        })
    });

// Gọi ajax thay đổi html tables list
    $('.wrap__link').on('click',function(){
        const groupId = $(this).attr('data-group-id');

    })


    // Active wrap link và gọi ajax
    const tables__links = $('.tables__item')

    $('.tables__item').on('click',function(){
        $.each(tables__links, function (indexInArray, valueOfElement) {
            $(this).removeClass('tables__focus');
        });
        $(this).addClass('tables__focus');
        $('#pills-home-tab').removeClass('active');
        $('#pills-profile-tab').addClass('active');
        $('#pills-home').removeClass('show');
        $('#pills-home').removeClass('active');
        $('#pills-profile').addClass('show');
        $('#pills-profile').addClass('active');
    })


//    Active category_link
    const category_links = $('.category__link')

    $('.category__link').on('click',function(){

        $.each(category_links, function (indexInArray, valueOfElement) {
            $(valueOfElement).removeClass('active-table');
        });
        const categoryId = $(this).attr('data-category-id');
        $(this).addClass('active-table')
        //   Gọi ajax để thay đổi html products

    })

    // Action
    $('#icon').on('click',function(){
        console.log(1)
    })

    // Modal Payment
    $('.bill__pay').on('click',function(){
        $('#modalPayment').show();
        $('.payment__content').addClass('payment__content-right');
    })

});
