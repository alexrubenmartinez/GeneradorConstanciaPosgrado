<?php
  /* Llamamos al archivo de conexion.php */
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php require_once("../html/MainHead.php"); ?>

    <title>Posgrado UNSCH::MntProgramaEstudios</title>
  </head>

  <body>

    <?php require_once("../html/MainMenu.php"); ?>

    <?php require_once("../html/MainHeader.php"); ?>

    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Programa de Estudios</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Programa de Estudios</h4>
        <p class="mg-b-0">Mantenimiento</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Programa de Estudios</h6>
            <p class="mg-b-30 tx-gray-600">Listado de Programas de Estudios</p>

            <button class="btn btn-outline-primary" id="add_button" onclick="nuevo()"><i class="fa fa-plus-square mg-r-10"></i> Nuevo Registro</button>


            <p></p>

            <div class="table-wrapper"></div>
                <table id="posgrado_data" class="table display responsive nowrap">
                <thead>
                    <tr>
                    <th class="wd-15p">Facultad</th>
                    <th class="wd-15p">Denominacion</th>
                    <th class="wd-15p">Tipo</th>
                    <th class="wd-15p">Mencion</th>
                    <th class="wd-10p">Editar</th>
                    <th class="wd-10p">Eliminar</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                </table>
            </div>

        </div>
      </div>
    </div>

    <?php require_once("modalmantenimiento.php"); ?>
    <?php require_once("modalplantilla.php"); ?>

    <?php require_once("../html/MainJs.php"); ?>
    <script type="text/javascript" src="admindetalleprogramaestudio.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
  </body>
</html>
<?php
  }else{

    header("Location:".Conectar::ruta()."view/404/");
  }
?>