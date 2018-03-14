<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>

<body>

    
    <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"></h3>
  </div>
  <div class="w3-bar-block">
    <h1>
        Add A Game
    </h1>
    <form action="AddGameNOW.php" method="post" >
        <p>test</p>
        <input style="length:20px" type="text" name="Genre" placeholder="Genre "/> <br/>   
        <select name="Consoles">
            <option value="5">PlayStation 1</option>
            <option value="6">PlayStation 2  </option>
            <option value="7">PlayStation 3</option>
            <option value="8">PlayStation 4</option>
            <option value="9">Xbox</option>
            <option value="10">Xbox 360</option>
            <option value="11">Xbox One</option>
            <option value="13">Sega Genesis</option>
            <option value="14">Dreamcast</option>>
            <option value="4">GameCube</option>
            <option value="4">Nintendo 64</option>
            <option value="1">NES</option>
            <option value="2">NES</option>
            <option value="16">Nintendo Switch</option>
            <option value="15">Wii</option>
            <option value="12">PC(Computer)</option>
        </select>
        <input type="text" name="Name" placeholder="Name of the Game"/><br/>
        <input type="text" name="Publisher" placeholder="Publisher"/><br/>
        <input type="text" name="Developer" placeholder="Developer"/><br/>
        <input type="text" name="ESRB" placeholder="ESRB"/><br/>
        <input type="text" name="Date" placeholder="Release Date (yyyy-mm-dd)"/><br/>
        <input type="submit" value"Submit"/>
        <input type="reset" value"reset">
    </form>
  </div>
</nav>

<div class="w3-main" style="margin-left:340px;margin-right:40px">
  <div class="w3-container" style="margin-top:0" id="showcase">
    <h1 style="margin-bottom:0" class="w3-xxxlarge w3-text-red"><b>All Video Games</b></h1>
    <hr  style="width:500px;border:5px solid blue;margin-top:0" class="w3-round">
    
       <?php
        $db = new mysqli('localhost', 'tanuki55', '', 'videoGameReviews');
        
		$Name=trim($_POST["Name"]);
		
	if ($db->connect_error) {
    	die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
	}
    	if ($result = $db->query("SELECT gameID, gameGenre AS Genre, gameTitle as Title, Publisher, Developer,ESRB,releaseDate AS `Release Date` FROM Games WHERE gameTitle =  '$Name';")) {
    	    //find size of result set
    		$num_results = $result->num_rows;
    		$num_fields = $result->field_count;
    		echo "<table border='0'>";
    		echo "<tr>";
    		//get and display field names
    		$dbinfo = $result->fetch_fields();
    		foreach ($dbinfo as $val) {
    			echo "<th>".$val->name."</th>";
    		}
    
    		echo "</tr>";
    		while($row = $result->fetch_row())	{
    			echo "<tr>";
    			for($i=0; $i<$num_fields; $i++){
    				echo "<td>". stripslashes($row[$i])."</td>";
    			}
          //add this for edit and delete functions
    			echo "<td>";
    			echo "<a href='EditGame.php?id=". $row[0] ."'>Edit</a>";
                echo "</td>";
                echo "<td>";
    			echo "<a href='DeleteGame.php?id=". $row[0] ."'>Delete</a>";
                echo "</td>";
    			echo "</tr>";
    		}
    		$result->close();
    		echo "</table>";
    		echo "<br/><a href='runner.php'>home</a>";
        }
	$db->close();
     ?>
  </div>
</div>

<style>
p
{
  margin:0;
  padding:-5;
  font-size:20px;
}
h1{
    padding:-5;
}

th{
  border: 1px solid black;
}
td{
    padding:10px;
    border: 1px solid black;
}
table{
    border: 1px solid black;
    /*padding:10px;*/
}
tr {
    text-align: center;
}

</style>
</body>
</html>