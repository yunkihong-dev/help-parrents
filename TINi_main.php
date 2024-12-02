<div id="main_content">

    <div class="row_container">
        <div id="notice">
            <div>
                <span><h4><a href="TINi_notice.php">공지사항</a></h4></span>
                <span><a href="TINi_notice.php">+</a></span>
            </div>
            <ul id="write">
                <?php
                    include "config/db.php";
                    
                    $sql = "SELECT n.id, n.reg_date, n.title, u.user_nickname 
                            FROM tbl_notice n 
                            JOIN tbl_user u ON n.user_id = u.id 
                            ORDER BY n.id DESC 
                            LIMIT 10";
                    $result = mysqli_query($conn, $sql);

                    if (!$result)
                        echo "아직 게시글이 없습니다!";
                    else {
                        while ($row = mysqli_fetch_array($result)) {
                            $regist_day = substr($row["reg_date"], 0, 10); // 날짜 포맷 처리
                ?>
                <li onclick="window.location.href='TINi_notice_view.php?id=<?= $row['id'] ?>';">
                    <span><?=$row["title"]?></span>
                    <span><?=$regist_day?></span> <!-- 날짜 표시 -->
                    <span><?=$row["user_nickname"]?></span>
                </li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>
        
        <div class="banner-container">
            <div class="banner">
                <img src="img/캐치티니핑.png" alt="배너 이미지 1" class="banner-image">
                <img src="img/반짝반짝 캐치티니핑.png" alt="배너 이미지 2" class="banner-image">
                <img src="img/알쏭달쏭 캐치티니핑.png" alt="배너 이미지 3" class="banner-image">
                <img src="img/새콤달콤 캐치티니핑.png" alt="배너 이미지 4" class="banner-image">
                <img src="img/슈팅스타 캐치티니핑.png" alt="배너 이미지 5" class="banner-image">
            </div>
            <div class="overlay">
                <a href="TINi_info.php" class="overlay-text">티니핑 알아보러가기</a>
            </div>
        </div>

    </div>

    <div class="row_container">
        <div id="notice">
            <div>
                <span><h4><a href="TINi_goods.php">굿즈 판매 정보</a></h4></span>
                <span><a href="TINi_goods.php">+</a></span>
            </div>
            <ul id="write">
                <?php
                    include "config/db.php";
                    
                    $sql = "SELECT g.id, g.title, u.user_nickname 
                            FROM tini_goods_info g 
                            JOIN tbl_user u ON g.user_id = u.id 
                            ORDER BY g.id DESC 
                            LIMIT 10";
                    $result = mysqli_query($conn, $sql);

                    if (!$result)
                        echo "아직 게시글이 없습니다!";
                    else {
                        while ($row = mysqli_fetch_array($result)) {
                ?>
                <li onclick="window.location.href='TINi_goods.php?id=<?= $row['id'] ?>';">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                    <span><?=$row["title"]?></span>
                    <span><?=$row["user_nickname"]?></span>
                </li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>

        <div id="notice">
            <div>
                <span><h4><a href="TINi_community.php">커뮤니티</a></h4></span>
                <span><a href="TINi_community.php">+</a></span>
            </div>
            <ul id="write">
                <?php
                    include "config/db.php";
                    
                    $sql = "SELECT b.id, b.title, u.user_nickname 
                            FROM tbl_board b 
                            JOIN tbl_user u ON b.user_id = u.id 
                            ORDER BY b.id DESC 
                            LIMIT 10";
                    $result = mysqli_query($conn, $sql);

                    if (!$result)
                        echo "아직 게시글이 없습니다!";
                    else {
                        while ($row = mysqli_fetch_array($result)) {
                            $regist_day = substr($row["reg_date"], 0, 10); // 날짜 포맷 처리
                ?>
                <li onclick="window.location.href='TINi_community_view.php?id=<?= $row['id'] ?>';">
                    <span><?=$row["title"]?></span>
                    <span><?=$regist_day?></span> <!-- 날짜 표시 -->
                    <span><?=$row["user_nickname"]?></span>
                </li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>

    </div>
</div>