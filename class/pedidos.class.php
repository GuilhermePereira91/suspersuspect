<?php
    class Pedidos extends Model{
        private $data;
        private $codigoenvio;
        private $produto;
        private $usuario;
        private $status;      
        
        public function getData(){
            return $this->data;
        }
    
        public function setData($data){
            $this->data = $data;
        }

        public function getCodigoenvio(){
            return $this->codigoenvio;
        }
    
        public function setCodigoenvio($codigoenvio){
            $this->codigoenvio = $codigoenvio;
        }

        public function getProduto(){
            return $this->produto;
        }
    
        public function setProduto($produto){
            $this->produto = $produto;
        }

        public function getUsuario(){
            return $this->usuario;
        }
    
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }

        public function getStatus(){
            return $this->status;
        }
    
        public function setStatus($status){
            $this->status = $status;
        }

        public function cadastrar($idusuario, $valortotal){
            $sql = $this->db->prepare("INSERT INTO pedidos (idusuario, valortotal, idstatuspedido) VALUES (:idusuario, :valortotal, 1)");
            $sql->bindValue(":idusuario", $idusuario);
            $sql->bindValue(":idusuario", $idusuario);                
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