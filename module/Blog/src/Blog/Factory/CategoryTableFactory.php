<?php

namespace Blog\Factory;

use Blog\Model\CategoryTable;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class CategoryTableFactory
 * @package Blog\Factory
 */
class CategoryTableFactory implements FactoryInterface
{
	/**
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 *
	 * @return \Blog\Model\CategoryTable
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		/** @var \Blog\Model\CategoryTable $tableGateway */
		$tableGateway = $serviceLocator->get( 'CategoryTableGateway' );
		return new CategoryTable( $tableGateway );
	}
}