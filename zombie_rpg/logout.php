<?php 

	session_start();
	session_destroy();
	
	echo "Thanks for playing!<br />";
	echo "<a href='login.php'>Go to Log In Page!</a>";

?>