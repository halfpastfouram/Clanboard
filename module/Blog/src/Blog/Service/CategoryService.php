<?php

namespace Blog\Service;

use Blog\Mapper\CategoryMapperInterface;
use Blog\Model\CategoryInterface;

/**
 * Class PostService
 * @package Blog\Service
 */
class CategoryService implements CategoryServiceInterface
{
	/**
	 * @var \Blog\Mapper\PostMapperInterface
	 */
	protected $_categoryMapper;

	/**
	 * @param CategoryMapperInterface $categoryMapper
	 */
	public function __construct( CategoryMapperInterface $categoryMapper )
	{
		$this->_categoryMapper	= $categoryMapper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAllCategories()
	{
		return $this->_categoryMapper->findAll();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findCategory( $id )
	{
		return $this->_categoryMapper->find( $id );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findCategoryTree()
	{
		return $this->_categoryMapper->findTree();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findCategoryPath( $toId, $fromId = null )
	{
		return $this->_categoryMapper->findPath( $toId, $fromId );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findCategoryChildren( $parentId, $depth = 1 )
	{
		return $this->_categoryMapper->findChildren( $parentId, $depth );
	}

	/**
	 * {@inheritDoc}
	 */
	public function saveCategory( CategoryInterface $category )
	{
		$this->_categoryMapper->save( $category );
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleteCategory( $categoryId )
	{
		$this->_categoryMapper->delete( $categoryId );
	}
}