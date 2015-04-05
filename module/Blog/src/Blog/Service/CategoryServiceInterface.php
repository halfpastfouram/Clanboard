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

	/**
	 * Should return the entire category tree
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findCategoryTree();

	/**
	 * Should return the path of categories to the given $toId and from the optional $fromId
	 *
	 * @param      	   $toId
	 * @param int|null $fromId
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findCategoryPath( $toId, $fromId = null );

	/**
	 * Get all the children in a category
	 *
	 * @param      $parentId
	 * @param int  $depth
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findCategoryChildren( $parentId, $depth = 1 );

	/**
	 * Should save the given category or create it if it does not yet exists
	 *
	 * @param \Blog\Model\CategoryInterface $category
	 */
	public function saveCategory( CategoryInterface $category );

	/**
	 * Should delete the category with the given category id
	 *
	 * @param $categoryId
	 */
	public function deleteCategory( $categoryId );
}