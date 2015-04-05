<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class CategoryTable
 * @package CategoryTable\Model\DbTable
 */
class CategoryTable
{
	/**
	 * @var \Zend\Db\TableGateway\TableGateway
	 */
	protected $_tableGateway;

	/**
	 * @param \Zend\Db\TableGateway\TableGateway $tableGateway
	 */
	public function __construct( TableGateway $tableGateway )
	{
		$this->_tableGateway	= $tableGateway;
	}

	/**
	 * @return \Zend\Db\ResultSet\ResultSet
	 */
	public function fetchAll()
	{
		$resultSet	= $this->_tableGateway->select();
		return $resultSet;
	}

	/**
	 * @param int $categoryId
	 *
	 * @return \Blog\Model\Category
	 * @throws \Exception
	 */
	public function getCategory( $categoryId )
	{
		$rowset	= $this->_tableGateway->select( array( 'id' => intval( $categoryId ) ) );
		$row	= $rowset->current();

		if( !$row ) {
			throw new \Exception( 'Could not find row with id ' . intval( $categoryId ) );
		}

		return $row;
	}

	/**
	 * @param \Blog\Model\CategoryInterface $category
	 *
	 * @throws \Exception
	 */
	public function saveAlbum( CategoryInterface $category )
	{
		$data	= array(
			'parent_category_id'	=> $category->getParentCategoryId(),
			'title'					=> $category->getTitle(),
			'description'			=> $category->getDescription(),
		);

		$id		= intval( $category->getId() );
		if( $id == 0 ) {
			$this->_tableGateway->insert( $data );
		} else {
			if( $this->getCategory( $id ) ) {
				$this->_tableGateway->update( $data, array( 'id' => $id ) );
			} else {
				throw new \Exception( 'CategoryTable id does not exist' );
			}
		}
	}

	/**
	 * @param $categoryId
	 */
	public function deleteCategory( $categoryId )
	{
		$this->_tableGateway->delete( array( 'id' => intval( $categoryId ) ) );
	}
}