<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/usuarios.class.php';
    $usuario = new Usuario();
    if(isset($_POST['email']) OR isset($_POST['senha'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $login = $usuario->login($email, $senha);
            if($login){
                header("Location: /supersuspect/view/principal.php");
            }else{
                echo 'Falha no login! Tente novamente';
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
        <title>Login</title>
    </head>
    <body>
    <h1><strong>Login de Usuario</strong></h1>
        <form method="POST" action="login.php">
            <label for="email">Email:</label><br/>
            <input type="email" name="email"/><br/>
            <label for="senha">Senha:</label><br/>
            <input type="password" name="senha"/><br/><br/>
            <input type="submit" value="Entrar">
        </form>
    </body>
</html>