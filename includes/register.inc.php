<?php
if (isset($_POST['tour_num']) && isset($_POST['user_num'])){
  require 'dbconn.inc.php';
  $user_num = $_POST['user_num'];
  $tour_num = $_POST['tour_num'];
  $sql = "INSERT INTO tour_users
          VALUES ($user_num, $tour_num);
          ";
  $result = $mysqlidb->sql_insert_update($sql);
  if($result){
    header("Location:../user.php?success=registered");
    exit();
  }else{
    header("Location:../user.php?error=sqlerror");
    exit();
  }
}
?>
