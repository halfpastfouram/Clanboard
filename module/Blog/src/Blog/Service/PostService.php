<?php

namespace Blog\Service;

use Blog\Mapper\PostMapperInterface;

/**
 * Class PostService
 * @package Blog\Service
 */
class PostService implements PostServiceInterface
{
	/**
	 * @var \Blog\Mapper\PostMapperInterface
	 */
	protected $_postMapper;

	/**
	 * @param \Blog\Mapper\PostMapperInterface $postMapper
	 */
	public function __construct( PostMapperInterface $postMapper )
	{
		$this->_postMapper	= $postMapper;
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAllPosts()
	{
		return $this->_postMapper->findAll();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findByCategory( $categoryId )
	{
		return $this->_postMapper->findByCategory( $categoryId );
	}

	/**
	 * {@inheritDoc}
	 */
	public function findPost( $id )
	{
		return $this->_postMapper->find( $id );
	}
}