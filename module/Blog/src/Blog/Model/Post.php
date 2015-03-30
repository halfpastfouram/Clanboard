<?php

namespace Blog\Model;

/**
 * Class Post
 * @package Blog\Model
 */
class Post implements PostInterface
{
	/**
	 * @var int
	 */
	protected $_id;

	/**
	 * @var int
	 */
	protected $_categoryId;

	/**
	 * @var string
	 */
	protected $_title;

	/**
	 * @var string
	 */
	protected $_text;

	/**
	 * {@inheritDoc}
	 */
	public function getId()
	{
		return $this->_id;
	}

	/**
	 * @param int $id
	 *
	 * @return $this
	 */
	public function setId( $id )
	{
		$this->_id	= $id;
		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getCategoryId()
	{
		return $this->_categoryId;
	}

	/**
	 * @param int $categoryId
	 *
	 * @return $this
	 */
	public function setCategoryId( $categoryId )
	{
		$this->_categoryId	= $categoryId;
		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getTitle()
	{
		return $this->_title;
	}

	/**
	 * @param string $title
	 *
	 * @return $this
	 */
	public function setTitle( $title )
	{
		$this->_title	= $title;
		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getText()
	{
		return $this->_text;
	}

	/**
	 * @param string $text
	 *
	 * @return $this
	 */
	public function setText( $text )
	{
		$this->_text	= $text;
		return $this;
	}
}