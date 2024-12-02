<?php
include 'config/db.php';

// tbl_tiniping 테이블에서 모든 티니핑 정보를 가져오기
$sql = "SELECT id, tini_name, tini_img_path, tini_description, tini_rank, tini_symbol, tini_magic, tini_traits, tini_favorite_food, tini_disliked_food, tini_item FROM tbl_tiniping";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $tini_name = $row['tini_name'];
        $tini_img_path = $row['tini_img_path'];
        $tini_description = $row['tini_description'];
        $tini_rank = $row['tini_rank'];
        $tini_symbol = $row['tini_symbol'];
        $tini_magic = $row['tini_magic'];
        $tini_traits = $row['tini_traits'];
        $tini_favorite_food = $row['tini_favorite_food'];
        $tini_disliked_food = $row['tini_disliked_food'];
        $tini_item = $row['tini_item'];
?>
        <div class="tini_info" id="tini_info_<?=$id?>">
            <!-- 티니핑 이미지 클릭 시 정보 토글 -->
            <div class="tini_image_container" onclick="toggleInfo(<?=$id?>)">
                <img src="files/<?=$tini_img_path?>" alt="<?=$tini_name?>" class="tini_image">
                <h4><?=$tini_name?></h4>
            </div>
            
            <!-- 토글되는 정보 -->
            <div id="info_<?=$id?>" class="tini_info_content" style="display:none;">
                <p><strong>성격:</strong> <?=$tini_rank?></p>
                <p><strong>상징:</strong> <?=$tini_symbol?></p>
                <p><strong>마법:</strong> <?=$tini_magic?></p>
                <p><strong>특징:</strong> <?=$tini_traits?></p>
                <p><strong>아이템:</strong> <?=$tini_item?></p>
                <p><strong>좋아하는 것:</strong> <?=$tini_favorite_food?></p>
                <p><strong>싫어하는 것:</strong> <?=$tini_disliked_food?></p>
                <p><strong>성별:</strong> <?=$tini_description?></p>
            </div>
        </div>
<?php
    }
} else {
    echo "티니핑 정보가 없습니다.";
}

mysqli_close($conn);
?>
<script>
    // 클릭 시 정보 토글 함수
function toggleInfo(id) {
    var infoDiv = document.getElementById('info_' + id);
    var allInfo = document.querySelectorAll('.tini_info_content');
    
    // 모든 정보 숨기기
    allInfo.forEach(function(info) {
        info.style.display = 'none';
    });

    // 클릭한 티니핑 정보만 보이게
    if (infoDiv.style.display === 'none' || infoDiv.style.display === '') {
        infoDiv.style.display = 'block';
    } else {
        infoDiv.style.display = 'none';
    }
}
</script>