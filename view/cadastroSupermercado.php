<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    
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
        <h1><strong>Cadastro de Supermercados</strong></h1>
        <form method="POST" action="cadastroSupermercado.php">
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