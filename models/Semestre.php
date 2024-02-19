<?php
    class Semestre extends Conectar{

        public function insert_semestre($nom,$fech_inicio,$fech_fin){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_semestre (sem_id, nom,fech_inicio,fech_fin, fech_crea, est) VALUES (NULL,?,?,?, (date_sub(now(), interval 5 hour)),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nom);
            $sql->bindValue(2, $fech_inicio);
            $sql->bindValue(3, $fech_fin);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_semestre($sem_id,$nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_semestre
                SET
                    nom = ?
                WHERE
                    sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nom);
            $sql->bindValue(2, $sem_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_semestre($sem_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_semestre
                SET
                    est = 0
                WHERE
                    sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_semestre(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_semestre WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_semestre_id($sem_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_semestre WHERE est = 1 AND sem_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $sem_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function verificarSemestreExistente($sem_nom) {
            $conectar = parent::conexion();
            $sql = "SELECT COUNT(*) AS existe FROM tm_semestre WHERE sem_nom = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $sem_nom);
            $sql->execute();
            $result = $sql->fetchAll();
            
            // Devuelve true si ya existe un semestre con ese nombre, false si no existe
            return $result[0]['existe'] > 0;
        }

        public function insertSemestreDesdeExcel($sem_nom,$sem_fech_inicio,$sem_fech_fin) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_semestre (sem_id,sem_nom,sem_fech_inicio,sem_fech_fin,sem_fech_crea, est) VALUES (NULL,?,?,?,(date_sub(now(), interval 5 hour)),'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $sem_nom);
            $sql->bindValue(2, $sem_fech_inicio);
            $sql->bindValue(3, $sem_fech_fin);

            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>