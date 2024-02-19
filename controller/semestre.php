<?php
    
    require_once("../config/conexion.php");
    
    require_once("../models/Semestre.php");
    
    $semestre = new Semestre();

    
    switch($_GET["op"]){
        
        case "guardaryeditar":
            if(empty($_POST["sem_id"])){
                $semestre->insert_semestre($_POST["sem_nom"],$_POST["sem_fech_inicio"],$_POST["sem_fech_fin"]);
            }else{
                $semestre->update_semestre($_POST["sem_id"],$_POST["sem_nom"],$_POST["sem_fech_inicio"],$_POST["sem_fech_fin"]);
            }
            break;
        
        case "mostrar":
            $datos = $semestre->get_semestre_id($_POST["sem_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["sem_id"] = $row["sem_id"];
                    $output["sem_nom"] = $row["sem_nom"];
                    $output["sem_fech_inicio"] = $row["sem_fech_inicio"];
                    $output["sem_fech_fin"] = $row["sem_fech_fin"];
                }
                echo json_encode($output);
            }
            break;
        
        case "eliminar":
            $semestre->delete_semestre($_POST["sem_id"]);
            break;
        
        case "listar":
            $datos=$semestre->get_semestre();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["sem_nom"];
                $sub_array[] = $row["sem_fech_inicio"];
                $sub_array[] = $row["sem_fech_fin"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["sem_id"].');"  id="'.$row["sem_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["sem_id"].');"  id="'.$row["sem_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
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
            $datos=$semestre->get_semestre();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['sem_id']."'>".$row['sem_nom']."</option>";
                }
                echo $html;
            }
            break;

        case "guardar_desde_excel":
            $sem_nom = $_POST["sem_nom"];
            $sem_fech_inicio = $_POST["sem_fech_inicio"];
            $sem_fech_fin = $_POST["sem_fech_fin"];
            
            
            if (!$semestre->verificarSemestreExistente($sem_nom)) {
                
                $semestre->insertSemestreDesdeExcel($sem_nom,$sem_fech_inicio,$sem_fech_fin);
                echo "exito";
            } else {
                
                echo "error_semestre_existente";
            }
            break;

        case "verificar_sem_nom":
            $sem_nom = $_POST["sem_nom"];
        
            
            $existeDNI = $semestre->verificarSemestreExistente($sem_nom);
        
            
            echo $existeDNI ? "existe" : "no_existe";
            break;

    }
?>