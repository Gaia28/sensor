<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'models/DataModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents("php://input");

    if ($input) {
        $dataModel = new DataModel();
        if ($dataModel->saveSensorData($input)) {
            echo "OK"; 
        } else {
            http_response_code(500); 
            echo "Erro ao salvar os dados.";
        }
    } else {
        http_response_code(400); 
        echo "Nenhum dado recebido";
    }
    exit;
} else {
    http_response_code(405); 
    echo "Método de acesso não permitido.";
}
?>