<?php
include 'config/db.php';
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
    echo "<script>alert('로그인이 필요합니다!'); window.location.href='TINi_index.php';</script>";
    exit;
}

$user_id = $_SESSION['id'];
$username = $_SESSION['name'];

$subject = $_POST['title'] ?? null;
$content = $_POST['content'] ?? null;
$place_name = $_POST['place_name'] ?? null;
$tini_id = $_POST['tini_id'] ?? null; 

if (!$subject || !$content || !$place_name || !$tini_id) {
    echo "<script>alert('제목, 내용, 장소, 티니핑 ID를 모두 입력하세요!'); history.back();</script>";
    exit;
}

$subject = mysqli_real_escape_string($conn, $subject);
$content = mysqli_real_escape_string($conn, $content);
$place_name = mysqli_real_escape_string($conn, $place_name); 
$tini_id = (int)$tini_id; 

try {
    // SQL 쿼리 생성
    $sql = "
        INSERT INTO tini_goods_info (title, content, place_name, reg_date, user_id, tini_id, hit)
        VALUES ('$subject', '$content', '$place_name', NOW(), '$user_id', '$tini_id', 0)";

    // 쿼리 실행
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('글이 성공적으로 저장되었습니다.'); window.location.href='TINi_goods.php';</script>";
    } else {
        echo "<script>alert('글 저장에 실패했습니다.'); history.back();</script>";
    }

    // DB 연결 종료
    mysqli_close($conn);
} catch (Exception $e) {
    echo "<script>alert('글 저장에 실패했습니다: " . $e->getMessage() . "'); history.back();</script>";
}
?>