<?php session_start(); ?>

<?php 
include "talk_model.php";

$result = $model->insertBoard();

if($result){
    header('Location: talk.php');
}else{
    echo "글쓰기 실패";
}

?>