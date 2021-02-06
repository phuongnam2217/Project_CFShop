$(document).ready(function () {

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
