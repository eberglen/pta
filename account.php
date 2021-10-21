<?php
session_start();
if (isset($_SESSION['user_num'])){
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
  <script type="text/javascript" src="mdbootstrap/js/mdb.min.js"></script>
  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>
  <script type="text/javascript">
    function change_pwd(){
      var r = confirm("Are you sure you want to change password?");
      if (r == true) {
        var cur_pwd = document.getElementById("cur_pwd").value;
        var new_pwd = document.getElementById("new_pwd").value;
        var rpt_pwd = document.getElementById("rpt_pwd").value;
          $.ajax({
            type: 'POST',
            url: 'includes/change_pwd.inc.php',
            data: { cur_pwd: cur_pwd, new_pwd: new_pwd, rpt_pwd: rpt_pwd },
            success:function(html){
              $('#pword_status').html(html);
            }
          });
        }
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

    <?php
    require 'includes/dbconn.inc.php';
    if(isset($_SESSION['nccid'])){
      echo '<div class="container shadow mt-5 pt-3">';

      $sql = "SELECT user_num, nccid, fname, mname, lname, DATE_FORMAT(birth, '%M %e, %Y') as birth, email, mnum, gym, instructor, region, gender, division, approval, birth as births, belt_level
              FROM users
              WHERE user_num = $user_num
              ;";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
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
          switch ($belt) {
              case "White":
                  $sw = 'selected';
                  $sy = '';
                  $sg = '';
                  $sb = '';
                  $sr = '';
                  $sbl = '';
                  break;
              case "Yellow":
                  $sw = '';
                  $sy = 'selected';
                  $sg = '';
                  $sb = '';
                  $sr = '';
                  $sbl = '';
                  break;
              case "Green":
                  $sw = '';
                  $sy = '';
                  $sg = 'selected';
                  $sb = '';
                  $sr = '';
                  $sbl = '';
                  break;
              case "Blue":
                  $sw = '';
                  $sy = '';
                  $sg = '';
                  $sb = 'selected';
                  $sr = '';
                  $sbl = '';
                  break;
              case "Red":
                  $sw = '';
                  $sy = '';
                  $sg = '';
                  $sb = '';
                  $sr = 'selected';
                  $sbl = '';
                  break;
              case "Black":
                  $sw = '';
                  $sy = '';
                  $sg = '';
                  $sb = '';
                  $sr = '';
                  $sbl = 'selected';
                  break;
              default:
              $sw = '';
              $sy = '';
              $sg = '';
              $sb = '';
              $sr = '';
              $sbl = '';
                  //echo "Your favorite color is neither red, blue, nor green!";
          }
          switch ($gender) {
      case "Male":
          $gm = 'selected';
          $gf = '';
          break;
      case "Female":
          $gm = '';
          $gf = 'selected';
          break;
      default:
      $gm = '';
      $gf = '';
        //  echo "Your favorite color is neither red, blue, nor green!";
  }
  switch ($divi) {
      case "Cadet":
        $cadet = 'selected';
        $gs = '';
        $jr = '';
        $sr = '';
        break;
      case "Grade School":
        $cadet = '';
        $gs = 'selected';
        $jr = '';
        $sr = '';
        break;
      case "Junior":
        $cadet = '';
        $gs = '';
        $jr = 'selected';
        $sr = '';
        break;
      case "Senior":
        $cadet = '';
        $gs = '';
        $jr = '';
        $sr = 'selected';
        break;
default:
$cadet = '';
$gs = '';
$jr = '';
$sr = '';

//  echo "Your favorite color is neither red, blue, nor green!";
}
  echo '
  <h3>User Profile (NCCID: '.$nccid.')</h3>
  <form action="includes/edit_user.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to save changes?&quot);">
  <input type="hidden" name="user_num" id="user_num" value="'.$un.'">
  <div class="col-md-5">
    <img src="includes/images/'.$nccid.'_dp.jpg" alt="thumbnail" class="img-thumbnail" style="width: 200px">
  </div>
  <div class="row">
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="fname" name="fname" class="form-control" value="'.$fname.'">
              <label for="fname" class="active">First Name</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="mname" name="mname" class="form-control" value="'.$mname.'">
              <label for="mname" class="active">Middle Name</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="lname" name="lname" class="form-control" value="'.$lname.'">
              <label for="lname" class="active">Last Name</label>
          </div>
      </div>
  </div><br>
  <div class="row">
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="date" id="birth" name="birth" class="form-control" value="'.$births.'">
              <label for="birth" class="active">Birthdate</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="email" id="email" name="email" class="form-control" value="'.$email.'">
              <label for="email" class="active">E-mail</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="mnum" name="mnum" class="form-control" value="'.$mnum.'">
              <label for="mnum" class="active">Mobile Number</label>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="gym" name="gym" class="form-control" value="'.$gym.'">
              <label for="gym" class="active">Gym</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="inst" name="inst" class="form-control" value="'.$inst.'">
              <label for="inst" class="active">Instructor</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="reg" name="reg" class="form-control" value="'.$reg.'">
              <label for="reg" class="active">Region</label>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="md-form mb-0">
        <select class="browser-default custom-select mb-4" id="belt" name="belt">
            <option value="" disabled="">Select Belt</option>
            <option '.$sw.' value="White">White</option>
            <option '.$sy.' value="Yellow">Yellow</option>
            <option '.$sg.' value="Green">Green</option>
            <option '.$sb.' value="Blue">Blue</option>
            <option '.$sr.' value="Red">Red</option>
            <option '.$sbl.' value="Black">Black</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
        <div class="md-form mb-0">
          <select class="browser-default custom-select mb-4" id="gender" name="gender">
              <option value="" disabled="">Gender</option>
              <option '.$gm.' value="Male">Male</option>
              <option '.$gf.' value="Female">Female</option>
          </select>
        </div>
    </div>
    <div class="col-md-4">
      <div class="md-form mb-0">
        <select class="browser-default custom-select mb-4" id="divi" name="divi">
            <option value="" disabled="" selected="">Division</option>
            <option '.$cadet.' value="Cadet">Cadet</option>
            <option '.$gs.' value="Grade School">Grade School</option>
            <option '.$jr.' value="Junior">Junior</option>
            <option '.$sr.' value="Senior">Senior</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="footer">
    <button type="Submit" class="btn btn-primary btn-sm">Save changes</button>
  </div>
</form>
  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#pword">
    Change password
  </button>
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#upload_dp">
    Upload Profile Picture
  </button>
</div>
</div>
  <!-- Modal -->
    <div class="modal fade" id="pword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="md-form mb-5">
              Current Password: <input type="password" id="cur_pwd" name="cur_pwd" class="form-control mb-4">
            </div>
            <div class="md-form mb-5">
              New Password: <input type="password" id="new_pwd" name="new_pwd" class="form-control mb-4">
            </div>
            <div class="md-form mb-5">
              Repeat Password: <input type="password" id="rpt_pwd" name="rpt_pwd" class="form-control mb-4">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onClick="change_pwd();">Submit</button>
          </div>
          <div name="pword_status" id="pword_status"></div>
        </div>
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="upload_dp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Profile Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="includes/upload_dp.inc.php" method="POST" enctype="multipart/form-data">
          <input type="file" name="img1" id="img1" accept="image/*" onchange="loadFile(event)">
          <input type="hidden" name="nccid" id="nccid" value="'.$nccid.'"></input>
          <img id="output"/ style="width: 200px"><br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>
  ';
        }
      }
    }
    else if (isset($_SESSION['fname'])){
      $sql = "SELECT nccid
              FROM users
              WHERE user_num = $user_num
              ;";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)) {
        $username = $row['nccid'];
      }
      echo '<div class="container col-md-4 shadow mt-5 pt-3">';
      echo '

        <h1 align="center">Account</h1><br>
        <div class="col-md-12">
          <div class="row">
            <h3 align="center">Username: '.$username.'</h3>
          </div>

        <br>

          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#pword">
            Change password
          </button><br>


          <!-- Modal -->
            <div class="modal fade" id="pword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="md-form mb-5">
                      Current Password: <input type="password" id="cur_pwd" name="cur_pwd" class="form-control mb-4">
                    </div>
                    <div class="md-form mb-5">
                      New Password: <input type="password" id="new_pwd" name="new_pwd" class="form-control mb-4">
                    </div>
                    <div class="md-form mb-5">
                      Repeat Password: <input type="password" id="rpt_pwd" name="rpt_pwd" class="form-control mb-4">
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onClick="change_pwd();">Submit</button>
                  </div>
                  <div name="pword_status" id="pword_status"></div>
                </div>
              </div>
            </div>
          </div>
      ';
      echo '</div>';
    }

    ?>



</body>
<?php
}
else{
  header("Location:./index.php?");
  exit();
}
 ?>
