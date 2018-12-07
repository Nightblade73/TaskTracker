/* Article FructCode.com */
$(document).ready(function () {
    $("#btn-login").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "http://localhost/main/login",
            type: "POST",
            data: $('#form-login').serialize(),
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


