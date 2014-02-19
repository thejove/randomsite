<?php 
	session_start();
	include_once 'inc/functions.inc.php';

	$player = $_SESSION['player'];
	$input = $_POST['usermsg'];
	
	//Connect to database
	$db = new PDO(DB_INFO, DB_USER, DB_PASS);

	//Check database
	$sql = "SELECT * FROM players WHERE player_name = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute(array($player));
	$data = $stmt->fetch();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Zombie RPG</title>
		<link type="text/css" rel="stylesheet" href="css/default.css" />
	</head>
	
	<body>
		<div id="wrapper">
		    <div id="menu">
		        <p class="welcome">Welcome, <b>
		        <?php 
		        	echo $player; echo " Lvl: " 
					. $data['player_level']
		        	. " HP: " . $data['player_hp']
		        	. " Atk: " . $data['player_attack']
		        	. " Def: " . $data['player_defense'];
		        ?></b></p>
		        <p class="logout"><a id="exit" href="logout.php">Logout</a></p>
		        <div style="clear:both"></div>
		    </div>
		     
		    <div id="display">
		    	<?php
		    		echo $input;
		    	?>
		    </div>
		     
		    <form action="" method="post" name="message">
		        <input name="usermsg" type="text" id="usermsg" size="63" />
		        <input name="submitmsg" type="submit"  id="submitmsg" value="Do it!" />
		    </form>
		    
		    <script type="text/javascript">document.message.usermsg.focus()</script>
		</div>
	</body>
</html>