$(document).ready(function () {
    var TablaProductos = $("#TblProductos").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btnAdd'><i class='fas fa-plus-square' aria-hidden='true'> </i> Añadir</button></div></div>",
        }],

        orderCellsTop: true,
        fixedHeader: true, //incialidzar las bsuquedas

        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Registros del _START_ al _END_ del total de _TOTAL_ registros",
            "infoEmpty": "registros del 0 al 0",
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

    var TablaAdds = $("#TablaAdds").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnEliminar'><i class='fas fa-trash' aria-hidden='true'> </i> Eliminar</button></div></div>",
        }],

        orderCellsTop: true,
        fixedHeader: true, //incialidzar las bsuquedas

        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Registros del _START_ al _END_ del total de _TOTAL_ registros",
            "infoEmpty": "Registros del 0 al 0",
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


//---------------------------Añadir articulos a la tabla---------------------//
    $(document).on("click", ".btnAdd", function (e) {
        e.preventDefault();
        let Option = 1;
        let Id = parseInt($(this).closest("tr").find('td:eq(0) input').val());
        let CantidadA = parseInt($(this).closest("tr").find('td:eq(6) select').val());
        console.log(CantidadA);

        $.ajax({
            type: "POST",
            url: "../php/Salidas.php",
            data: {Option:Option,Id:Id},
            dataType: "json",
            success: function (Datos) {
                console.log(Datos);
                TablaAdds.row.add([
                    Datos['Id_Articulo'],
                    Datos['Codigo'],
                    Datos['Nombre'],
                    CantidadA,
                    Datos['PrecioVenta'],
                    parseInt(Datos['PrecioVenta'])*CantidadA
                ]).draw();
                ExtraerSuma();
            }
        });
    });


    $(document).on("click", ".btnEliminar", function (e) {
        e.preventDefault();
        let fila = $(this);
        TablaAdds.row(fila.parents('tr')).remove().draw();
        ExtraerSuma();
    });

    function ExtraerSuma() {
        var total = 0;
        TablaAdds.rows().data().each(function(el, index){
            //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
            total += el[5];
          });
        
        $('#ValorTotal').val(total);
    }

    function Articulos(Id_Articulo,Cantidad,PrecioU,Total) {
        this.Id_Articulo = Id_Articulo;
        this.Cantidad = Cantidad;
        this.PrecioU = PrecioU;
        this.Total = Total; 
    }


    //----------------------------Insertar Salida
    $('#Form_Salida').submit(function (e) { 
        e.preventDefault();
        
        let Option = 1;
        let Id = $('input[name=Id]').val();
        let Fecha= $('input[name=Fecha]').val();
        let Nombre =$('input[name=Nombre]').val();
        let total= $('#ValorTotal').val();
        let Productos = [];

        TablaAdds.rows().data().each(function(el, index){
            //Asumiendo que es la column(a 5 de cada fila la que quieres agregar a la sumatoria
            let articulo = new Articulos(el[0],el[3],el[4],el[5]) ;
            Productos.push(articulo);
          });

        $.ajax({
            type: "post",
            url: "../php/InsertarSalida.php",
            data: {
                Option:Option,
                Fecha:Fecha,
                Nombre:Nombre,
                total:total
            },
            dataType: "json",
            success: function (datos) {
                if (datos) {
                    let i=0;
                    while(i < Productos.length){
                        $.ajax({
                            type: "post",
                            url: "../php/InsertarSalida.php",
                            data: {
                                Option:2,
                                Id:Id,
                                Id_Articulo:Productos[i]['Id_Articulo'],
                                Cantidad : Productos[i]['Cantidad'],
                                PrecioU : Productos[i]['PrecioU'],
                                Total:Productos[i]['Total']
                            },
                            dataType: "JSON",
                            success: function (datos) {
                                if (datos) {
                                    
                                        
                                    
                                   
                                }
                            }
                        });
                        i++;
                        if (i == Productos.length) {
                            swal("Se ha Agregado correctamente!", {
                                buttons: false,
                                timer: 4000,                                
                            });
                            setTimeout(()=> {
                                window.location.href = 'AgregarSalida.php'
                            },4000)
                       }

                    }
                }
            }
        });
    
    });

    $('#Prueba').click(function(e) {
        
    });



    //----------------------------------detalles -------------------

    $(document).on("click", ".BtnDetalles", function (e) {
        e.preventDefault();
        
        $('#Mdetalles').modal('show');
        let IdSalida = $(this).val();
        let Option=2;
        $('#Mdetalles #Id_Salida').text(IdSalida);

        $.ajax({
            type: "POST",
            url: "../php/Salidas.php",
            data: {Option:Option,Id:IdSalida},
            dataType: "json",
            success: function (Datos) {
                console.log(Datos);
                
                var elementostd = $('#TblDetalles tbody tr');
                if (elementostd.length > 0) {
                    $('#TblDetalles tbody tr').remove();
                }
                let tabla = $('#TblDetalles tbody');
                let i = 0;
                while (i<Datos.length) {
                    let plantilla = `
                <tr>
					<td class='Codigos'> ${Datos[i]['Codigo'] }</td>
                    <td> ${Datos[i]['Nombre'] }</td>
                    <td>${Datos[i]['Marca'] }</td>
                    <td class='Cantidad'>${Datos[i]['Cantidad'] }</td>
                    <td>${Datos[i]['PrecioXunidad'] }</td>
                    <td>${Datos[i]['Total'] }</td>
                </tr>
                `;
                tabla.append(plantilla);
                i++;
                }
                
            }
        });
    });

    $(document).on("click", "#BtnChange", function (e) {
        e.preventDefault();
        
        $('#Mdetalles').modal('show');
        let IdSalida = $('#Mdetalles #Id_Salida').text();
        let Option=3;
        let Codigos = $('.Codigos');
        let Cantidad = $('.Cantidad');
        $.ajax({
            type: "POST",
            url: "../php/Salidas.php",
            data: {Option:Option,Id:IdSalida},
            dataType: "json",
            success: function (Datos) {
                if (Datos) {
                    let i=0;
                    while ( i < Codigos.length) {
                        $.ajax({
                            type: "post",
                            url: "../php/ChangeState.php",
                            data: {
                                Option :2,
                                Id:IdSalida,
                                Codigo:Codigos[i].innerHTML,
                                Cantidad:Cantidad[i].innerHTML
                            },
                            dataType: "JSON",
                            success: function (Datos) {
                                
                            }
                        });
                        i++
                        if (i== Codigos.length) {
                            swal("Se ha Modificado Correctamente!", {
                                buttons: false,
                                timer: 3000,                                
                            });
                            setTimeout(()=> {
                                window.location.href = 'RevisarSalidas.php'
                            },3000)
                        }

                    }
                }
                
                
            }
        });
       
    });
});