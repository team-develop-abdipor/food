<?php
    $id=$_GET["id"];
    include("../application/config.php");
    
    // Check connection
    if ($con->connect_error) 
    {
        die("Connection failed: " . $con->connect_error);
    }
    else 
    {
        unset($Personel);
		$sql="SELECT * FROM tbl_personel where section=".$id;
		$result = $con->query($sql);
		while($row =$result->fetch_assoc())
		{
			$Personel[] = array("id" => $row['id'], "name" => $row['name'],"section"=>$row['section'],"job"=>$row['job'],"phone"=>$row['phone']);
		}
		$json["list"]= $Personel;

			echo json_encode($json,JSON_UNESCAPED_SLASHES);
 
    }
