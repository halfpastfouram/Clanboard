<?php

namespace Album;

use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @package AlbumTable
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
	/**
	 * @return array
	 */
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\ClassMapAutoloader'	=> array(
				__DIR__ . '/autoload_classmap.php',
			), 'Zend\Loader\StandardAutoloader'	=> array(
				'namespaces'	=> array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				)
			)
		);
	}

	/**
	 * @return mixed
	 */
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	/**
	 * @return array
	 */
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'Album\Model\AlbumTable' =>  function( $serviceManager ) {
					$tableGateway	= $serviceManager->get( 'AlbumTableGateway' );
					$table			= new AlbumTable( $tableGateway );
					return $table;
				},
				'AlbumTableGateway'		=> function( $serviceManager ) {
					$dbAdapter			= $serviceManager->get( 'Zend\Db\Adapter\Adapter' );
					$resultSetPrototype	= new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype( new Album() );
					return new TableGateway( 'album', $dbAdapter, null, $resultSetPrototype );
				},
			),
		);
	}
}
