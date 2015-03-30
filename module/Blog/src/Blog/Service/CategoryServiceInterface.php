<?php

namespace Blog\Service;

use Blog\Model\CategoryInterface;

/**
 * Interface CategoryServiceInterface
 * @package Blog\Service
 */
interface CategoryServiceInterface
{
	/**
	 * Should return a set of all blog categories that we can iterate over. Single entries of the array are supposed to
	 * be implementing \Blog\Model\CategoryInterface
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findAllCategories();

	/**
	 * Should return a single blog category
	 *
	 * @param  int $id Identifier of the Category that should be returned
	 * @return CategoryInterface
	 */
	public function findCategory( $id );
}