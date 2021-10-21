<?php
if (isset($_POST['nccid'])){
  include 'dbconn.inc.php';
  $nccid = $_POST['nccid'];

  $sql = "DELETE FROM nccid WHERE nccid = '$nccid';
          DELETE FROM users WHERE nccid = '$nccid';";
  $result = mysqli_multi_query($conn,$sql);
  if ($result){
    header("Location:../users_admin.php?successdel=".$nccid);
    exit();
  }
  else{
    header("Location:../users_admin.php?error=sqlerror");
    exit();
  }
}

?>
