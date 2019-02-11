<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <base href="../../">
    <?php include "../../head.php" ?>
    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="pages/list/list.css" />
</head>

<body>
    <?php include "../../header.php" ;?>
    <?php $subTitle="PICK"; include '../../sub-title.php'; ?>
    <!-- /////////////////////////////////////////////////-->
    <?php include 'list_model.php' ?>
    <?php 
        
        $search = "";
        
        $search = !empty($_GET['search'])?$_GET['search']:"";
        $result = $model->getTopTags();
        
    ?>
    <div class="content">
        <div class="top clearfix">
            <div class="filter">
                <div class="filter__group">
                <?php 
                    if(!empty($search)){
                        echo "<div class='search__title'>검색어</div><a href='#' class='search__item search__item--active'>$search</a> <span class='search__desc'><- 클릭시 <strong>검색해제</strong>가 가능합니다!</span>";
                    }
                ?>
                </div>
                <div class="filter__group">
                    <div class="filter__title">주요 태그</div><a href="#" class="filter__item">게임</a><a href="#" class="filter__item">요리</a><a href="#" class="filter__item">리뷰</a><a href="#" class="filter__item">음악</a><a href="#" class="filter__item">창업</a><a href="#" class="filter__item">여행</a>
                </div>
                <div class="filter__group">
                    <div class="filter__title">인기 태그</div>
                    <?php 
                    foreach($result as $data){
                        echo '<a href="#" class="filter__item">',$data->tag,'</a>';
                    }
                ?>
                </div>
                <div class ="order">
                <div class="order__title">
                    높은 점수로 정렬 -
                </div>
                <a href="#" class="order__item">정보</a>
                <a href="#" class="order__item">비주얼</a>
                <a href="#" class="order__item">재능</a>
                <a href="#" class="order__item">유머</a>
                <a href="#" class="order__item">소통</a>
            </div>
            </div>
            <a href="#" class="button button--point top__add-youtuber">유투버 등록하기</a>

        </div>
        

        <ul id="list" class="list"></ul>
    </div>
    <div id="nothing" class="nothing">&lt 해당하는 유투버가 없습니다. ㅠ.ㅠ &gt</div>
    <a href="#" id="more" class="more button button--light">더보기</a>
    <script>

    </script>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php";?>
    <script>
    $(function() {
        let $listContainer = $("#list");
        let offset=0;
        function getList(append) {
            
            
            $activeTags = $(".filter__item--active");
            
            let tags = [];
            $activeTags.each(function(index){
                tags.push($(this).text());
            })

            let search ="";
            if($(".search__item--active")[0]){
                search = $(".search__item--active").text();
            }

            let order ="";
            if($(".order__item--active")[0]){
                order = $(".order__item--active").text();
            }

            
            var data = {};
            data['offset']=offset;
            if(tags.length>0) data['tags']=tags;
            if(search!=="") data['search']=search;
            if(order!=="") data['order']=order;

            $.ajax({
                url: 'pages/list/list_ajax.php',
                type: "get",
                data: data,
            }).done(function(data) {
                data=JSON.parse(data)
                if(data.html==""&&offset==0){
                    $('#nothing').css("display","block");
                }else{
                    $('#nothing').css("display","none");
                }
               
                if(data.more){
                    $("#more").css("display","block");
                }else{
                    $("#more").css("display","none");
                }
                if(append){
                    $listContainer.append(data.html);
                }else{
                    $listContainer.html(data.html);
                }
                showCircle(0);
            })
        }

        // 더보기 선택시
        $("#more").on("click",function(ev){
            offset++;
            ev.preventDefault();
            getList(true);
        });


        // 정렬 태그 선택시
        $(".order__item").each(function(index){
            var $elm = $(this);
            $elm.on("click",function(ev){
                ev.preventDefault();
                offset=0;
                var activated = $elm.hasClass("order__item--active");
                $(".order__item").removeClass("order__item--active");

                if(!activated){
                    $elm.addClass("order__item--active");
                }

                getList();
            });
        });

        // 검색 태그 선택시
        $(".search__item").on("click",function (ev){
            ev.preventDefault();
            offset=0;
            $(".search__item").toggleClass("search__item--active");
            getList();
        });

        // 필터 태그 선택시
        $(".filter__item").each(function(index){
            var $elm = $(this);
            
            $elm.on("click",function (ev){
                ev.preventDefault();
                offset=0;
                $elm.toggleClass("filter__item--active");
                getList();
            });
        });


        getList();

    });
    </script>
</body>

</html>