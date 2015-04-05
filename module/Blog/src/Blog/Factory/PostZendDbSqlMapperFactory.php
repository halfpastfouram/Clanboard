<?php

namespace Blog\Factory;

use Blog\Mapper\ZendDbSql\PostMapper;
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
	 * @return \Blog\Mapper\ZendDbSql\PostMapper
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		/** @var \Zend\Db\Adapter\Adapter $adapter */
		$adapter	= $serviceLocator->get( 'Zend\Db\Adapter\Adapter' );
		return new PostMapper(
			$adapter,
			new ClassMethods,
			new Post
		);
	}
}