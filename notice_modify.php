<?php
    include 'config/db.php';
    $id = $_GET["id"];
    $page = $_GET["page"];

    // 세션 시작
    session_start();

    // 세션에 저장된 user_id
    $user_id = $_SESSION['id'];

    // 관리자 권한 확인
    if ($_SESSION['roll'] != 'ADMIN') {
        echo "<script>alert('접근권한이 없습니다!'); window.location.href='TINi_index.php';</script>";
        exit;  // 권한이 없으면 스크립트 종료
    }

    // 게시글 정보 가져오기
    $sql = "SELECT user_id FROM tbl_notice WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_array()) {
        $post_user_id = $row['user_id'];  // 게시글 작성자의 user_id
    } else {
        echo "<script>alert('해당 게시글을 찾을 수 없습니다.'); window.location.href='TINi_notice.php';</script>";
        exit;
    }

    // 게시글 수정 권한 확인: 작성자와 세션의 user_id가 동일해야 수정 가능
    if ($user_id != $post_user_id) {
        echo "<script>alert('자신의 글만 수정할 수 있습니다.'); window.location.href='TINi_notice_view.php?id=$id&page=$page';</script>";
        exit;
    }

    // 수정된 제목과 내용 받기
    $title = $_POST["title"];
    $content = $_POST["content"];
    
    // 게시글 업데이트
    $sql = "UPDATE tbl_notice SET title = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $title, $content, $id);  // 'ssi'는 문자열 2개, 정수 1개
    $stmt->execute();

    // 연결 종료
    mysqli_close($conn);

    // 수정 후 게시글 페이지로 리디렉션
    echo "
        <script>
            location.href = 'TINi_notice_view.php?id=$id&page=$page';
        </script>
    ";
?>