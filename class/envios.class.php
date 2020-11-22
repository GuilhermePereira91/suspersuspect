<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
    class Envios extends Model{
        
        public function getformEnvio(){
            $array = array();
            $sql = $this->db->prepare("SELECT id,descricao FROM formaenvio");
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
            }
            return $array;
        }

        public function cadastrar($idformaenvio){
            //$dataentrega = date("Y-m-d",strtotime("+ 3 days"));
            $sql = $this->db->prepare("INSERT INTO envios (idformaenvio, idpedido, idusuario, idenviostatus) VALUES (:idformaenvio, (SELECT id FROM pedidos WHERE idusuario = :idusuario ORDER BY datapedido DESC LIMIT 1), :idusuario, 1)");
            $sql->bindValue(":idformaenvio", $idformaenvio);
            $sql->bindValue(":idusuario", $_SESSION['cLogin']);              
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function getEnvio($idpedido){
            $array = array();
            $sql = $this->db->prepare("SELECT envios.id AS 'Codigo Rastreio', envios.idenviostatus,formaenvio.descricao as 'Forma de envio', usuarios.nome as 'Nome', usuarios.endereco as 'Endereco', formaenvio.custo as 'Custo', DATE_FORMAT(envios.dataentrega, '%Y-%m-%d') as 'Data Entrega', enviostatus.descricao as 'Status'  FROM supersuspect.envios INNER JOIN formaenvio ON formaenvio.id = envios.idformaenvio INNER JOIN enviostatus ON enviostatus.id = envios.idenviostatus INNER JOIN usuarios ON usuarios.id = envios.idusuario WHERE idpedido = :idpedido");
            $sql->bindValue(":idpedido", $idpedido);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetch();            
            }
            return $array;

        }

        public function confirmarPedido($idpedido,$idenvio, $dataentrega){
            
            $sql = $this->db->prepare("UPDATE envios SET idenviostatus = 2, dataentrega = :dataentrega WHERE id = :idenvio");
            $sql->bindValue(":idenvio", $idenvio);
            $sql->bindValue(":dataentrega", $dataentrega);            
            if($sql->execute()){
                $sql = $this->db->prepare("UPDATE pedidos SET idstatuspedido = 2 WHERE id = :idpedido");
                $sql->bindValue(":idpedido", $idpedido);
                if($sql->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function cancelarPedido($idpedido,$idenvio){

            $sql = $this->db->prepare("UPDATE envios SET idenviostatus = 4 WHERE id = :idenvio");
            $sql->bindValue(":idenvio", $idenvio);        
            
            if($sql->execute()){
                
                $sql = $this->db->prepare("UPDATE pedidos SET idstatuspedido = 4 WHERE id = :idpedido");
                $sql->bindValue(":idpedido", $idpedido);
                
                if($sql->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function receberPedido($idpedido,$idenvio){

            $sql = $this->db->prepare("UPDATE envios SET idenviostatus = 3 WHERE id = :idenvio");
            $sql->bindValue(":idenvio", $idenvio);        
            
            if($sql->execute()){
                
                $sql = $this->db->prepare("UPDATE pedidos SET idstatuspedido = 3 WHERE id = :idpedido");
                $sql->bindValue(":idpedido", $idpedido);
                
                if($sql->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
?>