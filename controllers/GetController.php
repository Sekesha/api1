<?php

require_once ROOT.'/model-api/GetRead.php';
require_once ROOT.'/components/HelperFunc.php';

class GetController
{
    private $table; //название входящей таблицы для БД
    private $id; //айди компонента

    function __construct($params)
    {
        $this->table = strtolower(array_shift($params));
        $this->id = array_shift($params);
    }

    public function allAction() //показать все
    {
        $allData = [];
        $allData = GetRead::readAll($this->table);
        $this->sendJson($allData);
        return true;
    }

    public function oneAction() //показать один
    {
        $oneData = [];
        $oneData = GetRead::readOne($this->table,$this->id);
        $this->sendJson($oneData);
        return true;
    }

    private function sendJson($data){
        if($data){
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 200, true, $data);
        }else{
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Page Not Found');
        }
    }
}