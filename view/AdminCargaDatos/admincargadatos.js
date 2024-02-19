
var usu_id = $('#usu_idx').val();

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){

            $('#usuario_data').DataTable().ajax.reload();
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
    $('#usu_sex').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#rol_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

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
            url:"../../controller/usuario.php?op=listar",
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

function editar(usu_id){
    $.post("../../controller/usuario.php?op=mostrar",{usu_id : usu_id}, function (data) {
        console.log(data);
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_sex').val(data.usu_sex).trigger('change');
        $('#rol_id').val(data.rol_id).trigger('change');
        $('#usu_telf').val(data.usu_telf);
        $('#usu_dni').val(data.usu_dni);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(usu_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/usuario.php?op=eliminar",{usu_id : usu_id}, function (data) {
                $('#usuario_data').DataTable().ajax.reload();

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
    $('#usu_id').val('');
    $('#usu_sex').val('').trigger('change');
    $('#rol_id').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalplantilla').modal('show');
});

var ExcelToJSON = function () {
    this.parseExcel = function (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });

            workbook.SheetNames.forEach(function (sheetName) {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);

                XL_row_object = XL_row_object.map(function (row) {
                    return {
                        'fac_nom': row['fac_nom'] || '',
                        'DENOMINACIÓN MAESTRÍA': row['DENOMINACIÓN MAESTRÍA'] || '',
                        'mencion': row['mencion'] !== undefined ? row['mencion'] : '',
                        'NOMBRES': row['NOMBRES'] || '',
                        'APELLIDO PATERNO': row['APELLIDO PATERNO'] || '',
                        'APELLIDO MATERNO': row['APELLIDO MATERNO'] || '',
                        'CODIGO DE ESTUDIANTE': row['CODIGO DE ESTUDIANTE'] || '',
                        '¿DEUDA?': row['¿DEUDA?'] || '',
                        'DNI': row['DNI'] || '',
                        'SEMESTRE': row['SEMESTRE'] || '',
                        'FECHA INICIO SEMESTRE': row['FECHA INICIO SEMESTRE'] || '',
                        'FECHA FIN SEMESTRE': row['FECHA FIN SEMESTRE'] || '',
                        'CURSO': row['CURSO'] || '',
                        'SIGLA': row['SIGLA'] || '',
                        'NOTA': row['NOTA'] || ''
                    };
                });

                var totalRecords = 0;
                var errorRecords = 0;
                var showErrorAlert = true;

                var requests = [];

                for (var i = 0; i < XL_row_object.length; i++) {
                    var columns = Object.values(XL_row_object[i]);

                    requests.push($.post("../../controller/usuario.php?op=guardar_desde_excel_2", {
                        fac_nom: columns[0],
                        posg_nom: columns[1],
                        mencion: columns[2],
                        usu_nom: columns[3],
                        usu_apep: columns[4],
                        usu_apem: columns[5],
                        usu_cod_estudiante: columns[6],
                        usu_deuda: columns[7],
                        usu_dni: columns[8],
                        sem_nom: columns[9],
                        sem_fech_inicio: columns[10],
                        sem_fech_fin: columns[11],
                        curso_nom: columns[12],
                        cur_sigla: columns[13],
                        nota: columns[14]
                    }));
                }

                Promise.all(requests).then(function (responses) {
                    for (var i = 0; i < responses.length; i++) {
                        var data = responses[i];

                        if (data.includes('Datos insertados correctamente')) {
                            totalRecords++;
                        } else if (data.includes('El usuario ya tiene registrado el mismo curso con la misma nota')) {
                            errorRecords++;
                        } else {
                            // Mostrar SweetAlert de error solo una vez
                            if (showErrorAlert) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error en la carga de datos: Formato incorrecto',
                                });
                                showErrorAlert = false; // Evitar mostrar más SweetAlerts de error
                            }
                        }
                    }

                    // Mostrar SweetAlert después de revisar todas las respuestas
                    Swal.fire({
                        icon: errorRecords > 0 ? 'info' : 'success',
                        title: errorRecords > 0 ? 'Información de carga de datos' : 'Éxito',
                        html: errorRecords > 0
                            ? 'Total de registros cargados: ' + totalRecords + '<br>Registros repetidos: ' + errorRecords
                            : 'Total de registros cargados: ' + totalRecords,
                    });

                    // Resto del código (recargar DataTable, cerrar modal, etc.)
                    document.getElementById("upload").value = null;
                    $('#usuario_data').DataTable().ajax.reload();
                    $('#modalplantilla').modal('hide');
                });
            });
        };

        reader.onerror = function (ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};



function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);


init();
