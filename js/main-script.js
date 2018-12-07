/* Article FructCode.com */
$(document).ready(function () {
    $("#btn").click(
            function () {
                $.ajax({
                    url: "http://localhost/main/login",
                    type: "POST", 
                    data: $('#form-login').serialize(),
                    success: function (response) { //Данные отправлены успешно
                        var $json = JSON.parse(data);
                        $('#result_form').html('Имя: ' + result.name + '<br>Телефон: ' + result.phonenumber);
                    },
                    error: function (response) { // Данные не отправлены
                        alert('Ошибка. Данные не отправлены.');
                    }
                });
                return false;
            }
    );
});


