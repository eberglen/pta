<?php
session_start();
if ($_SESSION['fname'] == 'Admin'){
require 'includes/dbconn.inc.php';
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
    $(document).ready(function(){
      $('#q').on('input',function(){
        var q = $(this).val();
        if(q){
          $.ajax({
            type: 'POST',
            url: 'includes/search_tour.inc.php',
            data: 'q=' + q,
            success:function(html){
              $('#q_results').html(html);
            }
          });
        }
      });
    });
  </script>
  <script type="text/javascript">
    function tour_reg(){
        var tour_num = document.getElementById("tour_num").value;
          $.ajax({
            type: 'POST',
            url: 'includes/export.inc.php',
            data: { tour_num: tour_num },
            success:function(html){
              $('#tour_status').html(html);
            }
          });
    }
  </script>
  <script>
  function fnExcelReport()
{
  var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
  var textRange; var j=0;
  tab = document.getElementById('exportTable'); // id of table

  for(j = 0 ; j < tab.rows.length ; j++)
  {
      tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
      //tab_text=tab_text+"</tr>";
  }

  tab_text=tab_text+"</table>";
  tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
  tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
  tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");

  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
  {
      txtArea1.document.open("txt/html","replace");
      txtArea1.document.write(tab_text);
      txtArea1.document.close();
      txtArea1.focus();
      sa=txtArea1.document.execCommand("SaveAs",true,"attendance report.xlsx");
  }
  else                 //other browser not tested on IE 11
      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

  return (sa);
}
  </script>
  <?php require 'includes/header.inc.php'; ?>
</head>
<body>
<div class="container shadow mt-5 pt-3">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="home_admin.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="users_admin.php">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="tournaments_admin.php">Tournaments</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="export_admin.php">Export</a>
    </li>
  </ul><br>
  <div class="animated fadeIn faster">
    <div>
      <h1>List of Tournaments</h1>
      <?php
      $sql = "SELECT title, tour_category, DATE_FORMAT(dstart, '%M %e, %Y') as dstart, DATE_FORMAT(dend, '%M %e, %Y') as dend, location, description, DATE_FORMAT(date_posted, '%m/%d/%y %r') as date_posted, tour_num
              FROM tournament
              ORDER BY date_posted
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
    <th scope="col">Description</th>
    <th scope="col">Date Posted</th>
    <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>';
        while($row = mysqli_fetch_assoc($result)) {
          $title = $row['title'];
          $tour_cat = $row['tour_category'];
          $dstart = $row['dstart'];
          $dend = $row['dend'];
          $loc = $row['location'];
          $descr = $row['description'];
          $date_posted = $row['date_posted'];
          $tour_num = $row['tour_num'];

          echo '

          <tr>
          <th scope="row">'.$title.'</th>
          <td>'.$tour_cat.'</td>
          <td>'.$dstart.'</td>
          <td>'.$dend.'</td>
          <td>'.$loc.'</td>
          <td>'.$descr.'</td>
          <td>'.$date_posted.'</td>
          <td>
          <form action="includes/delete_tour.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to delete tournament?&quot);">
            <input type="hidden" name="tour_num" value="'.$tour_num.'"></input>
            <button type="submit" class="btn btn-danger px-3 waves-effect waves-light btn-sm"><i class="far fa-trash-alt"></i></button>
          </form>
          </td>
          </tr>

          ';
        }
        echo '</tbody>
      </table>
      </div>';
      }
      ?>
    </div><hr>
      <h1>List of Registrants</h1>
  <div class="col-md-6">
    <form class="form-inline active-pink-3 active-pink-4">
    <i class="fas fa-search" aria-hidden="true"></i>
    <input class="form-control form-control-sm ml-3 w-75" name="q" id="q" type="text" placeholder="Search"
      aria-label="Search">
    </form><br><br>
  </div>
    <div name="q_results" id="q_results">
  <?php
  $sql = "SELECT fname, mname, lname, belt_level, tour_category, DATE_FORMAT(dstart, '%M %e, %Y') as dstart, DATE_FORMAT(dend, '%M %e, %Y') as dend, nccid, users.user_num as user_num, tournament.tour_num as tour_num
          FROM users, tournament, tour_users
          WHERE users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    echo '<div class="table-responsive">
    <table class="table table-hover">
<thead>
<tr>
<th scope="col">NCCID</th>
<th scope="col">First</th>
<th scope="col">Middle</th>
<th scope="col">Last</th>
<th scope="col">Belt</th>
<th scope="col">Tournament Category</th>
<th scope="col">Start</th>
<th scope="col">End</th>
<th scope="col">Delete</th>
</tr>
</thead>
<tbody>';
    while($row = mysqli_fetch_assoc($result)) {
      $fname = $row['fname'];
      $mname = $row['mname'];
      $lname = $row['lname'];
      $belt_level = $row['belt_level'];
      $tour_category = $row['tour_category'];
      $dstart = $row['dstart'];
      $dend = $row['dend'];
      $nccid = $row['nccid'];
      $user_num = $row['user_num'];
      $tour_num = $row['tour_num'];

      echo '

      <tr>
      <th scope="row">'.$nccid.'</th>
      <td>'.$fname.'</td>
      <td>'.$mname.'</td>
      <td>'.$lname.'</td>
      <td>'.$belt_level.'</td>
      <td>'.$tour_category.'</td>
      <td>'.$dstart.'</td>
      <td>'.$dend.'</td>
      <td>
      <form action="includes/del_touruser.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to remove user from the tournament?&quot);">
        <input type="hidden" name="user_num" value="'.$user_num.'"></input>
        <input type="hidden" name="tour_num" value="'.$tour_num.'"></input>
        <button type="submit" class="btn btn-danger px-3 waves-effect waves-light btn-sm"><i class="far fa-trash-alt"></i></button>
      </form>
      </td>
      </tr>

      ';

    }
    echo '</tbody>
  </table>
  </div>';
  }

   ?>
  </div>
  <hr>
  <h1>Export</h1>
  <div class="row">
    <div class="col-md-8"><br>
      <select class="form-control" name="tour_num" id="tour_num">
        <option selected disabled>Select Tournament</option>
         <?php
         $sql = "SELECT * FROM tournament
                 ;";
           $result = mysqli_query($conn, $sql);
         while($row = mysqli_fetch_assoc($result)) {
           $title = $row['title'];
           $tour_num = $row['tour_num'];
           echo '
           <option value="'.$tour_num.'">'.$title.'</option>
           ';
         }
         ?>
       </select>
    </div>
    <div class="col-md-4"><br>
      <button type="submit" class="btn btn-block btn-outline-danger waves-effect btn-sm" onClick="tour_reg()">Show</button>
    </div>
  </div>
  <div name="tour_status" id="tour_status"></div><br><br>
  <br>
</div>
</div>
</body>
</html>
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
