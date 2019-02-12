<?php session_start(); ?>
<?php 
if(empty($_SESSION['id'])){
    header('Location: ../../pages/member/login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../">
    <?php include "../../head.php" ?>
    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="pages/list/add_youtuber.css" />
</head>

<body>
    <?php include "../../header.php";?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Youtuber"; include "../../sub-title.php" ?>
    <div class="content">
    
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>
</body>

</html>