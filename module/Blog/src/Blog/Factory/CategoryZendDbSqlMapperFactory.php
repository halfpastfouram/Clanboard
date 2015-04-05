<?php

namespace Blog\Factory;

use Blog\Mapper\ZendDbSql\CategoryClosureMapper;
use Blog\Model\Category;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Class CategoryZendDbSqlMapperFactory
 * @package Blog\Factory
 */
class CategoryZendDbSqlMapperFactory implements FactoryInterface
{
	/**
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 *
	 * @return \Blog\Mapper\PostZendDbSqlMapper
	 */
	public function createService( ServiceLocatorInterface $serviceLocator )
	{
		/** @var \Zend\Db\Adapter\Adapter $adapter */
		$adapter	= $serviceLocator->get( 'Zend\Db\Adapter\Adapter' );
		return new CategoryClosureMapper(
			$adapter,
			new ClassMethods,
			new Category
		);
	}
}