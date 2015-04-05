<?php
namespace Blog\Factory;

use Blog\Controller\PostController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PostControllerFactory
 * @package Blog\Factory
 */
class PostControllerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 *
	 * @return mixed
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		$realServiceLocator	= $serviceLocator->getServiceLocator();

		return new PostController(
			$realServiceLocator->get( 'Blog\Service\PostServiceInterface' ),
			$realServiceLocator->get( 'Blog\Service\CategoryServiceInterface' )
		);
	}
}