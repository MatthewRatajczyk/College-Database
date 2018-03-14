<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Book-O-Rama Delete</title>
	<meta http-equiv="refresh" content="0; AddGame.php" />
</head>

<body>

    <?php

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
      $id = trim($_GET["id"]);

    	@$db = new mysqli('localhost', 'tanuki55', '', 'videoGameReviews');

    	if ($db->connect_error) {
    		die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    	}
      // Prepare a select statement
      $sql = "DELETE FROM Games WHERE gameID = ?";
      if($stmt = $db->prepare($sql)){
          $stmt->bind_param("i", $id);
          if ($stmt->execute()){
              echo "<h2>Book Deleted</h2>";
          }else{
              echo "<h2>Something went wrong. Please try again later.</h2";
          }
      }
    }
    ?>

	<a href="AddGame.php">Return to Books</a>
</body>

</html>
