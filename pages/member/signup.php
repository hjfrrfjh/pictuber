<?php include "../../common.php" ?>


<!DOCTYPE html>
<html id="html" style="opacity: 1">

<head>
    <?php echo includeHelper("../../head.php"); ?>
    <link rel="stylesheet" href="signup.css">
    <meta name="google-signin-client_id" content="215398164300-i7rs96pt3feecuat232n6e7qn74sk811.apps.googleusercontent.com">
    <title>Picktuber</title>
    
</head>

<body>
    <?php echo includeHelper("../../header.php"); ?>
    <?php $subTitle="Signup"; include "../../sub-title.php" ?>
    <div class="content">
        <div class="desc">- 원하는 방식을 선택하세요 -</div>
        <!-- <a class="button google" href="#">G 구글 ID로 로그인</a> -->
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
        <a class="button naver" href="#">N 네이버 아이디로 로그인</a>
        <a class="button normal" href="#">일반 회원 가입</a>
    </div>

    <?php echo includeHelper("../../footer.php"); ?>
    <script src="https://apis.google.com/js/platform.js" async defer></script>    
    <script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        console.log('id_token: '+ googleUser.getAuthResponse().id_token);
        $.ajax({
            url:'google.php',
            type:"post",
            data:{"idtoken":googleUser.getAuthResponse().id_token}
        }).done(function(data){
            alert(data);
        });
    }
    </script>
</body>

</html>