const {
    default: Axios
} = require("axios");

$(document).ready(function () {
    // работа с клиентом
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

    $('#saveClient').click(function (e) {
        e.preventDefault();
        $(this).find('.spinner-border').removeClass('d-none');
        $(this).prop('disabled', true);
        //let self=this
        let data = {
            'id': $(this).data('id'),
            'inn': $('[name="inn"]').val(),
            'organization': $('[name="organization"]').val(),
            'fullname': $('[name="fullname"]').val(),
            'email': $('[name="email"]').val(),
            'address': $('[name="address"]').val(),
            'phone': $('[name="phone"]').val(),
        };
        axios.post('/ajax/contacts/update', data)
            .then(function (response) {
                $('#successAlert').removeClass('d-none');
            })
            .catch(function (error) {

            })
            .then(() => {
                console.log('fin')
                $(this).find('.spinner-border').addClass('d-none');
                // $(this).prop('disabled', true);
            })
    })

});
