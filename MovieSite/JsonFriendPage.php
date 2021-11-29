<?php
include 'Pdo.php';
Session_start();
 if (isset($_POST)) {
	 if ($_POST['Action'] == "Accepted") {
	 $sql = 'INSERT INTO friends (Username1, Username2) 
	 VALUES (:Sender, :Session_User)';
	 $stmt = $pdo->prepare ($sql);
	 $stmt-> bindParam (':Sender', $Sender);
	 $stmt-> bindParam (':Session_User', $Session);
     $Session = $_SESSION['userName'];
	 $Sender = $_POST['Friend'];
     $stmt->execute ();
	 
	 $sql = 'INSERT INTO friends (Username1, Username2) 
	 VALUES (:Session_User, :Sender)';
	 $stmt = $pdo->prepare ($sql);
	 $stmt-> bindParam (':Sender', $Sender);
	 $stmt-> bindParam (':Session_User', $Session);
     $Session = $_SESSION['userName'];
	 $Sender = $_POST['Friend'];
     $stmt->execute ();
	 
	 $sql = 'DELETE FROM friend_requests WHERE Username1 = :Sender AND Username2 = :Rejecter';
	 $stmt2 = $pdo->prepare ($sql);
	 $stmt2->bindparam (':Rejecter', $Rejected);
	 $stmt2->bindparam (':Sender', $Sender);
	 $Sender = $_POST['Friend'];
	 $Rejected = $_SESSION['userName'];
	 $stmt2->execute();
	 
	 $sql = 'SELECT * FROM comments,friends,movies 
WHERE friends.Username1 = :User 
AND comments.Username = friends.Username2 AND 
comments.Movie_ID = movies.Movie_ID 
ORDER BY comments.Date_Added DESC LIMIT 10';
$stmt3 = $pdo->prepare ($sql);
$stmt3-> bindParam (':User', $_SESSION['userName']);
$stmt3->execute ();
while ($row4 = $stmt3->fetch()) {
	echo($row4['Username']. ' '); 
	echo($row4['Movie_Name']); ?>
	<br>
	<?php
	echo($row4['Comment']); ?>
	<br> 
	<?php
}

	 }
	 if ($_POST['Action'] == "Rejected") {
	 $sql = 'DELETE FROM friend_requests WHERE Username1 = :Sender AND Username2 = :Rejecter';
	 $stmt = $pdo->prepare ($sql);
	 $stmt->bindparam (':Rejecter', $Rejected);
	 $stmt->bindparam (':Sender', $Sender);
	 $Sender = $_POST['Friend'];
	 $Rejected = $_SESSION['userName'];
	 $stmt->execute();
	 echo($_POST['Friend']);


 }
 }

?>