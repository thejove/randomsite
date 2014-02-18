<?php 
	session_start();
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
		        <p class="welcome">Welcome, <?php echo $_SESSION['player'];?><b></b></p>
		        <p class="logout"><a id="exit" href="logout.php">Logout</a></p>
		        <div style="clear:both"></div>
		    </div>
		     
		    <div id="chatbox"></div>
		     
		    <form name="message" action="">
		        <input name="usermsg" type="text" id="usermsg" size="63" />
		        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
		    </form>
		</div>
	</body>
</html>