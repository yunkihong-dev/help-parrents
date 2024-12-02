<?php
    $id = $_GET["id"];
    $page = $_GET["page"];

    include 'config/db.php';

    if (!is_numeric($id)) {
        echo "<script>alert('잘못된 접근입니다.'); location.href='TINi_ask.php?page=$page';</script>";
        exit;
    }

    // 게시글 정보 조회
    $sql = "SELECT * FROM tbl_opinion WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 게시글 삭제
        $sql = "DELETE FROM tbl_opinion WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        echo "<script>
            alert('글이 삭제되었습니다');
            location.href = 'TINi_ask.php?page=$page';
        </script>";
    } else {
        echo "<script>alert('게시글을 찾을 수 없습니다.'); location.href = 'TINi_ask.php?page=$page';</script>";
    }

    $stmt->close();
    mysqli_close($conn);
?>