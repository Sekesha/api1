<?php

require_once ROOT.'/model-api/PutEdit.php';

class PutController
{
    private $table; //название входящей таблицы для БД
    private $id;

    function __construct($params)
    {
        $this->table = strtolower(array_shift($params));
        $this->id = array_shift($params);
    }

    public function allAction(){
        HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Invalid request');
        return true;
    }

    public function oneAction(){
        $data = file_get_contents('php://input'); //принимаем из PUT в Json форме
        $data = json_decode($data, true); //превращаем в ассоц

        $result = HelperFunc::checkParameters('put', $data);

        if ($result){
            PutEdit::EditPostInDb($this->table,$this->id, $data);
        } else {
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Not all parameters');
        }
        return true;
    }
}