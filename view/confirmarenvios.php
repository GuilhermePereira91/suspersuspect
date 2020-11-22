<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/envios.class.php'; 
    $envio = new Envios();

    $idpedido = $_GET['idpd'];
    $idenvio = $_GET['iden'];
    $dataentrega = date("Y-m-d",strtotime("+ 3 days"));
    if($envio->confirmarPedido($idpedido,$idenvio, $dataentrega)){
        header("Location: pedidosdetalhes.php?id=$idpedido");
    }else{
        echo $idpedido.'<br>';
        echo $idenvio;
        echo 'Erro!';
    }


    
?>