$(document).ready(function () {

    var $taskDescriptionOld;

    $("#add").click(function (e) {
        e.preventDefault();
        var $taskname = $('#task-name').val().trim();
        if ($taskname === '') {
            alert("Пустая строка");
            return false;
        }
        console.log($taskname);
        $.ajax({
            url: "http://localhost/tasklist/addtask",
            type: "POST",
            data: {name: $taskname},
            success: function (data, textStatus, jqXHR) {
                $('.container-fluid').append('<div class="card text-white bg-primary mb-3 " style="max-width: 18rem;">\n\
        <button type="button" class="card-header btn btn-primary" data-toggle="modal"data-target="#editTask"> ' +
                        data + '</button>\n\
        </div>');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
            }
        });
        return false;
    });

    $("#change-desc-submit").click(function (e) {
        e.preventDefault();
        var $taskDescriptionNew = $('#description').val().trim();
        $.ajax({
            url: "http://localhost/tasklist/changetaskdescription",
            type: "POST",
            data: {name: $('.task-title').text(),
                desc: $taskDescriptionNew},
            success: function (data, textStatus, jqXHR) {
                $('#change-desc-submit').css('display', 'none');
                $('#change-desc').css('display', 'flex');
                $('#description').attr('disabled', true);
                $('#description').css('border', 'none');
                $("#cancel-desc").css('display', 'none');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
            }
        });
        return false;
    });

    $(".task").click(function (e) {
        e.preventDefault();
        $('.task-title').html(this.value);
        $.ajax({
            url: "http://localhost/tasklist/gettaskinfo",
            type: "POST",
            data: {name: $('.task-title').text()},
            success: function (data, textStatus, jqXHR) {
                console.log(data);
             //   $('#description').attr('disabled', true);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
            }
        });
    });

    $("#add-task-but").click(function (e) {
        e.preventDefault();
        $('#task-name').val("");
    });

    $("#change-desc").click(function (e) {
        e.preventDefault();
        $taskDescriptionOld = $('#description').val();
        $('#change-desc-submit').css('display', 'inline-block');
        $('#cancel-desc').css('display', 'flex');
        $('#description').attr('disabled', false);
        $('#description').css('border', '1px solid #ced4da');
        $("#change-desc").hide();
        return false;
    });

    $("#cancel-desc").click(function (e) {
        e.preventDefault();
        $('#description').val($taskDescriptionOld);
        $('#change-desc-submit').css('display', 'none');
        $('#change-desc').css('display', 'flex');
        $('#description').attr('disabled', true);
        $('#description').css('border', 'none');
        $("#cancel-desc").css('display', 'none');
        return false;
    });


});
