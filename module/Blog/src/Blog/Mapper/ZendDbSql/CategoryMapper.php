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
 * Class CategoryMapper
 * @package Blog\Mapper
 */
class CategoryMapper implements CategoryMapperInterface
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
		$query		= "
			SELECT node.*, ( COUNT( parent.id ) - ( sub_tree.depth + 1 ) ) AS depth
			FROM blog__category AS node,
				blog__category AS parent,
				blog__category AS sub_parent,
				(
					SELECT node.id, ( COUNT( parent.id ) - 1 ) AS depth
					FROM blog__category AS node,
						blog__category AS parent
					WHERE node.left_position BETWEEN parent.left_position AND parent.right_position
					AND node.parent_category_id IS NULL
					GROUP BY node.id
					ORDER BY node.left_position
				) AS sub_tree
			WHERE node.left_position BETWEEN parent.left_position AND parent.right_position
			AND node.left_position BETWEEN sub_parent.left_position AND sub_parent.right_position
			AND sub_parent.id = sub_tree.id
			GROUP BY node.id
			ORDER BY node.left_position, node.id
		";

		$statement	= $this->_dbAdapter->query( $query );
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

	private function _parseTree( array &$tree, $root = null )
	{
		$nestedTree	= array();
		foreach( $tree as $key => $item ) {
			/** @var CategoryInterface $item */
			if( $item->getParentCategoryId() == $root ) {
				$nestedTree[ $item->getId() ]	= array(
					'item'		=> $item,
					'children'	=> $this->_parseTree( $tree, $item->getId() )
				);
			}
		}
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
	 * @param      $parentId
	 *
	 * @param int  $depth
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findChildren( $parentId, $depth = 1 )
	{
		// TODO: Implement findChildren() method.
	}
}