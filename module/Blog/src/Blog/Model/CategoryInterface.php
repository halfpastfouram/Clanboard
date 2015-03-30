<?php

namespace Blog\Model;

/**
 * Interface CategoryInterface
 * @package Blog\Model
 */
interface CategoryInterface
{
	/**
	 * Will return the ID of the blog category
	 *
	 * @return int
	 */
	public function getId();

	/**
	 * Will return the ID of the parent category
	 *
	 * @return int
	 */
	public function getParentCategoryId();

	/**
	 * Will return the TITLE of the blog category
	 *
	 * @return string
	 */
	public function getTitle();

	/**
	 * Will return the DESCRIPTION of the blog category
	 *
	 * @return string
	 */
	public function getDescription();
}