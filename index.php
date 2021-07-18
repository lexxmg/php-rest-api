
<?php

header('Content-type: application/json; charset=utf-8');

require ($_SERVER['DOCUMENT_ROOT'] . '/php/content.php');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($usersExample, JSON_UNESCAPED_UNICODE);
        break;
    case 'POST':
        //echo 'Метод POST: пришли данные ';
        echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
        break;
    case 'PUT':
        echo 'Метод PUT';
        echo file_get_contents('php://input');
        //$arr = json_decode(file_get_contents('php://input'), true);
        break;
    case 'DELETE':
        echo 'Метод DELETE';
        break;
    default:
        echo 'Не тзвестный метод';
        break;
}

//var_dump($_SERVER);
