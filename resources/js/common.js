$(document).ready(function () {

    $('.changeLink').click(function (e) {
        e.preventDefault();
        $(this).parent('.realData').addClass('d-none');
        $(this).parents('td').find('.resetData').addClass('d-flex');
        $('#saveClient').prop('disabled', false);
    });

    $('.resetLink').click(function (e) {
        e.preventDefault();
        $(this).siblings('.dataInp').val($(this).siblings('.dataInp').data('orig'))

        $(this).parent('.resetData').removeClass('d-flex');
        $(this).parents('td').find('.realData').removeClass('d-none');

    });

});
