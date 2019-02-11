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
    <?php $subTitle="PAGENAME"; include "../../sub-title.php" ?>

    <?php 
        $process_id= $_SESSION['process_id'];
    ?>

    <div class="content">
        <?php 
            if(empty($_SESSION['process_id'])){
                echo "잘못된 접근입니다";
            }else{
                echo "닉네임을 변경합시다^^";
            }
        ?>
        
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>
</body>

</html>