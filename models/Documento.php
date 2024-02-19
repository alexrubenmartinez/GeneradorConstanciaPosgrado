<?php
    class Documento extends Conectar{

        public function insert_documento($cat_id,$doc_nom,$doc_descrip,$enca_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_documento (doc_id, cat_id, doc_nom, doc_descrip, enca_id,doc_img, fech_crea, est) VALUES (NULL,?,?,?,?,?,?,'../../public/1.png', (date_sub(now(), interval 5 hour)),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $doc_nom);
            $sql->bindValue(3, $doc_descrip);
            $sql->bindValue(4, $enca_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_documento($doc_id,$cat_id,$doc_nom,$doc_descrip,$enca_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_documento
                SET
                    cat_id =?,
                    doc_nom = ?,
                    doc_descrip = ?,
                    enca_id = ?
                WHERE
                    doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $doc_nom);
            $sql->bindValue(3, $doc_descrip);
            $sql->bindValue(4, $enca_id);
            $sql->bindValue(5, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_documento($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_documento
                SET
                    est = 0
                WHERE
                    doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_documento(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
                tm_documento.cat_id,
                tm_documento.doc_img,
                tm_categoria.cat_nom,
                tm_documento.enca_id,
                tm_encargado.enca_nom,
                tm_encargado.enca_apep,
                tm_encargado.enca_apem,
                tm_encargado.enca_correo,
                tm_encargado.enca_sex,
                tm_encargado.enca_telf
                FROM tm_documento
                INNER JOIN tm_categoria on tm_documento.cat_id = tm_categoria.cat_id
                INNER JOIN tm_encargado on tm_documento.enca_id = tm_encargado.enca_id
                WHERE tm_documento.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_documento_id($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_documento WHERE est = 1 AND doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_documento_usuario($docd_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE td_documento_usuario
                SET
                    est = 0
                WHERE
                    docd_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $docd_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_documento_usuario($doc_id, $usu_id, $enca_id, $num_boleta, $unidad_perteneciente) {
            $conectar = parent::conexion();
            parent::set_names();
        
            $ultimoNumero = $this->obtenerUltimoNumero($doc_id);
            $nuevoNumero = $ultimoNumero + 1;

            $sql = "INSERT INTO td_documento_usuario (docd_id, doc_id, usu_id, enca_id, num_boleta, doc_num, unidad_perteneciente, fech_crea, est) VALUES (NULL, ?, ?, ?, ?, ?, ?, (date_sub(now(), interval 5 hour)), 1)";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $enca_id);
            $sql->bindValue(4, $num_boleta);  
            $sql->bindValue(5, $nuevoNumero);  
            $sql->bindValue(6, $unidad_perteneciente);
        
            $sql->execute();

            $docd_id = $conectar->lastInsertId();
            $doc_num = $nuevoNumero;
        
            return array("docd_id" => $docd_id, "doc_num" => $doc_num);
        }
        
        public function obtenerUltimoNumero($doc_id) {
            $sql = "SELECT MAX(doc_num) AS ultimo_numero, YEAR(NOW()) AS anio_actual FROM td_documento_usuario WHERE doc_id = ?";
            $stmt = $this->conexion()->prepare($sql);
            $stmt->bindValue(1, $doc_id);
            $stmt->execute();
        
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $ultimoNumero = $result["ultimo_numero"];
            $anioActual = $result["anio_actual"];
        
            
            return ($ultimoNumero !== null && $ultimoNumero !== "" && $ultimoNumero >= $anioActual) ? $ultimoNumero : 0;
        }

        

        public function update_imagen_documento($doc_id,$doc_img){
            $conectar= parent::conexion();
            parent::set_names();

            require_once("Documento.php");
            $curx = new Documento();
            $doc_img = '';
            if ($_FILES["doc_img"]["name"]!=''){
                $doc_img = $curx->upload_file();
            }

            $sql="UPDATE tm_documento
                SET
                    doc_img = ?
                WHERE
                    doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_img);
            $sql->bindValue(2, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function upload_file(){
            if(isset($_FILES["doc_img"])){
                $extension = explode('.', $_FILES['doc_img']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = '../public/' . $new_name;
                move_uploaded_file($_FILES['doc_img']['tmp_name'], $destination);
                return "../../public/".$new_name;
            }
        }
        public function contar_documentos_x_categoria($doc_id){
            $conectar= parent::conexion();
            parent::set_names();

            $sql="SELECT COUNT(*) as contador 
            FROM td_documento_usuario 
            WHERE doc_id = ?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_documentos_totales_x_categoria($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as total FROM td_documento_usuario WHERE doc_id = ? and est=1;";
            
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id); 
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>