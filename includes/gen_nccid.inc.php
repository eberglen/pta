<?php
if(isset($_POST['generate'])){
  include 'dbconn.inc.php';

  $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // and any other characters
  shuffle($seed); // probably optional since array_is randomized; this may be redundant
  $rand = '';
  foreach (array_rand($seed, 3) as $k) $rand .= $seed[$k];
  //echo $rand;
  $om = rand(10000, 99999);
  echo $random = $rand.$om;


  $sql = "SELECT COUNT(*)
          FROM nccid
          WHERE nccid = '$rand'
          ;";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $a = $row['COUNT(*)'];
  }

  if ($a >= 1){
    header("Location:../users_admin.php?error=nccidexist");
    exit();
  }
  else{
    $sql = "INSERT INTO nccid(nccid)
            VALUES ('$random')
            ;";
    $result = $mysqlidb->sql_insert_update($sql);
    if ($result){
      header("Location:../users_admin.php?successgen=".$random."");
      exit();
    }
  }
}
 ?>
