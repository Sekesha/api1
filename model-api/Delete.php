<?php


class Delete
{
    public static function deleteOne($nameTable, $id){

        $db = Db::getConection();

        $query = "DELETE FROM $nameTable WHERE $nameTable.`id` = :id";
        $result = $db->prepare($query);
        $result->bindParam(':id', $id,PDO::PARAM_INT);
        $result->execute();
        if($result->rowCount()){
            return true;
        }
        return false;
    }
}