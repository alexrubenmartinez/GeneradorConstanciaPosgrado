<?php
    class Estudiante extends Conectar{

        
        public function get_documentos_x_estudiante($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_estudiante.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.doc_fechini,
                tm_documento.doc_fechfin,
                tm_estudiante.usu_id,
                tm_estudiante.usu_nom,
                tm_estudiante.usu_apep,
                tm_estudiante.usu_apem,
                tm_estudiante.usu_dni,
                tm_encargado.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem
                FROM td_documento_estudiante INNER JOIN 
                tm_documento ON td_documento_estudiante.doc_id = tm_documento.doc_id INNER JOIN
                tm_estudiante ON td_documento_estudiante.usu_id = tm_estudiante.usu_id INNER JOIN
                tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                WHERE 
                td_documento_estudiante.usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_documentos_x_estudiante_top10($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_estudiante.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.doc_fechini,
                tm_documento.doc_fechfin,
                tm_estudiante.usu_id,
                tm_estudiante.usu_nom,
                tm_estudiante.usu_apep,
                tm_estudiante.usu_apem,
                tm_estudiante.usu_dni,
                tm_encargado.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem
                FROM td_documento_estudiante INNER JOIN 
                tm_documento ON td_documento_estudiante.doc_id = tm_documento.doc_id INNER JOIN
                tm_estudiante ON td_documento_estudiante.usu_id = tm_estudiante.usu_id INNER JOIN
                tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                WHERE 
                td_documento_estudiante.usu_id = ?
                AND td_documento_estudiante.est = 1
                LIMIT 10";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public  function get_documentos_estudiante_x_id($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_estudiante.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.doc_fechini,
                tm_documento.doc_fechfin,
                tm_estudiante.usu_id,
                tm_estudiante.usu_nom,
                tm_estudiante.usu_apep,
                tm_estudiante.usu_apem,
                tm_estudiante.usu_dni,
                tm_encargado.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem
                FROM td_documento_estudiante INNER JOIN 
                tm_documento ON td_documento_estudiante.doc_id = tm_documento.doc_id INNER JOIN
                tm_estudiante ON td_documento_estudiante.usu_id = tm_estudiante.usu_id INNER JOIN
                tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                WHERE 
                tm_documento.doc_id = ?
                AND td_documento_estudiante.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_documento_x_id_detalle($docd_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_estudiante.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.doc_fechini,
                tm_documento.doc_fechfin,
                tm_estudiante.usu_id,
                tm_estudiante.usu_nom,
                tm_estudiante.usu_apep,
                tm_estudiante.usu_apem,
                tm_documento.doc_img,
                tm_encargado.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem
                FROM td_documento_estudiante INNER JOIN 
                tm_documento ON td_documento_estudiante.doc_id = tm_documento.doc_id INNER JOIN
                tm_estudiante ON td_documento_estudiante.usu_id = tm_estudiante.usu_id INNER JOIN
                tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                WHERE 
                td_documento_estudiante.docd_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $docd_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_total_documentos_x_estudiante($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM td_documento_estudiante WHERE usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_estudiante_x_id($est_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_estudiante WHERE est=1 AND est_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_estudiante_x_dni($usu_dni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_estudiante WHERE est=1 AND usu_dni=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_dni);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function update_estudiante_perfil($usu_id,$usu_nom,$usu_apep,$usu_apem,$usu_pass,$usu_sex,$usu_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_estudiante 
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_pass = ?,
                    usu_sex = ?,
                    usu_telf = ?
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apep);
            $sql->bindValue(3, $usu_apem);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $usu_sex);
            $sql->bindValue(6, $usu_telf);
            $sql->bindValue(7, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function insert_estudiante($cod_estudiante,$dni,$posg_id,$deuda,$sem_id_actual,$aprob_tesis_i,$aprob_tesis_ii){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_estudiante (est_id,cod_estudiante,dni,posg_id,deuda,sem_id_actual,aprob_tesis_i,aprob_tesis_ii,fech_crea,est) VALUES (NULL,?,?,?,?,?,?,?,(date_sub(now(), interval 5 hour)),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cod_estudiante);
            $sql->bindValue(2, $dni);
            $sql->bindValue(3, $posg_id);
            $sql->bindValue(4, $deuda);
            $sql->bindValue(5, $sem_id_actual);
            $sql->bindValue(6, $aprob_tesis_i);
            $sql->bindValue(7, $aprob_tesis_ii);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function update_estudiante($est_id,$cod_estudiante,$dni,$posg_id,$deuda,$sem_id_actual,$aprob_tesis_i,$aprob_tesis_ii){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_estudiante
                SET
                cod_estudiante = ?,
                dni = ?,
                posg_id = ?,
                deuda = ?,
                sem_id_actual = ?,
                aprob_tesis_i = ?,
                aprob_tesis_ii = ?
                WHERE
                est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cod_estudiante);
            $sql->bindValue(2, $dni);
            $sql->bindValue(3, $posg_id);
            $sql->bindValue(4, $deuda);
            $sql->bindValue(5, $sem_id_actual);
            $sql->bindValue(6, $aprob_tesis_i);
            $sql->bindValue(7, $aprob_tesis_ii);
            $sql->bindValue(8, $est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function delete_estudiante($est_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_estudiante
                SET
                    est = 0
                WHERE
                    est_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $est_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
 
        
        public function get_estudiante(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            tm_estudiante.est_id,
            tm_estudiante.cod_estudiante,
            tm_estudiante.dni,
            tm_estudiante.posg_id,
            tm_estudiante.deuda,
            tm_estudiante.sem_id_actual,
            tm_estudiante.aprob_tesis_i,
            tm_estudiante.aprob_tesis_ii,
            tm_semestre.sem_nom,
            tm_posgrado.posg_nom
            FROM tm_estudiante 
            INNER JOIN tm_posgrado ON tm_estudiante.posg_id=tm_posgrado.posg_id
            INNER JOIN tm_semestre on tm_semestre.sem_id=tm_estudiante.sem_id_actual
            WHERE tm_estudiante.est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_estudiante_modal($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_estudiante 
                WHERE est = 1
                AND usu_id not in (select usu_id from td_documento_estudiante where doc_id=? AND est=1)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_documentos_totales(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="select count(*) as total from td_documento_estudiante where est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_documentos_totales_admin_top10(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                    td_documento_estudiante.docd_id,
                    tm_documento.doc_id,
                    tm_documento.doc_nom,
                    tm_documento.doc_descrip,
                    tm_documento.doc_fechini,
                    tm_documento.doc_fechfin,
                    tm_estudiante.usu_id,
                    tm_estudiante.usu_nom,
                    tm_estudiante.usu_apep,
                    tm_estudiante.usu_apem,
                    tm_estudiante.usu_dni,
                    tm_encargado.enca_id,
                    tm_encargado.enca_nom,
                    tm_encargado.enca_apep,
                    tm_encargado.enca_apem,
                    td_documento_estudiante.fech_crea
                FROM 
                    td_documento_estudiante
                INNER JOIN 
                    tm_documento ON td_documento_estudiante.doc_id = tm_documento.doc_id
                INNER JOIN
                    tm_estudiante ON td_documento_estudiante.usu_id = tm_estudiante.usu_id
                INNER JOIN
                    tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                ORDER BY
                    td_documento_estudiante.fech_crea DESC
                LIMIT 10;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>