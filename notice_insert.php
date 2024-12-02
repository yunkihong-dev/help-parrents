<?php
include 'config/db.php';
session_start();

// 오류 출력 활성화 (개발 환경에서만 활성화)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 로그인 확인
if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
    echo "<script>alert('로그인이 필요합니다!'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['id'];
$username = $_SESSION['name'];

// 관리자인지 확인
if ($_SESSION['roll'] !== 'ADMIN') {
    echo "<script>alert('권한이 없습니다!'); window.location.href='TINi_notice.php';</script>";
    exit;
}

// POST 데이터 가져오기
$subject = $_POST['title'] ?? null;
$content = $_POST['content'] ?? null;

// 데이터 유효성 검사
if (!$subject || !$content) {
    echo "<script>alert('제목과 내용을 모두 입력하세요!'); history.back();</script>";
    exit;
}

// MySQL 데이터베이스에 데이터 삽입
$subject = mysqli_real_escape_string($conn, $subject); // 제목 escaping
$content = mysqli_real_escape_string($conn, $content); // 내용 escaping

try {
    // SQL 쿼리 생성
    $sql = "
        INSERT INTO tbl_notice (title, content, reg_date, user_id, hit)
        VALUES ('$subject', '$content', NOW(), '$user_id', 0)";

    // 쿼리 실행
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('글이 성공적으로 저장되었습니다.'); window.location.href='TINi_notice.php';</script>";
    } else {
        echo "<script>alert('글 저장에 실패했습니다.'); history.back();</script>";
    }

    // DB 연결 종료
    mysqli_close($conn);
} catch (Exception $e) {
    echo "<script>alert('글 저장에 실패했습니다: " . $e->getMessage() . "'); history.back();</script>";
}
?>
