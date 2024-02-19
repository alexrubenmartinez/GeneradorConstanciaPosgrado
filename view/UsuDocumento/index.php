<?php
  /* Llamamos al archivo de conexion.php */
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Posgrado UNSCH::Documento</title>
  </head>

  <body>

    <?php require_once("../html/MainMenu.php"); ?>
    <?php require_once("../html/MainHeader.php"); ?>

    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Mis Documentos</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Mis Documentos</h4>
        <p class="mg-b-0">Listado de Documentos</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Listado de mis Documentos</h6>
          <p class="mg-b-25 mg-lg-b-50">Desde aqui podra buscar sus documentos por certificado.</p>

          <div class="table-wrapper">
            <table id="documentos_data" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Documento</th>
                  <th class="wd-15p">Fecha Inicio</th>
                  <th class="wd-20p">Fecha Fin</th>
                  <th class="wd-15p">Encargado</th>
                  <th class="wd-10p"></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <?php require_once("../html/MainJs.php");?>
    <script type="text/javascript" src="usudocumento.js"></script>
  </body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
    header("Location:".Conectar::ruta()."view/404/");
  }
?>