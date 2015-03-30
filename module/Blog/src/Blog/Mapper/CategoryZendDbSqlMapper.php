<?php

namespace Blog\Mapper;

use Blog\Model\CategoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Class CategoryZendDbSqlMapper
 * @package Blog\Mapper
 */
class CategoryZendDbSqlMapper implements CategoryMapperInterface
{
	/**
	 * @var \Zend\Db\Adapter\AdapterInterface
	 */
	protected $_dbAdapter;

	/**
	 * @var \Zend\StdLib\Hydrator\HydratorInterface
	 */
	protected $_hydrator;

	/**
	 * @var \Blog\Model\CategoryInterface
	 */
	protected $_categoryPrototype;

	/**
	 * @param \Zend\Db\Adapter\AdapterInterface       $adapter
	 * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
	 * @param \Blog\Model\CategoryInterface           $categoryPrototype
	 */
	public function __construct(
		AdapterInterface $adapter,
		HydratorInterface $hydrator,
		CategoryInterface $categoryPrototype
	) {
		$this->_dbAdapter		= $adapter;
		$this->_hydrator		= $hydrator;
		$this->_postPrototype	= $categoryPrototype;
	}

	/**
	 * {@inheritdoc}
	 */
	public function find( $id )
	{
		$sql    = new Sql( $this->_dbAdapter );
		$select	= $sql->select( 'blog__category' );
		$select->where( array( 'id = ?' => $id ) );

		$statement	= $sql->prepareStatementForSqlObject( $select );
		$result		= $statement->execute();

		if( $result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows() ) {
			return $this->_hydrator->hydrate( $result->current(), $this->_postPrototype );
		}

		throw new \InvalidArgumentException( "Category with given id '{$id}' not found." );
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll()
	{
		$sql	= new Sql( $this->_dbAdapter );
		$statement	= $sql->prepareStatementForSqlObject( $sql->select( 'blog__category' ) );
		$result		= $statement->execute();

		if( $result instanceof ResultInterface && $result->isQueryResult() ) {
			$resultSet	= new HydratingResultSet( $this->_hydrator, $this->_postPrototype );

			return $resultSet->initialize( $result );
		}

		return array();
	}
}