<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST'
	&& !empty($_POST['name']))
	{
		//Include mySQL details
		include_once "db.inc.php";
		
		//Connect to database
		$db = new PDO(DB_INFO, DB_USER, DB_PASS);
		
		//Post entry to database
		$artistname = $_POST['name'];
		$task = array(':artistname' => $artistname);
		$sql = "INSERT INTO artists(artist_name) VALUES (:artistname)";
		$stmt = $db->prepare($sql);
		$stmt->execute($task);
		$stmt->closeCursor();
		
		//Get the id of the entry that was just saved
		$id_obj = $db->query("SELECT LAST_INSERT_ID()");
		$id = $id_obj->fetch();
		$id_obj->closeCursor();
		
		//Send user back to home page
		header('Location: ../?id=' . $id[0]);
	}
	else
		header('Location: ../');

?>