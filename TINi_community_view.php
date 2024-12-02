<?php
	include 'config/db.php';
	session_start();

	$userid = $_SESSION['userid'];
	$id = $_GET["id"]; // URL 파라미터에서 가져온 id
	$page = $_GET["page"];

	$sql = "SELECT b.id, b.title, b.content, u.user_nickname AS nickname, b.reg_date, b.hit , u.id user_id
			FROM tbl_board b 
			JOIN tbl_user u ON b.user_id = u.id 
			WHERE b.id = ?";
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

	// HTML 콘텐츠 그대로 출력하려면, htmlspecialchars을 사용하지 말고 그대로 출력
	$content = $content;

	// 조회수 증가
	$new_hit = $hit + 1;
	$sql = "UPDATE tbl_board SET hit = ? WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii", $new_hit, $id);
	$stmt->execute();

	// 댓글 조회
	$comment_sql = "SELECT c.content, c.reg_date, u.user_nickname
                    FROM tbl_board_comment c
                    JOIN tbl_user u ON c.user_id = u.id
                    WHERE c.board_id = ? ORDER BY c.reg_date DESC";
	$comment_stmt = $conn->prepare($comment_sql);
	$comment_stmt->bind_param("i", $id);
	$comment_stmt->execute();
	$comment_result = $comment_stmt->get_result();
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
            커뮤니티 > 내용보기
        </h3>
        <ul id="view_content">
            <li>
                <span class="col1"><b>제목 :</b> <?=$title?></span>
                <span class="col2"><?=$nickname?> | <?=$reg_date?></span>
            </li>
            <li>
                <!-- 여기에서 HTML 태그를 그대로 출력합니다 -->
                <div class="content"><?=$content?></div>
            </li>
        </ul>

        <!-- 댓글 작성 폼 -->
        <div id="comment_section">
            <h4>댓글 작성</h4>
            <form action="board_comment_insert.php" method="post">
                <textarea name="comment" rows="4" style="width: 100%;" placeholder="댓글을 작성하세요"></textarea>
                <input type="hidden" name="board_id" value="<?=$id?>">
                <button type="submit" class="letter-button">댓글 작성</button>
            </form>
        </div>

        <!-- 댓글 목록 -->
        <div id="comments">
            <h4>댓글 목록</h4>
            <?php while($comment = $comment_result->fetch_assoc()): ?>
                <div class="comment">
                    <p><strong><?=$comment['user_nickname']?>:</strong> <?=$comment['content']?></p>
                    <span class="comment-date"><?=$comment['reg_date']?></span>
                </div>
            <?php endwhile; ?>
        </div>

        <ul class="buttons">
            <li>
                <?php 
                if ($userid == $board_userid) {
                ?>
                  <a class="letter-button" href="TINi_community_modify_form.php?id=<?=$id?>&page=<?=$page?>">수정하기</a>
                  <a class="letter-button" href="community_delete.php?id=<?=$id?>&page=<?=$page?>">삭제하기</a>
                <?php
                } 
                ?>
            </li>
            <li ><a class="letter-button" onclick="history.back();">뒤로가기</a></li>
        </ul>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "TINi_footer.php";?>
</footer>
</body>
<script src="./js/modal.js"></script>
</html>