<?php 
session_start(); 
//Get username from the session to use in the queries
$username = $_SESSION["username"];
//Login to database
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "registration";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

//check if connected or not
if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
}
//score value
if ( ! empty( $_COOKIE['score'] ) ) { 
	$score = $_COOKIE['score'];
    

}
//Get the highest score for the user
$checkscore = "SELECT score FROM user WHERE username = '$username'";
$checkresult = mysqli_query($conn,$checkscore);

//compare the recent score with the score in the database
while ($row = mysqli_fetch_assoc($checkresult)){
    if($score > $row['score']){
    $sql = "UPDATE user SET score = '$score' WHERE username= '$username'";
    if(mysqli_query($conn, $sql)){
     echo "Score updated.<br>";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
}
}

//get the scores and the usernames from highest score to lowest and display the leaderboared

$sql = "SELECT username, score FROM user ORDER BY score DESC";
$result = mysqli_query($conn,$sql);
$rank = 1;
$count = mysqli_num_rows($result);


if (mysqli_num_rows($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<td>{$rank}</td>
              <td>{$row['username']}</td>
             <td>{$row['score']}</td><br>";

        $rank++;
    }
}

?>
