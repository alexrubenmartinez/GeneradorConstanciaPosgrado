
var usu_id = $('#usu_idx').val();

function init(){
    $("#documentos_form").on("submit",function(e){
        guardaryeditar(e);
    });

    $("#detalle_form").on("submit",function(e){
        guardaryeditarimg(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#documentos_form")[0]);
    $.ajax({
        url: "../../controller/documento.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            $('#documentos_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){

    $('#cat_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#enca_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    combo_facultad();

    $('#documentos_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/documento.php?op=listar",
            type:"post"
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

function editar(doc_id){
    $.post("../../controller/documento.php?op=mostrar",{doc_id : doc_id}, function (data) {
        data = JSON.parse(data);
        $('#doc_id').val(data.doc_id);
        $('#cat_id').val(data.cat_id).trigger('change');
        $('#doc_nom').val(data.doc_nom);
        $('#doc_descrip').val(data.doc_descrip);
        $('#doc_fechini').val(data.doc_fechini);
        $('#doc_fechfin').val(data.doc_fechfin);
        $('#enca_id').val(data.enca_id).trigger('change');1
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(doc_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/documento.php?op=eliminar",{doc_id : doc_id}, function (data) {
                $('#documentos_data').DataTable().ajax.reload();

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

function imagen(doc_id){
    $('#curx_idx').val(doc_id);
    $('#modalfile').modal('show');
}

function nuevo(){
    $('#lbltitulo').html('Nuevo Registro');
    $('#documentos_form')[0].reset();
    combo_facultad();
    $('#modalmantenimiento').modal('show');
}

function combo_facultad(){
    $.post("../../controller/categoria.php?op=combo", function (data) {
        $('#cat_id').html(data);
    });
}


function guardaryeditarimg(e){
    e.preventDefault();
    var formData = new FormData($("#detalle_form")[0]);
    $.ajax({
        url: "../../controller/documento.php?op=update_imagen_documento",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){ 
            $('#documentos_data').DataTable().ajax.reload();
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Actualizo Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
            $("#modalfile").modal('hide');

        }
    });
}

init();
