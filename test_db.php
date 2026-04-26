<?php
// Teste de conexão
error_reporting(0);

echo "Testando...<br>";

require_once('./api/controles/db.php');

echo "db.php carregado!<br>";

$con = conectar_bd();

if ($con) {
    echo "Conexão OK!";
} else {
    echo "Erro na conexão";
}
?>