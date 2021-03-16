<?php

//user registration data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password']; 

//database access data
$servername = "localhost";
$dbusername= "root";
$dbpassword= "root";
$dbname = "registration";

//creating connection
$conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
//check if connected or not
if($conn->connect_error){
die("connection failed" . $conn->connect_error);
}
//regestring users into database
$sql = "INSERT INTO user(username, email, password)VALUES ('$username','$email','$password')";
//checking if the query was successfully added or not
if($conn->query($sql)=== TRUE){

    echo "added";
} else {echo "error";}

$conn->close();

?>
