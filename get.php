<?php
// ======================================================================
//  GET.PHP - API de Streaming no formato Xtream Codes
// ======================================================================

error_reporting(0);
ini_set('display_errors', 0);

$username = $_GET['username'] ?? $_POST['username'] ?? null;
$password = $_GET['password'] ?? $_POST['password'] ?? null;
$action = $_GET['action'] ?? $_POST['action'] ?? '';
$stream_id = $_GET['stream_id'] ?? $_GET['id'] ?? null;
$category_id = $_GET['category_id'] ?? null;
$output = $_GET['output'] ?? 'm3u8';

if (!$username || !$password) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['user_info' => ['auth' => 0, 'message' => 'Usuário e senha necessários']]);
    exit;
}

require_once('./api/controles/db.php');
date_default_timezone_set('America/Sao_Paulo');

$base_url = 'https://' . $_SERVER['HTTP_HOST'];

try {
    $conexao = conectar_bd();
    
    if (!$conexao) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['user_info' => ['auth' => 0, 'message' => 'Erro de conexão com banco']]);
        exit;
    }