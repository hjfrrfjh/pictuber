<?php include "../../common.php" ?>
<!DOCTYPE html>
<html>

<head>
    <?php echo includeHelper("../../head.php"); ?>

    <title>Picktuber</title>
    <link rel="stylesheet" type="text/css" media="screen" href="talk.css" />

</head>

<body>
    <?php echo includeHelper("../../header.php");?>
    <?php $subTitle="PickTalk"; include "../../sub-title.php" ?>
    <!-- /////////////////////////////////////////////////-->
    <?php include "../../db_conn.php" ?>

    <?php
            $search = $_GET['search'];
            $offset = $_GET['offset'];
            $id = $_GET['id'];
    ?>
    <div class="content clearfix">
        <?php


             $search_where="";
            if(isset($_GET['search'])){
                $search_where = " where subject like '%".$_GET['search']."%'";
            }
            
            if(isset($_GET['id'])){
                $sql = "select * from view_board_talk_content where id=$id;";
                $result = mysqli_query($conn, $sql);
                if($result&&mysqli_num_rows($result)!=0){
                    $row = mysqli_fetch_assoc($result);
                    $subject = $row['subject'];
                    $author = $row['author'];
                    $recommend = $row['recommend'];
                    $hit = $row['hit'];
                    $write_time = $row['write_time'];
                    $content = $row['content'];
        ?>
        <section class="inside card-base-deco">
            <div class="inside__title-area clearfix">
                <div class="inside__title">
                    <?php echo $subject; ?>
                </div>
                <div class="inside__author">
                    <?php echo $author; ?>
                </div>
            </div>

            <div class="inside__info-area clearfix">
                <div class="inside__recommend">
                    <?php echo $recommend; ?>
                </div>



                <div class="inside__hit">
                    <?php echo $hit; ?>
                </div>

                <div class="inside__date">
                    <?php echo $write_time; ?>
                </div>
            </div>

            <div class="inside__content-area">
                <div class="inside__content">
                    <?php echo $content; ?>
                </div>
            </div>
            <div class="inside__comment-area">
                <ul class="comment">
                    <?php
                    }

                    $sql="select * from view_board_talk_comment where board_id=${id}";
                    $result = mysqli_query($conn,$sql);
                    if($result&&mysqli_num_rows($result)!=0){
                        while($row = mysqli_fetch_assoc($result)){
                            $author = $row['author'];
                            $comment = $row['comment'];
                            $write_time = $row['write_time'];

                    ?>
                    <li class="comment__item card-base-deco">
                        <div class="comment__item-author">
                            <?php echo $author ?>
                        </div>
                        <div class="comment__item-body">
                            <div class="comment__item-comment"><?php echo $comment ?></div>
                            <div class="comment__item-date">
                                <?php echo $write_time; ?>
                            </div>
                        </div>
                    </li>
                    <?php 
                            }
                        }
                    }
                    ?>
                </ul>


        </section>




        <section class="now">
            <ul class="board">
                <li class="board__item board__header">
                    <div class="cell col1">추천</div>
                    <div class="cell col2">제목</div>
                    <div class="cell col3">코멘트</div>
                    <div class="cell col4">조회</div>
                    <div class="cell col5">작성자</div>
                    <div class="cell col6">날짜</div>
                </li>
                <?php 
                
                $scale = 20;
                $sql = "select * from view_board_talk_list".$search_where." limit $scale offset ".($offset*$scale);
  
                $result = mysqli_query($conn, $sql);

                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        $recommend = $row['recommend'];
                        $subject = $row['subject'];
                        $comment_count = is_null($row['comment_count'])?0:$row['comment_count'];
                        $hit = $row['hit'];
                        $username = $row['username'];
                        $write_time = $row['write_time'];


                        $link="talk.php?offset=$offset&id=$id".(isset($_GET['search'])?"&search=".$_GET['search']:'');
                ?>
                <li class="board__item">
                    <a href=<?php echo $link ?>>
                    <div class="cell col1"><?php echo $recommend ?></div>
                    <div class="cell col2"><?php echo $subject ?></div>
                    <div class="cell col3"><?php echo $comment_count ?></div>
                    <div class="cell col4"><?php echo $hit ?></div>
                    <div class="cell col5"><?php echo $username ?></div>
                    <div class="cell col6"><?php echo date("y/m/d", strtotime($write_time)) ?></div>
                    </a>
                </li>
                <?php 
                    }
                }
                ?>
            </ul>
            <div class="board__bottom">
                <div class="board__buttons">
                    <a href="write.php" class="button button--point">글쓰기</a>
                </div>
                <div class="board__control-page">
                    <span class="board__page-num">
                        <</span>
                            <?php 
                        $result = mysqli_query($conn,"select count(*) as count from board_talk".$search_where);
                        
                        if($result){
                            $pageCount = ceil(mysqli_fetch_assoc($result)['count']/20);
                            
                            for($i=0;$i<$pageCount;$i++){
                                $active=$i==$offset?" board__page-num--active":'';
                                $link = "talk.php?offset=".$i;
                                
                                if(isset($_GET['search'])){
                                    $link = $link."&search=".$_GET['search']."'";
                                }
                                
                                echo "<a href='$link' class='board__page-num".$active."'>".($i+1)."</a>";
                            }
                        }

                        mysqli_close($conn);
                        
                    ?>
                            <span class="board__page-num">>
                    </span>
                </div>
                <form class="board__search-control" method="GET" action="talk.php">
                    <input class="board__search-text" type="text" placeholder="검색어 입력" name="search">
                    <button class="board__search-submit button" type="submit" value="검색하기">검색</button>
                    <?php 
                        if(isset($search)){
                            echo "<a href='talk.php' class='button'>전체보기</a>";
                        }
                    ?>
                    
                </form>
                    
            </div>



        </section>

    </div>


    <section class="pick-talk">

    </section>

    <!-- ///////////////////////////////////////////// -->
    <?php echo includeHelper("../../footer.php");?>
    <script>

    </script>
</body>

</html>