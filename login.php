<?php

require_once("connect.php");


if (isset($_POST['submit'])) {



  $email = $_POST["Email"];
  if (empty($_POST["Email"])) {

    echo '<script>alert ("Email is required")</script>';
  }
  if (!preg_match("/[a-zA-Z- ]*$/", $email)) {
    echo '<script> alert("Only letters and numbers are allowed") </script> ';
  }


  $password = $_POST["password"];
  if (empty($_POST["password"])) {

    echo '<script>alert ("password is required")</script>';
  }
  $sql = "SELECT * from doctors where email ='$email' and password='$password'";
  $result = mysqli_query($conn, $sql);
  try {
    if (!$result)
      throw new Exception("Error occured!!");
  } catch (Exception $e) {
    echo "Message:", $e->getMessage();
  }


  if ($row = mysqli_fetch_array($result)) {
     
      $_SESSION["id"] = $row[0];
      $_SESSION["Email"] = $row[1];
      echo "<script> alert('Done')</script>";
    
  } else {
    echo "<script> alert('invalid Email or Password')</script>";
  }
} ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>


  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>


  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" href="css/font-awesome.min.css">

  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/responsive.css">

</head>

<body class="myhome">

  <div class="container">
    <center>
      <h1 class="ml2"></h1>
    </center>
    <div class="jumbotron" style="background-color:bisque !important;">
      <center>
        <form method="POST">
          <div class="form-group myform">
            <label>Email</label>
            <input name="Email" type="text" class="form-control" required>
          </div>
          <div class="form-group myform">
            <label>Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <button name="submit" type="submit" class="btn btn-primary mybtn">Submit</button>
        </form>
        </center>
    </div>
  </div>
  
</body>

</html>
