<?php
if(isset($_POST['q'])){
  include 'dbconn.inc.php';
  $q = $_POST['q'];

  $sql = "SELECT fname, mname, lname, belt_level, tour_category, DATE_FORMAT(dstart, '%M %e, %Y') as dstart, DATE_FORMAT(dend, '%M %e, %Y') as dend, users.user_num as user_num, tournament.tour_num as tour_num
          FROM users, tournament, tour_users
          WHERE users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          AND fname LIKE '%$q%'
          OR mname LIKE '%$q%'
          AND users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          OR lname LIKE '%$q%'
          AND users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          OR belt_level LIKE '%$q%'
          AND users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          OR tour_category LIKE '%$q%'
          AND users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          OR dstart LIKE '%$q%'
          AND users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          OR dend LIKE '%$q%'
          AND users.user_num = tour_users.user_num
          AND tour_users.tour_num = tournament.tour_num
          ;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0){
    echo '<H2>Results</h2>
    <div class="table-responsive">
    <table class="table table-hover table-responsive-md">
      <thead>
        <tr>
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
      <tbody>
    ';

    while($row = mysqli_fetch_assoc($result)) {
      $fname = $row['fname'];
      $mname = $row['mname'];
      $lname = $row['lname'];
      $belt_level = $row['belt_level'];
      $tour_category = $row['tour_category'];
      $dstart = $row['dstart'];
      $dend = $row['dend'];
      $user_num = $row['user_num'];
      $tour_num = $row['tour_num'];

      echo '

      <tr>
      <th scope="row">'.$fname.'</th>
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
    echo '
    </tbody>
  </table>
  </div>
    ';
  }
}

?>
