<?php session_start(); ?>
<!DOCTYPE html>
<html id="html" style="opacity: 1">

<head>
    <base href="../../">
    <?php include "../../head.php" ?>
    <link rel="stylesheet" href="pages/member/login.css">
    <meta name="google-signin-client_id"
        content="215398164300-i7rs96pt3feecuat232n6e7qn74sk811.apps.googleusercontent.com">
    <title>Picktuber</title>

</head>

<body>
    <?php include "../../header.php" ?>
    <?php $subTitle="Login"; include "../../sub-title.php" ?>
    <div class="content">
        <div class="desc">- 로그인이 필요합니다</div>
        <!-- <a class="button google" href="#">G 구글 ID로 로그인</a> -->
        <div class="google">
            <div class="g-signin2" data-width="300" data-height="80" data-longtitle="true"
                data-onsuccess="onSignInGoogle"></div>
        </div>

        <a href="#" onclick="signOut();">Sign out</a>

        <!-- <a class="button naver" href="#">N 네이버 아이디로 로그인</a>
        <a class="button normal" href="#">일반 회원 가입</a> -->
    </div>

    <?php include "../../footer.php" ?>
    <script src="https://apis.google.com/js/platform.js?hl=ko" async defer></script>
    <script>
    function onSignInGoogle(googleUser) {
        var profile = googleUser.getBasicProfile();
        // console.log(googleUser.getAuthResponse().id_token);
        $.ajax({
            url: '/pages/member/google_ajax.php',
            type: "post",
            data: {
                "idtoken": googleUser.getAuthResponse().id_token
            }
        }).done(function(data) {
            if(data=="next"){
                location.href="pages/member/signup.php";
            }else{
                console.log(data);
            }
        });
    }

    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function() {
            console.log('User signed out.');
        });
    }
    </script>
</body>

</html>