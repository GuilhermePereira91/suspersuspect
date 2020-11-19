<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/carrinho.class.php';

    $carrinho = new Carrinho();


    $produto = $_GET['id'];
    $usuario = $_SESSION['cLogin'];
      
    if($carrinho->cadastrar($produto, 1, $usuario)){
        header("Location: /supersuspect/view/carrinho.php");
    }else{
        header("Location: /supersuspect/view/carrinho.php");
    }        
?>