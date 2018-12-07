$(document).ready(function () {
    $("#btn-sign-up").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "http://localhost/signup/registration",
            type: "POST",
            data: $('#form-sign-up').serialize(),
            success: function (data) {
                var $json = JSON.parse(data);
                console.log($json);
                if (typeof $json.error !== 'undefined') {
                    $('#alert').html($json.error);
                    $('#alert').fadeIn(500);
                    $('#alert').delay(3000).fadeOut();
                } else {
                    document.location.replace("http://localhost" + $json);
                }
            },
            error: function (response) { // Данные не отправлены
                alert('Ошибка. Данные не отправлены.');
            }
        });
        return false;
    });
});
