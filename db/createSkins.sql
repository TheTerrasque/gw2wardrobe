CREATE TABLE IF NOT EXISTS `gw2_skins` (
	`id` MEDIUMINT(6) unsigned NOT NULL,
	`name` varchar(64),
	`icon_file_id` MEDIUMINT(16),
	`icon_file_signature` varchar(64),
	`type` varchar(32),
	`armor_type` varchar(16),
	`armor_weight` varchar(16),
	`weapon_type` varchar(16),
	`acquisition` varchar(512),
	PRIMARY KEY (`id`)
);
