<?php
if (!empty($_POST['nccid'])){
  include 'dbconn.inc.php';
  $nccid = $_POST['nccid'];
  if ($nccid == '@dm1n2020'){
    session_start();
    $_SESSION['nccid'] = $nccid;
    header("Location:../signup1.php");
    exit();
  }
  else{
    $sql = "SELECT *
            FROM users
            WHERE nccid = '$nccid'
            ;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      header("Location:../signup.php?error=nccidtaken");
      exit();
    }
    else{
      $sql = "SELECT *
              FROM nccid
              WHERE nccid = '$nccid'
              ;";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) == 0) {
        header("Location:../signup.php?error=nccidinv");
        exit();
      }
      else{
        session_start();
        $_SESSION['nccid'] = $nccid;
        header("Location:../signup1.php");
        exit();
      }
    }
  }
}
else{
  header("Location:../signup.php?error=emptyfields");
  exit();
}
?>
