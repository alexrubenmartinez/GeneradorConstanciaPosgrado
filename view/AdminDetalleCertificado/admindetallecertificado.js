
var usu_id = $('#usu_idx').val();

function init(){

}

$(document).ready(function(){
    $('#doc_id').select2();
    $('#enca_id').select2({
        dropdownParent: $('#modaldetalle')
    });
    combo_documento();

    combo_encargado();

    /* Obtener Id de combo documento */
    $('#doc_id').change(function() {
        $("#doc_id option:selected").each(function () {
            doc_id = $(this).val();

            /* Listado de datatable */
            $('#detalle_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax":{
                    url:"../../controller/usuario.php?op=listar_documentos_usuario",
                    type:"post",
                    data:{doc_id:doc_id},
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo":true,
                "iDisplayLength": 10,
                "order": [[ 0, "desc" ]],
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
            });

        });
    });

});

function eliminar(docd_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/documento.php?op=eliminar_documento_usuario",{docd_id : docd_id}, function (data) {
                $('#detalle_data').DataTable().ajax.reload();

                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}

function combo_documento(){
    $.post("../../controller/documento.php?op=combo", function (data) {
        $('#doc_id').html(data);
    });
}
function combo_encargado(){
    $.post("../../controller/encargado.php?op=combo", function (data) {
        $('#enca_id').html(data);
    });
}

function certificado(docd_id){
    console.log(docd_id);
    window.open('../Certificado/index.php?docd_id='+ docd_id +'','_blank');
}

function nuevo(){
    if ($('#doc_id').val()==''){
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar Documento',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    }else{
        var doc_id = $('#doc_id').val();
        listar_usuario(doc_id);
        $('#modalmantenimiento').modal('show');
    }
}

function listar_usuario(doc_id){
    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/usuario.php?op=listar_detalle_usuario",
            type:"post",
            data:{doc_id:doc_id}
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
}

function registrardetalle() {
    table = $('#usuario_data').DataTable();


    table.rows().every(function (rowIdx, tableLoop, rowLoop) {
        cell1 = table.cell({ row: rowIdx, column: 0 }).node();
        if ($('input', cell1).prop("checked") == true) {
            usu_id = $('input', cell1).val();  // Cambiado a un único valor
            console.log("Este es el id que se debe almacenar: " + usu_id);
        }
    });

    if (usu_id === null) {  // Cambiado el chequeo a null
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar un Usuario',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        console.log('Entrando a registrardetalle');
    } else {
        // Abre el modal para llenar datos de td_documento_usuario
        $('#modalmantenimiento').modal('hide');
        $('#modaldetalle').modal('show');
        console.log('Entrando a registrardetalle2');
        // También puedes hacer aquí cualquier otra lógica necesaria antes de abrir el modal
    }
}

// Lógica para cuando se hace clic en el botón "Guardar" en el segundo modal
function guardarDatosDocumento() {
    console.log('Entrando a seg'+usu_id);
    // Obtener los valores del segundo modal
    var enca_id = $('#enca_id').val();
    var num_boleta = $('#num_boleta').val();
    var unidad_perteneciente = $('#unidad_perteneciente').val(); 

    // Validar los valores si es necesario

    // Aquí puedes agregar la lógica para enviar los datos al servidor
    // Puedes utilizar AJAX para enviarlos al servidor y manejar la respuesta

    // Cerrar el segundo modal
    $('#modaldetalle').modal('hide');

    // Después de cerrar el segundo modal, puedes continuar con la lógica original para generar el documento
    // ...

    /* Creando formulario */
    const formData = new FormData($("#form_detalle")[0]);
    formData.append('doc_id', doc_id);
    formData.append('usu_id', usu_id)
    formData.append('enca_id', $('#enca_id').val());
    formData.append('num_boleta', $('#num_boleta').val());
    formData.append('unidad_perteneciente', $('#unidad_perteneciente').val());

    $.ajax({
        url: "../../controller/documento.php?op=insert_documento_usuario",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            try {

                console.log("Este es "+data.docd_id);
                // Intentar convertir la respuesta a un array de objetos JSON
                var results = JSON.parse(data);


                if (results && results.length === 1 && results[0].docd_id) {
                    var result = results[0];
                    generarQR(result.docd_id);
                } else {
                    console.error('La respuesta no contiene un único elemento válido con docd_id:', results);
                }
                if (Array.isArray(results) && results.length > 0) {
                    // Iterar sobre cada elemento del array
                    results.forEach(function (result) {
                        // Verificar si el elemento contiene docd_id
                        if (result ) {
                            console.log("Este es el docd_id "+result.docd_id);
                            var jsonResult = { "docd_id": result.docd_id };
                            mostrarMensajeExitoso(result.docd_id);
                            generarQR(jsonResult);
                        } else {
                            // Manejar el caso en que no se recibe un docd_id válido en este elemento
                            console.error('Elemento de la respuesta no contiene docd_id válido:', result);
                        }
                    });
                } else {
                    // Manejar el caso en que no se recibe un array válido
                    console.error('Respuesta del servidor no es un array válido:', results);
                }
            } catch (error) {
                // Manejar cualquier error que ocurra durante el análisis JSON
                console.error('Error al analizar JSON:', error);
                mostrarMensajeError('Error al procesar la respuesta del servidor');
            }
        }
    });
    function mostrarMensajeExitoso(docd_id) {
        Swal.fire({
            icon: 'success',
            title: 'Operación Exitosa',
            text: 'El documento se insertó correctamente.',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            confirmButtonText: 'Abrir constancia',
        }).then((result) => {
            if (result.isConfirmed) {
                base="https://posgrado-unsch.000webhostapp.com/GeneradorConstancia/";
                window.location.href = base+"view/Certificado/index.php?docd_id="+docd_id+"#loaded";
            }
        });
    }
    
    // Función para mostrar un mensaje de error
    function mostrarMensajeError(mensaje) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: mensaje,
        });
    }
    function generarQR(docd_id) {
        $.ajax({
            type: "POST",
            url: "../../controller/documento.php?op=generar_qr",
            data: { docd_id: docd_id },
            dataType: "json",
            success: function (qrData) {
                // Manejar la respuesta del servidor al generar el QR
                console.log('QR generado:', qrData);
            },
/*                 error: function (xhr, status, error) {
                    // Manejar errores en la solicitud de generar el QR
                    console.log('xhr:', xhr);
                    console.log('status:', status);
                    console.error('Error al generar el QR:', error);
                } */
        });
    }
    
    
    /* Recargar datatable de los usuarios del documento */
    $('#detalle_data').DataTable().ajax.reload();

    $('#usuario_data').DataTable().ajax.reload();


}



init();
