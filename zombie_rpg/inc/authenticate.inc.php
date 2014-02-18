<?php 
	session_start();
	include_once 'db.inc.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//Connect to database
		$db = new PDO(DB_INFO, DB_USER, DB_PASS);
		
		$player = $_POST['player'];
		$pass = $_POST['pass'];
		
		//Sanatise the input
		$player = strip_tags($player);
		$pass = strip_tags($pass);
		
		//Encrypt password for comparison
		$pass = md5($pass);
		
		//Check database
		$sql = "SELECT player_name, player_pass
					FROM players
					WHERE player_name = ?";
		$stmt = $db->prepare($sql);
		$stmt->execute(array($player));
		$data = $stmt->fetch();
		
		//Check if password is correct
		if($data['player_pass'] === $pass)
		{
			$_SESSION['player'] = $player;
			echo "Logged in successfully!<br />";
			echo "<a href='../'>Continue</a>";
		}
		else
		{
			echo "Wrong username or password! <br />";
			echo "<a href='../login.php'>Go Back!</a>";
		}
		
	}
	

?>