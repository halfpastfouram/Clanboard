<?php

namespace Blog\Factory;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Feed\Reader\Collection\Category;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class CategoryTableGatewayFactory
 * @package Blog\Factory
 */
class CategoryTableGatewayFactory implements FactoryInterface
{
	/**
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 *
	 * @return \Blog\Model\CategoryTable
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		/** @var \Zend\Db\Adapter\Adapter $dbAdapter */
		$dbAdapter			= $serviceLocator->get( 'Zend\Db\Adapter\Adapter' );
		$resultSetPrototype	= new ResultSet();
		$resultSetPrototype->setArrayObjectPrototype( new Category() );
		return new TableGateway( 'category', $dbAdapter, null, $resultSetPrototype );
	}
}