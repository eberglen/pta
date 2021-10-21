<?php
session_start();
if (isset($_SESSION['fname'])){
require 'includes/dbconn.inc.php';

$sql = "SELECT COUNT(*)
        FROM tournament, tour_users, users
        WHERE tournament.tour_num = tour_users.tour_num
        AND tour_users.user_num = users.user_num
        AND tour_category = 'Kyorugi'
        GROUP BY tournament.tour_num
        ;";
$result = mysqli_query($conn, $sql);
$ave_kyo = 0;
$ave_poom = 0;
if (mysqli_num_rows($result) > 0){
  $i = 0;
  $ctr = 0;
  $ave = 0;
  while($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $ctr = $ctr + $row['COUNT(*)'];
  }
  $ave_kyo = $ctr / $i;
}
$sql = "SELECT COUNT(*)
        FROM tournament, tour_users, users
        WHERE tournament.tour_num = tour_users.tour_num
        AND tour_users.user_num = users.user_num
        AND tour_category = 'Poomsae'
        GROUP BY tournament.tour_num
        ;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
  $i = 0;
  $ctr = 0;
  $ave = 0;
  while($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $ctr = $ctr + $row['COUNT(*)'];
  }
  $ave_poom = $ctr / $i;
}

$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND gender = 'Male'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $male = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND gender = 'Female'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $female = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND belt_level = 'White'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $white = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND belt_level = 'Yellow'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $yellow = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND belt_level = 'Green'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $green = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND belt_level = 'Blue'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $blue = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND belt_level = 'Red'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $red = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND belt_level = 'Black'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $black = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND division = 'Cadet'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $cadet = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND division = 'Grade School'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $gs = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND division = 'Junior'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $jr = $row['COUNT(*)'];
}
$sql = "SELECT COUNT(*)
        FROM users
        WHERE fname <> 'Admin'
        AND division = 'Senior'
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $sr = $row['COUNT(*)'];
}
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
  <script type="text/javascript">
    //$('#sched_table').load(document.URL +  ' #sched_table');
    function submit_add(){
      var title = document.getElementById("title").value;
      var tour_cat = document.getElementById("tour_cat").value;
      var dstart = document.getElementById("dstart").value;
      var dend = document.getElementById("dend").value;
      var description = document.getElementById("description").value;
      var loc = document.getElementById("loc").value;
        $.ajax({
          type: 'POST',
          url: 'includes/upload_tour.inc.php',
          data: { title: title, tour_cat: tour_cat, dstart: dstart, dend: dend, description: description, loc: loc },
          async: false,
          success:function(html){
            $('#status').html(html);
          }
        });

    }
  </script>
  <script type="text/javascript">
    function wind_ref(){
      window.location.reload();
    }
  </script>
  <?php require 'includes/header.inc.php'; ?>
</head>
<body>
<div class="container shadow mt-5 pt-3">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="home_admin.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="users_admin.php">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="tournaments_admin.php">Tournaments</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="export_admin.php">Export</a>
    </li>
  </ul><br>
  <div class="row">
  <div class="card col-md-4" style=height:1100px;><br>
    <?php
      if ($ave_kyo > 0 || $ave_poom > 0){
        echo '
          <h2 align="center">Average Tournament Registrants</h2>
          <canvas id="doughnutChart"></canvas>
          <input type="hidden" id="ave_kyo" value="'.$ave_kyo.'">
          <input type="hidden" id="ave_poom" value="'.$ave_poom.'"><br>
        ';
      }
      if ($male > 0 || $female > 0){
        echo '
          <h2 align="center">Total Number of Users</h2>
          <canvas id="numUsers"></canvas>
          <input type="hidden" id="male" value="'.$male.'">
          <input type="hidden" id="female" value="'.$female.'"><br>
        ';
      }
      if ($white > 0 || $yellow > 0 || $green > 0 || $blue > 0 || $red > 0 || $black > 0){
        echo '
          <h2 align="center">Belts</h2>
          <canvas id="numBelts"></canvas>
          <input type="hidden" id="white" value="'.$white.'">
          <input type="hidden" id="yellow" value="'.$yellow.'">
          <input type="hidden" id="green" value="'.$green.'">
          <input type="hidden" id="blue" value="'.$blue.'">
          <input type="hidden" id="red" value="'.$red.'">
          <input type="hidden" id="black" value="'.$black.'"><br>
        ';
      }
      if ($cadet > 0 || $gs > 0 || $jr > 0 || $sr > 0){
        echo '
          <h2 align="center">Division</h2>
          <canvas id="numDivision"></canvas>
          <input type="hidden" id="cadet" value="'.$cadet.'">
          <input type="hidden" id="gs" value="'.$gs.'"><br>
          <input type="hidden" id="jr" value="'.$jr.'"><br>
          <input type="hidden" id="sr" value="'.$sr.'"><br>
        ';
      }
    ?>

  </div>
  <div class="col">
  </div>
  <div class="container shadow col-md-7">
  <button type="button" class="btn purple-gradient btn-block" data-toggle="modal" data-target="#add_tournament">
    Create Tournament
  </button><hr>
  <br>


