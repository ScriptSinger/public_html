$(function () {
    let $errorList = $('.error-list');
    $('form').on('submit', function (e) {
        e.preventDefault();
        let $url = $(this).attr('action');
        $.post($url, $(this).serialize(), function (data) {
            if (data.res) {
                $errorList.html('Заявка отправлена!');
                $('form').slideUp(300);
            } else {
                $errorList.css('color', 'red').html(data.errors.toString());
            }
        }, 'json');
    });
});

    /* Button disable */
    let send = document.querySelector('.btn');
    document.getElementById('chckd').addEventListener('click', function () {
        (this.checked) ? send.classList.remove('btn-disable') : send.classList.add('btn-disable');
    });
