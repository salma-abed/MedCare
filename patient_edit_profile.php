<?php
    $dbservername="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="your_database_name";
    $conn=mysqli_connect($dbservername,$dbuser,$dbpass,$dbname);
?>
<form action="Profile_update.php" method="post">
   fname: <input type="text" name="fname"><br>
 
   lname: <input type="text" name="lname"><br>
 
   email: <input type="email" name="email"><br>

   phonenumber :<input type="phonenumber" name="phonenumber"><br>
   
   <input type="submit" name="edit">
   
</form>
<?php
 
 session_start();
 include "Connection.php";
 if(isset($_POST['edit']))
 {
    $id=$_SESSION['id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $phonenumber=$_POST['phonenumber'];
    $select= "select * from users where id='$id'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['id'];
    if($res === $id)
    {
   
       $update = "update users set fname='$fname',lname='$lname',email='$email' ,phonenumber='$phonenumber' where id='$id'";
       $sql2=mysqli_query($conn,$update);
if($sql2)
       { 
           /*Successful*/
           header('location:Dashboard.php');
       }
       else
       {
           /*sorry your profile is not update*/
           header('location:Profile_edit_form.php');
       }
    }
    else
    {
        /*sorry your id is not match*/
        header('location:Profile_edit_form.php');
    }
 }
?>