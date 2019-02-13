<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../">
    <?php include "../../head.php"; ?>
    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="pages/talk/write.css" />
    <link href="lib/quill/quill.snow.css" rel="stylesheet">
</head>

<body>
    <?php include "../../header.php"?>
    <?php $subTitle="PickTalk"; include "../../sub-title.php" ?>
    <!-- /////////////////////////////////////////////////-->
   
    <div class="content">
    <form class="editor" method="POST" action="pages/talk/write_process.php">
        <h3 class="title">
            새로운 글쓰기
        </h3>
        <label class="editor__subject-label">글제목 : </label><input id="subject" type="text" class="editor__subject" name="subject">
        <input type="hidden" id="body_data" name="body">
        <div id="quill-editor">
        </div>
        <div class="editor__buttons">
            <input type="submit" class="button" value="글쓰기" onclick="confirm();">
            <button class="button" onclick="history.go(-1); return false;">취소</button>
        </div>
    </form>
    
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>
    <script src="lib/quill/quill.min.js"></script>

    <script>
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });

        function confirm(){
            // var title = $("#subject").val();
            $("#body_data").val(quill.root.innerHTML);
        }

    </script>

</body>

</html>