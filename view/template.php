<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/usuarios.class.php';
if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
    header("Location: /supersuspect/view/login.php");
}
$usuario = new Usuario();
$usuarionome = $usuario->getusuarioNome($_SESSION['cLogin']);
?>
<h1><strong>Bem vindo <?php echo utf8_encode($usuarionome['nome']); ?>!</strong></h1>

        Menu:<br>
        <ul>
        <li><a href="principal.php">Home</a></li>
            <li><a href="produtos.php">Lista de Produtos</a></li>
            <li><a href="cadastroproduto.php">Cadastrar Produtos</li>
            <li><a href="cadastrosupermercado.php">Cadastrar Supermercado</li>
            <li><a href="carrinho.php">Carrinho</li>
            <li><a href="pedidos.php">Meus Pedidos</li>
            <li><a href="sair.php">Sair</a></li>
        </ul>
        <br/>
        <hr/>