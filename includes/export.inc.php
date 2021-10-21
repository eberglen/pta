<?php
if (!empty($_POST['tour_num'])){
  include 'dbconn.inc.php';
  $tour_num = $_POST['tour_num'];
  $sql = "SELECT title
          FROM tournament
          WHERE tour_num = $tour_num
          ;";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $title = $row['title'];
  }

  echo '
  <div class="row">
    <div class="col-md-12"><br>
    <div class="table-responsive">
      <table class="table table-bordered" id="exportTable" name="exportTable">
        <thead>
          <tr>
            <th colspan="6">'.$title.' Registrants</th>
          </tr>
          <tr>
            <th scope="col">NCCID</th>
            <th scope="col">First Name</th>
            <th scope="col">Middle Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Belt</th>
            <th scope="col">Division</th>
          </tr>
        </thead>
        <tbody>
  ';

  $sql = "SELECT *
          FROM users, tour_users
          WHERE users.user_num = tour_users.user_num
          AND tour_num = $tour_num
          ;";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $nccid = $row['nccid'];
    $mn = $row['mname'];
    $fn = $row['fname'];
    $ln = $row['lname'];
    $belt = $row['belt_level'];
    $divi = $row['division'];
    echo '
    <tr>
      <td>'.$nccid.'</td>
      <td>'.$fn.'</td>
      <td>'.$mn.'</td>
      <td>'.$ln.'</td>
      <td>'.$belt.'</td>
      <td>'.$divi.'</td>
    </tr>
    ';
  }
  echo '
  </tbody>
</table>
</div>
<button class="btn btn-info" id="btnExport" onclick="fnExcelReport();"><i class="fas fa-file-export">Export</i></button>
</div>
</div>
  ';
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
