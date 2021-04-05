<?php
session_start();

//database access data
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "registration";

//creating connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
//check if connected or not
if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
//store user data on session
$_SESSION['username'] = $_POST['username'];
$username = $_SESSION['username'];

 //if a data is posted in the form  
if($_POST) {

   //store the data
   $username = mysqli_real_escape_string($conn,$_POST['username']);
   $password = mysqli_real_escape_string($conn,$_POST['password']); 
  //check if the data exist, and they match the found data 
   $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
   //performe the query
   $result = mysqli_query($conn,$sql);
   //check the number of rows in the table, if zero, the data is not registerd
   $count = mysqli_num_rows($result);
   
//if correct direct the user to the home page, if not send an error message     
   if($count == 1) {

      header("location: Game.html");
   }else {
      echo '<script>alert("Invalid login info");
      window.location.href="login.html";
      </script>';

   }

   }

?>
