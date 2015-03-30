<?php

namespace Blog\Factory;

use Blog\Service\PostService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PostServiceFactory
 * @package Blog\Factory
 */
class PostServiceFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 *
	 * @return \Blog\Service\PostService
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		return new PostService(
			$serviceLocator->get( 'Blog\Mapper\PostMapperInterface' )
		);
	}
}