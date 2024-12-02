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

if (!$subject || !$content) {
    echo "<script>alert('제목과 내용을 모두 입력하세요!'); history.back();</script>";
    exit;
}

$subject = mysqli_real_escape_string($conn, $subject);
$content = mysqli_real_escape_string($conn, $content); 

try {
    $sql = "
        INSERT INTO tbl_board (title, content, reg_date, user_id, hit)
        VALUES ('$subject', '$content', NOW(), '$user_id', 0)";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('글이 성공적으로 저장되었습니다.'); window.location.href='TINi_community.php';</script>";
    } else {
        echo "<script>alert('글 저장에 실패했습니다.'); history.back();</script>";
    }

    // DB 연결 종료
    mysqli_close($conn);
} catch (Exception $e) {
    echo "<script>alert('글 저장에 실패했습니다: " . $e->getMessage() . "'); history.back();</script>";
}
?>
