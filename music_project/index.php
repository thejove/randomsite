<?php 
	
	$an = array();

	//Includes
	include_once "inc/db.inc.php";
	
	//Connect to database
	$db = new PDO(DB_INFO, DB_USER, DB_PASS);
	
	//Get the artist names
	$sql = "SELECT artist_name
			FROM artists
			ORDER BY artist_id ASC";
	foreach($db->query($sql) as $row)
		$an[] = array(
			'artist_name' => $row['artist_name']
		);

?>



<form action="inc/db_input.inc.php" method="post">
	<label for="name">Enter artist name: </label>
	<input type="text" name="name" />
	<input type="submit" value="Post to Database!" />
</form>
<br />
<br />
<?php

	foreach($an as $artname)
		echo $artname['artist_name'] . "<br />";
?>