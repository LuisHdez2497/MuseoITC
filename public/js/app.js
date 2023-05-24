$(document).ready(function() {
    //Notificaciones
    setTimeout(function() {
        $(".message-edit").fadeOut(1000);
    },1500);

    setTimeout(function() {
        $(".message-error").fadeOut(1000);
    },1500);
    //Fin notificaciones
});

$('#modal-eliminar').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('data-id', $(e.relatedTarget).data('href'));
});

$('#eliminar-museo').on('click', function (){
    let base_url = window.location.origin;
    let id_museo = $(this).data('id');

    $.ajax({
        type: "GET",
        url: base_url+'/museo/eliminar/'+id_museo,
        global: false,
        success: data => {
            $('#notificaciones').append('' +
                '<div class="alert alert-success message-edit">' + 'Se eliminó el objeto. ' +
                '<button type="button" class="close" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>' +
                '</div>');
            setTimeout(function() {
                $(".message-edit").fadeOut(1000);
            },2000);
            setTimeout(function (){
                document.getElementById('redireccionar-museo').click();
            }, 3000);
        },
        error: error => {
            $('#notificaciones').append('' +
                '<div class="alert alert-danger message-edit">' + 'No se puede eliminar el objeto. ' +
                '<button type="button" class="close" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>' +
                '</div>');
            setTimeout(function() {
                $(".message-edit").fadeOut(1000);
            },2000);
        }
    });
});
