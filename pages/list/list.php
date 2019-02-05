<?php include "../../common.php" ?>

<!DOCTYPE html>
<html>

<head>
    <?php echo includeHelper("../../head.php"); ?>

    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="list.css" />

</head>

<body>
    <?php echo includeHelper("../../header.php");?>
    <?php $subTitle="PICK"; include '../../sub-title.php'; ?>
    <!-- /////////////////////////////////////////////////-->
    <div class="content">
        <div class="top clearfix">
            <ul class="filter">
                <div class="filter__title">조건 검색</div>
                <a href="#" class="filter__item">먹방</a>
                <a href="#" class="filter__item">게임</a>
                <a href="#" class="filter__item">일상</a>
                <a href="#" class="filter__item">리뷰</a>
                <a href="#" class="filter__item">병맛</a>
                <a href="#" class="filter__item">토크</a>
                <a href="#" class="filter__item">구독자1000</a>
                <a href="#" class="filter__item">버킷첼린지</a>
            </ul>
            <a href="#" class="button button--point top__add-youtuber">유투버 등록하기</a>
        </div>

        <ul id="list" class="list">

        </ul>
    </div>
    <a href="#" id="more" class="more button">더보기</a>
    <form id="form" method="post">
        <input id="last_item" type="hidden" name="last_item" value="0">
        <input id="no_more" type="hidden" name="no_more" value=false>
    </form>
    <script>

    </script>
    <!-- ///////////////////////////////////////////// -->
    <?php echo includeHelper("../../footer.php");?>
    <script>
    $(function() {
        

        var $listContainer = $("#list");

        $(document.body).on("click",function (){
            
        });
        
        $("#more").on("click",function(ev){
            ev.preventDefault();
            $("#last_item").val(Number($("#last_item").val())+12);
            getList();
        });

        function getList(){
            $.ajax({
                url:'list_ajax.php',
                type:"post",
                data:$("#form").serialize(),
            }).done(function(data){
                $listContainer.append(data);
                showCircle(0);
            })
        }

        getList();
    });
    </script>
</body>

</html>