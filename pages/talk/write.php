<!DOCTYPE html>
<html>

<head>
    <?php include "../../head.php"; ?>

    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="write.css" />
    <link href="../../lib/quill/quill.snow.css" rel="stylesheet">
</head>

<body>
    <?php include "../../header.php"?>
    <?php $subTitle="PickTalk"; include "../../sub-title.php" ?>
    <!-- /////////////////////////////////////////////////-->
    
    <div class="content">
    <form class="editor">
        <h3 class="title">
            새로운 글쓰기
        </h3>
        <div id="quill-editor">
        </div>
        <div class="editor__buttons">
            <a href="#" class="button">글쓰기</a>
            <a href="#" class="button" onclick="history.go(-1)">취소</a>
        </div>
    </form>


    
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>
    <script src="../../lib/quill/quill.min.js"></script>

    <script>
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });
    </script>
</body>

</html>