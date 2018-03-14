
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
<style>
.dropbtn {
    background-color: green;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,.5);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
  background-color: black
  
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>
<body>
  
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>Computer<br>Scores</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="AllReviews.php" class="w3-bar-item w3-button w3-hover-white">Reviews</a> 
    <a href="runner.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a> 
    
<div class="dropdown">
  <button class="dropbtn">Games</button>
  <div class="dropdown-content">
    <a href="AddGame.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">All Games</a>
    <a href="AddGame.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Add Games</a>
    <a href="SearchMenu.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Search Games</a>
     <div class="dropdown-content">
        <form action="SearchGames.php" method="post" >
            <input type="text" name="Name" placeholder="Name of the Game"/><br/>
            <input type="submit" value"Submit"/>
            <input type="reset" value"reset">
        </form>
      </div>
  </div>
</div> 
    <a href="AllReviewers.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Reviewers </a>  
    <a href="MakeAReview.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Make A Review </a> 
    <a href="#designers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Designers</a> 
    
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact</a>
  </div>
</nav>

<div class="w3-main" style="margin-left:340px;margin-right:40px">
  <div class="w3-container" style="margin-top:0" id="showcase">
    <h1 style="margin-bottom:0" class="w3-xxxlarge w3-text-red"><b>All Video Game Reviewers</b></h1>
    <hr  style="width:500px;border:5px solid blue;margin-top:0" class="w3-round">
    
            <?php
            
            
        $db = new mysqli('localhost', 'tanuki55', '', 'videoGameReviews');


	if ($db->connect_error) {
    	die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
	}

	$query="SELECT reviewName AS Name, favGenere AS 'Favorite Genere', favConcole AS 'Favorite Concole' FROM Reviewer";
	//$result = $db->query($query);

	if ($result = $db->query($query)) {

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
	//		echo "<td>";
	//		echo "<a href='edit_book.php?id=". $row[0] ."'>Edit</a>";
      //      echo "</td>";
        //    echo "<td>";
		//	echo "<a href='delete_book.php?id=". $row[0] ."'>Delete</a>";
          //  echo "</td>";
			//echo "</tr>";
		}

		$result->close();
		echo "</table>";
		echo "<br/><a href='runner.php'>Home</a>";
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