<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0; MakeAReview.php" /> 
    <title>ADD Games to database.</title>
    
</head>
<body>
    <?php
        $ReviewID =trim($_POST["ReviewID"]);
        $GameID =$_POST["GameID"];
        $Score =trim($_POST["Score"]);
        $Review =trim($_POST["Review"]);

        
        if(!$ReviewID || !$GameID || !$Score || !$Review ) {
            //echo $Review;
      		echo "You have not entered all required details. Go <a href='MakeAReview.php'>back</a> and try again.";
      		exit;
      	}
    
      	//format input
      	$ReviewID = doubleval($ReviewID);
      	$GameID = doubleval($GameID);
      	$Score = doubleval($Score);
      	$Review = addslashes($Review);
      	
      	//connect to the database
      	@$db = new mysqli('localhost', 'tanuki55', '', 'videoGameReviews');
    
      	if ($db->connect_error) {
      		die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
      	}
        
        //need help here. SHIT
      	$query = "insert into Ratings values (null, ?, ?, ?, ?)";
        if( $stmt = $db->prepare($query)){
          $stmt->bind_param("iiis", $ReviewID, $GameID, $Score, $Review);
          $stmt->execute();
          echo $stmt->affected_rows." ITS ALIVE";
        
          /* close statement */
            $stmt->close();
        }
    
      	$db->close();
        ?>
</body>
</html>