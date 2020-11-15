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
        <title>Login</title>
    </head>
    <body>
        <form method="GET" action="">
            Usuario:<br/>
            <input name="usuario" type="text" ><br/><br/>
            Senha:<br/>
            <input name="senha" type="password"><br/><br/>
            <input type="submit" value="Entrar">
        </form>
    </body>
</html>