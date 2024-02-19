<?php
    class ProgramaEstudio extends Conectar{
        


        
        public function get_documentos_x_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_usuario.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.doc_fechini,
                tm_documento.doc_fechfin,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apep,
                tm_usuario.usu_apem,
                tm_usuario.usu_dni,
                tm_encargado.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem
                FROM td_documento_usuario INNER JOIN 
                tm_documento ON td_documento_usuario.doc_id = tm_documento.doc_id INNER JOIN
                tm_usuario ON td_documento_usuario.usu_id = tm_usuario.usu_id INNER JOIN
                tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                WHERE 
                td_documento_usuario.usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_documentos_x_usuario_top10($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_usuario.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.doc_fechini,
                tm_documento.doc_fechfin,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apep,
                tm_usuario.usu_apem,
                tm_usuario.usu_dni,
                tm_encargado.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem
                FROM td_documento_usuario INNER JOIN 
                tm_documento ON td_documento_usuario.doc_id = tm_documento.doc_id INNER JOIN
                tm_usuario ON td_documento_usuario.usu_id = tm_usuario.usu_id INNER JOIN
                tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                WHERE 
                td_documento_usuario.usu_id = ?
                AND td_documento_usuario.est = 1
                LIMIT 10";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_maestrias_x_facultad($fac_id){
            $conectar = parent::conexion();
            parent::set_names();
            
            $sql = "SELECT 
                        tm_facultad.fac_id,
                        tm_facultad.fac_nom,
                        tm_posgrado.posg_nom,
                        tm_posgrado.tipo,
                        tm_posgrado.mencion,
                        tm_posgrado.posg_id
                    FROM tm_posgrado
                    INNER JOIN tm_facultad ON tm_posgrado.fac_id = tm_facultad.fac_id
                    WHERE tm_facultad.fac_id = ? AND tm_posgrado.est = 1;";
            
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $fac_id, PDO::PARAM_INT);
            $sql->execute();
            
            return $resultado = $sql->fetchAll();
        }
        

        
        public function get_documento_x_id_detalle($docd_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_usuario.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.doc_fechini,
                tm_documento.doc_fechfin,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apep,
                tm_usuario.usu_apem,
                tm_documento.doc_img,
                tm_encargado.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem
                FROM td_documento_usuario INNER JOIN 
                tm_documento ON td_documento_usuario.doc_id = tm_documento.doc_id INNER JOIN
                tm_usuario ON td_documento_usuario.usu_id = tm_usuario.usu_id INNER JOIN
                tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                WHERE 
                td_documento_usuario.docd_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $docd_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_total_documentos_x_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM td_documento_usuario WHERE usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_posgrado_x_id($posg_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_posgrado WHERE est=1 AND posg_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $posg_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_usuario_x_dni($usu_dni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est=1 AND usu_dni=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_dni);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function update_usuario_perfil($usu_id,$usu_nom,$usu_apep,$usu_apem,$usu_pass,$usu_sex,$usu_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario 
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

        
        public function insert_programaEstudio($fac_id,$posg_nom,$tipo,$mencion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_posgrado (posg_id,fac_id,posg_nom,tipo,mencion,fech_crea, est) VALUES (NULL,?,?,?,?,(date_sub(now(), interval 5 hour)),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->bindValue(2, $posg_nom);
            $sql->bindValue(3, $tipo);
            $sql->bindValue(4, $mencion);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function update_usuario($usu_id,$usu_nom,$usu_apep,$usu_apem,$usu_correo,$usu_pass,$usu_sex,$usu_telf,$rol_id,$usu_dni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_correo = ?,
                    usu_pass = ?,
                    usu_sex = ?,
                    usu_telf = ?,
                    rol_id = ?,
                    usu_dni = ?
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_apep);
            $sql->bindValue(3, $usu_apem);
            $sql->bindValue(4, $usu_correo);
            $sql->bindValue(5, $usu_pass);
            $sql->bindValue(6, $usu_sex);
            $sql->bindValue(7, $usu_telf);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $usu_dni);
            $sql->bindValue(10, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function delete_programaEstudio($posg_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_posgrado
                SET
                    est = 0
                WHERE
                    posg_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $posg_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_usuario_modal($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario 
                WHERE est = 1
                AND usu_id not in (select usu_id from td_documento_usuario where doc_id=? AND est=1)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_documentos_totales(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="select count(*) as total from td_documento_usuario where est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_documentos_totales_admin_top10(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                    td_documento_usuario.docd_id,
                    tm_documento.doc_id,
                    tm_documento.doc_nom,
                    tm_documento.doc_descrip,
                    tm_documento.doc_fechini,
                    tm_documento.doc_fechfin,
                    tm_usuario.usu_id,
                    tm_usuario.usu_nom,
                    tm_usuario.usu_apep,
                    tm_usuario.usu_apem,
                    tm_usuario.usu_dni,
                    tm_encargado.enca_id,
                    tm_encargado.enca_nom,
                    tm_encargado.enca_apep,
                    tm_encargado.enca_apem,
                    td_documento_usuario.fech_crea
                FROM 
                    td_documento_usuario
                INNER JOIN 
                    tm_documento ON td_documento_usuario.doc_id = tm_documento.doc_id
                INNER JOIN
                    tm_usuario ON td_documento_usuario.usu_id = tm_usuario.usu_id
                INNER JOIN
                    tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                ORDER BY
                    td_documento_usuario.fech_crea DESC
                LIMIT 10;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_programa_estudio(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT *,tm_facultad.fac_nom
            FROM tm_posgrado INNER JOIN
            tm_facultad ON tm_facultad.fac_id = tm_posgrado.fac_id
            WHERE tm_posgrado.est = 1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function verificarProgramaEstudioExistente($posg_nom) {
            $conectar = parent::conexion();
            $sql = "SELECT COUNT(*) AS existe FROM tm_posgrado WHERE posg_nom = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $posg_nom);
            $sql->execute();
            $result = $sql->fetchAll();
            
            
            return $result[0]['existe'] > 0;
        }

        public function insertProgramaEstudioDesdeExcel($fac_id,$posg_nom,$tipo,$mencion) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_posgrado (posg_id,fac_id,posg_nom,tipo,mencion,fech_crea, est) VALUES (NULL,?,?,?,?,(date_sub(now(), interval 5 hour)),'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->bindValue(2, $posg_nom);
            $sql->bindValue(3, $tipo);
            $sql->bindValue(4, $mencion);

            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>