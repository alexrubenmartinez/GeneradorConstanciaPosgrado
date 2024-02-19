<?php
    class Encargado extends Conectar{

        public function insert_encargado($enca_nom,$enca_apep,$enca_apem,$enca_correo,$enca_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_encargado (enca_id, enca_nom, enca_apep, enca_apem, enca_correo, enca_telf, est) VALUES (NULL,?,?,?,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $enca_nom);
            $sql->bindValue(2, $enca_apep);
            $sql->bindValue(3, $enca_apem);
            $sql->bindValue(4, $enca_correo);
            $sql->bindValue(5, $enca_telf);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_encargado($enca_id,$enca_nom,$enca_apep,$enca_apem,$enca_correo,$enca_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_encargado
                SET
                    enca_nom = ?,
                    enca_apep = ?,
                    enca_apem = ?,
                    enca_correo = ?,
                    enca_telf = ?
                WHERE
                    enca_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $enca_nom);
            $sql->bindValue(2, $enca_apep);
            $sql->bindValue(3, $enca_apem);
            $sql->bindValue(4, $enca_correo);
            $sql->bindValue(5, $enca_telf);
            $sql->bindValue(6, $enca_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_encargado($enca_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_encargado
                SET
                    est = 0
                WHERE
                    enca_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $enca_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_encargado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_encargado WHERE est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_encargado_id($enca_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_encargado WHERE est = 1 AND enca_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $enca_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>