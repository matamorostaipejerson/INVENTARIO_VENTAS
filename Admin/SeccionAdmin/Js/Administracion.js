$(document).ready(function () {

    var TablaAdministracion = $("#tblAdministracion").DataTable({

        orderCellsTop: true,
        fixedHeader: true, //incialidzar las bsuquedas

        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        },
    });




    $('#BtnAdd').click(function (e) {
        e.preventDefault();
        let Option = 0;
        if (window.location.href.indexOf('ReporteIngresos.php') > -1) {
            Option = 1;
        } else {
            Option = 2;
        }
        let Nombre = $('#Nombre').val();
        let ValorTotal = $('#VTotal').val();
        let fecha = moment().format('YYYY-MM-DD');
        let Registros = [];
        console.log(fecha, Nombre, ValorTotal);

        TablaAdministracion.rows().data().each(function (el, index) {
            //Asumiendo que es la column(a 5 de cada fila la que quieres agregar a la sumatoria;
            Registros.push(el[0]);
        });

        $.ajax({
            type: "POST",
            url: "../php/Administracion.php",
            data: {
                Option: Option,
                Nombre: Nombre,
                Fecha: fecha,
                ValorTotal: ValorTotal
            },
            dataType: "json",
            success: function (dato) {
                if (Option == 1) {
                    Option =3;
                }else{
                    Option =4;
                }
                if (dato) {
                    let i = 0;
                    while (i < Registros.length) {
                        $.ajax({
                            type: "POST",
                            url: "../php/Administracion.php",
                            data: {
                                Option: Option,
                                Id:Registros[i]
                            },
                            dataType: "json",
                            success: function (dato) {
                                if (dato) {
                                    alert("Correcto");
                                }

                            }

                        });
                     i++;
                    }
                }
            }
        });



    });
});