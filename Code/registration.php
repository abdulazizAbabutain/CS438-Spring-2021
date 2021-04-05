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
//user registration data
$username = mysqli_real_escape_string($conn,$_POST['username']);
$email =  mysqli_real_escape_string($conn,$_POST['email']);
$password =  mysqli_real_escape_string($conn,$_POST['password']);

//check if the username and email are duplicated or not
$duplicate_username = "SELECT username FROM user WHERE username = '$username'";
$user_result = mysqli_query($conn ,$duplicate_username);//
$user_count = mysqli_num_rows($user_result);
if($user_count > 0){
    echo '<script>alert("username already exist");
    window.location.href="Front-end/Home_page/Registration_page/Registration.html";
    </script>';
  return false;
}
$duplicate_email = "SELECT email FROM user WHERE email = '$email'";
$email_result = mysqli_query($conn ,$duplicate_email);
$email_count = mysqli_num_rows($email_result);
if($email_count > 0){
  echo '<script>alert("email already exist");
  window.location.href="Front-end/Home_page/Registration_page/Registration.html";
  </script>';
  return false;
}
//regestring users into database
$sql = "INSERT INTO user(username, email, password, score)VALUES ('$username','$email','$password', 0)";
//if the registraion is correct the user will be directed to the login page, if not it will display error message 
if ($conn->query($sql) === TRUE) {

    header("location: /Front-end/Home_page/Log_in_page/Login.html");
} else {
    echo "error";
}


$conn->close();
