<?php
    class Facultad extends Conectar{

        public function insert_facultad($fac_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_facultad (fac_id, fac_nom, fech_crea, est) VALUES (NULL,?, (date_sub(now(), interval 5 hour)),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_nom);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_facultad($fac_id,$fac_nom){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_facultad
                SET
                    fac_nom = ?
                WHERE
                    fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_nom);
            $sql->bindValue(2, $fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_facultad($fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_facultad
                SET
                    est = 0
                WHERE
                    fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_facultad(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_facultad WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_facultad_id($fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_facultad WHERE est = 1 AND fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>