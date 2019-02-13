<?php
session_start();

include 'member_model.php';

$client_id = "215398164300-i7rs96pt3feecuat232n6e7qn74sk811.apps.googleusercontent.com";
$id_token=$_POST['idtoken'];
session_unset();

$response = file_get_contents( "https://oauth2.googleapis.com/tokeninfo?id_token=".$id_token);

// 토큰 유효성 확인
$status = $http_response_header[0];
$valid = preg_match("/200 OK/i",$status);

if(!$valid){
    echo "invalid_token";
    exit;
}

$response = json_decode($response,true);

$id = $response['sub'];
$name = $response['name'];
$email = $response['email'];


if($result = $model->getMemberInfo("google",$id)){ //맴버 존재시 로그인처리
    $_SESSION['id'] = $result->id;
    $_SESSION['name'] = $result->username;
    $_SESSION['email'] = $email;
    $_SESSION['type'] = "google";
    echo "login_succeed";
}else{//맴버 없을시
    $_SESSION['process_id'] = $id;
    $_SESSION['process_nick'] = $name;
    $_SESSION['process_email'] = $email;
    $_SESSION['process_type'] = "google";
    echo "next";
}


?>
