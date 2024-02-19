<!DOCTYPE html>
<html lang="es" class="pos-relative">
<head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Constancia</title>
    <style>
        .custom-btn {
            width: 250px; /* Ajusta el ancho según tus necesidades */
            background-color: #E64A19; /* Ajusta el color de fondo de los botones */
            color: white; /* Ajusta el color del texto de los botones */
            border-color:white;
        }

        .resaltante-text {
            font-size: 18px; /* Ajusta el tamaño del texto según tus necesidades */
            font-weight: bold;
            color: white; /* Ajusta el color del texto resaltante */
        }

        #canvas-container {
            background-color: #B63D23; /* Ajusta el color de fondo del contenedor según tus preferencias */
        }
    </style>
</head>

<body class="pos-relative">

    
    <div id="canvas-container" class="ht-100v d-flex align-items-center justify-content-center">

        
        <div class="wd-lg-70p wd-xl-50p tx-center pd-x-40 d-flex justify-content-between">
            <div>
                <h1 class="tx-100 tx-xs-140 tx-normal tx-inverse tx-roboto mg-b-0">
                    <canvas id="canvas" height="842px" width="595px" class="img-fluid" alt="Responsive image"></canvas>
                </h1>

            </div>
            
            <div class="d-flex flex-column align-items-end align-self-center">
                <p class="resaltante-text tx-16 mg-b-30 text-justify-right">
                    DESCARGAR:
                </p>
                <button class="btn btn-outline-info custom-btn mb-2" id="btnpng"><i class="fa fa-send mg-r-10"></i> IMAGEN EN FORMATO PNG</button>
                <button class="btn btn-outline-success custom-btn" id="btnpdf"><i class="fa fa-send mg-r-10"></i> DOCUMENTO EN FORMATO PDF</button>
            </div>
        </div>

    </div>

    <?php require_once("../html/MainJs.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script type="text/javascript" src="certificado.js"></script>
</body>
</html>
