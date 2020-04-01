<?php


class HelperFunc
{
    public static function sendHeaders($method, $errorCode, $status = '', $message = '')
    {
        $errorCode = intval($errorCode);
        http_response_code($errorCode);

        header("Access-Control-Allow-Methods: $method");
        header("Content-type: application/json");


//        if (($errorCode == 404) and ($status == false)) { //если ошибка
//            $res = [
//                "status" => $status,
//                "message" => $message
//            ];
//            echo json_encode($res);
//        } elseif ($errorCode == 200 and $status == true) { //если все ок
//            echo json_encode($message, JSON_UNESCAPED_UNICODE);
//        } elseif ($errorCode == 201 and $status == true) {
//            $res = [
//                "status" => $status,
//                "message" => $message
//            ];
//            echo json_encode($res);
//        } elseif ($errorCode == 202 and $status == true) {
//            $res = [
//                "status" => $status,
//                "message" => $message
//            ];
//            echo json_encode($res);
//        } elseif ($errorCode == 401 and $status == true) {
//            $res = [
//                "status" => $status,
//                "message" => $message
//            ];
//            echo json_encode($res);
//        }

        switch ($errorCode) { ///обожаю switch)))(no)
            case  404: ;
            case  401: ;
            case  202: ;
            case 201:
                $res = [
                    "status" => $status,
                    "message" => $message
                ];
                echo json_encode($res);
                break;
            case 200:    echo json_encode($message, JSON_UNESCAPED_UNICODE); break;
        }
        die(); //чтобы работало
    }

    public static function checkParameters($method, $data = [])     //очень хуево - переделать!
    {
        switch ($method) {
            case 'post' :
                if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author']) && isset($_POST['creation_date'])) {
                    return true;
                }
                break;
            case 'put' :
                if (isset($data['title']) || isset($data['content']) || isset($data['author']) || isset($data['creation_date'])) {
                    return true;
                }
                break;
        }
        return false;
    }
}// $date = DateTime::createFromFormat('Y-m-d', $_POST['creation_date']);