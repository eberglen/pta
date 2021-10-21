<?php
if (isset($_POST['tour_num'])){
  include 'dbconn.inc.php';
  $tour_num = $_POST['tour_num'];

  $sql = "DELETE FROM tournament WHERE tour_num = $tour_num;
          DELETE FROM tour_users WHERE tour_num = $tour_num;";
  $result = mysqli_multi_query($conn, $sql);
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
