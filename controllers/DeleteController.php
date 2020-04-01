<?php

require_once ROOT . '/components/HelperFunc.php';
require_once ROOT . '/model-api/Delete.php';

class DeleteController
{

    private $table; //название входящей таблицы для БД
    private $id; //айди компонента

    function __construct($params)
    {
        $this->table = strtolower(array_shift($params));
        $this->id = array_shift($params);
    }

    public function allAction()
    {
        HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Invalid request');
        return true;
    }

    public function oneAction()
    {
        $result = Delete::deleteOne($this->table, $this->id);
        if ($result) {
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 202, true, 'Post deleted');
        } else {
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Error deleting');
        }
        return true;
    }
}