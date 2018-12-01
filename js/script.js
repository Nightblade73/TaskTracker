

//$('#add').click(function (event) {
//    console.log('я здесь');
//    event.preventDefault();
//    addDynamicExtraField();
//});

$(document).on('click', '#add', function (e)
{
    e.preventDefault();
    var $tasks = $('.container-fluid');
    console.log($('#task-name').val());
    $('.container-fluid').append('<div class="card text-white bg-primary mb-3 " style="max-width: 18rem;">\n\
        <button type="button" class="card-header btn btn-primary" data-toggle="modal"data-target="#editTask"> ' +
           $('#task-name').val() + '</button>\n\
        </div>');
});

//
//$(function()
//{
//    $(document).on('click', '.add-task', function(e)
//    {
//        e.preventDefault();
//
//        var controlForm = $('.controls form:first'),
//            currentEntry = $(this).parents('.entry:first'),
//            newEntry = $(currentEntry.clone()).appendTo(controlForm);
//
//        newEntry.find('input').val('');
//        controlForm.find('.entry:not(:last) .btn-add')
//            .removeClass('btn-add').addClass('btn-remove')
//            .removeClass('btn-success').addClass('btn-danger')
//            .html('<span class="glyphicon glyphicon-minus"></span>');
//    }).on('click', '.btn-remove', function(e)
//    {
//		$(this).parents('.entry:first').remove();
//
//		e.preventDefault();
//		return false;
//	});
//});
