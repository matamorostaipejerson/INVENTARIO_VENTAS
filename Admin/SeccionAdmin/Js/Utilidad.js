$(document).ready(function () {
    var Tabla = $("#TblUtilidad").DataTable({
        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ ",
            "zeroRecords": "No se encontraron resultados",
            "info": " _TOTAL_ registros",
            "infoEmpty": "Total de 0 registros",
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
          //para usar los botones
        /* responsive: "true", */
        dom: 'Bfrtilp', // hacen referencia a b de boton f de find
        buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                titleAttr: 'Exportar a excel',
                className: 'btn btn-success',
                footer: true
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
                footer: true,
                orientation: 'landscape',
                alignment: 'center',
                pageSize: 'A4',
                fontSize: '3',

                exportOptions: {
                    columns: ':visible',
                    footer: true,
                    stripHtml: true,
                }
               

            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i>',
                titleAttr: 'Imprimir',
                className: 'btn btn-info',
                footer: true,

            },
        ],

        "drawCallback": function () {
            //alert("La tabla se está recargando"); 
            var api = this.api();
            $(api.column(7).footer()).html(
                'Total: ' + api.column(7, {
                    page: 'current'
                }).data().sum()
            )
            $(api.column(8).footer()).html(
                'Total: ' + api.column(8, {
                    page: 'current'
                }).data().sum()
            )

            $(api.column(2).footer()).html(

                'Utilidad: ' + (api.column(8, {
                    page: 'current'
                }).data().sum() - api.column(7, {
                    page: 'current'
                }).data().sum())
            )

        }
    });
});