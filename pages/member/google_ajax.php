<?php
session_start();

include 'signup_model.php';

$id_token=$_POST['idtoken'];

$client_id = "215398164300-i7rs96pt3feecuat232n6e7qn74sk811.apps.googleusercontent.com";
$response = file_get_contents('https://oauth2.googleapis.com/tokeninfo?id_token='.$id_token);

$response = json_decode($response,true);

$id = $response['sub'];
$name = $response['name'];
$email = $response['email'];

if($model->isMember("google",$id)){ //맴버 존재시 로그인처리
    $_SESSION["id"] = $id;
    $_SESSION["name"] = $name;
    echo "login";
}else{ //맴버 없을시 가입처리
    if($model->insertMember("google",$id,$name,$email)){
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $name;
        echo "singup_succeed";
    }else{
        echo "signup_failed";
    }
}


// if($response['aud']==$client_id){
//     echo $response;
// }else{
//     echo "실패";
// }

// {
// "iss": "accounts.google.com",
// "azp": "215398164300-i7rs96pt3feecuat232n6e7qn74sk811.apps.googleusercontent.com",
// "aud": "215398164300-i7rs96pt3feecuat232n6e7qn74sk811.apps.googleusercontent.com",
// "sub": "110745150562962285064", 저장할 식별자 ID
// "email": "kimhyojin87@gmail.com",
// "email_verified": "true",
// "at_hash": "CWlgtR_z5XjJ3hdGZON-fQ",
// "name": "hyojin kim",
// "picture": "https://lh4.googleusercontent.com/-SpQv2pibjYU/AAAAAAAAAAI/AAAAAAAAAAA/ACevoQPraibnGmUg66tXMnGTp54ErvqAZw/s96-c/photo.jpg",
// "given_name": "hyojin",
// "family_name": "kim",
// "locale": "ko",
// "iat": "1549759224",
// "exp": "1549762824",
// "jti": "2ab90e8a43f7cd5eea78a3ec757f35d2004c5456",
// "alg": "RS256",
// "kid": "7c309e3a1c1999cb0404ab7125ee40b7cdbcaf7d",
// "typ": "JWT"
// }


// $response = json_decode($response);

// eyJhbGciOiJSUzI1NiIsImtpZCI6IjdjMzA5ZTNhMWMxOTk5Y2IwNDA0YWI3MTI1ZWU0MGI3Y2RiY2FmN2QiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiYXpwIjoiMjE1Mzk4MTY0MzAwLWk3cnM5NnB0M2ZlZWN1YXQyMzJuNmU3cW43NHNrODExLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXVkIjoiMjE1Mzk4MTY0MzAwLWk3cnM5NnB0M2ZlZWN1YXQyMzJuNmU3cW43NHNrODExLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwic3ViIjoiMTEwNzQ1MTUwNTYyOTYyMjg1MDY0IiwiZW1haWwiOiJraW1oeW9qaW44N0BnbWFpbC5jb20iLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiYXRfaGFzaCI6IkNXbGd0Ul96NVhqSjNoZEdaT04tZlEiLCJuYW1lIjoiaHlvamluIGtpbSIsInBpY3R1cmUiOiJodHRwczovL2xoNC5nb29nbGV1c2VyY29udGVudC5jb20vLVNwUXYycGliallVL0FBQUFBQUFBQUFJL0FBQUFBQUFBQUFBL0FDZXZvUVByYWlibkdtVWc2NnRYTW5HVHA1NEVydnFBWncvczk2LWMvcGhvdG8uanBnIiwiZ2l2ZW5fbmFtZSI6Imh5b2ppbiIsImZhbWlseV9uYW1lIjoia2ltIiwibG9jYWxlIjoia28iLCJpYXQiOjE1NDk3NTkyMjQsImV4cCI6MTU0OTc2MjgyNCwianRpIjoiMmFiOTBlOGE0M2Y3Y2Q1ZWVhNzhhM2VjNzU3ZjM1ZDIwMDRjNTQ1NiJ9.ORHr0o6pY1CdtMIoj1RFXf6qRzjwvFC0ABM4M3cmfYTOzcrrT5KWtfpaYwmMoZcjLihZoomwsV8W-XwL_2-6SFplFgLHBNRqwnB-BfyoQGdlDZj8w_bzf0oFtJzwgZUvgFTi7ahkYaX6zVknqpjeJAS_BQ4QXNY3vxTGJgxsJLUlzNlKEQxrl4noM9sAU1b3zmkQs8pEw6HFjvj_cLzG2yPPIYY_wv1piKKKGpOQadJTAPunQCOkWue3glCxLUQejDuRvJ8_PlbJB5i5TCp90WLbnl-R0j6hSHKTypMrEse-FMm8WFFnRNpdZQbn0q210C-atW8eI33hrrdxB7bacw
?>
