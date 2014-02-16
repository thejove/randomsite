<?php 

	function getData($db, $id)
	{
		$data = array();
		
		//If an id was supplied display artists albums
		if(isset($id))
		{
			$sql = "SELECT album_name
					FROM albums
					WHERE artist_id = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($_GET['id']));
			
			$data = $stmt->fetch();
		
			//Set display all artists
			$dispArtist = 0;
		}
		
		//If no id was supplied display all artists
		else
		{
			$sql = "SELECT artist_name
			FROM artists
			ORDER BY artist_id ASC";
			foreach($db->query($sql) as $row)
				$data[] = array(
						'artist_name' => $row['artist_name']
				);
			
			$dispArtist = 1;
			
			if(!empty($data))
			{
				$dispArtist = 0;
				
				$data = array(
					'artist_name' => "No Entries Yet!"
				);
			}
		}
		
		array_push($data, $dispArtist);
		
		return $data;
	}

?>