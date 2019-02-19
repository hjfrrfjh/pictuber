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
    <script src="lib/ellipsis.min.js"></script>
</head>
<!-- AIzaSyDESprQYHa5oGHw8eIvAmwusM4X8iUxqmA -->

<body>
    <?php include "../../header.php";?>
    <!-- /////////////////////////////////////////////////-->
    <?php $subTitle="Youtuber"; include "../../sub-title.php" ?>
    <div class="content">
        <form action="pages/list/add_youtuber_process.php" class="form" method="POST">
            <label class="form__label"><strong>1.</strong> 채널주소를 입력하여 유투버의 정보를 불러옵니다</label>
            <div class="form__search-area card-base-deco">
                <input class="form__url" type="text" name="url" id="form-url">
                <a class="form__url-button button"><i class="icon-font icon-font--down"></i>정보 불러오기</a>
                <a href="https://www.youtube.com" class="button button--light" target="blank">유투브로 이동</a>
                <p class="form__url-desc">잘못된 URL입니다 주소를 확인해주세요!</p>
                <div class="form__url-help"><a href="#" onclick="helpToggle(); return false"> HELP! 잘 모르겠어요 ㅠ</a></div>
            </div>
            
            <img src="img/add_help.jpg" class="help_img">
            
            <label class="form__label"><strong>2.</strong> 설명을 수정/확인 합니다</label>
            <div class="form__autofill-area card-base-deco">
                <div class="form__info-area">
                    <input id="form-id" type="hidden" name="id">
                    <div class="form__name">유투버</div>
                    <input id="form-name" type="hidden" name="name">
                    <img class="form__img" src="https://via.placeholder.com/300">
                    <input id="form-img" type="hidden" name="img_url">
                    <textarea class="form__desc" name="desc"></textarea>
                </div>
                <div class="form_info-warn">
                    URL을 먼저 입력해주세요!
                </div>
            </div>
            <label class="form__label"><strong>3.</strong> 태그를 설정합니다.</label>
            <div class="form__tag-area card-base-deco">
                <div class="tag-base">
                    <div class="tag-title">주요 태그</div>
                    <label><input class="tag" type="checkbox" name="tag[]" value="게임"><span>게임</span></label>
                    <label><input class="tag" type="checkbox" name="tag[]" value="요리"><span>요리</span></label>
                    <label><input class="tag" type="checkbox" name="tag[]" value="리뷰"><span>리뷰</span></label>
                    <label><input class="tag" type="checkbox" name="tag[]" value="음악"><span>음악</span></label>
                    <label><input class="tag" type="checkbox" name="tag[]" value="창업"><span>창업</span></label>
                    <label><input class="tag" type="checkbox" name="tag[]" value="여행"><span>여행</span></label>
                </div>
                <div class="tag-custom">
                    <div class="tag-title">태그 직접 입력</div>
                    <div class="tag-input-area">
                        <input class="tag-input" type="text">
                        <a class="tag-add-button button button--light">추가</a>
                    </div>
                    <div id="custom-tag-container">

                    </div>
                </div>

            </div>
            <input class="form__submit button" type="submit" value="등록하기" onclick="return check()">
        </form>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>

    <script>

    function helpToggle(){
        $(".help_img").toggleClass("help_img--display");
    }

    $(function() {
        $(document).ready(function() {
            $("#form-url").keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return true;
                }
            });
            // $(window).keydown(function(event) {
            //     if (event.keyCode == 13) {
            //         event.preventDefault();
            //         return true;
            //     }
            // });
        });



        $("#form-url").focus();

        var key = "AIzaSyDESprQYHa5oGHw8eIvAmwusM4X8iUxqmA";

        $('.form__url-button').on("click", function() {
            printYoutubeInfo($("#form-url").val());
        });


        $('.tag-add-button').on("click", function() {
            var tag = $('.tag-input').val();

            var regex = /^[1-9|a-zA-z|가-힣]+$/;
           
           if(!regex.test(tag)){
               alert('특수문자와 공백, 초성체는 입력할 수 없습니다!');
               return;
           }

            $("#custom-tag-container").append(
                ' <label><input class="tag" type="checkbox" name="tag[]" value="' + tag + '"><span>' +
                tag + '</span></label> ');
            var tagCount = $(".tag").length;
            $(".tag")[tagCount - 1].click();
            var tag = $('.tag-input').val("");
        });

        $('.tag-input').keydown(function(event) {
            if (event.keyCode == 13) {
                $('.tag-add-button').click();
                event.preventDefault();
            }
        });

        function printYoutubeInfo(url) {
            try {
                var temp = url.split("/");

                // 끝에붙은 / 제거
                temp = temp.filter(function(item) {
                    return item != "";
                });

                //파라미터 제거
                var id = temp[temp.length - 1];
                id = id.split("?")[0];

                var url = "https://www.googleapis.com/youtube/v3/channels";
                var param = [];

                param.push("key=" + key);
                param.push("part=snippet");

                if (temp[temp.length - 2] == "user") {
                    param.push("forUsername=" + id);
                } else {
                    param.push("id=" + id);
                }

                param.push("maxResults=1");

                url = url + "?" + param.join("&");
            } catch (e) {
                hideInfo();
                return;
            };

            $.get(url, function(data) {
                var item = data.items;
                if (item.length == 0) {
                    hideInfo();
                    return;
                }

                fixedUrl = url;
                var item = item[0].snippet;

                $(".form__name").text(item.title);
                $("#form-name").val(item.title);
                $(".form__desc").val(item.description);
                $(".form__img").attr("src", item.thumbnails.medium.url);
                $("#form-img").val(item.thumbnails.medium.url);
                $("#form-id").val(id);
               
                displayInfo();
            });
        }

        function displayInfo() {
            $(".form__info-area").css("display","block");
            $(".form_info-warn").css("display","none");
            $(".form__url-desc").css("display","none");
            
        }
        
        function hideInfo() {
            $(".form__info-area").css("display","none");
            $(".form_info-warn").css("display","block");
            $(".form__url-desc").css("display","block");
            
            $(".tag").each(function(){
                this.checked  = false;
            });
            
            $("input[type='text'], input[type='hidden']").val("");

            $(".form__url").focus();
        }



    });


    function check() {
        
        var checked = $(".tag:checked").map(function(){
            return  $(this).val();
        })
        
        if(checked.length==0){
            alert('하나이상의 태그가 필요합니다.');
            return false;
        }

        if(!$("#form-name").val()||
        !$("#form-img").val()||
        !$("#form-url").val()||
        !$("#form-id").val()
        ){
            alert('주소를 확인해주세요');
            return false;
        }

        return true;

        // return false;
       
        // console.log(checked);
        
    }


    // console.log(



    // https://www.googleapis.com/youtube/v3/search?part=snippet&key=AIzaSyDESprQYHa5oGHw8eIvAmwusM4X8iUxqmA&type=channel&q=비둘기&maxResults=20

    // $.get( "ajax/test.html", function( data ) {
    //     $( ".result" ).html( data );
    //     alert( "Load was performed." );
    // });
    </script>
</body>

</html>