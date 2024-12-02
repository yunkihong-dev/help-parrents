<?php
include 'config/db.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>alert('로그인이 필요합니다!'); window.location.href='TINi_index.php';</script>";
    exit;
}

$userid = $_SESSION['id'];
$comment = $_POST['comment'] ?? null;
$board_id = $_POST['board_id'] ?? null;

if (!$comment || !$board_id) {
    echo "<script>alert('댓글을 작성해주세요.'); history.back();</script>";
    exit;
}

$comment = mysqli_real_escape_string($conn, $comment); // escaping for SQL

$sql = "INSERT INTO tbl_board_comment (content, board_id, reg_date, user_id)
        VALUES ('$comment', '$board_id', NOW(), '$userid')";

if (mysqli_query($conn, $sql)) {
    echo "<script>window.location.href='TINi_community_view.php?id=$board_id&page=1';</script>";
} else {
    echo "<script>alert('댓글 작성에 실패했습니다.'); history.back();</script>";
}

mysqli_close($conn);
?>