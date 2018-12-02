$('#sandbox-container .input-daterange').datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    todayHighlight: true
});

$(document).ready(function () {

    var $taskDescriptionOld;
// Добавление новой задачи
    $("#add").click(function (e) {
        //  e.preventDefault();
        var $taskname = $('#task-name').val().trim();
        if ($taskname === '') {
            alert("Пустая строка");
            return false;
        }
        $.ajax({
            url: "http://localhost/tasklist/addtask",
            type: "POST",
            data: {name: $taskname},
            success: function (data, textStatus, jqXHR) {
                $('.container-fluid').append('<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">\n\
        <input type="button" class="card-header btn btn-primary task newtask" data-toggle="modal" data-target="#edit-Task" \n\
        data-backdrop="static" data-keyboard="false" value="' + data + '"/></div>');
                $('.newtask').click(function (e) {
                    e.preventDefault();
                    $('.task-title').html(this.value);
                    $.ajax({
                        url: "http://localhost/tasklist/gettaskinfo",
                        type: "POST",
                        data: {name: $('.task-title').html()},
                        success: function (data, textStatus, jqXHR) {
                            var $json = JSON.parse(data);
                            console.log($json);
                            $('#description').val($json.description);
                            $('input[name="begin"]').val($json.date_begin);
                            $('input[name="end"]').val($json.date_end);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
                        }
                    });
                });
                $('.newtask').removeClass('newtask');
                $('#add-Task').modal('toggle');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
            }
        });
        return false;
    });
//изменение описания
    $("#change-desc-submit").click(function (e) {
        e.preventDefault();
        var $taskDescriptionNew = $('#description').val().trim();
        $.ajax({
            url: "http://localhost/tasklist/changetaskdescription",
            type: "POST",
            data: {name: $('.task-title').html(),
                desc: $taskDescriptionNew},
            success: function (data, textStatus, jqXHR) {
                changeState();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
            }
        });
        return false;
    });
//просмотреть информацию о задаче
    $(".task").click(function (e) {
        e.preventDefault();
        $('.task-title').html(this.value);
        $.ajax({
            url: "http://localhost/tasklist/gettaskinfo",
            type: "POST",
            data: {name: $('.task-title').html()},
            success: function (data, textStatus, jqXHR) {
                var $json = JSON.parse(data);
                console.log($json);
                $('#description').val($json.description);
                $('input[name="begin"]').val($json.date_begin);
                $('input[name="end"]').val($json.date_end);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
            }
        });
    });
//очистка полей
    $("#task-close-but").click(function (e) {
        e.preventDefault();
        changeState();
        $('#description').val("");
        $('input[name="begin"]').val("");
        $('input[name="end"]').val("");
    });
//очистка поля имени задачи
    $("#add-task-but").click(function (e) {
        e.preventDefault();
        $('#task-name').val("");
    });

//изменения даты окончания
    $('input[name="end"]').change(function (e) {
        e.preventDefault();
        $.ajax({
            url: "http://localhost/tasklist/changeenddate",
            type: "POST",
            data: {name: $('.task-title').html(),
                date: $('input[name="end"]').val()},
            success: function (data, textStatus, jqXHR) {

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '|\n' + textStatus + '|\n' + errorThrown);
            }
        });
    });
//изменения состояния редактирования описания    
    $("#change-desc").click(function (e) {
        e.preventDefault();
        $taskDescriptionOld = $('#description').val();
        $('#change-desc-submit').removeAttr('hidden');
        $('#cancel-desc').removeAttr('hidden');
        $('#description').attr('disabled', false);
        $('#description').css('border', '1px solid #ced4da');
        $("#change-desc").attr('hidden', true);
        return false;
    });
//изменения состояния редактирования описания  
    $("#cancel-desc").click(function (e) {
        e.preventDefault();
        $('#description').val($taskDescriptionOld);
        changeState();
        return false;
    });
//отмена редактирования
    function changeState() {
        $('#change-desc-submit').attr('hidden', true);
        $('#change-desc').removeAttr('hidden');
        $('#description').attr('disabled', true);
        $('#description').css('border', 'none');
        $("#cancel-desc").attr('hidden', true);
    };
});
