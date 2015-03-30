<?php

namespace Blog\Factory;

use Blog\Mapper\PostZendDbSqlMapper;
use Blog\Model\Post;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Class PostZendDbSqlMapperFactory
 * @package Blog\Factory
 */
class PostZendDbSqlMapperFactory implements FactoryInterface
{
	/**
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 *
	 * @return \Blog\Mapper\PostZendDbSqlMapper
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		return new PostZendDbSqlMapper(
			$serviceLocator->get( 'Zend\Db\Adapter\Adapter' ),
			new ClassMethods( false ),
			new Post
		);
	}
}