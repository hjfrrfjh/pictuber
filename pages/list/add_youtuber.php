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
    <div id="list-area" class="list">
    <div class="card card-base-deco">    <img src="https://yt3.ggpht.com/-eknxsNEyq_A/AAAAAAAAAAI/AAAAAAAAAAA/GuruK1OZBI0/s240-c-k-no-mo-rj-c0xffffff/photo.jpg" alt="" class="card__img">    <div class="card__body">        <div class="card__title">WebTVBrasileira        </div>        <p class="card__desc">INSCREVA-SE, venha INTERAGIR, FOFOCAR e se DIVERTIR nos nossos programas AO VIVO*** Olá, somos Tati Martins e Marcelo Carlos, criadores da ...        </p>    </div></div>
    </div>
    </div>
    <!-- ///////////////////////////////////////////// -->
    <?php include "../../footer.php" ?>

    <script>
    $(function(){
        var key = "AIzaSyDESprQYHa5oGHw8eIvAmwusM4X8iUxqmA";
        var url = "https://www.googleapis.com/youtube/v3/search";
        var param = [];

        param.push("key="+key);
        param.push("part=snippet");
        param.push("type=channel");
        param.push("q=web");
        param.push("maxResults=20");

        var nextPageToken;

        var url = url+"?"+param.join("&");
        $.get(url, function(data){
            nextPageToken = data.nextPageToken;
            // 
            var items = data.items;

            items.forEach(function(item){
                var snippet = item.snippet;
                var list_html = '<div class="card card-base-deco">'+
                '    <img src="'+snippet.thumbnails.medium.url+'" alt="" class="card__img">'+
                '    <div class="card__body">'+
                '        <div class="card__title">'+snippet.channelTitle+
                '        </div>'+
                '        <div class="card__desc">'+snippet.description+
                '        </div>'+
                '    </div>'+
                '</div>';
                $("#list-area").append(list_html);
            });


            $('.card__desc').ellipsis({
                lines: 3,             // force ellipsis after a certain number of lines. Default is 'auto'
            });

        });

    });


    // console.log(



    // https://www.googleapis.com/youtube/v3/search?part=snippet&key=AIzaSyDESprQYHa5oGHw8eIvAmwusM4X8iUxqmA&type=channel&q=비둘기&maxResults=20

    // $.get( "ajax/test.html", function( data ) {
    //     $( ".result" ).html( data );
    //     alert( "Load was performed." );
    // });

    </script>
</body>

</html>