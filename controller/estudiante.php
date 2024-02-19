<?php
    
    require_once("../config/conexion.php");
    
    require_once("../models/Estudiante.php");
    
    $estudiante = new Estudiante();

    
    switch($_GET["op"]){

        
        case "listar_documentos":
            $datos=$estudiante->get_documentos_x_estudiante($_POST["usu_id"]);
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
            $datos=$estudiante->get_documentos_x_estudiante_top10($_POST["usu_id"]);
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
            $datos = $estudiante->get_documento_x_id_detalle($_POST["docd_id"]);
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
            $datos=$estudiante->get_total_documentos_x_estudiante($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        
        case "mostrar":
            $datos = $estudiante->get_estudiante_x_id($_POST["est_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["est_id"] = $row["est_id"];
                    $output["cod_estudiante"] = $row["cod_estudiante"];
                    $output["dni"] = $row["dni"];
                    $output["posg_id"] = $row["posg_id"];
                    $output["deuda"] = $row["deuda"];
                    $output["sem_id_actual"] = $row["sem_id_actual"];
                    $output["aprob_tesis_i"] = $row["aprob_tesis_i"];
                    $output["aprob_tesis_ii"] = $row["aprob_tesis_ii"];

                }
                echo json_encode($output);
            }
            break;
        
        case "consulta_dni":
            $datos = $estudiante->get_estudiante_x_dni($_POST["usu_dni"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_sex"] = $row["usu_sex"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["usu_telf"] = $row["usu_telf"];
                    $output["rol_id"] = $row["rol_id"];
                    $output["usu_dni"] = $row["usu_dni"];
                }
                echo json_encode($output);
            }
            break;
        
        case "update_perfil":
            $estudiante->update_estudiante_perfil(
                $_POST["usu_id"],
                $_POST["usu_nom"],
                $_POST["usu_apep"],
                $_POST["usu_apem"],
                $_POST["usu_pass"],
                $_POST["usu_sex"],
                $_POST["usu_telf"]
            );
            break;
        
        case "guardaryeditar":
            if(empty($_POST["est_id"])){
                $estudiante->insert_estudiante($_POST["cod_estudiante"],$_POST["dni"],$_POST["posg_id"],$_POST["deuda"],$_POST["sem_id_actual"],$_POST["aprob_tesis_i"],$_POST["aprob_tesis_ii"]);
            }else{
                $estudiante->update_estudiante($_POST["est_id"],$_POST["cod_estudiante"],$_POST["dni"],$_POST["posg_id"],$_POST["deuda"],$_POST["sem_id_actual"],$_POST["aprob_tesis_i"],$_POST["aprob_tesis_ii"]);
            }
            break;
        
        case "eliminar":
            $estudiante->delete_estudiante($_POST["est_id"]);
            break;
        
        case "listar":
                $datos=$estudiante->get_estudiante();
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["est_id"];
                    $sub_array[] = $row["cod_estudiante"];
                    $sub_array[] = $row["dni"];
                    $sub_array[] = $row["posg_nom"];
                    if ($row["deuda"]==1) {
                        $sub_array[] = "Deuda Activa";
                    }else{
                        $sub_array[] = "No Adeuda";
                    }
                    $sub_array[] = $row["sem_nom"];
                    
                    if ($row["aprob_tesis_i"]==1) {
                        $sub_array[] = "Aprobado";
                    }else{
                        $sub_array[] = "Desaprobado";
                    }

                    if ($row["aprob_tesis_ii"]==1) {
                        $sub_array[] = "Aprobado";
                    }else{
                        $sub_array[] = "Desaprobado";
                    }

                    $sub_array[] = '<button type="button" onClick="editar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["est_id"].');"  id="'.$row["est_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                    $data[] = $sub_array;
                }

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
            break;
        
        case "listar_documentos_estudiante":
            $datos=$estudiante->get_documentos_estudiante_x_id($_POST["doc_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["doc_nom"];
                $sub_array[] = $row["usu_nom"]." ".$row["usu_apep"]." ".$row["usu_apem"];
                $sub_array[] = $row["doc_fechini"];
                $sub_array[] = $row["doc_fechfin"];
                $sub_array[] = $row["enca_nom"]." ".$row["enca_apep"];
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

        case "listar_detalle_estudiante":
            $datos=$estudiante->get_estudiante_modal($_POST["doc_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "<input type='checkbox' name='detallecheck[]' value='". $row["usu_id"] ."'>";
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_apep"];
                $sub_array[] = $row["usu_apem"];
                $sub_array[] = $row["usu_correo"];
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "guardar_desde_excel":
            $estudiante->insert_estudiante($_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_sex"],$_POST["usu_telf"],$_POST["rol_id"],$_POST["usu_dni"]);
            break;

        case "total_documentos":
            $totalDocumentos=$estudiante->get_documentos_totales();
            $output["total"] = $totalDocumentos;
            echo json_encode($output);
            break;  
        case "get_documentos_totales_admin_top10":
            $datos=$estudiante->get_documentos_totales_admin_top10();
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
    }
?>