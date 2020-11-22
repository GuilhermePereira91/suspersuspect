<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
    class Pedidos extends Model{
        
        public function cadastrar($idusuario, $idformapagamento, $valortotal){
            $sql = $this->db->prepare("INSERT INTO pedidos (idusuario, idformapagamento, valortotal, idstatuspedido) VALUES (:idusuario, :idformapagamento, :valortotal, 1)");
            $sql->bindValue(":idusuario", $idusuario);
            $sql->bindValue(":idformapagamento", $idformapagamento);
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

       public function getDetalhes($idpedido){
           $array = array();
           $sql = $this->db->prepare("SELECT produtos.nome AS 'nome', pedidosdetalhes.qtdproduto AS 'quantidade', produtos.valor AS 'valor' FROM pedidosdetalhes INNER JOIN produtos ON produtos.id = pedidosdetalhes.idproduto WHERE idpedido = :idpedido");
           $sql->bindValue(":idpedido", $idpedido);
           $sql->execute();
           if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            return $array;

       }

        public function getPedidos(){
            $array = array();
            $sql = $this->db->prepare("SELECT pedidos.id, pedidos.idstatuspedido, pedidosstatus.descricao AS pdstatus, valortotal, formapagamento.descricao AS formpagamento, DATE_FORMAT(datapedido, '%Y-%m-%d') as datapedido FROM pedidos INNER JOIN pedidosstatus ON pedidosstatus.id = pedidos.idstatuspedido INNER JOIN formapagamento ON formapagamento.id = pedidos.idformapagamento WHERE idusuario = :idusuario");
            $sql->bindValue(":idusuario", $_SESSION['cLogin']);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
            }
            return $array;
        }

    }
?>