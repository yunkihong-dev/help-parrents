<?php
    include 'config/db.php';  // DB 연결
    $id = $_GET["id"];
    $page = $_GET["page"];

    session_start();

    $user_id = $_SESSION['id'];

    $sql = "SELECT user_id FROM tbl_board WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_array()) {
        $post_user_id = $row['user_id'];
    } else {
        echo "<script>alert('해당 게시글을 찾을 수 없습니다.'); window.location.href='TINi_community.php';</script>";
        exit;
    }

    // 게시글 수정 권한 확인
    if ($user_id != $post_user_id) {
        echo "<script>alert('자신의 글만 수정할 수 있습니다.'); window.location.href='TINi_community_view.php?id=$id&page=$page';</script>";
        exit;
    }

    $title = $_POST["title"];
    $content = $_POST["content"];
    
    $sql = "UPDATE tbl_board SET title = ?, content = ?, hit = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $hit = 0;  
    $stmt->bind_param('ssii', $title, $content, $hit, $id); 
    $stmt->execute();

    mysqli_close($conn);

    echo "
        <script>
            alert('수정 완료');
            location.href = 'TINi_community_view.php?id=$id&page=$page';
        </script>
    ";
?>