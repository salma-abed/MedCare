<?php

require_once("connect.php");

if (isset($_POST['submit'])) {
  $Pname = $_POST["Pname"];
  if (empty($_POST["Pname"])) {

    echo '<script>alert ("Patient name is required")</script>';
  }
  if (!preg_match("/[a-zA-Z- ]*$/", $Pname)) {
    echo '<script> alert("Only letters and numbers are allowed") </script> ';
  }

  $password = $_POST["password"];
  if (empty($_POST["password"])) {

    echo '<script>alert ("password is required")</script>';
  }

  $email = $_POST["email"];
  if (empty($_POST["email"])) {

    echo '<script>alert ("email is required")</script>';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo '<script>alert ("invalid email format")</script>';
  }


  $phone = $_POST["phone"];
  if (empty($_POST["phone"])) {

    echo '<script>alert ("phone is required")</script>';
  }
  if (!preg_match("/[a-zA-Z- ]*$/", $Pname)) {
    echo '<script> alert("Only numbers are allowed") </script> ';
  }


  $resultset_1 = mysqli_query($conn, "select * from patient where Pname='" . $Pname . "' ");
  $count = mysqli_num_rows($resultset_1);

  $resultset_2 = mysqli_query($conn, "select * from patient where email='" . $email . "'  ");
  $count2 = mysqli_num_rows($resultset_2);



  if ($count > 0 || $count2 > 0) {
    echo '<script> alert("this user is already used ")</script>';
  } else {

    $sql = "INSERT INTO patient(Pname,password,email,PhoneNumber) values('$Pname','$password','$email','$phone')";
    $result = mysqli_query($conn, $sql);
    try{
        if(!$result)
    throw new Exception("Error occured!!");
    
  
} catch (Exception $e) {
  echo "Message:",$e->getMessage();
}



    echo '<script> alert("Done :) ")</script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>


    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css"> -->

    
</head>


<body class="register">


  <div class="container">
    <div class="jumbotron">
      <form method="POST">
        <div class="form-group">
          <label>Name</label>
          <input name="Pname" id="Pname" type="text" class="form-control" placeholder="Enter Your Name" minlength="6" maxlength="10" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input name="password" type="password" class="form-control" placeholder="Enter Your Password" minlength="6" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input name="email" type="email" class="form-control" placeholder="Enter Your Email" required>
        </div>

        <div class="form-group">
          <label>Phone</label>
          <input onkeypress="return onlyNumberKey(event)" name="phone" type="text" class="form-control" placeholder="Enter Your Phone" maxlength="11" minlength="11" required>
        </div>
        <center>
          <button name="submit" type="submit" class="btn btn-primary mybtn">Submit</button>
        </center>
      </form>
    </div>
  </div>

  <script>
    $("#Pname").on({
      keydown: function(e) {
        if (e.which === 32)
          return false;
      },
      change: function() {
        this.value = this.value.replace(/\s/g, "");
      }
    });
  </script>


  <script>
    $("#number").on({
      keydown: function(e) {
        if (e.which === 32)
          return false;
      },
      change: function() {
        this.value = this.value.replace(/\s/g, "");
      }
    });
  </script>

  <script>
    function onlyNumberKey(evt) {

      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
      return true;
    }
  </script>

  </form>
</body>

</html>