<?php
    include "config/db.php";

    // tini_name 버튼 만들기
    $sql = "SELECT id, tini_name FROM tbl_tiniping";
    $result = mysqli_query($conn, $sql);
?>

<!-- 티니핑 버튼 -->
<div id="tiniping_buttons">
    <h3>티니핑 선택</h3>
    <?php
    // 티니핑 버튼 생성
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $tini_name = $row['tini_name'];
            $tini_id = $row['id'];

            // 선택된 버튼인지 체크
            $selected = (isset($_GET['tini_ids']) && in_array($tini_id, explode(',', $_GET['tini_ids']))) ? 'selected' : '';
            echo "<button class='$selected' onclick='filterPosts($tini_id)'>$tini_name</button> ";
        }
    } else {
        echo "티니핑을 찾을 수 없습니다.";
    }
    ?>
</div>

<!-- 게시글 리스트 -->
<div id="board_box">
    <h3>
        굿즈 판매 정보
    </h3>
    <ul id="board_list">
        <li>
            <span class="col1">번호</span>
            <span class="col2">제목</span>
            <span class="col3">글쓴이</span>
            <span class="col5">등록일</span>
            <span class="col6">조회</span>
        </li>

        <?php
            // 페이지 번호
            if (isset($_GET["page"]))
                $page = $_GET["page"];
            else
                $page = 1;

            // 선택된 tini_id 필터링
            $tini_ids = isset($_GET['tini_ids']) ? $_GET['tini_ids'] : '';

            // 기본 SQL 쿼리
            $sql = "SELECT g.id, g.title, g.content, u.user_nickname, g.reg_date, g.hit
                    FROM tini_goods_info g
                    JOIN tbl_user u ON g.user_id = u.id";

            // tini_ids가 설정되었을 경우 IN 조건 추가
            if ($tini_ids) {
                $sql .= " WHERE g.tini_id IN ($tini_ids)";  // IN 조건 추가
            }

            // 게시글 조회
            $result = mysqli_query($conn, $sql);
            $total_record = mysqli_num_rows($result);  // 총 글 수

            $scale = 10;
            $total_page = ceil($total_record / $scale);  // 전체 페이지 수 계산

            // 시작 인덱스 계산
            $start = ($page - 1) * $scale;
            $number = $total_record - $start;

            // 게시글 리스트 출력
            for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
                mysqli_data_seek($result, $i);
                $row = mysqli_fetch_array($result);
                $id = $row["id"];
                $title = $row["title"];
                $name = $row["user_nickname"];
                $reg_date = $row["reg_date"];
                $hit = $row["hit"];
        ?>
        <li>
            <span class="col1"><?= $number ?></span>
            <span class="col2"><a href="TINi_goods_view.php?id=<?= $id ?>&page=<?= $page ?>"><?= $title ?></a></span>
            <span class="col3"><?= $name ?></span>
            <span class="col5"><?= $reg_date ?></span>
            <span class="col6"><?= $hit ?></span>
        </li>
        <?php
                $number--;
            }
            mysqli_close($conn);
        ?>
    </ul>

    <!-- 페이지 번호 -->
    <ul id="page_num">
        <?php
        if ($total_page >= 2 && $page >= 2) {
            $new_page = $page - 1;
            echo "<li><a href='TINi_goods.php?page=$new_page&tini_ids=$tini_ids'>◀ 이전</a></li>";
        } else {
            echo "<li>&nbsp;</li>";
        }

        // 페이지 번호 출력
        for ($i = 1; $i <= $total_page; $i++) {
            if ($page == $i)
                echo "<li><b> $i </b></li>";
            else
                echo "<li><a href='TINi_goods.php?page=$i&tini_ids=$tini_ids'> $i </a></li>";
        }

        if ($total_page >= 2 && $page != $total_page) {
            $new_page = $page + 1;
            echo "<li><a href='TINi_goods.php?page=$new_page&tini_ids=$tini_ids'>다음 ▶</a></li>";
        } else {
            echo "<li>&nbsp;</li>";
        }
        ?>
    </ul>
    <ul class="buttons">
				<li>
					<?php
						session_start();
						if (isset($_SESSION['id'])) {
							echo "<a href='TINi_goods_write.php' class='letter-button'>작성하기</a>";
						}
					?>
				</li>
			</ul>
</div>

<script>
    // 버튼 클릭 시 필터링
    function filterPosts(tiniId) {
        let selectedTiniIds = new URLSearchParams(window.location.search).get('tini_ids');
        if (selectedTiniIds) {
            selectedTiniIds = selectedTiniIds.split(',');
        } else {
            selectedTiniIds = [];
        }

        if (selectedTiniIds.includes(String(tiniId))) {
            // 이미 선택된 경우 해제
            selectedTiniIds = selectedTiniIds.filter(id => id !== String(tiniId));
        } else {
            // 선택되지 않은 경우 추가
            selectedTiniIds.push(tiniId);
        }

        // 새로고침하여 URL 업데이트
        window.location.href = "TINi_goods.php?tini_ids=" + selectedTiniIds.join(',');
    }
</script>