<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
    class Pedidos extends Model{
        
        public function cadastrar($idusuario, $valortotal){
            $sql = $this->db->prepare("INSERT INTO pedidos (idusuario, valortotal, idstatuspedido) VALUES (:idusuario, :valortotal, 1)");
            $sql->bindValue(":idusuario", $idusuario);
            $sql->bindValue(":valortotal", $valortotal);                
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getAllstatus(){
        
            $array = array();
            $sql = $this->db->prepare("SELECT * FROM pedidosstatus");
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetch();            
            }
            return $array;
        }

    }
?>