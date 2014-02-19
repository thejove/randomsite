<?php
	include_once 'db.inc.php';	
	
	//Checks database to see of item already exists
	function item_exists($db, $col, $val)
	{
    	$query = $db->prepare("SELECT * FROM players WHERE $col = :val");
    	$query->execute(array(':val' => $val));
    	$fetch = $query->fetch();
    	if($fetch[$col]){
        return true;
    	}
    	else{
        	return false;
    	}
	}
?>