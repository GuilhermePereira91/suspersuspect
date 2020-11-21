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

        public function cadastrarDetalhes($idproduto, $qtdproduto){
            $sql = $this->db->prepare("INSERT INTO pedidosdetalhes (idpedido, idproduto, qtdproduto) VALUES ((SELECT id FROM pedidos WHERE idusuario = :idusuario ORDER BY datapedido DESC LIMIT 1), :idproduto, :qtdproduto)");
            $sql->bindValue(":idusuario", $_SESSION['cLogin']);
            $sql->bindValue(":idproduto", $idproduto);
            $sql->bindValue(":qtdproduto", $qtdproduto);                
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

        public function getPedidos(){
            $array = array();
            $sql = $this->db->prepare("SELECT pedidos.id, pedidosstatus.descricao AS pdstatus, valortotal, DATE_FORMAT(datapedido, '%Y-%m-%d') as datapedido FROM pedidos INNER JOIN pedidosstatus ON pedidosstatus.id = pedidos.idstatuspedido WHERE idusuario = :idusuario");
            $sql->bindValue(":idusuario", $_SESSION['cLogin']);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
            }
            return $array;
        }

    }
?>