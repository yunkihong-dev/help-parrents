<?php
    
    $id   = $_GET["id"];
    $page   = $_GET["page"];

    include 'config/db.php';

    $sql = "select * from tbl_board where id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $sql = "delete from tbl_board where id = $id";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    echo "
	     <script>
            alert('글이 삭제되었습니다');
            location.href = 'TINi_community.php?page=$page';
	     </script>
	   ";
?>