<?php
date_default_timezone_set("Asia/Hong_Kong");
$date_today = date("Y-m-d H:i:s");
$sql = "SELECT title, tour_category, DATE_FORMAT(dstart, '%M %e, %Y') as dstart, DATE_FORMAT(dend, '%M %e, %Y') as dend, location, description, DATE_FORMAT(date_posted, '%m/%d/%y %r') as date_posted, tour_num
        FROM tournament
        WHERE dend > '$date_today'
        ORDER BY date_posted
        ;";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
  $title = $row['title'];
  $tour_cat = $row['tour_category'];
  $dstart = $row['dstart'];
  $dend = $row['dend'];
  $loc = $row['location'];
  $descr = $row['description'];
  $date_posted = $row['date_posted'];
  $tour_num = $row['tour_num'];

  echo'
  <!--First row-->

  <div class="card row mb-5">
      <!--Image column-->
<div class="col-md-12">
<div class="row">
      <div class="col-sm-2 mb-3"><br>
        <img src="includes/avatar.jpg" alt="sample image" class="avatar rounded-circle z-depth-1-half w-75">
      </div>
      <!--/.Image column-->

      <!--Content column-->
      <div class="col-sm-10 mb-3"><br>
          <a>
              <h5 class="user-name font-weight-bold">Admin</h5>
          </a>
          <!-- Rating -->
          <div class="card-data">
              <ul class="list-unstyled mb-1">
                  <li class="comment-date font-small grey-text">
                      <i class="far fa-clock-o"></i>'.$date_posted.'</li>
              </ul>
          </div>
</div>
</div>
          <p class="dark-grey-text article">
          <strong>'.$title.'</strong><br>'
          .$tour_cat.'<br>'
          .$dstart.' - '.$dend.'<br>'
          .$loc.'<br>'
          .nl2br($descr).'<br>';

          echo '
          <button type="button" class="btn btn-outline-default waves-effect btn-block" data-toggle="modal" data-target="#AV'.$tour_num.'E">Registrants</button>

          <div id="AV'.$tour_num.'E" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">';

              $sql2 = "SELECT fname, mname, lname, nccid
                      FROM tour_users, users
                      WHERE users.user_num = tour_users.user_num
                      AND tour_num = $tour_num
                      ;";
              $result2 = mysqli_query($conn, $sql2);
              if(mysqli_num_rows($result2) > 0) {
                echo '
<div class="table-responsive">
                <table class="table table-hover">
<thead>
  <tr>
    <th scope="col">NCCID</th>
    <th scope="col">First</th>
    <th scope="col">Middle</th>
    <th scope="col">Last</th>
  </tr>
</thead>
<tbody>';
                while($row2 = mysqli_fetch_assoc($result2)){
                  $fname = $row2['fname'];
                  $mname = $row2['mname'];
                  $lname = $row2['lname'];
                  $nccid = $row2['nccid'];

                  echo '

    <tr>
      <th scope="row">'.$nccid.'</th>
      <td>'.$fname.'</td>
      <td>'.$mname.'</td>
      <td>'.$lname.'</td>
    </tr>

                  ';

                }
                echo '</tbody>
              </table>
              </div>';
              }
              else{
              }
              echo '</div>
            </div>
          </div>
          ';
          echo '</p>
      </div>
      <!--/.Content column-->
  </div>
  <!--/.First row-->

  ';


}

