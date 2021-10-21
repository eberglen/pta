<?php
session_start();
if (isset($_SESSION['fname'])){
  header("Location:./home_admin.php?");
  exit();
}
else if(isset($_SESSION['nccid'])){
  require 'includes/dbconn.inc.php';
  $user_num = $_SESSION['user_num'];


?>
<!doctype html>
<html lang="en">
<head>
  <title>Philippine Taekwondo Association</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="mdbootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="mdbootstrap/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="mdbootstrap/css/style.css" rel="stylesheet">
  <script type="text/javascript" src="mdbootstrap/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="mdbootstrap/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="mdbootstrap/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="mdbootstrap/js/mdb.min.js"></script>
  <?php require 'includes/header.inc.php'; ?>
<body>
<div class="container shadow mt-5 pt-3 animated fadeIn faster">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="user.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="tournaments_user.php">My Tournaments</a>
    </li>
  </ul><br>
    <div name="q_results" id="q_results">
  <?php
  $sql = "SELECT title, tour_category, DATE_FORMAT(dstart, '%M %e, %Y') as dstart, DATE_FORMAT(dend, '%M %e, %Y') as dend, location
          FROM users, tournament, tour_users
          WHERE users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          AND tour_users.user_num = $user_num
          ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    echo '<div class="table-responsive">
    <table class="table table-hover">
<thead>
<tr>
<th scope="col">Title</th>
<th scope="col">Tournament Category</th>
<th scope="col">Start</th>
<th scope="col">End</th>
<th scope="col">Location</th>

</tr>
</thead>
<tbody>';
    while($row = mysqli_fetch_assoc($result)) {
      $title = $row['title'];
      $tour_category = $row['tour_category'];
      $dstart = $row['dstart'];
      $dend = $row['dend'];
      $loc = $row['location'];

      echo '

      <tr>
      <th scope="row">'.$title.'</th>
      <td>'.$tour_category.'</td>
      <td>'.$dstart.'</td>
      <td>'.$dend.'</td>
      <td>'.$loc.'</td>
      </tr>

      ';

    }
    echo '</tbody>
  </table>
  </div>';
  }

   ?>
</div>
</body>
</html>
<?php
}
else{
  header("Location:./index.php?");
  exit();
}

?>
