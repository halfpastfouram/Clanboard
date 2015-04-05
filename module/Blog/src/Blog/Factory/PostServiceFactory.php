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
		/** @var \Blog\Mapper\PostMapperInterface $mapperService */
		$mapperService	= $serviceLocator->get( 'Blog\Mapper\PostMapperInterface' );
		return new PostService( $mapperService );
	}
}