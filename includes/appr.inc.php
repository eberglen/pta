<?php
if(isset($_POST['user_num'])){
  include 'dbconn.inc.php';
  $un = $_POST['user_num'];

  $sql = "UPDATE users
          SET approval = 'approved'
          WHERE user_num = $un;";
  $result = $mysqlidb->sql_insert_update($sql);
  if ($result){
    header("Location:../users_admin.php");
    exit();
  }
  else{
    header("Location:../users_admin.php?error=sqlerror");
    exit();
  }
}

?>
