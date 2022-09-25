CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `state` tinyint NOT NULL DEFAULT '0' COMMENT '0 => Inactive, 1 Active',
  `picture` varchar(255) NULL,
  `create_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE='InnoDB';

ALTER TABLE `game` ADD UNIQUE `name` (`name`);

CREATE TABLE `form_validations` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `form` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `validation_key` enum('required', 'string', 'number', 'unique', 'file_size', 'file_type') NOT NULL,
  `additional_settings` json NULL
) ENGINE='InnoDB';

ALTER TABLE `form_validations`
ADD UNIQUE `form_field_validation_key` (`form`, `field`, `validation_key`);

INSERT INTO `form_validations` (`id`, `form`, `field`, `validation_key`, `additional_settings`) VALUES
(1,	'GameForm',	'state',	'number',	'{\"inclusion\": [0, 1]}'),
(2,	'GameForm',	'state',	'required',	NULL),
(3,	'GameForm',	'name',	'required',	NULL),
(4,	'GameForm',	'name',	'string',	NULL),
(5,	'GameForm',	'name',	'unique',	NULL),
(6,	'GameForm',	'picture',	'file_size',	'5242880'),
(7,	'GameForm',	'picture',	'file_type',	'{\"formats\": [\"image/jpeg\", \"image/png\"], \"extensions\": [\"jpg\", \"png\", \"jpeg\"]}');

