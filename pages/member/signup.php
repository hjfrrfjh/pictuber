<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../">
    <?php include "../../head.php" ?>
    <link rel="stylesheet" href="pages/member/signup.css">
    <title>Picktuber</title>
</head>

<body>
    <?php include "../../header.php";?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Nickname"; include "../../sub-title.php" ?>

    <?php
        include 'member_model.php'; 
    ?>

    <script src="https://apis.google.com/js/platform.js?hl=ko" async defer></script>

    <?php 
        $process_id= $_SESSION['process_id'];
        $process_nick = $_SESSION['process_nick'];
        $process_email = $_SESSION['process_email'];
        $process_type = $_SESSION['process_type'];
        

        if(empty($_SESSION['process_id'])){
            echo "<div style='text-align:center;font-size:1.5rem;padding:100px;'>잘못된 접근입니다</div>";
            include "../../footer.php";
            exit;
        }
    ?>
    <div class="content">
    <form class="form" id="form" action="pages/member/signup_complete.php" method="POST">
            <h4 class="welcome">환영합니다!</h4>
            <h4 class="desc"><strong>닉네임</strong>을 설정해주세요</h4>
            <input class="nick" type="text" name="nick" id="nick" value="<?php echo preg_replace('/\s+/', '', $process_nick);?>" required>
            <div class="form__button-area">
                <input class="submit button" type="submit" value="설정 & 로그인">
                <button class="cancel button" onclick="location.href='../../'; return false;">취소하기</button>
            </div>
        </form>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>
    <script>
    $(function(){
        $("#nick").select();
    });
    </script>
</body>

</html>