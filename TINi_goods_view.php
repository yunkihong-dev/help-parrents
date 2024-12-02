<?php
    include 'config/db.php';
    session_start();

    $userid = $_SESSION['id'];

    $id = $_GET["id"]; // URL 파라미터에서 가져온 id
    $page = $_GET["page"];

    // tini_goods_info 테이블에서 데이터 조회
    $sql = "SELECT g.id, g.title, g.content, u.user_nickname AS nickname, g.reg_date, g.hit, u.id AS user_id, g.place_name
            FROM tini_goods_info g
            JOIN tbl_user u ON g.user_id = u.id 
            WHERE g.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_array();
    $title = $row["title"];
    $nickname = $row["nickname"];
    $reg_date = $row["reg_date"];
    $content = $row["content"];
    $hit = $row["hit"];
    $place_name = $row["place_name"];
    $board_userid = $row["user_id"];

    // HTML 콘텐츠 그대로 출력하려면, htmlspecialchars을 사용하지 말고 그대로 출력
    $content = $content;

    // 조회수 증가
    $new_hit = $hit + 1;
    $sql = "UPDATE tini_goods_info SET hit = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $new_hit, $id);
    $stmt->execute();
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>엄빠를 도와핑!</title>
<link rel="stylesheet" type="text/css" href="./css/header_style.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">

<!-- 카카오맵 API -->
<script type="text/javascript" src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=573240f60f9ad349c89ba164e67eff45&libraries=services,geometry"></script>

</head>
<body> 
<header>
    <?php include "TINi_header.php";?>
</header>  
<section>
    <div id="board_box">
        <h3 class="title">
            굿즈 판매 정보 > 내용보기
        </h3>
        <ul id="view_content">
            <li>
                <span class="col1"><b>제목 :</b> <?=$title?></span>
                <span class="col2"><?=$nickname?> | <?=$reg_date?> | <?=$place_name?></span>
            </li>
            <li>
                <!-- 여기에서 HTML 태그를 그대로 출력합니다 -->
                <div class="content"><?=$content?></div>
            </li>
            <li>
                <!-- 카카오맵을 표시할 div -->
                <div id="map" style="width:100%; height:400px;"></div>
            </li>
        </ul>
        <ul class="buttons">
            <li>
                <?php 
                if ($userid == $board_userid) {
                ?>
                  <a class="letter-button" href="TINi_goods_modify_form.php?id=<?=$id?>&page=<?=$page?>">수정하기</a>
                  <a class="letter-button" href="goods_delete.php?id=<?=$id?>&page=<?=$page?>">삭제하기</a>
                <?php
                } 
                ?>
            </li>
            <li ><a class="letter-button" onclick="history.back();">뒤로가기</a></li>
        </ul>
           <!-- 댓글 작성 폼 -->
           <div id="comment_section">
            <h4>댓글 작성</h4>
            <form action="goods_comment_insert.php" method="POST">
                <textarea name="comment" placeholder="댓글을 작성해주세요" required></textarea><br>
                <input type="hidden" name="goods_id" value="<?=$id?>">
                <button type="submit" class="letter-button">댓글 작성</button>
            </form>
        </div>

        <!-- 댓글 목록 -->
        <div id="comments">
            <?php
            // 댓글 조회
            $comment_sql = "SELECT c.content, c.reg_date, u.user_nickname 
                            FROM tbl_goods_comment c
                            JOIN tbl_user u ON c.user_id = u.id
                            WHERE c.goods_id = ? ORDER BY c.reg_date DESC";
            $stmt = $conn->prepare($comment_sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $comment_result = $stmt->get_result();

            while ($comment_row = $comment_result->fetch_array()) {
                echo "<div class='comment'>
                        <p><b>".$comment_row['user_nickname']."</b> : ".$comment_row['content']."</p>
                        <span class='comment-date'>".$comment_row['reg_date']."</span>
                      </div>";
            }
            ?>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "TINi_footer.php";?>
</footer>
</body>

<script src="./js/modal.js"></script>

<script>
    // 카카오맵 API 로딩이 완료된 후 실행할 함수를 설정합니다.
    kakao.maps.load(function() {
        var mapContainer = document.getElementById('map'), // 지도를 표시할 div
            mapOption = {
                center: new kakao.maps.LatLng(37.5665, 126.9780), // 서울 위치 (위도, 경도)
                level: 3 // 지도의 확대 수준
            };

        var map = new kakao.maps.Map(mapContainer, mapOption); // 지도 생성

        // 장소 검색 객체를 생성합니다
        var ps = new kakao.maps.services.Places(); 

        // 키워드로 장소를 검색합니다
        ps.keywordSearch('<?=$place_name?>', placesSearchCB); 

        // 키워드 검색 완료 시 호출되는 콜백함수입니다
        function placesSearchCB (data, status, pagination) {
            if (status === kakao.maps.services.Status.OK) {
                // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
                // LatLngBounds 객체에 좌표를 추가합니다
                var bounds = new kakao.maps.LatLngBounds();

                for (var i = 0; i < data.length; i++) {
                    displayMarker(data[i]);    
                    bounds.extend(new kakao.maps.LatLng(data[i].y, data[i].x));
                }       

                // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
                map.setBounds(bounds);
            } 
        }

        // 지도에 마커를 표시하는 함수입니다
        function displayMarker(place) {
            var marker = new kakao.maps.Marker({
                map: map,
                position: new kakao.maps.LatLng(place.y, place.x) 
            });

            // 마커에 클릭이벤트를 등록합니다
            kakao.maps.event.addListener(marker, 'click', function() {
                var infowindow = new kakao.maps.InfoWindow({
                    content: '<div style="padding:5px;font-size:12px;">' + place.place_name + '</div>'
                });
                infowindow.open(map, marker);
            });
        }
    });
</script>

</html>