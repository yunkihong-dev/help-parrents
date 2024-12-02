<?php
  session_start();

  unset($_SESSION["id"]);
  unset($_SESSION["email"]);
  unset($_SESSION["name"]);
  unset($_SESSION["roll"]);
  
  echo("
       <script>
          location.href = '../TINi_index.php';
         </script>
       ");
?>
