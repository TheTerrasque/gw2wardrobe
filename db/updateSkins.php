<?php
	include('config.php');
	
	// URLs
	$apiSkins = 'https://api.guildwars2.com/v1/skins.json';
	$apiSkinDetails = 'https://api.guildwars2.com/v1/skin_details.json?skin_id=';

	// Let's get a list over all the skins in the game!
	$skins = file_get_contents($apiSkins);
	$skins = json_decode($skins);
	$skins = $skins->skins;
	$skinsProcessed = array();
	$i = 0;
	
	// If we got our data
	if(isset($skins)) {
		// Now, we'll have to get some details about every single one of the skins
		foreach ($skins as $skin) {
			$i++;
			if ($i == 10) break;
			
			$detailsUrl = $apiSkinDetails . $skin;
			$details = file_get_contents($detailsUrl);
			$details = json_decode($details);
			
			// Gotta create an StdClass to hold the skin details
			$detailsProcessed = new StdClass;
			$detailsProcessed->skin_id = $details->skin_id;
			$detailsProcessed->name = $details->name;
			$detailsProcessed->icon_file_id = $details->icon_file_id;
			$detailsProcessed->icon_file_signature = $details->icon_file_signature;
			$detailsProcessed->type = $details->type;
			
			// Weapon or armor
			$type = $details->type;
			
			if($type == "Armor") {
				$detailsProcessed->armor_type = $details->armor->type;
				$detailsProcessed->armor_weight = $details->armor->weight_class;
			}
			else if($type == "Weapon") {
				$detailsProcessed->weapon_type = $details->weapon->type;
			}
			
			// Push it to the array
			array_push($skinsProcessed, $detailsProcessed);
		}
		
		echo "All skins pushed to array (length: " . sizeof($skinsProcessed) . ") <br />";
		
		// Now, let's do the SQL stuffsies
		foreach($skinsProcessed as $skin) {
			// Different values for type = armor, and type = weapon
			$type = $skin->type;
			
			if($type == "Weapon") {
				$sql = "UPDATE gw2_skins
						SET name='$skin->name', icon_file_id='$skin->icon_file_id', icon_file_signature='$skin->icon_file_signature', weapon_type='$skin->weapon_type'
						WHERE id = '$skin->skin_id'";
			
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error($con));
				}
			}
			else if($type == "Armor") {
				$sql = "UPDATE gw2_skins 
						SET name='$skin->name', icon_file_id='$skin->icon_file_id', icon_file_signature='$skin->icon_file_signature', armor_type='$skin->armor_type', armor_weight='$skin->armor_weight')
						WHERE id = '$skin->skin_id'";
			
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error($con));
				}
			}
		}
	}
	
	mysqli_close($con);
?>