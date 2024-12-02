<?php

    include '../config/db.php';

    $email   = $_POST["email"];
    $password = $_POST["password"];

   $sql = "select * from tbl_user where user_email='$email'";
   $result = mysqli_query($conn, $sql);

   $num_match = mysqli_num_rows($result);

   if(!$num_match) 
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다!')
             history.go(-1)
           </script>
         ");
    }
    else
    {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["user_password"];

        mysqli_close($conn);

        if($password != $db_pass)
        {

           echo("
              <script>
                window.alert('비밀번호가 틀립니다!')
                history.go(-1)
              </script>
           ");
           exit;
        }
        else
        {
            session_start();
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["name"] = $row["user_nickname"];
            $_SESSION["roll"] = $row["user_roll"];

            echo("
              <script>
             history.go(-1);
              </script>
            ");
        }
     }        
?>
