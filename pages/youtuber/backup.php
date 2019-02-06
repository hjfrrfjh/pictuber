<section class="pick">
        <ul>
                <?php while($row = mysqli_fetch_assoc($result_review)){
                    ?>
                <li class="pick__item card-base-deco">
                    <div class="pick__item-body clearfix">
                        <div class="pick__item-author"><?php echo $row['username'] ?></div>
                        <p class="pick__item-text">
                        <?php echo $row['detail'] ?>
                        <p>
                    </div>
                    <div class="pick__item-point">
                        <div class="point-row">
                            <div class="point-col">영상미 </div>
                            <div class="point-col point-data" data-value=<?php echo $row['point1'] ?>>
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">비주얼</div>
                            <div class="point-col point-data" data-value=<?php echo $row['point2'] ?>>
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">재능</div>
                            <div class="point-col point-data" data-value=<?php echo $row['point3'] ?>>
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">유머</div>
                            <div class="point-col point-data" data-value=<?php echo $row['point4'] ?>>
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        <div class="point-row">
                            <div class="point-col">소통</div>
                            <div class="point-col point-data" data-value=<?php echo $row['point5'] ?>>
                                <div class="point__item-graph"></div>
                                <div class="point__item-value"></div>
                            </div>
                        </div>
                        
                    </div>
                </li>
                <?php } ?>
            </ul>
        </section>