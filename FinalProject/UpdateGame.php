<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Edit Book</title>
</head>

<body>
	<h1> Book-O-Rama Book Updated </h1>
<?php
	$gameID=$_POST["gameID"];
	$gameGenre=$_POST["gameGenre"];
	$gameTitle=$_POST["gameTitle"];
	$Publisher=$_POST["Publisher"];
	$Developer=$_POST["Developer"];
	$ESRB=$_POST["ESRB"];
	$releaseDate=$_POST["releaseDate"];
	
	if(!$gameGenre || !$gameTitle || !$Publisher || !$Developer || !$ESRB || !$releaseDate) {
		echo "You have not entered all required details.  Please go back and try again.";
		exit;
	}

	//format input
	$gameGenre = addslashes($gameGenre);
	$gameTitle = addslashes($gameTitle);
	$Publisher = addslashes($Publisher);
	$Developer = addslashes($Developer);
	$ESRB = addslashes($ESRB);
	$releaseDate = addslashes($releaseDate);
	//connect to the database
	@$db = new mysqli('localhost', 'tanuki55', '', 'videoGameReviews');
   
	if ($db->connect_error) {
		die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
	}
    echo $Developer;
    echo $Publisher;
	$query = "update Games SET gameGenre = ?, gameTitle = ?, Publisher = ?, Developer = ?, ESRB = ?,releaseDate = ? WHERE gameID =?";
	if(	$stmt = $db->prepare($query)){
		$stmt->bind_param("ssssssi", $gameGenre, $gameTitle,$Publisher,$Developer,$ESRB,$releaseDate,$gameID);
	  $stmt->execute();

    if ($stmt->affected_rows == 1){
    	echo "<h2>New Values:</h2>";
    	echo "<strong>ISBN: </strong>". $gameGenre . "<br/>";
    	echo "<strong>Title: </strong>". $gameTitle . "<br/>";
    	echo "<strong>Author: </strong>". $Publisher. "<br/>";
    	echo "<strong>Price: </strong>". $Developer. "<br/>";
    	echo "<strong>Author: </strong>". $ESRB. "<br/>";
    	echo "<strong>Price: </strong>". $releaseDate. "<br/>";
    }
}else{
	 echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$db->close();

?>
<a href="AddGame.php">Return to Books</a>
</body>

</html>
