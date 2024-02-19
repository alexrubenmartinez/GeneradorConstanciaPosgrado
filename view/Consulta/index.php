<!DOCTYPE html>
<html lang="es" class="pos-relative">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Consulta Constancias::Posgrado UNSCH</title>
    
    <style>
        #custom-body {
            background-color: #B63D23;
            color: white;
            font-family: 'Arial', sans-serif; /* Cambia la fuente según tus preferencias */
        }

        .tx-roboto {
            font-family: 'Roboto', sans-serif; /* Puedes cambiar a la fuente Roboto si está disponible en tu proyecto */
        }

        .tx-inverse {
            color: #ffffff; /* Asegúrate de que el texto sea claro para un fondo oscuro */
        }

        .btn-info {
            background-color: #E64A19; /* Ajusta el color de fondo del botón de búsqueda */
            color: white;
        }

        /* Ajusta el tamaño y color del texto según tus preferencias */
        h2, h5, p, h6 {
            color: white;
            margin-bottom: 10px; /* Añade espaciado entre los elementos de texto */
        }
        #documentos_data td {
            color: black; /* Cambia el color del texto de las celdas de la tabla a negro */
        }
    </style>

    <link href="../../public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <link href="../../public/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="../../public/css/bracket.css">
  </head>

  <body id="custom-body" class="pos-relative">

    <div class="ht-100v d-flex align-items-center justify-content-center">
      <div class="wd-lg-70p wd-xl-50p tx-center pd-x-40">
        <h2 class="tx-50 tx-xs-40 tx-normal tx-normal  tx-roboto mg-b-0">Consulta Constancias Posgrado - UNSCH</h2>
        <br>
        <h5 class="tx-xs-24 tx-normal tx-normal mg-b-30 lh-5">Ingrese DNI para Validar Constancias</h5>

        <div class="d-flex justify-content-center">
          <div class="input-group wd-xs-300">
            <input type="text" id="usu_dni" name="usu_dni" class="form-control" placeholder="DNI...">
            <div class="input-group-btn">
              <button class="btn btn-info" id="btnconsultar"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>

        <div class="row row-sm mg-t-20" id="divpanel">
          <div class="col-12">
            <div class="card pd-0 bd-0 shadow-base">
              <div class="pd-x-30 pd-t-30 pd-b-15">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1" id="lbldatos">Listado de Documentos</h6>
                    <p class="tx-inverse mg-b-0">Aqui podra visualizar los Certificados</p>
                  </div>
                </div>
              </div>
              <div class="pd-x-15 pd-b-15">
                <div class="table-wrapper">
                  <table id="documentos_data" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-15p">Documento</th>
                        <th class="wd-15p">Fecha Emisión</th>
                        <th class="wd-10p">Visualizar</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <script src="../../public/lib/jquery/jquery.js"></script>
    <script src="../../public/lib/popper.js/popper.js"></script>
    <script src="../../public/lib/bootstrap/bootstrap.js"></script>

    <script src="../../public/lib/datatables/jquery.dataTables.js"></script>
    <script src="../../public/lib/datatables-responsive/dataTables.responsive.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="consulta.js"></script>
  </body>
</html>
