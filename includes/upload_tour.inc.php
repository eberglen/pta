<?php
if (!empty($_POST['title']) && $_POST['tour_cat'] != '' && !empty($_POST['dstart']) && !empty($_POST['dend']) && !empty($_POST['loc'])){
  require 'dbconn.inc.php';
  $title = $_POST['title'];
  $tour_cat = $_POST['tour_cat'];
  $dstart = $_POST['dstart'];
  $dend = $_POST['dend'];
  $loc = $_POST['loc'];
  $description = $_POST['description'];
  date_default_timezone_set("Asia/Hong_Kong");
  $date_posted=date("Y-m-d H:i:s");
  $sql = "INSERT INTO tournament (title, tour_category, dstart, dend, date_posted, location, description) VALUES (?,?,?,?,?,?,?)";
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

  mysqli_stmt_bind_param($stmt, "sssssss", $title, $tour_cat, $dstart, $dend, $date_posted, $loc, $description);
  mysqli_stmt_execute($stmt);
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success! </strong>Tournament posted successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="wind_ref()">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>';

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
