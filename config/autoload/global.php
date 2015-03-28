<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 */

return array(
	'db'	=> array(
		'driver'			=> 'Pdo',
		'dsn'				=> 'mysql:dbname=clanboard;host=localhost',
		'driver_options'	=> array(
			PDO::MYSQL_ATTR_INIT_COMMAND	=> 'SET NAMES \'UTF8\'',
		),
	),

	'service_manager'	=> array(
		'factories'	=> array(
			'Zend\Db\Adapter\Adapter'	=> 'Zend\Db\Adapter\AdapterServiceFactory',
		),
	),
);
