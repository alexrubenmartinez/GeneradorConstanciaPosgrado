<?php
    
    require_once("../config/conexion.php");
    
    require_once("../models/Usuario.php");
    
    $usuario = new Usuario();

    
    switch($_GET["op"]){

        
        case "listar_documentos":
            $datos=$usuario->get_documentos_x_usuario($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["doc_nom"];
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

        case "listar_documentos_externo":
            $datos=$usuario->get_documentos_x_usuario_ext($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["doc_nom"];
                $sub_array[] = $row["fech_crea"];
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
                $sub_array[] = $row["doc_nom"];;
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
                    $output["doc_img"] = $row["doc_img"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_dni"] = $row["usu_dni"];
                    $output["usu_cod_estudiante"] = $row["usu_cod_estudiante"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["enca_id"] = $row["enca_id"];
                    $output["enca_nom"] = $row["enca_nom"];
                    $output["enca_apep"] = $row["enca_apep"];
                    $output["enca_apem"] = $row["enca_apem"];
                    $output["posg_nom"] = $row["posg_nom"];
                    $output["fac_nom"] = $row["fac_nom"];
                    $output["num_boleta"] = $row["num_boleta"];
                    $output["unidad_perteneciente"] = $row["unidad_perteneciente"];
                    $output["iniciales_encargado"] = $row["iniciales_encargado"];
                    $output["doc_num"] = $row["doc_num"];
                    $output["usu_sem_id_ingreso"] = $row["usu_sem_id_ingreso"];
                    $output["sem_nom_ingreso"] = $row["sem_nom_ingreso"];
                    $output["sem_fech_inicio_ingreso"] = $row["sem_fech_inicio_ingreso"];
                    $output["sem_fech_fin_ingreso"] = $row["sem_fech_fin_ingreso"];
                    $output["usu_sem_id_actual"] = $row["usu_sem_id_actual"];
                    $output["sem_nom_actual"] = $row["sem_nom_actual"];
                    $output["sem_fech_inicio_actual"] = $row["sem_fech_inicio_actual"];
                    $output["sem_fech_fin_actual"] = $row["sem_fech_fin_actual"];
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
            $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
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

                    $output["usu_cod_estudiante"] = $row["usu_cod_estudiante"];
                    $output["posg_id"] = $row["posg_id"];
                    $output["usu_deuda"] = $row["usu_deuda"];
                    $output["usu_sem_id_actual"] = $row["usu_sem_id_actual"];
                    $output["usu_sem_id_ingreso"] = $row["usu_sem_id_ingreso"];
                    $output["ciclo_actual"] = $row["ciclo_actual"];
                }
                echo json_encode($output);
            }
            break;
        
        case "consulta_dni":
            $datos = $usuario->get_usuario_x_dni($_POST["usu_dni"]);
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
            $usuario->update_usuario_perfil(
                $_POST["usu_id"],
                $_POST["usu_nom"],
                $_POST["usu_apep"],
                $_POST["usu_apem"],
                $_POST["usu_pass"],
                $_POST["usu_sex"],
                $_POST["usu_telf"],
                $_POST["usu_correo"]
            );
            break;
        
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_sex"],$_POST["usu_telf"],$_POST["rol_id"],$_POST["usu_dni"]);
            }else{
                $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_apep"],$_POST["usu_apem"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_sex"],$_POST["usu_telf"],$_POST["usu_dni"],$_POST["usu_cod_estudiante"],$_POST["posg_id"],$_POST["usu_deuda"],$_POST["usu_sem_id_actual"],$_POST["usu_sem_id_ingreso"],$_POST["ciclo_actual"]);
            }
            break;
        
        case "eliminar":
            $usuario->delete_usuario($_POST["usu_id"]);
            break;
        
        case "listar":
                $datos=$usuario->get_usuario();
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["usu_nom"];
                    $sub_array[] = $row["usu_apep"];
                    $sub_array[] = $row["usu_apem"];
                    $sub_array[] = $row["usu_dni"];

                    $sub_array[] = '<button type="button" onClick="editar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                    $data[] = $sub_array;
                }

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
        
        case "listar_documentos_usuario":
            $datos=$usuario->get_documentos_usuario_x_id($_POST["doc_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["doc_nom"];
                $sub_array[] = $row["usu_nom"]." ".$row["usu_apep"]." ".$row["usu_apem"];
                $sub_array[] = $row["enca_nom"]." ".$row["enca_apep"];
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

        case "listar_detalle_usuario":
            $datos=$usuario->get_usuario_modal($_POST["doc_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "<input type='radio' name='detallecheck[]' value='". $row["usu_id"] ."'>";
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
            $usuario->insert_usuario_xls($_POST["usu_nom"], $_POST["usu_apep"], $_POST["usu_apem"], $_POST["usu_correo"], $_POST["usu_pass"], $_POST["usu_sex"], $_POST["usu_telf"], $_POST["rol_id"], $_POST["usu_dni"], $_POST["usu_cod_estudiante"],$_POST["usu_deuda"]);
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
        case "verificar_dni":
            $usu_dni = $_POST["usu_dni"];
            $existeDNI = $usuario->verificarDNIExistente($usu_dni);
            echo $existeDNI ? "existe" : "no_existe";
            break;
            
        case "mostrar_documento_detalle_tesis":
            $datos = $usuario->get_documento_x_id_detalle_tesis($_POST["docd_id"]);
            $outputArray = array();  
        
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output = array();  
        
                    $output["docd_id"] = $row["docd_id"];
                    $output["doc_id"] = $row["doc_id"];
                    $output["doc_nom"] = $row["doc_nom"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_dni"] = $row["usu_dni"];
                    $output["usu_cod_estudiante"] = $row["usu_cod_estudiante"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["posg_id"] = $row["posg_id"];
                    $output["usu_sem_id_ingreso"] = $row["usu_sem_id_ingreso"];
                    $output["sem_nom_ingreso"] = $row["sem_nom_ingreso"];
                    $output["sem_fech_inicio_ingreso"] = $row["sem_fech_inicio_ingreso"];
                    $output["sem_fech_fin_ingreso"] = $row["sem_fech_fin_ingreso"];
                    $output["doc_img"] = $row["doc_img"];
                    $output["enca_id"] = $row["enca_id"];
                    $output["posg_nom"] = $row["posg_nom"];
                    $output["sem_nom_actual"] = $row["sem_nom_actual"];
                    $output["sem_fech_inicio_actual"] = $row["sem_fech_inicio_actual"];
                    $output["sem_fech_fin_actual"] = $row["sem_fech_fin_actual"];
                    $output["doc_num"] = $row["doc_num"];
                    $output["num_boleta"] = $row["num_boleta"];
                    $output["iniciales_encargado"] = $row["iniciales_encargado"];
                    $output["curso_nom"] = $row["curso_nom"];
                    $output["cur_sigla"] = $row["cur_sigla"];
                    $output["nota_maxima"] = $row["nota_maxima"];
                    $output["cur_fecha"] = $row["cur_fecha"];
                    

                    $outputArray[] = $output;
                }

                echo json_encode($outputArray);
            }
            break;

        case 'guardar_desde_excel_2':

                $resultado = $usuario->guardarDesdeExcel($_POST);

                echo $resultado;
                
            
            break;

        
        
        } 
        




?>