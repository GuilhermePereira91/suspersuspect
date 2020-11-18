<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/supermercados.class.php';
    $supermercado = new Supermercados();
    
    if(isset($_POST['cnpj'])){
        $cnpj = $_POST['cnpj'];
        $razao = $_POST['razaosocial'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $cadsm = $supermercado->cadastrar($razao, $cnpj, $telefone, $endereco);
        if($cadsm){
            echo 'Supermercado cadastrado com Sucesso! <br/>';

        }else{
            echo 'Falha ao cadastrar!';
        }
    }
    
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
        <title>Cadastrar Supermercados</title>
    </head>
    <body>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/view/template.php'; ?>
        <h1><strong>Cadastro de Supermercados</strong></h1>
        <form method="POST" action="cadastrosupermercado.php">
            <label for="cnpj">CNPJ:</label><br/>
            <input type="text" name="cnpj" /><br/>
            <label for="razaosocial">Razao Social:</label><br/>
            <input type="text" name="razaosocial"/><br/>
            <label for="endereco">Endereço:</label><br/>
            <input type="endereco" name="endereco"/><br/>
            <label for="telefone">Telefone:</label><br/>
            <input type="text" name="telefone"/><br/>
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>