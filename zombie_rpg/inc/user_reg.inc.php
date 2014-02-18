<?php 
	include_once "db.inc.php";
	include_once "functions.inc.php";
	
	//Check if user get here through registration form
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//Connect to database
		$db = new PDO(DB_INFO, DB_USER, DB_PASS);
		
		$player = $_POST['player'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$email = $_POST['email'];
		
		//Sanatise data
		$player = strip_tags($player);
		$email = strip_tags($email);
		
		//Check if player name was entered
		if($player == "")
		{
			echo "You need to enter a player name! <br />";
			echo "<a href='../register.php'>Go Back!</a>";
			exit;
		}
		
		//Check if email was entered
		if($email == "")
		{
			echo "You need to enter an email address! <br />";
			echo "<a href='../register.php'>Go Back!</a>";
			exit;
		}
		
		//Check if passwords match
		if($pass1 == $pass2)
		{
			//Check if password fields hold data
			if(!$_POST['pass1'] || !$_POST['pass2'])
			{
					echo "You did not enter a password!<br />";
					echo "<a href='../register.php'>Go Back!</a>";
					exit;
			}
			
			//Check if player name already exits and if its too long/short
			else if(item_exists($db, 'player_name', $player) || strlen($player) > 21 || strlen($player) < 1)
			{
				echo "There is already a player with that name or the name you specified is over 16 letters or less than 1 letter!<br />";
				echo "<a href='../register.php'>Go Back!</a>";
				exit;
			}
			
			//Check if email is in use
			else if(item_exists($db, 'player_email', $email))
			{
				echo "Email is already in use!<br />";
				echo "<a href='../register.php'>Go Back!</a>";
				exit;
			}
			
			else 
			{
				//Encrypt password
				$pass1 = md5($pass1);
				
				$lvl = 1;
				$exp = 0;
				
				$sql = "INSERT INTO players(player_name, player_email, player_pass, player_level, player_exp) 
						VALUES(?, ?, ?, ?, ?)";
				$stmt = $db->prepare($sql);
				$stmt->execute(array($player, $email, $pass1, $lvl, $exp));
				$stmt->closeCursor();
				
				echo "Thank you for registering!";
			}
		}
		//If passwords don't match
		else
		{
			echo "Your passwords do not match! <br />";
			echo "<a href='../register.php'>Go Back!</a>";
			exit;
		}
	}
	//Send user back if he got not through registration form
	else
		header("Location: ../register.php");
	
	echo "<a href='../login.php'>Login Page</a>"
	
	
?>