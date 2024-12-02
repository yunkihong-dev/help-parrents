<?php
    include 'config/db.php';
    session_start();

    // 로그인 확인 및 권한 확인
    if (!isset($_SESSION['id'])) {
        echo "<script>alert('로그인이 필요합니다!'); window.location.href='login.php';</script>";
        exit;
    }

    // ADMIN 권한 체크
    if ($_SESSION['roll'] !== 'ADMIN') {
        echo "<script>alert('관리자만 덧글을 작성할 수 있습니다.'); history.back();</script>";
        exit;
    }

    $userid = $_SESSION['userid'];
    $userlevel = $_SESSION['userlevel'];

    $id = $_GET["id"]; // URL 파라미터에서 가져온 id
    $page = $_GET["page"];

    // tbl_opinion 테이블에서 데이터 조회
    $sql = "SELECT o.id, o.title, o.content, u.user_nickname AS nickname, o.reg_date, o.hit, o.likes , o.user_id user_id
            FROM tbl_opinion o 
            JOIN tbl_user u ON o.user_id = u.id 
            WHERE o.id = ?";
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
    $board_userid = $row["user_id"];

    // HTML 콘텐츠 그대로 출력
    $content = $content;

    // 조회수 증가
    $new_hit = $hit + 1;
    $sql = "UPDATE tbl_opinion SET hit = ? WHERE id = ?";
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
</head>
<body> 
<header>
    <?php include "TINi_header.php";?>
</header>  
<section>
    <div id="board_box">
        <h3 class="title">
            문의사항 > 내용보기
        </h3>
        <ul id="view_content">
            <li>
                <span class="col1"><b>제목 :</b> <?=$title?></span>
                <span class="col2"><?=$nickname?> | <?=$reg_date?></span>
            </li>
            <li>
                <div class="content"><?=$content?></div>
            </li>
        </ul>
        <ul class="buttons">
            <li>
                <?php   
                    if ($userid == $board_userid) {
                ?>           
                    <a class="letter-button" href="TINi_ask_modify_form.php?id=<?=$id?>&page=<?=$page?>">수정하기</a>
                    <a class="letter-button" href="ask_delete.php?id=<?=$id?>&page=<?=$page?>">삭제하기</a>
                <?php
                    } 
                ?>
            </li>
            <li><a class="letter-button" onclick="history.back();">뒤로가기</a></li>
        </ul>

        <!-- 댓글 작성 폼 (ADMIN만 작성 가능) -->
        <?php if ($_SESSION['roll'] === 'ADMIN') { ?>
        <div id="comment_section">
            <h4>댓글 작성</h4>
            <form action="ask_comment_insert.php" method="POST">
                <textarea name="comment" placeholder="댓글을 작성해주세요" required></textarea><br>
                <input type="hidden" name="opinion_id" value="<?=$id?>">
                <button type="submit" class="letter-button">댓글 작성</button>
            </form>
        </div>
        <?php } else { ?>
            <p>댓글 작성은 관리자만 가능합니다.</p>
        <?php } ?>

        <!-- 댓글 목록 -->
        <div id="comments">
            <?php
            // 댓글 조회
            $comment_sql = "SELECT c.content, c.reg_date, u.user_nickname 
                            FROM tbl_opinion_comment c
                            JOIN tbl_user u ON c.user_id = u.id
                            WHERE c.opinion_id = ? ORDER BY c.reg_date DESC";
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
        </div> <!-- comments -->
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "TINi_footer.php";?>
</footer>
</body>

<script src="./js/modal.js"></script>
</html>