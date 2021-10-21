<?php
session_start();
if (!empty($_POST['fname']) && !empty($_POST['mname']) && !empty($_POST['lname']) && !empty($_POST['birth']) && !empty($_POST['email']) && !empty($_POST['mnum']) && !empty($_POST['gym']) && !empty($_POST['inst']) && !empty($_POST['reg']) && ($_POST['belt'] != '') && ($_POST['gender'] != '') && !empty($_POST['divi']) && isset($_POST['user_num'])){
  require 'dbconn.inc.php';
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $birth = $_POST['birth'];
  $email = $_POST['email'];
  $mnum = $_POST['mnum'];
  $gym = $_POST['gym'];
  $inst = $_POST['inst'];
  $reg = $_POST['reg'];
  $belt = $_POST['belt'];
  $gender = $_POST['gender'];
  $divi = $_POST['divi'];
  $un = $_POST['user_num'];

        $sql = "UPDATE users SET fname = ?, mname = ?, lname = ?, birth = ?, email = ?, mnum = ?, gym = ?, instructor = ?, region = ?, belt_level = ?, gender = ?, division = ? WHERE user_num = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location:../users_admin.php?error=sqlerror");
          exit();
      }
      else{

        mysqli_stmt_bind_param($stmt, "sssssssssssss", $fname, $mname, $lname, $birth, $email, $mnum, $gym, $inst, $reg, $belt, $gender, $divi, $un);
        mysqli_stmt_execute($stmt);
        header("Location:../users_admin.php?success=updated");
        exit();

      }


}
else{
  header("Location:../users_admin.php?error=emptyfields");
  exit();
}

?>
