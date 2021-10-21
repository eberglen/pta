<?php
session_start();
if (isset($_SESSION['fname'])){
  header("Location:./home_admin.php?");
  exit();
}
else if(isset($_SESSION['nccid'])){
  require 'includes/dbconn.inc.php';
  $user_num = $_SESSION['user_num'];
  $nccid = $_SESSION['nccid'];
  date_default_timezone_set("Asia/Hong_Kong");
  $date_today = date("Y-m-d H:i:s");
  $sql = "SELECT *
          FROM users
          WHERE user_num = $user_num
          ;";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $nccid = $row['nccid'];
    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $birth = $row['birth'];
    $email = $row['email'];
    $mnum = $row['mnum'];
    $gym = $row['gym'];
    $inst = $row['instructor'];
    $reg = $row['region'];
    $gender = $row['gender'];
    $divi = $row['division'];
    $belt = $row['belt_level'];
  }

  $sql = "SELECT COUNT(*)
          FROM tour_users
          WHERE user_num = $user_num
          ;";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $tj = $row['COUNT(*)'];
  }

  $sql = "SELECT COUNT(*)
          FROM tour_users, tournament
          WHERE tour_users.tour_num = tournament.tour_num
          AND dend > '$date_today'
          AND user_num = $user_num
          ;";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $upt = $row['COUNT(*)'];
  }
  $ave_kyo = 0;
  $ave_poom = 0;
  $sql = "SELECT COUNT(*)
          FROM tournament, tour_users, users
          WHERE tournament.tour_num = tour_users.tour_num
          AND tour_users.user_num = users.user_num
          AND tour_category = 'Kyorugi'
          AND tour_users.user_num = $user_num
          GROUP BY tournament.tour_category
          ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
      $ave_kyo = $row['COUNT(*)'];
    }
  }

  $sql = "SELECT COUNT(*)
          FROM tournament, tour_users, users
          WHERE tournament.tour_num = tour_users.tour_num
          AND tour_users.user_num = users.user_num
          AND tour_category = 'Poomsae'
          AND tour_users.user_num = $user_num
          GROUP BY tournament.tour_category
          ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
      $ave_poom = $row['COUNT(*)'];
    }
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
  <?php require 'includes/header.inc.php'; ?>
<body>
<div class="container shadow mt-5 pt-3">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="user.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="tournaments_user.php">My Tournaments</a>
    </li>
  </ul><br>
  <div class="row">
  <div class="card col-md-4" style=height:700px;><br>
    <div class="row">
      <div class="col-md-4">
        <img src="includes/images/<?php echo $nccid; ?>_dp.jpg" alt="thumbnail"  class="avatar rounded-circle z-depth-3 w-100" >
      </div>
      <div class="col-md-8">
        <?php
          echo '
          <h2><strong>'.$fname.' '.$lname.'</strong></h2>
          '.$belt.' Belt<br>
          '.$divi.'
          ';
        ?>
      </div>
    </div><br>
      <h5>My Upcoming Tournaments: <?php echo ' <strong> '.$upt.'</strong>'; ?></h5><br>
      <?php
        if ($ave_kyo > 0 || $ave_poom > 0){
          echo '
            <h2 align="center">Tournaments Joined</h2>
            <canvas id="doughnutChart"></canvas>
            <input type="hidden" id="ave_kyo" value="'.$ave_kyo.'">
            <input type="hidden" id="ave_poom" value="'.$ave_poom.'"><br>
          ';
        }
        ?>
  </div>
  <div class="col">
  </div>
  <div class="container col-md-7">
  <?php
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
        <div class="col-sm-2 col-12 mb-3">
          <img src="includes/avatar.jpg" alt="sample image" class="avatar rounded-circle z-depth-1-half w-75">
        </div>
        <!--/.Image column-->

        <!--Content column-->
        <div class="col-sm-10 col-12">
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
            <p class="dark-grey-text article">
            <strong>'.$title.'</strong><br>'
            .$tour_cat.'<br>'
            .$dstart.' - '.$dend.'<br>'
            .$loc.'<br>'
            .nl2br($descr);

            $sql2 = "SELECT *
                    FROM tour_users
                    WHERE tour_num = $tour_num
                    AND user_num = $user_num
                    ;";
            $result2 = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2) > 0) {
              echo '<br><h5><strong>You are already registered.</strong></h5>';
            }
            else{
              echo '
              <form action="includes/register.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to register?&quot);">
              <input type="hidden" name="tour_num" value="'.$tour_num.'">
              <input type="hidden" name="user_num" value="'.$user_num.'">
              <button type="submit" class="btn peach-gradient">Register</button>
              </form>
              ';
            }

            echo '</p>
        </div>
        <!--/.Content column-->
    </div>

    <!--/.First row-->

    ';


  }

  ?><br>
  </div>
</div>
</div>
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
</script>
<?php
}
else{
  header("Location:./index.php?");
  exit();
}

?>
