<?php

namespace Blog\Mapper;

use Blog\Model\PostInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Class PostZendDbSqlMapper
 * @package Blog\Mapper
 */
class PostZendDbSqlMapper implements PostMapperInterface
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
	 * @var \Blog\Model\PostInterface
	 */
	protected $_postPrototype;

	/**
	 * @param \Zend\Db\Adapter\AdapterInterface       $adapter
	 * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
	 * @param \Blog\Model\PostInterface               $postPrototype
	 */
	public function __construct(
		AdapterInterface $adapter,
		HydratorInterface $hydrator,
		PostInterface $postPrototype
	) {
		$this->_dbAdapter		= $adapter;
		$this->_hydrator		= $hydrator;
		$this->_postPrototype	= $postPrototype;
	}

	/**
	 * {@inheritdoc}
	 */
	public function find( $id )
	{
		$sql    = new Sql( $this->_dbAdapter );
		$select	= $sql->select( 'blog__post' );
		$select->where( array( 'id = ?' => $id ) );

		$statement	= $sql->prepareStatementForSqlObject( $select );
		$result		= $statement->execute();

		if( $result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows() ) {
			return $this->_hydrator->hydrate( $result->current(), $this->_postPrototype );
		}

		throw new \InvalidArgumentException( "Post with given id '{$id}' not found." );
	}

	/**
	 * {@inheritdoc}
	 */
	public function findByCategory( $categoryId )
	{
		$sql	= new Sql( $this->_dbAdapter );
		$select	= $sql->select( 'blog__post' )
			->where( array( 'category_id = ?' => $categoryId ) );

		$statement	= $sql->prepareStatementForSqlObject( $select );
		$result		= $statement->execute();

		if( $result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows() ) {
			return $this->_hydrator->hydrate( $result->current(), $this->_postPrototype );
		}

		throw new \InvalidArgumentException( "Post with given category id '{$categoryId}' not found." );
	}

	/**
	 * {@inheritdoc}
	 */
	public function findAll()
	{
		$sql	= new Sql( $this->_dbAdapter );
		$statement	= $sql->prepareStatementForSqlObject( $sql->select( 'blog__post' ) );
		$result		= $statement->execute();

		if( $result instanceof ResultInterface && $result->isQueryResult() ) {
			$resultSet	= new HydratingResultSet( $this->_hydrator, $this->_postPrototype );

			return $resultSet->initialize( $result );
		}

		return array();
	}
}