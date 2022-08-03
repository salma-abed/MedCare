<?php 

require("connect.php");

if(empty($_SESSION['user']) || empty($_SESSION['adminaccess']))
{ 
    header("Location: login.php"); 
    die("Redirecting to login.php"); 
}

//BEGIN USER DELETE FUNCTION
//IM NOT SURE HOW TO SET THIS UP, OR IF IT'S EVEN IN THE RIGHT PLACE
if(isset($_SESSION['adminaccess']))  //if user has admin privilege
{
    $id = isset($_POST['id'])?intval($_POST['id']):0;
    if($id>0)  //if valid id for deleting is posted
    { 
      $query = 'DELETE FROM users WHERE id = '.$id;
      echo '<script>alert("Query: '.$query.'");</script>';  //debug line, remove this later
      try
      {
         $stmt = $db->prepare($query);
         $stmt->execute();
      }
      catch(PDOException $ex)
      {
         die("Failed to run query: " . $ex->getMessage()); 
      }
    }
    else
    {
       echo '<script>alert("Invalid ID: '.$id.'");</script>';  //debug line, remove this later
    }
}
else
{
    echo '<script>alert("No admin access privilege.");</script>';  //debug line, remove this later
}
//END USER DELETE FUNCTION

//BEGIN DATA FETCHING TO DISPLAY CURRENT USERS
$query = " 
    SELECT 
        id, 
        username,
        display_name, 
        email,
        admin
    FROM users 
"; 

try 
{ 
    $stmt = $db->prepare($query); 
    $stmt->execute(); 
} 
catch(PDOException $ex) 
{ 
    die("Failed to run query: " . $ex->getMessage()); 
} 

$rows = $stmt->fetchAll();
//END DATA FETCHING TO DISPLAY CURRENT USERS

..........


?>