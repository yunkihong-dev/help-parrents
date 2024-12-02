<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 60px;
   cursor:pointer;
}
</style>
</head>
<body>
   <?php
   $type = $_GET["type"];
   echo $type == "email" ? "<h3>이메일 중복체크</h3>" : ($type == "nickname" ? "<h3>닉네임 중복체크</h3>" : "");
   ?>
<p>
<?php
    include '../config/db.php';

   $type = $_GET["type"];
   $value = $_GET["value"];

   if(!$value) 
   {
      echo("<li>값을 입력해 주세요!</li>");
   }
   else
   {
      if($type == "email"){
        $sql = "select * from tbl_user where user_email='$value'";
        $result = mysqli_query($conn, $sql);

        $num_record = mysqli_num_rows($result);

        if ($num_record)
        {
            echo "<li>".$value." 아이디는 중복됩니다.</li>";
            echo "<li>다른 아이디를 사용해 주세요!</li>";
        }
        else
        {
            echo "<li>".$value." 아이디는 사용 가능합니다.</li>";
        }
        
        mysqli_close($con);
      }else if($type == "nickname"){
         $sql = "select * from tbl_user where user_nickname='$value'";
         $result = mysqli_query($conn, $sql);
 
         $num_record = mysqli_num_rows($result);
 
         if ($num_record)
         {
             echo "<li>".$value." 닉네임은 중복됩니다.</li>";
             echo "<li>다른 닉네임을 사용해 주세요!</li>";
         }
         else
         {
             echo "<li>".$value." 닉네임은 사용 가능합니다.</li>";
         }
         
         mysqli_close($con);
      }
    }
?>
</p>
<div id="close">
   <img src="./img/close2.png" onclick="javascript:self.close()">
</div>
</body>
</html>

