<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/usuarios.class.php';
    $usuario = new Usuario();
    if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['senha'])){
        $nome = utf8_encode($_POST['nome']);
        $endereco = utf8_encode($_POST['endereco']);
        $email = utf8_encode($_POST['email']);
        $cartaocredito = $_POST['cartaocredito'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $cadusu = $usuario->cadastrar($nome, $email, $senha, $telefone, $endereco, $cpf, $cartaocredito, 1);
        if($cadusu){
            echo 'Usuario cadastrado com Sucesso! <a href=login.php>Faça o Login!</a>';
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
        <title>Cadastrar Usuario</title>
    </head>
    <body>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/view/template.php'; ?>
        <h1><strong>Cadastro de Usuario</strong></h1>
        <form method="POST" action="cadastroUsuario.php">
            <label for="nome">Nome Completo:</label><br/>
            <input type="text" name="nome" /><br/>
            <label for="endereco">Endereço:</label><br/>
            <input type="text" name="endereco"/><br/>
            <label for="email">Email:</label><br/>
            <input type="email" name="email"/><br/>
            <label for="cartaocredito">Numero do cartão de credito:</label><br/>
            <input type="number" name="cartaocredito"/><br/>
            <label for="cpf">CPF:</label><br/>
            <input type="number" name="cpf"/><br/>
            <label for="telefone">Telefone:</label><br/>
            <input type="text" name="telefone"/><br/>
            <label for="senha">Senha:</label><br/>
            <input type="password" name="senha"/><br/><br/>
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>