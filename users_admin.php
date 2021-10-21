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
            url: 'includes/search.inc.php',
            data: 'q=' + q,
            success:function(html){
              $('#q_results').html(html);
            }
          });
        }
      });
    });
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
      <a class="nav-link active" href="users_admin.php">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="tournaments_admin.php">Tournaments</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-primary-dark" href="export_admin.php">Export</a>
    </li>
  </ul><br>
  <div class="">
  <div class="col-md-6">
    <form class="form-inline active-pink-3 active-pink-4">
    <i class="fas fa-search" aria-hidden="true"></i>
    <input class="form-control form-control-sm ml-3 w-75" name="q" id="q" type="text" placeholder="Search"
      aria-label="Search">
    </form><br><br>
  </div>
    <div name="q_results" id="q_results">
    <?php
    $sql = "SELECT user_num, nccid, fname, mname, lname, DATE_FORMAT(birth, '%M %e, %Y') as birth, email, mnum, gym, instructor, region, gender, division, approval, belt_level
            FROM users
            WHERE approval IS NULL
            ;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      echo '<H2>For Approvals</h2>
      <div class="table-responsive">
      <table class="table table-hover table-responsive-md">
        <thead>
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
            <th scope="col">Status</th>
            <th scope="col">Delete</th>
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
        $birth = $row['birth'];
        $email = $row['email'];
        $mnum = $row['mnum'];
        $gym = $row['gym'];
        $inst = $row['instructor'];
        $reg = $row['region'];
        $gender = $row['gender'];
        $divi = $row['division'];
        $appr = $row['approval'];
        $belt = $row['belt_level'];

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
          <td>
          <form action="includes/appr.inc.php" method="POST">
            <input type="hidden" name="user_num" id="user_num" value="'.$un.'">
            <button type="submit" class="btn btn-success btn-sm">Approve</button>
          </form>
          </td>
          <td>
          <form action="includes/del_user.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to delete user? &quot);">
            <input type="hidden" name="user_num" id="user_num" value="'.$un.'">
            <button type="submit" class="btn btn-danger mb-4 btn-rounded btn-sm"><i class="far fa-trash-alt"></i></button>
          </form>
          </td>
        </tr>
        ';




      }
      echo '
      </tbody>
    </table>
    </div>
      ';
    }

    $sql = "SELECT user_num, nccid, fname, mname, lname, DATE_FORMAT(birth, '%M %e, %Y') as birth, email, mnum, gym, instructor, region, gender, division, approval, birth as births, belt_level
            FROM users
            ;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
      echo '<H2>Users</h2>
      <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">NCCID</th>
            <th scope="col">Photo</th>
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
            <th scope="col">Status</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
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
      //  echo "Your favorite color is neither red, blue, nor green!";
}
        echo '
        <tr>
          <th scope="row">'.$nccid.'</th>
          <td><img src="includes/images/'.$nccid.'_dp.jpg" alt="thumbnail" class="img-thumbnail" style="width: 50px"></td>
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
          <td>';

          if($appr == null){
            echo '
            <form action="includes/appr.inc.php" method="POST">
              <input type="hidden" name="user_num" id="user_num" value="'.$un.'">
              <button type="submit" class="btn btn-success btn-sm">Approve</button>
            </form>

            ';
          }
          else{
            echo 'Approved';
          }

          echo'
          </td>
          <td>
          <a href="" class="btn btn-primary btn-rounded mb-4 btn-sm" data-toggle="modal" data-target="#AV'.$un.'E"><i class="far fa-edit"></i></a>
          </td>
          <td>
          <form action="includes/del_user.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to delete user? &quot);">
            <input type="hidden" name="user_num" id="user_num" value="'.$un.'">
            <button type="submit" class="btn btn-danger mb-4 btn-rounded btn-sm"><i class="far fa-trash-alt"></i></button>
          </form>
          </td>
        </tr>

        <!-- Central Modal Small -->
        <div class="modal fade" id="AV'.$un.'E" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">

          <!-- Change class .modal-sm to change the size of the modal -->
          <div class="modal-dialog modal-lg" role="document">


            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <h3>User Profile (NCCID: '.$nccid.')</h3>
              <form action="includes/edit_user.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to save changes?&quot);">
              <input type="hidden" name="user_num" id="user_num" value="'.$un.'">
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
                      <input type="text" id="divi" name="divi" class="form-control" value="'.$divi.'">
                      <label for="divi" class="active">Division</label>
                  </div>
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="Submit" class="btn btn-primary btn-sm">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        <!-- Central Modal Small -->

        ';




      }
      echo '
      </tbody>
    </table>
    </div>
      ';
    }
    ?>
    </div>
  </div>
  <hr>
  <h3>Valid NCCIDs</h3><br>
  <div class="row">
    <div class="col-md-6">
      <form action="includes/add_nccid.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to add NCCID?&quot);">
        <input type="text" class="form-control" placeholder="NCCID" name="nccid"><br>
        <div class="col-md-12">
          <div class="row">
        <button type="submit" class="btn btn-success btn-sm">Add</button>
      </form>
      <form action="includes/gen_nccid.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to generate NCCID?&quot);">
        <button type="submit" class="btn btn-secondary btn-sm" name="generate">Auto-Generate</button>
          </div>
        </div>
      </form>
      <?php
      if(isset($_GET['error'])){
        if ($_GET['error'] == 'nccidexist'){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>ERROR. </strong>NCCID already existing.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
        else if ($_GET['error'] == 'emptyfields'){
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Warning: </strong>Empty fields.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
        else if ($_GET['error'] == 'nccidinv'){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>ERROR. </strong>NCCID invalid.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
      }
      else if (isset($_GET['successgen'])){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success. </strong>NCCID:<strong> '.$_GET['successgen'].'</strong> has been added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
      }
      else if (isset($_GET['success'])){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success. </strong>NCCID:<strong> '.$_GET['success'].'</strong> has been added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
      }
       ?>
    </div>
    <div class="col-md-6">
          <form action="includes/del_nccid.inc.php" method="POST" onsubmit="return confirm(&quot Are you sure you want to delete NCCID? NOTE: If the NCCID is registered, it would also delete the user.&quot);">
            <select class="browser-default custom-select mb-4" id="nccid" name="nccid">
                <option value="" disabled="" selected>Select NCCID</option>
                <?php
                $sql = "SELECT *
                        FROM nccid
                        ;";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                  $nccid = $row['nccid'];
                  $nnum = $row['nccid_num'];
                  $sql2 = "SELECT nccid
                          FROM users
                          WHERE nccid = '$nccid'
                          ;";
                  $result2 = mysqli_query($conn, $sql2);
                  if (mysqli_num_rows($result2) > 0) {
                    echo '<option style="color:green" value="'.$nnum.'">'.$nccid.' (Registered)</option>';
                  }
                  else{
                    echo '<option value="'.$nccid.'">'.$nccid.'</option>';
                  }
                }
                 ?>
            </select>
            <button type="submit" class="btn btn-danger btn-sm" name="generate">Delete</button>
          </form>
        <?php
        if (isset($_GET['successdel'])){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success. </strong>NCCID:<strong> '.$_GET['successdel'].'</strong> has been DELETED.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
        ?>
    </div>
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
