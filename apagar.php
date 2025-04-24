<?php
if (!isset($_GET['id']) || !isset($_GET['categoria'])) {
    die('ID ou categoria não fornecidos.');
}

$id = (int) $_GET['id'];
$categoria = $_GET['categoria'];
$jsonPath = $categoria . '.json';

if (!file_exists($jsonPath)) {
    die('Arquivo não encontrado.');
}

$veiculos = json_decode(file_get_contents($jsonPath), true);
$veiculos = array_filter($veiculos, fn($v) => $v['id'] !== $id);

file_put_contents($jsonPath, json_encode(array_values($veiculos), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

header("Location: dashboard.php?categoria=$categoria");
exit;
