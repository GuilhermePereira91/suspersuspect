<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset=”UTF-8”>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
        <title>Cadastrar Usuario</title>
    </head>
    <body>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" />
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" />
                <label for="endereço">Endereço:</label>
                <input type="text" name="endereco" id="endereco" class="form-control" />
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control" />
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" class="form-control" />
            </div>
            <input type="submit" value="Cadastrar" class="btn btn-secondary" />
        </form>
    </body>
</html>