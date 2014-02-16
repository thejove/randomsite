<?php 

	//Includes
	include_once "inc/db.inc.php";
	include_once "inc/functions.ini.php";
	
	//Connect to database
	$db = new PDO(DB_INFO, DB_USER, DB_PASS);
	
	//Determine if id was passed in url
	$id = (isset($_GET['id'])) ? (int) $_GET['id'] : NULL;
	
	//Load data
	$data = getData($db, $id);
	
	//Get dislay method and remove fro array
	$dispArtist = array_pop($data);	

?>



<form action="inc/db_input.inc.php" method="post">
	<label for="name">Enter artist name: </label>
	<input type="text" name="name" />
	<input type="submit" value="Post to Database!" />
</form>
<br />
<br />
<?php

	if($dispArtist == 0)
	{
		foreach($data as $albName)
		{

?>

			<h2><?php echo $data['album_name']?></h2>
			<?php }?>
			<p><a href="./">Back To Artists</a></p>
<?php 	
	}
	else
	{
		foreach($data as $artName)
		{

?>

			<p>
				<a href="?id=<?php echo $data['artist_id']?>">
					<?php echo $data['artist_name']?></a>
			</p>
<?php 
		}
	}
?>