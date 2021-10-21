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
      sa=txtArea1.document.execCommand("SaveAs",true,"registered members.xlsx");
  }
  else                 //other browser not tested on IE 11
      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

  return (sa);
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
      <a class="nav-link text-primary-dark" href="home_admin.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="users_admin.php">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="tournaments_admin.php">Tournaments</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="export_admin.php">Export</a>
    </li>
  </ul><br>
  <div class="animated fadeIn faster">
  <?php
  $sql = "SELECT user_num, nccid, fname, mname, lname, DATE_FORMAT(birth, '%M %e, %Y') as birth, email, mnum, gym, instructor, region, gender, division, approval, birth as births, belt_level
          FROM users
          ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    echo '<H2><button class="btn btn-info" id="btnExport" onclick="fnExcelReport();"><i class="fas fa-file-export">Export</i></button></h2>
    <div class="table-responsive">
    <table class="table table-bordered" id="exportTable">
      <thead>
        <tr>
          <th colspan="13">Registered Members</th>
        </tr>
        <tr>
          <th scope="col">NCCID</th>
          <th scope="col">First</th>
          <th scope="col">Middle</th>
          <th scope="col">Last</th>
          <th scope="col">Belt</th>
          <th scope="col">Birthdate</th>
          <th scope="col">E-mail</th>
          <th scope="col">Mobile Number</th>
          <th scope="col">Gym</th>
          <th scope="col">Instructor</th>
          <th scope="col">Region</th>
          <th scope="col">Gender</th>
          <th scope="col">Division</th>
        </tr>
      </thead>
      <tbody>
    ';

    while($row = mysqli_fetch_assoc($result)) {
      $un = $row['user_num'];
      $nccid = $row['nccid'];
      $fname = $row['fname'];
      $mname = $row['mname'];
      $lname = $row['lname'];
      $belt = $row['belt_level'];
      $birth = $row['birth'];
      $email = $row['email'];
      $mnum = $row['mnum'];
      $gym = $row['gym'];
      $inst = $row['instructor'];
      $reg = $row['region'];
      $gender = $row['gender'];
      $divi = $row['division'];
      $appr = $row['approval'];
      $births = $row['births'];

      echo '
      <tr>
        <th scope="row">'.$nccid.'</th>
        <td>'.$fname.'</td>
        <td>'.$mname.'</td>
        <td>'.$lname.'</td>
        <td>'.$belt.'</td>
        <td>'.$birth.'</td>
        <td>'.$email.'</td>
        <td>'.$mnum.'</td>
        <td>'.$gym.'</td>
        <td>'.$inst.'</td>
        <td>'.$reg.'</td>
        <td>'.$gender.'</td>
        <td>'.$divi.'</td>
        ';
    }
    echo '
    </tbody>
  </table>
  </div>
    ';
  }
  ?>
<iframe id="txtArea1" style="display:none"></iframe>
</div>
</div>
</body>
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
