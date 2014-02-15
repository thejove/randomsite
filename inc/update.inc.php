<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST' 
		&& $_POST['submit'] == 'Save Entry'
		&& !empty($_POST['title'])
		&& !empty($_POST['entry']))
	{
		//Include database credentials and connect to database
		include_once 'db.inc.php';
		$db = new PDO(DB_INFO, DB_USER, DB_PASS);
		
		//$db->query("INSERT INTO entries (title, entry) VALUES ($title, $entry)");
		//Save the entry into the database
		$sql = "INSERT INTO entries (title, entry) VALUES (?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($title, $entry));
		$stmt->closeCursor();
		
		//Get the id of the entry that was just saved
		$id_obj = $db->query("SELECT LAST_INSERT_ID()");
		$id = $id_obj->fetch();
		$id_obj->closeCursor();
		
		//Send the user to the new entry
		header('Location: ../?id='. $id[0]);
	}
	
	//If both conditions are met send the user back to the main page
	else
	{
		header('Location: ../');
		exit;
	}

?>