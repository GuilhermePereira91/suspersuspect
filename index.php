<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['usuario'])){
        header("Location: /supersuspect/view/login.php");
    }
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset=”UTF-8”>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <title>Supersuspect</title>
    </head>
    <body>

    </body>
</html>