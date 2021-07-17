
<?php

header('Content-type: application/json; charset=utf-8');

require ($_SERVER['DOCUMENT_ROOT'] . '/php/content.php');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode($usersExample, JSON_UNESCAPED_UNICODE);
        break;
    case 'POST':
        echo 'Метод POST';
        break;
    case 'PUT':
        echo 'Метод PUT';
        break;
    case 'DELETE':
        echo 'Метод DELETE';
        break;
    default:
        echo 'Не тзвестный метод';
        break;
}

//var_dump($_SERVER);
