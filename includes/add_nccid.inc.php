<?php
include 'dbconn.inc.php';
if (!empty($_POST['nccid'])){
  $nccid = $_POST['nccid'];

  $sql = "SELECT COUNT(*)
          FROM nccid
          WHERE nccid = '$nccid'
          ;";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $a = $row['COUNT(*)'];
  }
  if ($a > 0){
    header("Location:../users_admin.php?error=nccidexist");
    exit();
  }
  else{
    $query = "INSERT INTO nccid (nccid) VALUES ('".$nccid."');";
    $result = $mysqlidb->sql_insert_update($query);
    if ($result){
      header("Location:../users_admin.php?success=".$nccid."");
      exit();
    }
    else{
      header("Location:../users_admin.php?error=sqlerror");
      exit();
    }
  }
}
else{
  header("Location:../users_admin.php?error=emptyfields");
  exit();
}

?>
