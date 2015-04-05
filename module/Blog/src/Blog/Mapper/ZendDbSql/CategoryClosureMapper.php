<?php

namespace Blog\Mapper\ZendDbSql;

use Blog\Mapper\CategoryMapperInterface;
use Blog\Model\CategoryInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Class CategoryClosureMapper
 * @package Blog\Mapper
 */
class CategoryClosureMapper implements CategoryMapperInterface
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
		$sql		= new Sql( $this->_dbAdapter );
		$statement	= $sql->prepareStatementForSqlObject( $sql->select( 'blog__category' ) );
		$result		= $statement->execute();

		if( $result instanceof ResultInterface && $result->isQueryResult() ) {
			$resultSet	= new HydratingResultSet( $this->_hydrator, $this->_postPrototype );

			return $resultSet->initialize( $result );
		}

		return array();
	}

	/**
	 * @return array|CategoryInterface[]
	 */
	public function findTree()
	{
		return $this->findChildren( 0, -1 );
	}

	/**
	 * @param     $parentCategoryId
	 * @param int $depth
	 *
	 * @return array|\Blog\Model\CategoryInterface[]
	 */
	public function findChildren( $parentCategoryId, $depth = 1 )
	{
		$sql	= new Sql( $this->_dbAdapter );
		$select	= $sql->select()
			->from( array( 'c' => 'blog__category' ), array( 'c.*' ) )
			->join( array( 'cc' => 'blog__category_closure' ), 'c.id = cc.descendant', array() );

		if( intval( $parentCategoryId ) > 0 ) {
			$select->where( array( 'cc.ancestor' => $parentCategoryId ) );
			if( intval( $depth ) >= 0 ) {
				$select->where( 'cc.depth <= ' . intval( $depth ) );
			}
			if( intval( $depth ) > 0 ) {
				$select->where( "cc.depth > 0" );
			}
		} else {
			$select
				->join( array( 'c2' => 'blog__category' ), 'c2.id = cc.ancestor', array() )
				->where( array( 'c2.parent_category_id IS NULL' ) );
			if( intval( $depth ) >= 0 ) {
				$select->where( 'cc.depth <= ' . intval( $depth ) );
			}
		}

		$statement	= $sql->prepareStatementForSqlObject( $select );
		$result		= $statement->execute();

		if( $result instanceof ResultInterface && $result->isQueryResult() ) {
			$resultSet	= new HydratingResultSet( $this->_hydrator, $this->_postPrototype );

			/** @var \Zend\Db\ResultSet\HydratingResultSet $categories */
			$categories			= $resultSet->initialize( $result );
			$categoryArrayMap	= array();
			foreach( $categories as $category ) {
				$categoryArrayMap[]	= $category;
			}

			return $this->_parseTree( $categoryArrayMap );
		}

		return array();
	}

	/**
	 * @param array $tree
	 * @param null  $root
	 *
	 * @return array
	 */
	private function _parseTree( array &$tree, $root = null )
	{
		static $depth;
		$depth		= is_null( $depth ) ? 0 : $depth + 1;
		$nestedTree	= array();

		foreach( $tree as $key => $item ) {
			/** @var CategoryInterface $item */
			if( $item->getParentCategoryId() == $root ) {
				$nestedTree[ $item->getId() ]	= array(
					'item'		=> $item->setDepth( $depth ),
					'children'	=> $this->_parseTree( $tree, $item->getId() )
				);
			}
		}

		$depth--;
		return $nestedTree;
	}

	/**
	 * @param      $toId
	 * @param null $fromId
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findPath( $toId, $fromId = null )
	{
		// TODO: Implement findPath() method.
		/*
		 * SELECT parent.name
FROM nested_category AS node,
        nested_category AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.name = 'FLASH'
ORDER BY node.lft;
		 */
	}

	/**
	 * @param \Blog\Model\CategoryInterface $category
	 */
	public function save( CategoryInterface $category )
	{
//		INSERT INTO blog__category_closure ( ancestor, descendant, depth )
//		SELECT ancestor, '{$node_id}', depth+1 FROM blog__category_closure
//		WHERE descendant = '{$parentCategoryId}'
//		UNION ALL SELECT '{$node_id}', '{$node_id}', 0;
	}

	/**
	 * @param $categoryId
	 */
	public function delete( $categoryId )
	{
		// TODO: Implement delete() method.
	}
}