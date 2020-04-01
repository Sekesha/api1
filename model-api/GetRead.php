<?php


class GetRead
{

    public static function readAll($nameTable){

        $db =  DB::getConection();

        $query = "SELECT * FROM $nameTable";
        $result = $db->prepare($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public static function readOne($nameTable, $id){

        $db = Db::getConection();

        $query = "SELECT * FROM $nameTable WHERE id = :id";
        $result = $db->prepare($query);
        $result->bindParam(':id', $id,PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

}