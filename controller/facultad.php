<?php
    
    require_once("../config/conexion.php");
    
    require_once("../models/Facultad.php");
    
    $facultad = new Facultad();

    
    switch($_GET["op"]){
        
        case "guardaryeditar":
            if(empty($_POST["fac_id"])){
                $facultad->insert_facultad($_POST["fac_nom"]);
            }else{
                $facultad->update_facultad($_POST["fac_id"],$_POST["fac_nom"]);
            }
            break;
        
        case "mostrar":
            $datos = $facultad->get_facultad_id($_POST["fac_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["fac_id"] = $row["fac_id"];
                    $output["fac_nom"] = $row["fac_nom"];
                }
                echo json_encode($output);
            }
            break;
        
        case "eliminar":
            $facultad->delete_facultad($_POST["fac_id"]);
            break;
        
        case "listar":
            $datos=$facultad->get_facultad();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["fac_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
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
            $datos=$facultad->get_facultad();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['fac_id']."'>".$row['fac_nom']."</option>";
                }
                echo $html;
            }
            break;
    }
?>