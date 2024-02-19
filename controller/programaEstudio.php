<?php
    
    require_once("../config/conexion.php");
    
    require_once("../models/ProgramaEstudio.php");
    
    $programaEstudio = new ProgramaEstudio();

    
    switch($_GET["op"]){

        
        case "listar_documentos":
            $datos=$usuario->get_documentos_x_usuario($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["doc_nom"];
                $sub_array[] = $row["doc_fechini"];
                $sub_array[] = $row["doc_fechfin"];
                $sub_array[] = $row["enca_nom"]." ".$row["enca_apep"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["docd_id"].');"  id="'.$row["docd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        
        case "listar_documentos_top10":
            $datos=$usuario->get_documentos_x_usuario_top10($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["doc_nom"];
                $sub_array[] = $row["doc_fechini"];
                $sub_array[] = $row["doc_fechfin"];
                $sub_array[] = $row["enca_nom"]." ".$row["enca_apep"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["docd_id"].');"  id="'.$row["docd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        
        case "mostrar_documento_detalle":
            $datos = $usuario->get_documento_x_id_detalle($_POST["docd_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["docd_id"] = $row["docd_id"];
                    $output["doc_id"] = $row["doc_id"];
                    $output["doc_nom"] = $row["doc_nom"];
                    $output["doc_descrip"] = $row["doc_descrip"];
                    $output["doc_fechini"] = $row["doc_fechini"];
                    $output["doc_fechfin"] = $row["doc_fechfin"];
                    $output["doc_img"] = $row["doc_img"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["enca_id"] = $row["enca_id"];
                    $output["enca_nom"] = $row["enca_nom"];
                    $output["enca_apep"] = $row["enca_apep"];
                    $output["enca_apem"] = $row["enca_apem"];
                }

                echo json_encode($output);
            }
            break;
        
        case "total":
            $datos=$usuario->get_total_documentos_x_usuario($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        
        case "mostrar":
            $datos = $programaEstudio->get_posgrado_x_id($_POST["posg_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["posg_id"] = $row["posg_id"];
                    $output["fac_id"] = $row["fac_id"];
                    $output["posg_nom"] = $row["posg_nom"];
                    $output["tipo"] = $row["tipo"];
                    $output["mencion"] = $row["mencion"];
                }
                echo json_encode($output);
            }
            break;
        

        case "guardaryeditar":
            if(empty($_POST["posg_id"])){
                $programaEstudio->insert_programaEstudio($_POST["fac_id"],$_POST["posg_nom"],$_POST["tipo"],$_POST["mencion"]);
            }else{
                $programaEstudio->insert_programaEstudio($_POST["posg_id"],$_POST["fac_id"],$_POST["posg_nom"],$_POST["tipo"],$_POST["mencion"]);
            }
            break;
        
        case "eliminar":
            $programaEstudio->delete_programaEstudio($_POST["posg_id"]);
            break;
        
        case "listar":
                $datos=$programaEstudio->get_programa_estudio();
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["fac_nom"];
                    $sub_array[] = $row["posg_nom"];
                    $sub_array[] = $row["tipo"];
                    $sub_array[] = $row["mencion"];

                    $sub_array[] = '<button type="button" onClick="editar('.$row["posg_id"].');"  id="'.$row["posg_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["posg_id"].');"  id="'.$row["posg_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                    $data[] = $sub_array;
                }

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
        

        case "total_documentos":
            $totalDocumentos=$usuario->get_documentos_totales();
            $output["total"] = $totalDocumentos;
            echo json_encode($output);
            break;  
        case "get_documentos_totales_admin_top10":
            $datos=$usuario->get_documentos_totales_admin_top10();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["doc_nom"];
                $sub_array[] = $row["usu_nom"]." ".$row["usu_apep"]." ".$row["usu_apem"];
                $sub_array[] = $row["doc_fechini"];
                $sub_array[] = $row["doc_fechfin"];
                $sub_array[] = $row["enca_nom"];
                $sub_array[] = $row["fech_crea"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["docd_id"].');"  id="'.$row["docd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["docd_id"].');"  id="'.$row["docd_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
            $datos=$programaEstudio->get_programa_estudio();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['posg_id']."'>".$row['posg_nom']."</option>";
                }
                echo $html;
            }
            break;

        case "guardar_desde_excel":
            $programaEstudio->insertProgramaEstudioDesdeExcel($_POST["fac_id"], $_POST["posg_nom"], $_POST["tipo"],isset($_POST["mencion"]) ? $_POST["mencion"] : null);
           
            break;
 
        case "verificar_posg_nom":
            $posg_nom = $_POST["posg_nom"];
        
            
            $existeFacu = $programaEstudio->verificarProgramaEstudioExistente($posg_nom);
        
            
            echo $existeFacu ? "existe" : "no_existe";
            break; 
    }
?>