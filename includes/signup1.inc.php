<?php
session_start();
if (!empty($_POST['fname']) && !empty($_POST['mname']) && !empty($_POST['lname']) && !empty($_POST['birth']) && !empty($_POST['email']) && !empty($_POST['mnum']) && !empty($_POST['gym']) && !empty($_POST['inst']) && !empty($_POST['reg']) && ($_POST['belt'] != '') && ($_POST['gender'] != '') && !empty($_POST['divi']) && !empty($_POST['pwd']) && !empty($_POST['rpt_pwd']) && isset($_SESSION['nccid'])){
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
  $pwd = $_POST['pwd'];
  $rpt_pwd = $_POST['rpt_pwd'];
  $nccid = $_SESSION['nccid'];

	if ($pwd !== $rpt_pwd){
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Passwords do not match. </strong>Please check the passwords.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>';
	}
      else{
        $sql = "INSERT INTO users (nccid, fname, mname, lname, birth, email, mnum, gym, instructor, region, belt_level, gender, division, password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>ERROR. </strong>SQL error.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
      }
      else{

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $nccid, $fname, $mname, $lname, $birth, $email, $mnum, $gym, $inst, $reg, $belt, $gender, $divi, $hashedPwd);
        mysqli_stmt_execute($stmt);
        session_unset();
        session_destroy();

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>User created successfully. Please wait for approval of your account, thank you!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="wind_ref()">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';

      }
    }

}
else{
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Warning: </strong>Empty fields.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';
}

?>
