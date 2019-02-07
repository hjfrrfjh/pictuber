<?php 
$id_token=$_POST['idtoken'];



$client_id = "215398164300-i7rs96pt3feecuat232n6e7qn74sk811.apps.googleusercontent.com";
$response = file_get_contents('https://oauth2.googleapis.com/tokeninfo?id_token='.$id_token);

$response = json_decode($response,true);

if($response['aud']==$client_id){
    echo "성공";
}else{
    echo "실패";
}
// $response = json_decode($response);


?>
