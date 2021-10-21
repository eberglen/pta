<?php
session_start();
if (isset($_SESSION['nccid'])){

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
      var fname = document.getElementById("fname").value;
      var mname = document.getElementById("mname").value;
      var lname = document.getElementById("lname").value;
      var birth = document.getElementById("birth").value;
      var email = document.getElementById("email").value;
      var mnum = document.getElementById("mnum").value;
      var gym = document.getElementById("gym").value;
      var inst = document.getElementById("inst").value;
      var reg = document.getElementById("reg").value;
      var belt = document.getElementById("belt").value;
      var gender = document.getElementById("gender").value;
      var divi = document.getElementById("divi").value;
      var pwd = document.getElementById("pwd").value;
      var rpt_pwd = document.getElementById("rpt_pwd").value;
        $.ajax({
          type: 'POST',
          url: 'includes/signup1.inc.php',
          data: { fname: fname, mname: mname, lname: lname, birth: birth, email: email, mnum: mnum, gym: gym, inst: inst, reg: reg, belt: belt, gender: gender, divi: divi, pwd: pwd, rpt_pwd: rpt_pwd },
          async: false,
          success:function(html){
            $('#status').html(html);
          }
        });

    }
  </script>
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color-dark">
    <a class="navbar-brand" href="index.php"><img src="includes/logo.png" height="30" class="d-inline-block align-top"
      alt="" >Philippine Taekwondo Association</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

</head>
<body>
<div class="container shadow mt-5 pt-3 animated fadeIn faster">
  <h2 class="h1-responsive font-weight-bold text-center my-4">Sign Up</h2>
  <h3>User Profile (NCCID: <?php echo $_SESSION['nccid']; ?>)</h3>
  <div class="row">
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="fname" name="fname" class="form-control">
              <label for="fname" class="">First Name</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="mname" name="mname" class="form-control">
              <label for="mname" class="">Middle Name</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="lname" name="lname" class="form-control">
              <label for="lname" class="">Last Name</label>
          </div>
      </div>
  </div><br>
  <div class="row">
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="date" id="birth" name="birth" class="form-control">
              <label for="birth" class="">Birthdate</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="email" id="email" name="email" class="form-control">
              <label for="email" class="">E-mail</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="mnum" name="mnum" class="form-control">
              <label for="mnum" class="">Mobile Number</label>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="gym" name="gym" class="form-control">
              <label for="gym" class="">Gym</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="inst" name="inst" class="form-control">
              <label for="inst" class="">Instructor</label>
          </div>
      </div>
      <div class="col-md-4">
          <div class="md-form mb-0">
              <input type="text" id="reg" name="reg" class="form-control">
              <label for="reg" class="">Region</label>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="md-form mb-0">
        <select class="browser-default custom-select mb-4" id="belt" name="belt">
            <option value="" disabled="" selected="">Select Belt</option>
            <option value="White">White</option>
            <option value="Yellow">Yellow</option>
            <option value="Green">Green</option>
            <option value="Blue">Blue</option>
            <option value="Red">Red</option>
            <option value="Black">Black</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
        <div class="md-form mb-0">
          <select class="browser-default custom-select mb-4" id="gender" name="gender">
              <option value="" disabled="" selected="">Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
          </select>
        </div>
    </div>
    <div class="col-md-4">
      <div class="md-form mb-0">
        <select class="browser-default custom-select mb-4" id="divi" name="divi">
            <option value="" disabled="" selected="">Division</option>
            <option value="Cadet">Cadet</option>
            <option value="Grade School">Grade School</option>
            <option value="Junior">Junior</option>
            <option value="Senior">Senior</option>
        </select>
      </div>
    </div>
  </div>
  <h3>Password</h3>
  <div class="row">
    <div class="col-md-6">
      <div class="md-form mb-0">
          <input type="password" id="pwd" name="pwd" class="form-control">
          <label for="pwd" class="">Password</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="md-form mb-0">
          <input type="password" id="rpt_pwd" name="rpt_pwd" class="form-control">
          <label for="rpt_pwd" class="">Repeat Password</label>
      </div>
    </div>
  </div><br>
  <div align="center">
    <button type="submit" class="btn peach-gradient" onClick="submit_add()">Sign Up</button>
  </div><br>
  <div name="status" id="status"></div>
</div>
</body>
</html>
<?php
}
else{
  header("Location:./signup.php");
  exit();
}
 ?>
