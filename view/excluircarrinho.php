<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/carrinho.class.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    $carrinho = new Carrinho();
    $id = $_GET['id'];
    if($carrinho->excluirProduto($id)){
        header("Location: /supersuspect/view/carrinho.php");
    }else{
        echo 'Erro!';
    }
?>