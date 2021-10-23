$(document).ready(function() {
    $('#rolesTable').DataTable();
    $('#userTable').DataTable();
    $('#codesniptTable').DataTable();

    $('.wysihtml5-toolbar').children().eq(0).hide();
    $('.wysihtml5-toolbar').children().eq(1).hide();
    $('.wysihtml5-toolbar').children().eq(3).hide();
    $('.wysihtml5-toolbar').children().eq(4).hide();
    $('.wysihtml5-toolbar').children().eq(2).children().children().eq(0).hide();
    $('.wysihtml5-toolbar').children().eq(2).children().children().eq(1).hide();

} );