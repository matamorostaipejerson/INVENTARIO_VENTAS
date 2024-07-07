$(function() {
    $('#Salidas-form').submit(function(e){
        const PostDatos = {
            Nombre: $('#Nombre').val(),
            Hora : $('#Hora').val(),
            Fecha : $('#Fecha').val(),
            PrecioTotal : $('#PrecioTotal')
        }
        console.log(PostDatos);
        e.preventDefault();
    
    });
});