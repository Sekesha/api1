<?php

require_once ROOT.'/model-api/PostWrite.php';
require_once ROOT.'/components/HelperFunc.php';

class PostController
{

    private $table; //название входящей таблицы для БД

    function __construct($params)
    {
        $this->table = strtolower(array_shift($params));
    }

    public function allAction(){

        $result = HelperFunc::checkParameters('post');

        if($result){
            PostWrite::WritePostToDb($this->table);
        }else{
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Not all parameters');
        }
        return true;
    }

    public function oneAction(){
        HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Invalid request');
        return true;
    }
}