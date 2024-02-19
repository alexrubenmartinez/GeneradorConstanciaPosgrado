<?php
   
    require_once("../config/conexion.php");
    
    require_once("../models/Documento.php");
  
    $documento = new Documento();

   
    switch($_GET["op"]){
       
        case "guardaryeditar":
            if(empty($_POST["doc_id"])){
                $documento->insert_documento($_POST["cat_id"],$_POST["doc_nom"],$_POST["doc_descrip"],$_POST["enca_id"]);
            }else{
                $documento->update_documento($_POST["doc_id"],$_POST["cat_id"],$_POST["doc_nom"],$_POST["doc_descrip"],$_POST["enca_id"]);
            }
            break;

        case "mostrar":
            $datos = $documento->get_documento_id($_POST["doc_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["doc_id"] = $row["doc_id"];
                    $output["cat_id"] = $row["cat_id"];
                    $output["doc_nom"] = $row["doc_nom"];
                    $output["doc_descrip"] = $row["doc_descrip"];
                    $output["enca_id"] = $row["enca_id"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $documento->delete_documento($_POST["doc_id"]);
            break;

        case "listar":
            $datos=$documento->get_documento();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = '<a href="'.$row["doc_img"].'" target="_blank">'.strtoupper($row["doc_nom"]).'</a>';
                $sub_array[] = '<button type="button" onClick="editar('.$row["doc_id"].');"  id="'.$row["doc_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["doc_id"].');"  id="'.$row["doc_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $sub_array[] = '<button type="button" onClick="imagen('.$row["doc_id"].');"  id="'.$row["doc_id"].'" class="btn btn-outline-success btn-icon"><div><i class="fa fa-file"></i></div></button>';                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "combo":
            $datos=$documento->get_documento();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['doc_id']."'>".$row['doc_nom']."</option>";
                }
                echo $html;
            }
            break;

        case "eliminar_documento_usuario":
            $documento->delete_documento_usuario($_POST["docd_id"]);
            break;

        case "insert_documento_usuario":
            $resultado = $documento->insert_documento_usuario($_POST["doc_id"], $_POST["usu_id"], $_POST["enca_id"], $_POST["num_boleta"], $_POST["unidad_perteneciente"]);
            $data = array("docd_id" => $resultado["docd_id"], "doc_num" => $resultado["doc_num"]);
            echo json_encode(array($data));
            break;

        case "generar_qr":
            require 'phpqrcode/qrlib.php';
            header('Content-Type: application/json');
            
            if (isset($_POST["docd_id"]) && !empty($_POST["docd_id"])) {
                $docd_id = $_POST["docd_id"];
                
                $url = conectar::ruta()."view/Certificado/index.php?docd_id=".$docd_id;

                
                $docd_id_str = is_array($docd_id) ? json_encode($docd_id) : strval($docd_id);

                
                QRcode::png($url, "../public/qr/".$docd_id_str.".png", 'L', 32, 5);

                
                echo json_encode(array("success" => true, "message" => "QR generado con éxito"));
            } else {
                
                echo json_encode(array("success" => false, "message" => "Error: No se recibió el docd_id"));
            }
        break;


        case "update_imagen_documento":
            $documento->update_imagen_documento($_POST["curx_idx"],$_POST["doc_img"]);
            break;
        
        case "contar_documento":
            $totalDocumentos=$documento->get_documentos_totales_x_categoria($_POST["doc_id"]);
            $output["total"] = $totalDocumentos;
            echo json_encode($output);
            break;  

    }
?>