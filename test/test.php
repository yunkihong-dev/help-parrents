<?php
// db 테스트
include '../config/db.php';

// 결과 출력 (테이블 형식)
try{
    // 쿼리 작성
    $sql = "SELECT * FROM tbl_user";
    $result = mysqli_query($conn, $sql);
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>user_nickname</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['user_nickname'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}catch(Exception $e){
    echo "쿼리가 안되는거같네요..";
}


// 연결 종료
mysqli_close($connect);
?>
