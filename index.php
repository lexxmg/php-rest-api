
<?php

header('Content-type: application/json; charset=utf-8');

require ($_SERVER['DOCUMENT_ROOT'] . '/php/content.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/php/functions.php');

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

$data = getFileData();

// var_dump($_GET);
// var_dump($_SERVER);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET': {
        switch ($type) {
            case 'user':
                getUser($data, $id);
                break;
            case 'users':
                getUsers($data);
                break;
        }
        break;
    }
    case 'POST': {
        switch ($type) {
            case 'user':
                addUser($data, $_POST);
                //echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
                break;
        }
        break;
    }
    case 'PUT': {
        echo 'Метод PUT';
        echo file_get_contents('php://input');
        //$arr = json_decode(file_get_contents('php://input'), true);
        break;
    }
    case 'DELETE': {
        echo 'Метод DELETE';
        break;
    }
    default: {
        http_response_code(404);

        $err = [
            'status' => false,
            'message' => 'bad request'
        ];

        echo json_encode($err);
        break;
    }
}

//var_dump($_SERVER);
