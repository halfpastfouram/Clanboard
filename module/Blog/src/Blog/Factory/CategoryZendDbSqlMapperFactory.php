<?php

namespace Blog\Factory;

use Blog\Mapper\CategoryZendDbSqlMapper;
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
		return new CategoryZendDbSqlMapper(
			$serviceLocator->get( 'Zend\Db\Adapter\Adapter' ),
			new ClassMethods( false ),
			new Category
		);
	}
}