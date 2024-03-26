<?php

require_once 'autoload.php';

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se a requisição é para incluir um dispositivo
    if (isset($_GET['acao']) && $_GET['acao'] === 'incluir_dispositivo') {
        incluirDispositivo();
    }
    // Verifica se a requisição é para incluir coordenadas
    elseif (isset($_GET['acao']) && $_GET['acao'] === 'incluir_coordenadas') {
        incluirCoordenadas();
    }
    // Se a ação não for reconhecida
    else {
        respostaJson(400, "Ação inválida.");
    }
}
// Se o método HTTP não for POST
else {
    respostaJson(405, "Método não permitido.");
}

function incluirDispositivo() {
    // Verifica se todos os parâmetros necessários estão presentes
    if (isset($_POST['id'], $_POST['codigo'], $_POST['descricao'])) {
        $database = new Database();
        $db = $database->getConnection();

        $dispositivo = new Dispositivo($db);

        $dispositivo->id = $_POST['id'];
        $dispositivo->codigo = $_POST['codigo'];
        $dispositivo->descricao = $_POST['descricao'];

        if ($dispositivo->inserir()) {
            respostaJson(200, "Dispositivo inserido com sucesso.");
        } else {
            respostaJson(500, "Erro ao inserir dispositivo.");
        }
    } else {
        respostaJson(400, "Parâmetros incompletos.");
    }
}

function incluirCoordenadas() {
    // Verifica se todos os parâmetros necessários estão presentes
    if (isset($_POST['id'], $_POST['latitude'], $_POST['longitude'])) {
        $database = new Database();
        $db = $database->getConnection();

        $coordenadas = new Coordenadas($db);

        $coordenadas->id = $_POST['id'];
        $coordenadas->latitude = $_POST['latitude'];
        $coordenadas->longitude = $_POST['longitude'];

        if ($coordenadas->inserir()) {
            respostaJson(200, "Coordenadas inseridas com sucesso.");
        } else {
            respostaJson(500, "Erro ao inserir coordenadas.");
        }
    } else {
        respostaJson(400, "Parâmetros incompletos.");
    }
}

function respostaJson($codigo, $mensagem) {
    http_response_code($codigo);
    header('Content-Type: application/json');
    echo json_encode(array('mensagem' => $mensagem));
}

?>
