<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../">
    <?php include "../../head.php" ?>
    <title>Picktuber</title>
    
</head>

<body>
    <?php include "../../header.php";?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Signup"; include "../../sub-title.php" ?>
    <?php include 'member_model.php'; ?>
    <?php
        $process_nick = $_POST['nick'];

        $process_id= $_SESSION['process_id'];
        $process_nick = $process_nick;
        $process_email = $_SESSION['process_email'];
        $process_type = $_SESSION['process_type'];

        $result = $model->insertMember($process_type,$process_id, $process_nick, $process_email);

        if($result){
            $resultInfo = $model->getMemberInfo("google",$process_id);
            $_SESSION['id'] = $resultInfo->id;
            $_SESSION['name'] = $process_nick;
            $_SESSION['email'] = $process_email;
            $_SESSION['type'] = $process_type;
            header('Location: ../../');
            exit;            
        }else{
            echo "잘못된 형식의 데이터 입니다";
        }

    ?>
    <div class="content">
        <?php 

        ?>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>
</body>

</html>