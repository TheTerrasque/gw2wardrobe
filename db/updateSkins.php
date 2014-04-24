<?php
	include('config.php');

	// Fetching GET
	$from = $_GET['from'];
	$to = $_GET['to'];
	
	// URLs
	$apiSkins = 'https://api.guildwars2.com/v1/skins.json';
	$apiSkinDetails = 'https://api.guildwars2.com/v1/skin_details.json?skin_id=';

	// Let's get a list over all the skins in the game!
	$skins = file_get_contents($apiSkins);
	$skins = json_decode($skins);
	$skins = $skins->skins;
	$skinsProcessed = array();
	
	// If we got our data
	if(isset($skins)) {
		// Maybe limit the search, because we suck at server-side programming
		// Unless $from is already set, we set it to 0.
		// If $from is set, we set the default if $from has strange values
		if(!isset($from) || $from < 0 || $from > sizeof($skins)) {
			$from = 0;
		}
		// Unless $to is already set, we set it to the length of $skins.
		// If $to is set, we set the default if $to has strange values
		if(!isset($to) || $to < 0 || $to > sizeof($skins) || $to < $from) {
			$to = sizeof($skins);
		}
		
		// Now, we'll have to get some details about every single one of the skins
		for($from; $from < $to; $from++) {
			$detailsUrl = $apiSkinDetails . $skins[$from];
			$details = file_get_contents($detailsUrl);
			$details = json_decode($details);
			
			// Gotta create an StdClass to hold the skin details
			$detailsProcessed = new StdClass;
			$detailsProcessed->skin_id = $details->skin_id;
			$detailsProcessed->name = mysqli_real_escape_string($con, $details->name);
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
				$sql = "INSERT INTO gw2_skins (id, name, icon_file_id, icon_file_signature, type, weapon_type)
						VALUES ('$skin->skin_id', '$skin->name', '$skin->icon_file_id', '$skin->icon_file_signature', '$type', '$skin->weapon_type')
						ON DUPLICATE KEY UPDATE name=VALUES(name), icon_file_id=VALUES(icon_file_id), icon_file_signature=VALUES(icon_file_signature), type=VALUES(type), weapon_type=VALUES(weapon_type)";
			
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error($con));
				}
			}
			else if($type == "Armor") {
				$sql = "INSERT INTO gw2_skins (id, name, icon_file_id, icon_file_signature, type, armor_type, armor_weight)
						VALUES ('$skin->skin_id', '$skin->name', '$skin->icon_file_id', '$skin->icon_file_signature', '$type', '$skin->armor_type', '$skin->armor_weight')
						ON DUPLICATE KEY UPDATE name=VALUES(name), icon_file_id=VALUES(icon_file_id), icon_file_signature=VALUES(icon_file_signature), type=VALUES(type), armor_type=VALUES(armor_type), armor_weight=VALUES(armor_weight)";
			
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error($con));
				}
			}
			else if($type == "Back") {
				$sql = "INSERT INTO gw2_skins (id, name, icon_file_id, icon_file_signature, type, armor_type)
						VALUES ('$skin->skin_id', '$skin->name', '$skin->icon_file_id', '$skin->icon_file_signature', 'Armor', '$type')
						ON DUPLICATE KEY UPDATE name=VALUES(name), icon_file_id=VALUES(icon_file_id), icon_file_signature=VALUES(icon_file_signature), type=VALUES(type), armor_type=VALUES(armor_type)";
			
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error($con));
				}
			}
		}
		
		// Now we update some bad naming from ArenaNet
		$sql = "UPDATE `gw2_skins` SET `armor_type`='Chest' WHERE `armor_type` = 'Coat'";
		if (!mysqli_query($con,$sql)) {
			die('Error: ' . mysqli_error($con));
		}
		
		$sql = "UPDATE `gw2_skins` SET `armor_type`='Headgear' WHERE `armor_type` = 'Helm'";
		if (!mysqli_query($con,$sql)) {
			die('Error: ' . mysqli_error($con));
		}
		
		$sql = "UPDATE `gw2_skins` SET `armor_type`='AquaticHeadgear' WHERE `armor_type` = 'HelmAquatic'";
		if (!mysqli_query($con,$sql)) {
			die('Error: ' . mysqli_error($con));
		}
		
		$sql = "UPDATE `gw2_skins` SET `weapon_type`='HarpoonGun' WHERE `weapon_type` = 'Harpoon'";
		if (!mysqli_query($con,$sql)) {
			die('Error: ' . mysqli_error($con));
		}
		
		$sql = "UPDATE `gw2_skins` SET `weapon_type`='Spear' WHERE `weapon_type` = 'Speargun'";
		if (!mysqli_query($con,$sql)) {
			die('Error: ' . mysqli_error($con));
		}
	}
	
	mysqli_close($con);
?>