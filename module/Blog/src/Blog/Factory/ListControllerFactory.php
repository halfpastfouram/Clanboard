<?php
namespace Blog\Factory;

use Blog\Controller\ListController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ListControllerFactory
 * @package Blog\Factory
 */
class ListControllerFactory implements FactoryInterface
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

		return new ListController(
			$realServiceLocator->get( 'Blog\Service\PostServiceInterface' ),
			$realServiceLocator->get( 'Blog\Service\CategoryServiceInterface' )
		);
	}
}