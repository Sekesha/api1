<?php

require_once ROOT.'/components/ApiRouter.php';
require_once ROOT.'/components/HelperFunc.php';

class PostWrite
{
    public static function WritePostToDb($nameTable)
    {
        $db = DB::getConection();

        $title = trim(htmlspecialchars($_POST['title']));
        $content = trim(htmlspecialchars($_POST['content']));
        $author = trim(htmlspecialchars($_POST['author']));
        $date = $_POST['creation_date'];


        $query = "INSERT INTO $nameTable (`id`, `title`, `content`, `author`, `creation_date`) VALUES (NULL, :title, :content, :author, :creation_date);";
        $result = $db->prepare($query);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':content', $content, PDO::PARAM_STR);
        $result->bindParam(':author', $author, PDO::PARAM_STR);
        $result->bindParam(':creation_date', $date, PDO::PARAM_STR);

        $result->execute();

        $id = $db->lastInsertId();

        if($result->rowCount()){
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 201, true, "Post Create. Id = $id");
        }else{
            HelperFunc::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Parameters are not correct');
        }
        return true;
    }
}