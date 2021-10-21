<?php
$img1 = $_POST['img1'];
$nccid = $_POST['nccid'];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["img1"]["name"]);
$extension = end($temp);
if ((($_FILES["img1"]["type"] == "image/gif") || ($_FILES["img1"]["type"] == "image/jpeg") || ($_FILES["img1"]["type"] == "image/jpg") || ($_FILES["img1"]["type"] == "image/pjpeg") || ($_FILES["img1"]["type"] == "image/x-png") || ($_FILES["img1"]["type"] == "image/png")) && ($_FILES["img1"]["size"] < 100000000) && in_array($extension, $allowedExts)) {
    if ($_FILES["img1"]["error"] > 0) {
        //echo "Return Code: " . $_FILES["img1"]["error"] . "<br>";
        header("Location:../account.php?error=filetype");
        exit();
    } else {

        //$fileName = $lid . "_img1." . $temp[1];
        $fileName = $nccid . "_dp.jpg";
        $temp[0] = rand(0, 3000); //Set to random number

        if (file_exists("images/" . $_FILES["img1"]["name"])) {
            //echo $_FILES["img1"]["name"] . " already exists. ";
            header("Location:../account.php?error=existing");
            exit();
        } else {
          if(move_uploaded_file($_FILES['img1']['tmp_name'], "images/".$fileName))
          {
            //echo $fileName.' stored.';
            header("Location:../account.php?success=uploaded");
            exit();
          }
        }
    }
} else {
    //echo "Invalid file1";
}

?>
