<?php
    class Usuario extends Conectar{
        
        public function login(){
            $conectar=parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $dni = $_POST["usu_dni"];
                $pass = $_POST["usu_pass"];
                if(empty($dni) and empty($pass)){
                    
                    header("Location:".conectar::ruta()."index.php?m=2");
					exit();
                }else{
                    $sql = "SELECT * FROM tm_usuario WHERE usu_dni=? and usu_pass=? and est=1";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1, $dni);
                    $stmt->bindValue(2, $pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if (is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_apep"]=$resultado["usu_apep"];
                        $_SESSION["usu_dni"]=$resultado["usu_dni"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        
                        header("Location:".Conectar::ruta()."view/UsuHome/");
                        exit();
                    }else{
                        
                        header("Location:".conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }

        
        public function get_documentos_x_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_usuario.docd_id,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
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
        public function get_documentos_x_usuario_ext($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                td_documento_usuario.docd_id,
                td_documento_usuario.fech_crea,
                tm_documento.doc_id,
                tm_documento.doc_nom,
                tm_documento.doc_descrip,
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

        public  function get_documentos_usuario_x_id($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            td_documento_usuario.docd_id,
            tm_documento.doc_id,
            tm_documento.doc_nom,
            tm_documento.doc_descrip,
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
        WHERE 
            tm_documento.doc_id = ?
            AND td_documento_usuario.est = 1
        ORDER BY 
            td_documento_usuario.fech_crea DESC;
        ";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_documento_x_id_detalle($docd_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            td_documento_usuario.docd_id,
            tm_documento.doc_id,
            tm_documento.doc_nom,
            tm_documento.doc_descrip,
            tm_usuario.usu_id,
            tm_usuario.usu_dni,
            tm_usuario.usu_cod_estudiante,
            tm_usuario.usu_nom,
            tm_usuario.usu_apep,
            tm_usuario.usu_apem,
            tm_usuario.posg_id,
            tm_usuario.usu_sem_id_ingreso,
            tm_sem_ingreso.sem_nom AS sem_nom_ingreso,
            tm_sem_ingreso.sem_fech_inicio AS sem_fech_inicio_ingreso,
            tm_sem_ingreso.sem_fech_fin AS sem_fech_fin_ingreso,
            tm_documento.doc_img,
            tm_encargado.enca_id,
            tm_encargado.enca_nom,
            tm_encargado.enca_apep,
            tm_encargado.enca_apem,
            tm_posgrado.posg_nom,
            tm_facultad.fac_nom,
            tm_usuario.usu_sem_id_actual,
            tm_sem_actual.sem_nom AS sem_nom_actual,
            tm_sem_actual.sem_fech_inicio AS sem_fech_inicio_actual,
            tm_sem_actual.sem_fech_fin AS sem_fech_fin_actual,
            td_documento_usuario.doc_num,
            td_documento_usuario.num_boleta,
            td_documento_usuario.unidad_perteneciente,
            CONCAT(LEFT(tm_encargado.enca_nom, 1), LEFT(tm_encargado.enca_apep, 1), LEFT(tm_encargado.enca_apem, 1)) AS iniciales_encargado
        
            FROM 
                td_documento_usuario
                INNER JOIN tm_documento ON td_documento_usuario.doc_id = tm_documento.doc_id
                INNER JOIN tm_usuario ON td_documento_usuario.usu_id = tm_usuario.usu_id
                INNER JOIN tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                INNER JOIN tm_posgrado ON tm_usuario.posg_id = tm_posgrado.posg_id
                INNER JOIN tm_facultad ON tm_facultad.fac_id = tm_posgrado.fac_id
                INNER JOIN tm_semestre AS tm_sem_ingreso ON tm_sem_ingreso.sem_id = tm_usuario.usu_sem_id_ingreso
                INNER JOIN tm_semestre AS tm_sem_actual ON tm_sem_actual.sem_id = tm_usuario.usu_sem_id_actual 
                INNER JOIN tm_semestre  ON tm_sem_actual.sem_id = tm_usuario.usu_sem_id_actual 
            WHERE 
                td_documento_usuario.docd_id = ?;";
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

        
        public function get_usuario_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est=1 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
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

        
        public function insert_usuario($usu_nom,$usu_apep,$usu_apem,$usu_correo,$usu_pass,$usu_sex,$usu_telf,$rol_id,$usu_dni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario (usu_id,usu_nom,usu_apep,usu_apem,usu_correo,usu_pass,usu_sex,usu_telf,rol_id,usu_dni,fech_crea, est) VALUES (NULL,?,?,?,?,?,?,?,?,?,(date_sub(now(), interval 5 hour)),'1');";
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
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function update_usuario($usu_id,$usu_nom,$usu_apep,$usu_apem,$usu_correo,$usu_pass,$usu_sex,$usu_telf,$usu_dni,$usu_cod_estudiante,$posg_id,$usu_deuda,$usu_sem_id_actual,$usu_sem_id_ingreso,$ciclo_actual){
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
                    usu_dni = ?,
                    usu_cod_estudiante=?,
                    posg_id=?,
                    usu_deuda=?,
                    usu_sem_id_actual=?,
                    usu_sem_id_ingreso=?,
                    ciclo_actual=?
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
            $sql->bindValue(8, $usu_dni);
            $sql->bindValue(9, $usu_cod_estudiante);
            $sql->bindValue(10, $posg_id);
            $sql->bindValue(11, $usu_deuda);
            $sql->bindValue(12, $usu_sem_id_actual);
            $sql->bindValue(13, $usu_sem_id_ingreso);
            $sql->bindValue(14, $ciclo_actual);
            $sql->bindValue(15, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario
                SET
                    est = 0
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE est = 1 ORDER BY fech_crea DESC;";
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


        public function get_documento_x_id_detalle_tesis($docd_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            td_documento_usuario.docd_id,
            tm_documento.doc_id,
            tm_documento.doc_nom,
            tm_usuario.usu_id,
            tm_usuario.usu_dni,
            tm_usuario.usu_cod_estudiante,
            tm_usuario.usu_nom,
            tm_usuario.usu_apep,
            tm_usuario.usu_apem,
            tm_usuario.posg_id,
            tm_usuario.usu_sem_id_ingreso,
            tm_sem_ingreso.sem_nom AS sem_nom_ingreso,
            tm_sem_ingreso.sem_fech_inicio AS sem_fech_inicio_ingreso,
            tm_sem_ingreso.sem_fech_fin AS sem_fech_fin_ingreso,
            tm_documento.doc_img,
            tm_encargado.enca_id,
            tm_posgrado.posg_nom,
            tm_facultad.fac_nom,
            tm_usuario.usu_sem_id_actual,
            tm_sem_actual.sem_nom AS sem_nom_actual,
            tm_sem_actual.sem_fech_inicio AS sem_fech_inicio_actual,
            tm_sem_actual.sem_fech_fin AS sem_fech_fin_actual,
            td_documento_usuario.doc_num,
            td_documento_usuario.num_boleta,
            td_documento_usuario.unidad_perteneciente,
            CONCAT(LEFT(tm_encargado.enca_nom, 1), LEFT(tm_encargado.enca_apep, 1), LEFT(tm_encargado.enca_apem, 1)) AS iniciales_encargado,
            td_cursos_usuario.curso_nom,
            td_cursos_usuario.cur_sigla,
            td_cursos_usuario.fecha as cur_fecha,
            MAX(td_cursos_usuario.nota) AS nota_maxima
            
            FROM 
                td_documento_usuario
                INNER JOIN tm_documento ON td_documento_usuario.doc_id = tm_documento.doc_id
                INNER JOIN tm_usuario ON td_documento_usuario.usu_id = tm_usuario.usu_id
                INNER JOIN tm_encargado ON tm_documento.enca_id = tm_encargado.enca_id
                INNER JOIN tm_posgrado ON tm_usuario.posg_id = tm_posgrado.posg_id
                INNER JOIN tm_facultad ON tm_facultad.fac_id = tm_posgrado.fac_id
                INNER JOIN tm_semestre AS tm_sem_ingreso ON tm_sem_ingreso.sem_id = tm_usuario.usu_sem_id_ingreso
                INNER JOIN tm_semestre AS tm_sem_actual ON tm_sem_actual.sem_id = tm_usuario.usu_sem_id_actual 
                INNER JOIN tm_semestre  ON tm_sem_actual.sem_id = tm_usuario.usu_sem_id_actual 
                INNER JOIN td_cursos_usuario  ON td_cursos_usuario.usu_id = tm_usuario.usu_id 
            
            WHERE 
                td_documento_usuario.docd_id = ?
                AND (td_cursos_usuario.curso_nom LIKE '%Tesis I%' OR td_cursos_usuario.curso_nom LIKE '%Tesis II%')
            
            GROUP BY
                tm_documento.doc_id, tm_usuario.usu_id, td_cursos_usuario.curso_nom;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $docd_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_usuario_xls($usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id, $usu_dni, $usu_cod_estudiante, $usu_deuda) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql_usuario = "INSERT INTO tm_usuario (usu_id, usu_nom, usu_apep, usu_apem, usu_correo, usu_pass, usu_sex, usu_telf, rol_id, usu_dni, usu_cod_estudiante, usu_deuda, fech_crea,est) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,(date_sub(now(), interval 5 hour)),'1')";
            $query_usuario = $conectar->prepare($sql_usuario);
            $query_usuario->bindValue(1, $usu_nom);
            $query_usuario->bindValue(2, $usu_apep);
            $query_usuario->bindValue(3, $usu_apem);
            $query_usuario->bindValue(4, $usu_correo);
            $query_usuario->bindValue(5, $usu_pass);
            $query_usuario->bindValue(6, $usu_sex);
            $query_usuario->bindValue(7, $usu_telf);
            $query_usuario->bindValue(8, $rol_id);
            $query_usuario->bindValue(9, $usu_dni);
            $query_usuario->bindValue(10, $usu_cod_estudiante);
            $query_usuario->bindValue(11, $usu_deuda);
            $query_usuario->execute();
    
            return $resultado = $query_usuario->fetchAll();
        }
    
        
        public function obtenerIdDesdeNombre($conectar, $tabla, $columna_nombre, $valor_nombre) {
            $sql = "SELECT {$tabla}_id FROM {$tabla} WHERE {$columna_nombre} = ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $valor_nombre);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
    
            return $resultado ? $resultado["{$tabla}_id"] : null;
        }

        public function verificarDNIExistente($usu_dni) {
            $conectar = parent::conexion();
            $sql = "SELECT COUNT(*) AS existe FROM tm_usuario WHERE usu_dni = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $usu_dni);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);  
        
            
            return $result['existe'] > 0;
        }


        public function guardarDesdeExcel($data) {
            $usu_nom = $data['usu_nom'];
            $usu_apep = $data['usu_apep'];
            $usu_apem = $data['usu_apem'];
            $usu_dni = $data['usu_dni'];
            $usu_cod_estudiante = $data['usu_cod_estudiante'];
            $usu_deuda = $data['usu_deuda'];
        
            $sem_nom = $data['sem_nom'];
            $sem_fech_inicio = $data['sem_fech_inicio'];
            $sem_fech_fin = $data['sem_fech_fin'];

            $sem_fech_inicio = DateTime::createFromFormat('n/j/y', $sem_fech_inicio)->format('Y-m-d');
            $sem_fech_fin = DateTime::createFromFormat('n/j/y', $sem_fech_fin)->format('Y-m-d');
        
            $posg_nom = $data['posg_nom'];
            $mencion = $data['mencion'];

            $curso_nom = $data['curso_nom'];
            $cur_sigla = $data['cur_sigla'];
            $nota = $data['nota'];

            $fac_nom = $data['fac_nom'];
        
            $conectar = parent::conexion();

            $fac_id = $this->obtenerIdFacultad($conectar, $fac_nom);
            
            $usu_id = $this->obtenerIdUsuario($conectar, $usu_dni);
            $posg_id = $this->obtenerIdPosgrado($conectar, $posg_nom, $mencion, $fac_id);
            
            $sem_id = $this->obtenerIdSemestre($conectar, $sem_nom);

            if (!$this->facultadExiste($conectar, $fac_nom)) {
                
                $sqlFacultad = "INSERT INTO tm_facultad (fac_nom,fech_crea,est) VALUES (?,(date_sub(now(), interval 5 hour)),'1')";
                $stmtFacultad = $conectar->prepare($sqlFacultad);
                $stmtFacultad->bindParam(1, $fac_nom);
                $stmtFacultad->execute();
                $fac_id = $conectar->lastInsertId();
            }


            if (!$usu_id  ) {

                $sqlInsertarUsuario = "INSERT INTO tm_usuario (usu_nom, usu_apep, usu_apem, usu_cod_estudiante, usu_deuda, usu_dni, posg_id,fech_crea,est) 
                                    VALUES (?, ?, ?, ?, ?, ?,?,(date_sub(now(), interval 5 hour)),'1')";

                $stmtInsertarUsuario = $conectar->prepare($sqlInsertarUsuario);
                $stmtInsertarUsuario->bindParam(1, $usu_nom);
                $stmtInsertarUsuario->bindParam(2, $usu_apep);
                $stmtInsertarUsuario->bindParam(3, $usu_apem);
                $stmtInsertarUsuario->bindParam(4, $usu_cod_estudiante);
                $stmtInsertarUsuario->bindParam(5, $usu_deuda);
                $stmtInsertarUsuario->bindParam(6, $usu_dni);
                $stmtInsertarUsuario->bindParam(7, $posg_id); 
                $stmtInsertarUsuario->execute();

                $usu_id = $conectar->lastInsertId();
            }
           
            
            if (!$this->semestreExiste($conectar, $sem_nom)) {

                $sqlSemestre = "INSERT INTO tm_semestre (sem_nom, sem_fech_inicio, sem_fech_fin,sem_fech_crea,est) 
                                VALUES (?,?,?,(date_sub(now(), interval 5 hour)),'1')";
        
                $stmtSemestre = $conectar->prepare($sqlSemestre);
                $stmtSemestre->bindParam(1, $sem_nom);
                $stmtSemestre->bindParam(2, $sem_fech_inicio);
                $stmtSemestre->bindParam(3, $sem_fech_fin);
                $stmtSemestre->execute();
            }
            $sem_id = $this->obtenerIdSemestre($conectar, $sem_nom);
            
            if ($posg_id !== null) {
                
                if ($this->cursoUsuarioExistente($conectar, $usu_id, $curso_nom, $nota)) {
        
                    return "El usuario ya tiene registrado el mismo curso con la misma nota.";
                }

                $sqlCurso = "INSERT INTO td_cursos_usuario (usu_id, sem_id, curso_nom, cur_sigla, nota, fecha) 
                            VALUES (?, ?, ?, ?, ?, (date_sub(now(), interval 5 hour)))";

                $stmtCurso = $conectar->prepare($sqlCurso);
                $stmtCurso->bindParam(1, $usu_id);
                $stmtCurso->bindParam(2, $sem_id);
                $stmtCurso->bindParam(3, $curso_nom);
                $stmtCurso->bindParam(4, $cur_sigla);
                $stmtCurso->bindParam(5, $nota);
                $stmtCurso->execute();

                
                $usu_sem_id_actual = $this->obtenerUsuSemIdActual($conectar, $usu_id);
                $sqlUpdateUsuario = "UPDATE tm_usuario SET usu_sem_id_actual = ?, usu_sem_id_ingreso = ? WHERE usu_id = ?";
                $stmtUpdateUsuario = $conectar->prepare($sqlUpdateUsuario);
                $stmtUpdateUsuario->bindParam(1, $usu_sem_id_actual);
                $stmtUpdateUsuario->bindParam(2, $sem_id);  
                $stmtUpdateUsuario->bindParam(3, $usu_id);
                $stmtUpdateUsuario->execute();




            } else {
               
                echo "Error: posg_id es nulo.";
            }


            return "Datos insertados correctamente";
        }
        
        private function obtenerUsuSemIdActual($conectar, $usu_id) {
            
            $sql = "SELECT td_cursos_usuario.sem_id
                    FROM td_cursos_usuario 
                    INNER JOIN tm_usuario ON tm_usuario.usu_id = td_cursos_usuario.usu_id
                    WHERE tm_usuario.usu_id = ?
                    ORDER BY td_cursos_usuario.fecha DESC
                    LIMIT 1;";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $usu_id);
            $stmt->execute();
        
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
            
            if ($result) {
                $usu_sem_id_actual = $result['sem_id'];
                return $usu_sem_id_actual;
            }
        
            
            return null;
        }


        
        private function semestreExiste($conectar, $sem_nom) {
            $sql = "SELECT COUNT(*) AS count FROM tm_semestre WHERE sem_nom = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $sem_nom);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }


        private function obtenerIdUsuario($conectar, $usu_dni) {
            $sql = "SELECT usu_id FROM tm_usuario WHERE usu_dni = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $usu_dni);
            $stmt->execute();
            return $stmt->fetchColumn();
        }

      
        private function obtenerIdSemestre($conectar, $sem_nom) {
            $sql = "SELECT sem_id FROM tm_semestre WHERE sem_nom = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $sem_nom);
            $stmt->execute();
            return $stmt->fetchColumn();
        }

        private function obtenerIdPosgrado($conectar, $posg_nom, $mencion, $fac_id) {
            $sql = "SELECT posg_id FROM tm_posgrado WHERE posg_nom = ? AND mencion = ? AND fac_id = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $posg_nom);
            $stmt->bindParam(2, $mencion);
            $stmt->bindParam(3, $fac_id);
            $stmt->execute();
        
            $posg_id = $stmt->fetchColumn();
        
            
            if (!$posg_id) {

                $tipo = "";

                // Convertir las cadenas a minúsculas sin tildes para hacer la comparación insensible a mayúsculas y tildes
                $posg_nom_lower = mb_strtolower($posg_nom, 'UTF-8');

                // Verificar el contenido de posg_nom para determinar el valor de tipo
                if (mb_stripos($posg_nom_lower, "maestría") !== false) {
                    $tipo = "Maestría";
                } elseif (mb_stripos($posg_nom_lower, "doctorado") !== false) {
                    $tipo = "Doctorado";

                }
                $sqlInsertarPosgrado = "INSERT INTO tm_posgrado (posg_nom, mencion, fac_id,tipo,fech_crea,est) VALUES (?, ?,?,?,(date_sub(now(), interval 5 hour)),'1')";
                $stmtInsertarPosgrado = $conectar->prepare($sqlInsertarPosgrado);
                $stmtInsertarPosgrado->bindParam(1, $posg_nom);
                $stmtInsertarPosgrado->bindParam(2, $mencion);
                $stmtInsertarPosgrado->bindParam(3, $fac_id);
                $stmtInsertarPosgrado->bindParam(4, $tipo);
                $stmtInsertarPosgrado->execute();
                $posg_id = $conectar->lastInsertId();
            }
        
            return $posg_id;
        }

        private function facultadExiste($conectar, $fac_nom) {
            $sql = "SELECT COUNT(*) AS count FROM tm_facultad WHERE fac_nom = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $fac_nom);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }
        
        
        private function obtenerIdFacultad($conectar, $fac_nom) {
            
            if (!$this->facultadExiste($conectar, $fac_nom)) {
                
                $sqlInsertarFacultad = "INSERT INTO tm_facultad (fac_nom,fech_crea,est) VALUES (?,(date_sub(now(), interval 5 hour)),'1')";
                $stmtInsertarFacultad = $conectar->prepare($sqlInsertarFacultad);
                $stmtInsertarFacultad->bindParam(1, $fac_nom);
                $stmtInsertarFacultad->execute();
            }
        
            
            $sqlObtenerFacultad = "SELECT fac_id FROM tm_facultad WHERE fac_nom = ?";
            $stmtObtenerFacultad = $conectar->prepare($sqlObtenerFacultad);
            $stmtObtenerFacultad->bindParam(1, $fac_nom);
            $stmtObtenerFacultad->execute();
        
            return $stmtObtenerFacultad->fetchColumn();
        }
        
        private function cursoUsuarioExistente($conectar, $usu_id, $curso_nom, $nota) {
            $sql = "SELECT COUNT(*) AS count FROM td_cursos_usuario WHERE usu_id = ? AND curso_nom = ? AND nota = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindParam(1, $usu_id);
            $stmt->bindParam(2, $curso_nom);
            $stmt->bindParam(3, $nota);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return $count > 0;
        }

       






}
?>