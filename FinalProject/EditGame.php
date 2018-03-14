<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Book-O-Rama Edit</title>
</head>

<body>

    <?php
        $id = $_GET["id"];
        
	    $db = new mysqli('localhost', 'tanuki55', '', 'videoGameReviews');
    	if ($db->connect_error) {
    		die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    	}
      $sql = "SELECT * FROM Games WHERE gameID = ?";

      if($stmt = $db->prepare($sql)){
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result =$stmt->store_result();
  	    $stmt->bind_result($gameID, $gameGenre, $consoleID, $gameTitle, $Publisher, $Developer, $ESRB, $releaseDate);
  	    $stmt->fetch();
        $stmt->close();
      }
          ?>

	<form action="UpdateGame.php" method="post">
		<input type="hidden" name="gameID" value="<?php echo $gameID?>"/>
		<p>Genre <input type="text" name="gameGenre" maxlength="30" size="30"value="<?php echo $gameGenre?>"/></p>
		<p>Title <input type="text" name="gameTitle" maxlength="30" size="30"value="<?php echo $gameTitle?>"/></p>
		<p>Publisher <input type="text" name="Publisher" maxlength="30" size="30"value="<?php echo $Publisher?>"/></p>
		<p>Developer <input type="text" name="Developer" maxlength="30" size="30"value="<?php echo $Developer?>"/></p>
		<p>ESRB <input type="text" name="ESRB" maxlength="30" size="30"value="<?php echo $ESRB?>"/></p>
        <p>Release Date <input type="text" name="releaseDate" maxlength="30" size="30"value="<?php echo $releaseDate?>"/></p>

		<input type="submit" name="submit" value="Update" />
	</form>
</body>

</html>