?>
</div>
<br>
</div>
</div>
<!-- Central Modal Small -->
<div class="modal fade" id="add_tournament" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<!-- Change class .modal-sm to change the size of the modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title w-100" id="myModalLabel">Create Tournament</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <h4>Details</h4>
      <div class="row">
          <div class="col-md-12">
              <div class="md-form mb-0">
                  <input type="text" id="title" name="title" class="form-control">
                  <label for="title" class="">Title</label>
              </div>
          </div>
      </div><br>
      <div class="row">
          <div class="col-md-6">
              <div class="md-form mb-0">
                <select class="browser-default custom-select mb-4" id="tour_cat" name="tour_cat">
                    <option value="" disabled="" selected="">Select Tournament Category</option>
                    <option value="Kyorugi">Kyorugi</option>
                    <option value="Poomsae">Poomsae</option>
                </select>
              </div>
          </div>
          <div class="col-md-6">
              <div class="md-form mb-0">
                  <input type="text" id="loc" name="loc" class="form-control">
                  <label for="loc" class="">Location</label>
              </div>
          </div>
      </div><br>
      <div class="row">
        <div class="col-md-6">Start Date
          <input type="date" class="form-control" name="dstart" id="dstart">
        </div>
        <div class="col-md-6">End Date
          <input type="date" class="form-control" name="dend" id="dend">
        </div>
      </div>
      <div class="md-form amber-textarea active-amber-textarea">
        <i class="fas fa-pencil-alt prefix"></i>
        <textarea id="description" name="description" class="md-textarea form-control" rows="3"></textarea>
        <label for="description" class="">Additional Details (Optional)</label>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary btn-sm" onClick="submit_add();">Upload</button>
    </div>
    <div name="status" id="status"></div>
  </div>
</div>
</div>
<!-- Central Modal Small -->
</body>
</html>
<script>
//doughnut
var ave_kyo = document.getElementById("ave_kyo").value;
var ave_poom = document.getElementById("ave_poom").value;
var ctxD = document.getElementById("doughnutChart").getContext('2d');
var myLineChart = new Chart(ctxD, {
type: 'doughnut',
data: {
labels: ["Kyorugi", "Poomsae"],
datasets: [{
data: [ave_kyo, ave_poom],
backgroundColor: ["#F7464A", "#FDB45C"],
hoverBackgroundColor: ["#FF5A5E", "#FFC870"]
}]
},
options: {
responsive: true
}
});
//doughnut
var male = document.getElementById("male").value;
var female = document.getElementById("female").value;
var ctxD = document.getElementById("numUsers").getContext('2d');
var myLineChart = new Chart(ctxD, {
type: 'doughnut',
data: {
labels: ["Male", "Female"],
datasets: [{
data: [male, female],
backgroundColor: ["#949FB1", "#4D5360"],
hoverBackgroundColor: ["#A8B3C5", "#616774"]
}]
},
options: {
responsive: true
}
});
//doughnut
var white = document.getElementById("white").value;
var yellow = document.getElementById("yellow").value;
var green = document.getElementById("green").value;
var blue = document.getElementById("blue").value;
var red = document.getElementById("red").value;
var black = document.getElementById("black").value;
var ctxD = document.getElementById("numBelts").getContext('2d');
var myLineChart = new Chart(ctxD, {
type: 'doughnut',
data: {
labels: ["Red", "Yellow", "White", "Green", "Blue", "Black"],
datasets: [{
data: [red, yellow, white, green, blue, black],
backgroundColor: ["#F7464A", "#FDB45C", "#f0f0f7", "#46BFBD", "#576cd9", "#1c1c1f"],
hoverBackgroundColor: ["#FF5A5E", "#FFC870", "#f2f2fc", "#FFC870", "#5e75eb", "#29292e"]
}]
},
options: {
responsive: true
}
});
//doughnut
var cadet = document.getElementById("cadet").value;
var gs = document.getElementById("gs").value;
var jr = document.getElementById("jr").value;
var sr = document.getElementById("sr").value;
var ctxD = document.getElementById("numDivision").getContext('2d');
var myLineChart = new Chart(ctxD, {
type: 'doughnut',
data: {
labels: ["Cadet", "Grade School", "Junior", "Senior"],
datasets: [{
data: [cadet, gs, jr, sr],
backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1"],
hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5"]
}]
},
options: {
responsive: true
}
});
</script>
<?php
}
else if (isset($_SESSION['nccid'])){
  header("Location:./user.php?");
  exit();
}
else{
  header("Location:./index.php?");
  exit();
}
?>
