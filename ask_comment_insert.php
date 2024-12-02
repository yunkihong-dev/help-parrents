<?php
    include 'config/db.php';
    session_start();

    // 로그인 확인
    if (!isset($_SESSION['id'])) {
        echo "<script>alert('로그인이 필요합니다!'); window.location.href='login.php';</script>";
        exit;
    }

    // 댓글 및 게시글 ID 가져오기
    $userid = $_SESSION['id'];
    $comment = $_POST['comment'] ?? null;
    $opinion_id = $_POST['opinion_id'] ?? null;

    // 필수 값 확인
    if (!$comment || !$opinion_id) {
        echo "<script>alert('댓글을 작성해주세요.'); history.back();</script>";
        exit;
    }

    // SQL 인젝션 방지
    $comment = mysqli_real_escape_string($conn, $comment); // escaping for SQL

    // 댓글 저장 SQL
    $sql = "INSERT INTO tbl_opinion_comment (content, opinion_id, user_id, reg_date)
            VALUES ('$comment', '$opinion_id', '$userid', NOW())";

    // 댓글 저장 성공 여부 확인
    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location.href='TINi_ask_view.php?id=$opinion_id&page=1';</script>";
    } else {
        echo "<script>alert('댓글 작성에 실패했습니다.'); history.back();</script>";
    }

    // 데이터베이스 연결 종료
    mysqli_close($conn);
?>