<?php
setlocale(LC_ALL, "pt_BR", "pt_BR.utf-8", "portuguese");
$config = array();
    $config['dbname'] = 'supersuspect';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';

global $db;

    try{
        $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
    }catch(PDOException $e){
        echo "ERRO: ".$e->getMessage();
    }
?>