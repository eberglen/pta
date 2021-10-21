
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
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color-dark">
    <a class="navbar-brand" href="index.php"><img src="includes/logo.png" height="30" class="d-inline-block align-top"
      alt="" >Philippine Taekwondo Association</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

</head>
<body><br><br><br><br><br><br><br><br><br><br><br>
<div class="container col-md-3 shadow mt-5 pt-3 animated fadeIn faster">
  <h1 align="center">Enter NCCID</h1>
  <form action="includes/signup.inc.php" method="POST">
    <div class="md-form mb-0">
      <input type="text" id="nccid" name="nccid" class="form-control">
      <label for="nccid" class="">Your NCCID</label><br>
    </div>
    <div align="center">
      <button class="btn peach-gradient">Submit</button>
    </div>
  </form>
  <?php
  if(isset($_GET['error'])){
    if ($_GET['error'] == 'nccidtaken'){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>ERROR. </strong>NCCID already registered.
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
   ?>
</div>
</body>
</html>
