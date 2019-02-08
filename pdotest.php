<?php
require 'db_conn.php';
class Model extends baseModel{
    function gg(){
        $text = $this->quote("as'123m'");
        $statement = $this->query("select * from board_talk where id=$text LIMIT 10");
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;        
    }
}

$model = new Model();

print_r($model->gg());

?>
