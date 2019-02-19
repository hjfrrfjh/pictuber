<?php session_start(); ?>

<?php 
include "talk_model.php";

$result = $model->insertComment();

if($result){
    header('Location: talk.php?id='.$_POST['board_id']);
}else{
    echo "코멘트 남기기 실패";
}

?>