<?php

namespace Blog\Factory;

use Blog\Service\CategoryService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class CategoryServiceFactory
 * @package Blog\Factory
 */
class CategoryServiceFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 *
	 * @return \Blog\Service\CategoryService
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		return new CategoryService(
			$serviceLocator->get( 'Blog\Mapper\CategoryMapperInterface' )
		);
	}
}