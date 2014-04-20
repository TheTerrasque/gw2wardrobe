<?php
	// Armor Categories
	$queryArmorCat = "SELECT * FROM gw2_armor_categories ORDER BY `order` ASC";
	$resultArmorCat = mysqli_query($con, $queryArmorCat);
	$armorCat = array();
	
	while($row = mysqli_fetch_assoc($resultArmorCat)) {
		$armorCatClass = new StdClass;
		$armorCatClass->id =		"{$row['id']}";
		$armorCatClass->order =		"{$row['order']}";
		$armorCatClass->shortname =	"{$row['shortname']}";
		$armorCatClass->fullname =	"{$row['fullname']}";
		
		
		array_push($armorCat, $armorCatClass);
	}

	// Armor Types
	$queryArmorTypes = "SELECT * FROM gw2_armor_types ORDER BY `order` ASC";
	$resultArmorTypes = mysqli_query($con, $queryArmorTypes);
	$armorTypes = array();
	
	while($row = mysqli_fetch_assoc($resultArmorTypes)) {
		$armorTypesClass = new StdClass;
		$armorTypesClass->id =			"{$row['id']}";
		$armorTypesClass->order =		"{$row['order']}";
		$armorTypesClass->shortname =	"{$row['shortname']}";
		$armorTypesClass->fullname =	"{$row['fullname']}";
		$armorTypesClass->category =	"{$row['category']}";
		
		array_push($armorTypes, $armorTypesClass);
	}

	// Weapon Categories
	$queryWeaponCat = "SELECT * FROM gw2_weapon_categories ORDER BY `order` ASC";
	$resultWeaponCat = mysqli_query($con, $queryWeaponCat);
	$weaponCat = array();
	
	while($row = mysqli_fetch_assoc($resultWeaponCat)) {
		$weaponCatClass = new StdClass;
		$weaponCatClass->id =			"{$row['id']}";
		$weaponCatClass->order =		"{$row['order']}";
		$weaponCatClass->shortname =	"{$row['shortname']}";
		$weaponCatClass->fullname =		"{$row['fullname']}";
		
		
		array_push($weaponCat, $weaponCatClass);
	}

	// Weapon Types
	$queryWeaponTypes = "SELECT * FROM gw2_weapon_types ORDER BY `order` ASC";
	$resultWeaponTypes = mysqli_query($con, $queryWeaponTypes);
	$weaponTypes = array();
	
	while($row = mysqli_fetch_assoc($resultWeaponTypes)) {
		$weaponTypesClass = new StdClass;
		$weaponTypesClass->id =			"{$row['id']}";
		$weaponTypesClass->order =		"{$row['order']}";
		$weaponTypesClass->shortname =	"{$row['shortname']}";
		$weaponTypesClass->fullname =	"{$row['fullname']}";
		$weaponTypesClass->category =	"{$row['category']}";
		
		array_push($weaponTypes, $weaponTypesClass);
	}
	
	
	// Skins
	$querySkins = "SELECT * FROM gw2_skins ORDER BY `name` ASC";
	$resultSkins = mysqli_query($con, $querySkins);
	$skins = array();
	
	while($row = mysqli_fetch_assoc($resultSkins)) {
		$skinClass = new StdClass;
		$skinClass->id =					"{$row['id']}";
		$skinClass->name =					"{$row['name']}";
		$skinClass->icon_file_id =			"{$row['icon_file_id']}";
		$skinClass->icon_file_signature =	"{$row['icon_file_signature']}";
		$skinClass->type =					"{$row['type']}";
		$skinClass->armor_type =			"{$row['armor_type']}";
		$skinClass->armor_weight =			"{$row['armor_weight']}";
		$skinClass->weapon_type =			"{$row['weapon_type']}";
		$skinClass->acquisition =			"{$row['acquisition']}";
		
		array_push($skins, $skinClass);
	}
?>

<script type="text/javascript">
	var skinsDB = {
		armor_categories: <?php echo json_encode($armorCat); ?>,
		armor_types: <?php echo json_encode($armorTypes); ?>,
		weapon_categories: <?php echo json_encode($weaponCat); ?>,
		weapon_types: <?php echo json_encode($weaponTypes); ?>,
		skins: <?php echo json_encode($skins); ?>
	}
</script>