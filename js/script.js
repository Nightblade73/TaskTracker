

$('#add-task').click(function (event) {
    addDynamicExtraField();
});

function addDynamicExtraField() {
    var $tables = $('.container-fluid');
    for (var i = 1; i <= 15; i++) {
        $('<div />', {class: 'inner', text: i}).appendTo($tables);
    };
}