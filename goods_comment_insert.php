<?php
include 'config/db.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>alert('로그인이 필요합니다!'); window.location.href='TINi_index.php';</script>";
    exit;
}

$userid = $_SESSION['id'];
$comment = $_POST['comment'] ?? null;
$goods_id = $_POST['goods_id'] ?? null;

if (!$comment || !$goods_id) {
    echo "<script>alert('댓글을 작성해주세요.'); history.back();</script>";
    exit;
}

$comment = mysqli_real_escape_string($conn, $comment); // escaping for SQL

$sql = "INSERT INTO tbl_goods_comment (content, goods_id, user_id, reg_date)
        VALUES ('$comment', '$goods_id', '$userid', NOW())";

if (mysqli_query($conn, $sql)) {
    echo "<script>window.location.href='TINi_goods_view.php?id=$goods_id&page=1';</script>";
} else {
    echo "<script>alert('댓글 작성에 실패했습니다.'); history.back();</script>";
}

mysqli_close($conn);
?>