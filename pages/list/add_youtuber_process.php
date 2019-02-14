<?php session_start();

if(empty($_SESSION['id'])){
    header('Location: ../../pages/member/login.php');
}

include 'list_model.php';

$passId = 0;

$result = $model->insertYoutuber();

if($result->succeed){
    header("location: ../youtuber/youtuber.php?id=$result->id");
}else{
    print_r($result);
}



?>