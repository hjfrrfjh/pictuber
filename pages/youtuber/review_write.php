<?php session_start(); ?>

<?php
$user_id = $_SESSION['id'];

if(empty($user_id)){
    echo "잘못된 접근입니다.";
    exit;
}

include 'youtuber_model.php';

$result = $model->insertReview();

if($result->sucessed){
    // 성공시 작업
}else{
    print_r($result);
}

?>
