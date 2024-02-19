
var usu_id = $('#usu_idx').val();

function init(){
    $("#posgrado_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#posgrado_form")[0]);
    $.ajax({
        url: "../../controller/programaEstudio.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){

            $('#posgrado_data').DataTable().ajax.reload();
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

     $('#fac_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });
    combo_facultad(); 

    $('#posgrado_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controller/programaEstudio.php?op=listar",
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

function editar(posg_id){
    $.post("../../controller/programaEstudio.php?op=mostrar",{posg_id : posg_id}, function (data) {
        data = JSON.parse(data);
        $('#posg_id').val(data.posg_id);
        $('#posg_nom').val(data.posg_nom);
        $('#fac_id').val(data.fac_id);
        $('#tipo').val(data.tipo);
        $('#mencion').val(data.mencion);


    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(posg_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/programaEstudio.php?op=eliminar",{posg_id : posg_id}, function (data) {
                $('#posgrado_data').DataTable().ajax.reload();

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

function nuevo(){
    $('#posg_id').val('');
    $('#lbltitulo').html('Nuevo Registro');
    $('#posgrado_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalplantilla').modal('show');
});

var ExcelToJSON = function () {
    // Mantén un conjunto para almacenar los posg_nom ya procesados
    var processedPosg = new Set();

    this.parseExcel = function (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });

            workbook.SheetNames.forEach(function (sheetName) {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                PosgList = JSON.parse(json_object);

                console.log(PosgList);

                for (var i = 0; i < PosgList.length; i++) {
                    var columns = Object.values(PosgList[i]);
                    var posg_nom = columns[2];

                    // Verificar si el posg_nom ya ha sido procesado
                    if (!processedPosg.has(posg_nom)) {
                        // Agregar posg_nom al conjunto para evitar duplicados
                        processedPosg.add(posg_nom);

                        // Realizar la verificación en el servidor antes de la inserción
                        $.ajax({
                            url: "../../controller/programaEstudio.php?op=verificar_posg_nom",
                            method: "POST",
                            data: {
                                posg_nom: posg_nom
                            },
                            success: function (response) {
                                if (response === "no_existe") {
                                    // El posg_nom no existe en la base de datos, realizar la inserción
                                    $.post("../../controller/programaEstudio.php?op=guardar_desde_excel", {
                                        fac_id: columns[0],
                                        tipo: columns[2],
                                        mencion: columns[3],
                                        posg_nom: posg_nom
                                    }, function (data) {
                                        console.log(data);
                                    });
                                } else {
                                    // posg_nom duplicado en la base de datos
                                    console.log("posg_nom duplicado en la base de datos: " + posg_nom);
                                    showErrorAlert("El dni "+posg_nom+" ya existe en la base de datos.");
                                }
                            }
                        });
                    } else {
                        // posg_nom duplicado en el conjunto procesado
                        console.log("posg_nom duplicado en el conjunto procesado: " + posg_nom);
                        showErrorAlert("El dni "+posg_nom +" está duplicado en el conjunto procesado.");
                    }
                }

                document.getElementById("upload").value = null;

                $('#usuario_data').DataTable().ajax.reload();
                $('#modalplantilla').modal('hide');
            });
        };

        reader.onerror = function (ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };

 
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }
};
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);

function combo_facultad(){
    $.post("../../controller/facultad.php?op=combo", function (data) {
        $('#fac_id').html(data);
    });
}

init();
