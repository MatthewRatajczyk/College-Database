<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0; AddGame.php" />
    <title>ADD Games to database.</title>
    
</head>
<body>
    <?php
        $Name=trim($_POST["Name"]);
        $Consoles=$_POST["Consoles"];
        $Publisher=trim($_POST["Publisher"]);
        $Developer=trim($_POST["Developer"]);
        $ESRB=trim($_POST["ESRB"]);
        $Date=trim($_POST["Date"]);
        $Genre=trim($_POST["Genre"]);
        
        if(!$Name || !$Consoles || !$Publisher || !$Developer || !$ESRB || !$Date || !$Genre) {
      		echo "You have not entered all required details. Go <a href='add_book.html'>back</a> and try again.";
      		exit;
      	}
    
      	//format input
      	$Name = addslashes($Name);
      	$Consoles = addslashes($Consoles);
      	$Publisher = addslashes($Publisher);
      	$Developer = addslashes($Developer);
      	$ESRB = addslashes($ESRB);
      	$Date = addslashes($Date);
      	$Genre = addslashes($Genre);
      	
      	//connect to the database
      	@$db = new mysqli('localhost', 'tanuki55', '', 'videoGameReviews');
    
      	if ($db->connect_error) {
      		die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
      	}
        
        //need help here. SHIT
      	$query = "insert into Games values (null, ?, ?, ?, ?, ?, ?, ?)";
        if( $stmt = $db->prepare($query)){
          $stmt->bind_param("sisssss", $Genre, $Consoles, $Name, $Publisher, $Developer,$ESRB,$Date);
          $stmt->execute();
          echo $stmt->affected_rows." book inserted into database";
        
          /* close statement */
            $stmt->close();
        }
    
      	$db->close();
        ?>
</body>
</html>