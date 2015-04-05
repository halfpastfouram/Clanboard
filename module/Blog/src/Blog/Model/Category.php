<?php

namespace Blog\Model;
/**
 * Class Category
 * @package Blog\Model
 */
class Category implements CategoryInterface
{
	/**
	 * @var int
	 */
	protected $_id;

	/**
	 * @var int
	 */
	protected $_parentCategoryId;

	/**
	 * @var int
	 */
	protected $_depth;

	/**
	 * @var string
	 */
	protected $_title;

	/**
	 * @var string
	 */
	protected $_description;

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->_id;
	}

	/**
	 * @param $id
	 *
	 * @return $this
	 */
	public function setId( $id )
	{
		$this->_id	= $id;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getParentCategoryId()
	{
		return $this->_parentCategoryId;
	}

	/**
	 * @param $categoryId
	 *
	 * @return $this
	 */
	public function setParentCategoryId( $categoryId )
	{
		$this->_parentCategoryId	= $categoryId;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTitle()
	{
		return $this->_title;
	}

	/**
	 * @param $title
	 *
	 * @return $this
	 */
	public function setTitle( $title )
	{
		$this->_title	= $title;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDescription()
	{
		return $this->_description;
	}

	/**
	 * @param $description
	 *
	 * @return $this
	 */
	public function setDescription( $description )
	{
		$this->_description	= $description;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDepth()
	{
		return $this->_depth;
	}

	/**
	 * @param int $depth
	 *
	 * @return $this
	 */
	public function setDepth( $depth )
	{
		$this->_depth = $depth;
		return $this;
	}
}