<?php 

	//Include necessary files
	include_once 'inc/functions.inc.php';
	include_once 'inc/db.inc.php';
	
	//Open database connection
	$db = new PDO(DB_INFO, DB_USER, DB_PASS);
	
	//Determine if entry id was passed in the url
	$id = (isset($_GET['id'])) ? (int) $_GET['id'] : NULL;
	
	//Load entries
	$e = retrieveEntries($db, $id);
	
	//Get fulldisp flag and remove it from the array
	$fulldisp = array_pop($e);
	
	//Sanatise the entry data
	$e = sanatiseData($e);

?>


<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="css/default.css" type="text/css" />
		<title>Simple Blog</title>
	</head>

	<body>
	
		<h1>Simple Blog Application</h1>
		
		<div id="entries">
			<?php 
				//If the full display flag is set, show the entry
				if($fulldisp == 1)
				{
			?>
					<h2><?php echo $e['title'] ?></h2>
					<p><?php echo $e['entry'] ?></p>
					<p class = "backlink">
						<a href="./">Back to Latest Entries</a>
					</p>
			<?php } //End the if statement
				else
				{
					//Loop through each entry
					foreach($e as $entry)
					{
			?>
						<p>
							<a href="?id=<?php echo $entry['id'] ?>">
								<?php echo $entry['title'] ?>
							</a>
						</p>
			<?php 
					} //End the foreach
				} 	  //End the else
			?>
			
			<p class="backlink">
				<a href="admin.php">Post a New Entry</a>
			</p>	
		</div>
	
	</body>
	
</html>