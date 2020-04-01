<?php


class PutEdit
{
    public static function EditPostInDb($nameTable, $id, $data)
    {
        $db = DB::getConection();
        $dataarr = "";

        foreach ($data as $kay => $value){

            $value = trim(htmlspecialchars($data[$kay]));

            $dataarr .= "$kay = '$value', ";
        }

        $dataarr = substr($dataarr, 0, -2); //обзераем лишнее

        $query = "UPDATE $nameTable SET $dataarr WHERE $nameTable.`id` = $id";

        $result = $db->prepare($query);

        $result->execute();

        if($result->rowCount()){
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 201, true, "Post edit");
        }else{
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 400, false, 'Parameters are not correct');
        }
        return true;
    }
}