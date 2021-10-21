<?php
if(isset($_POST['q'])){
  include 'dbconn.inc.php';
  $q = $_POST['q'];

  $sql = "SELECT * FROM users
          WHERE nccid LIKE '%$q%'
          OR fname LIKE '%$q%'
          OR mname LIKE '%$q%'
          OR lname LIKE '%$q%'
          OR belt_level LIKE '%$q%'
          OR birth LIKE '%$q%'
          OR email LIKE '%$q%'
          OR gym LIKE '%$q%'
          OR instructor LIKE '%$q%'
          OR region LIKE '%$q%'
          OR division LIKE '%$q%'
          OR gender LIKE '%$q%'
          ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    echo '<H2>Results</h2>
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
      </tr>
      ';




    }
    echo '
    </tbody>
  </table>
  </div>
    ';
  }
}

?>
