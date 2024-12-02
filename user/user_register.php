<?php
    include '../config/db.php';

    $email = $_POST['email'];
    $password = $_POST['password'] ;
    $nickname = $_POST['nickname'] ;

    $sql = "INSERT INTO tbl_user (user_email, user_password, user_nickname, user_roll) VALUES('$email', '$password', '$nickname', 'user')";
	
    mysqli_query($conn, $sql);
    mysqli_close($conn);     

    echo "
	      <script>
                  alert('회원가입이 완료되었습니다!');
	          location.href = '../TINi_index.php';
	      </script>
	  ";
?>