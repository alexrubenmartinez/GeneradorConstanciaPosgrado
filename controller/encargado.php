<?php
    
    require_once("../config/conexion.php");
    
    require_once("../models/Encargado.php");
    
    $encargado = new Encargado();

    
    switch($_GET["op"]){
        
        case "guardaryeditar":
            if(empty($_POST["enca_id"])){
                $encargado->insert_encargado($_POST["enca_nom"],$_POST["enca_apep"],$_POST["enca_apem"],$_POST["enca_correo"],$_POST["enca_telf"]);
            }else{
                $encargado->update_encargado($_POST["enca_id"],$_POST["enca_nom"],$_POST["enca_apep"],$_POST["enca_apem"],$_POST["enca_correo"],$_POST["enca_telf"]);
            }
            break;
        
        case "mostrar":
            $datos = $encargado->get_encargado_id($_POST["enca_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["enca_id"] = $row["enca_id"];
                    $output["enca_nom"] = $row["enca_nom"];
                    $output["enca_apep"] = $row["enca_apep"];
                    $output["enca_apem"] = $row["enca_apem"];
                    $output["enca_correo"] = $row["enca_correo"];
                    $output["enca_sex"] = $row["enca_sex"];
                    $output["enca_telf"] = $row["enca_telf"];
                }
                echo json_encode($output);
            }
            break;
        
        case "eliminar":
            $encargado->delete_encargado($_POST["enca_id"]);
            break;
        
        case "listar":
            $datos=$encargado->get_encargado();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["enca_nom"];
                $sub_array[] = $row["enca_apep"];
                $sub_array[] = $row["enca_apem"];
                $sub_array[] = $row["enca_correo"];
                $sub_array[] = $row["enca_telf"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["enca_id"].');"  id="'.$row["enca_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["enca_id"].');"  id="'.$row["enca_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
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
            $datos=$encargado->get_encargado();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['enca_id']."'>".$row['enca_nom']." ".$row['enca_apep']." ".$row['enca_apem']."</option>";
                }
                echo $html;
            }
            break;
    }
?>