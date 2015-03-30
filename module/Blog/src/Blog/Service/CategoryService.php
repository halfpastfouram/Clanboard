<?php

namespace Blog\Service;

use Blog\Mapper\CategoryMapperInterface;

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
	 * @param \Blog\Service\CategoryMapperInterface $categoryMapper
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
}