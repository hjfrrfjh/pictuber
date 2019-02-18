<?php session_start(); ?>
<!DOCTYPE html>
<html id="html" style="opacity: 1">

<head>
    <base href="../../">
    <?php include "../../head.php" ?>
    <link rel="stylesheet" href="pages/member/login.css">

    <?php  
        $file = '../../key.json';
        $json = file_get_contents($file);
        $json_data = json_decode($json, true);
        $google_sign = $json_data['google_sign'];
        $_SESSION['google_client_id'] = $google_sign;
    ?>

    <meta name="google-signin-client_id"
        content="<?php echo $google_sign ?>">
    <title>Picktuber</title>

</head>

<body>
    <?php include "../../header.php" ?>
    <?php $subTitle="Login"; include "../../sub-title.php" ?>
    <div class="content">
        <div class="desc">LOGIN</div>
        <!-- <a class="button google" href="#">G 구글 ID로 로그인</a> -->
        <div class="google">
            <div class="g-signin2" data-width="300" data-height="80" data-longtitle="true"
                data-onsuccess="onSignInGoogle"></div>
        </div>

        <!-- <a href="#" onclick="signOut();">Sign out</a> -->
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
            url: 'pages/member/google_ajax.php',
            type: "post",
            data: {
                "idtoken": googleUser.getAuthResponse().id_token
            }
        }).done(function(data) {
            signOut();
            if(data=="login_succeed"){
                location.href="../../";
                // 구글 로그아웃 처리
            }else if(data=="next"){
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