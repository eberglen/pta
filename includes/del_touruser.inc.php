<?php
if (isset($_POST['user_num']) && isset($_POST['tour_num'])){
  include 'dbconn.inc.php';
  $user_num = $_POST['user_num'];
  $tour_num = $_POST['tour_num'];
  $sql = "DELETE FROM tour_users WHERE user_num = $user_num AND tour_num = $tour_num;";
  $result = $mysqlidb->sql_insert_update($sql);
  if ($result){
    header("Location:../tournaments_admin.php?success=deleted");
    exit();
  }
  else{
    header("Location:../tournaments_admin.php?error=sqlerror");
    exit();
  }

}
 ?>
