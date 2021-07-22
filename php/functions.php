
<?php

function getUsers($data = [])
{
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

function getUser($data = [], $id = 0)
{
    $id = (int) $id;

    foreach ($data as $key => $value) {
        if ($value['id'] === $id) {
            $user = $value;
        }
    }

    if (isset($user)) {
        echo json_encode($user, JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(404);

        $err = [
            'status' => false,
            'message' => 'User not found'
        ];

        echo json_encode($err);
    }
}

function addUser($data = [], $body = [])
{
    $maxId = 0;

    foreach ($data as $key => $value) {
        if ($maxId < $value['id']) {
            $maxId = $value['id'];
        }
    }

    $maxId = $maxId + 1;

    $data[] = [
        'id' => $maxId,
        'name' => $body['name'],
        'data' => $body['data']
    ];

    $file = $_SERVER['DOCUMENT_ROOT'] . '/data/data.txt';

    file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE));

    foreach (getFileData() as $key => $value) {
        if ( $value['id'] ===  $maxId) {
            http_response_code(201);

            $user = $value;

            $success = [
                'status' => true,
                'user_id' => $value['id']
            ];

            echo json_encode($success);
        }
    }

    if ( !isset($user) ) {
        http_response_code(202);

        $err = [
            'status' => false,
            'message' => 'failed to write data'
        ];

        echo json_encode($err);
    }
}

function editUser($data = [], $id = 0)
{
    if ( !checkIsUser($data, $id) ) {
        return;
    }

    $file = $_SERVER['DOCUMENT_ROOT'] . '/data/data.txt';
    $id = (int) $id;
    $getDataArr = json_decode(file_get_contents('php://input'), true);
    $stat = false;
    $examination = false;

    foreach ($data as $key => $value) {
        if ( $id === $value['id'] ) {
            $data[$key]['name'] = $getDataArr['name'];
            $data[$key]['data'] = $getDataArr['data'];
            //$data = array_values($data);

            file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE));
            $stat = true;
        }
    }

    if ($stat) {
        foreach (getFileData() as $key => $value) {
            if ($value['name'] === $getDataArr['name'] && $value['data'] === $getDataArr['data']) {
                http_response_code(201);

                $success = [
                    'status' => true,
                    'message' => 'successfully changed'
                ];

                echo json_encode($success);

                $examination = true;
            }
        }

        if (!$examination) {
            http_response_code(202);

            $user = $value;

            $err = [
                'status' => false,
                'message' => 'failed to change'
            ];

            echo json_encode($err);
        }
    }
}

function deleteUser($data = [], $id = 0)
{
    if ( !checkIsUser($data, $id) ) {
        return;
    }

    $file = $_SERVER['DOCUMENT_ROOT'] . '/data/data.txt';
    $id = (int) $id;
    $stat = false;

    foreach ($data as $key => $value) {
        if ( $id === $value['id'] ) {
            unset($data[$key]);
            $data = array_values($data);
            file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE));
            $stat = true;
        }
    }

    if ($stat) {
        foreach (getFileData() as $key => $value) {
            if ( $value['id'] ===  $id) {
                http_response_code(202);

                $user = $value;

                $err = [
                    'status' => false,
                    'message' => 'failed to delete'
                ];

                echo json_encode($err);
            }
        }

        if ( !isset($user) ) {
            http_response_code(200);

            $success = [
                'status' => true,
                'message' => 'successful deletion'
            ];

            echo json_encode($success);
        }
    } else {
        http_response_code(204);

        $err = [
            'status' => false,
            'message' => 'User not found'
        ];

        echo json_encode($err);
    }
}

function getFileData()
{
    $file = $_SERVER['DOCUMENT_ROOT'] . '/data/data.txt';

    if ( file_exists($file) ) {
        return json_decode(file_get_contents($file), true);
    } else {
        return [];
    }
}

function checkIsUser($data = [], $id = 0)
{
    $id = (int) $id;

    foreach ($data as $key => $value) {
        if ($value['id'] === $id) {
            $user = $value;
        }
    }

    if (isset($user)) {
        //echo json_encode($user, JSON_UNESCAPED_UNICODE);
        return true;
    } else {
        http_response_code(404);

        $err = [
            'status' => false,
            'message' => 'User not found'
        ];

        echo json_encode($err);
        return false;
    }
}
