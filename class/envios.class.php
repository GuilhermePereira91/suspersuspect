<?php
    class Envios extends Model{
        private $custo;
        private $pedido;
        private $usuario;
        private $prazo;

        public function getCusto(){
            return $this->custo;
        }
    
        public function setCusto($custo){
            $this->custo = $custo;
        }

        public function getPedido(){
            return $this->pedido;
        }
    
        public function setPedido($pedido){
            $this->pedido = $pedido;
        }

        public function getUsuario(){
            return $this->usuario;
        }
    
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }

        public function getPrazo(){
            return $this->prazo;
        }
    
        public function setPrazo($prazo){
            $this->prazo = $prazo;
        }

    }
?>