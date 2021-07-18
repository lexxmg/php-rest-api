
<?php

function getUsers($data = [])
{
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

function getUser($data = [], $id = 0)
{
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

    $data[] = [
        'id' => $maxId + 1,
        'name' => $body['name']
    ];

    $file = $_SERVER['DOCUMENT_ROOT'] . '/data/data.txt';

    file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE));

    foreach (getFileData() as $key => $value) {
        if ( $value['id'] ===  $maxId + 1) {
            http_response_code(201);

            $success = [
                'status' => true,
                'user_id' => $value['id']
            ];

            echo json_encode($success);
        } else {
            http_response_code(202);

            $err = [
                'status' => false,
                'message' => 'failed to write data'
            ];

            echo json_encode($err);
        }
    }
}

function getFileData()
{
    $file = $_SERVER['DOCUMENT_ROOT'] . '/data/data.txt';

    return json_decode(file_get_contents($file), true);
}
