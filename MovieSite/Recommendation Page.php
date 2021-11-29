<html>
<head>
<link rel="stylesheet" href="Navigation Bar.css">
<ul>
  <li><a href="http://localhost/MovieSite/Home.php">Home</a></li>
  <li><a href="http://localhost/MovieSite/Login.php">Login</a></li>
  <li><a href="http://localhost/MovieSite/Registration.php">Register</a></li>
  <li><a href="http://localhost/MovieSite/Search.php">Search</a></li>
  <li><a href="http://localhost/MovieSite/Recommendation%20Page.php">Recommended</a></li>
</ul>
</head>
<body>
<?php 
include 'Pdo.php';
session_start();
if ($_SESSION['userName']) {
$sql = 'SELECT movies.Movie_ID, movies.Movie_Name ,COUNT(*) AS Rating_Count FROM movies, ratings, friends
WHERE movies.Movie_ID = ratings.Movie_ID AND friends.Username1 = :SessionUser AND ratings.stars = 5 AND ratings.Username = friends.Username2 
GROUP BY movies.Movie_ID
ORDER BY Rating_Count DESC'; 
$stmt = $pdo->prepare ($sql);
$stmt -> bindParam (':SessionUser', $_SESSION['userName']);
$stmt->execute ();
while($row = $stmt->fetch ()) { 
     echo '<p><a href = "http://localhost/MovieSite/Movie_Page.php?id='.$row['Movie_ID'].'">'.$row['Movie_Name'].'</a></p>';
	 ?> <br>
	 Number of 5 STAR RATINGS by YOUR friends:
	 <?php
	 echo $row['Rating_Count'];
	 ?>
	 <br> <br>
	 <?php 
}
}
else {
	echo("Sign in to see this page");
	header("Location:http://localhost/MovieSite/Home.php");
exit();
}
?>
<body>
<html>
