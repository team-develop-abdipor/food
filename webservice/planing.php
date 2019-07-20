<?php

    include("../application/config.php");
    
    // Check connection
    if ($con->connect_error) 
    {
        die("Connection failed: " . $con->connect_error);
    }
    else 
    {
	
		unset($planing);
		$sql="SELECT * FROM tbl_planing";
		$result = $con->query($sql);
		while($row =$result->fetch_assoc())
		{
			$planing[] = array("image" => $row['image']);
		}


		$json["list"]= $planing;

			echo json_encode($json,JSON_UNESCAPED_SLASHES);
 
    }

     
     
