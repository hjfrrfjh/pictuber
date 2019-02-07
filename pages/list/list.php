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
                <?php 
                    if(isset($_GET['search'])){
                        $search = $_GET['search'];
                        echo "<div>검색어 :  <a href='#' class='filter__item filter__item--active'>$search</a></div>";
                    }
                ?>
               
                <div class="filter__title">인기 태그</div>
                <?php 
                    include "../../db_conn.php";
                    $sql = "select * from view_top_tag;";
                    $result = mysqli_query($conn,$sql);

                    while($row=mysqli_fetch_assoc($result)){
                        echo '<a href="#" class="filter__item">',$row['tag'],'</a>';
                    }
                ?>
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
        <input id="where" type="hidden" name="where">
    </form>
    <script>

    </script>
    <!-- ///////////////////////////////////////////// -->
    <?php echo includeHelper("../../footer.php");?>
    <script>
    $(function() {
        var $listContainer = $("#list");
        var reviewCount = 0;

        $("#more").on("click",function(ev){
            ev.preventDefault();
            $("#last_item").val(Number($("#last_item").val())+12);
            getList({append:true});
        });

        function getList(options){
            var options = typeof options !== 'undefined' ?  options : {append:false};
            /////////////////////////where 절 생성
            $items = $(".filter__item--active");

            if($items.length==0) {
                $("#where").val("");
                $("#last_item").val("0");
            }else{
                var where = "where";

                for(var i=0;i<$items.length;i++){
                    if(i>0){
                        where = where + " or";
                    }
                    var searchText = $($items.get(i)).html();
                    where = where + ' tags like "%'+searchText+'%"';
                }

                $("#where").val(where);
                $("#last_item").val(0);
            }

            ///////////////////////
            $.ajax({
                url:'list_ajax.php',
                type:"post",
                data:$("#form").serialize(),
            }).done(function(data){
                if(options.append){
                    $listContainer.append(data);    
                }else{
                    $listContainer.html(data);    
                }
                showCircle(0);

                if($(".card").length==reviewCount){
                    $("#more").css("display","none");
                }else{
                    reviewCount = $(".card").length;
                }
            })
        }

        $(".filter__item").each(function(index){
            var text = $(this).text();
            var $elm = $(this);
            

            $(this).on("click",function (ev){
                console.log("clicked");
                ev.preventDefault();
                
                if($elm.hasClass("filter__item--active")){
                    $elm.removeClass("filter__item--active")
                }else{
                    $elm.addClass("filter__item--active")
                }
                // console.log('hi');
                // $elm.toggleClass("filter__item--active");
                getList();
                
            });
        });

        getList();


    });
    </script>
</body>

</html>