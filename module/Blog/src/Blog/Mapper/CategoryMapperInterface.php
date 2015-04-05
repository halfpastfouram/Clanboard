<?php

namespace Blog\Mapper;

use Blog\Model\CategoryInterface;

/**
 * Interface CategoryMapperInterface
 * @package Blog\Mapper
 */
interface CategoryMapperInterface
{
	/**
	 * @param int|string $id
	 *
	 * @return mixed
	 *
	 * @throws \InvalidArgumentException
	 */
	public function find( $id );

	/**
	 * @return array|CategoryInterface[]
	 */
	public function findAll();

	/**
	 * @return array|CategoryInterface[]
	 */
	public function findTree();

	/**
	 * @param      $toId
	 * @param null $fromId
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findPath( $toId, $fromId = null );

	/**
	 * @param      $parentId
	 *
	 * @param int  $depth
	 *
	 * @return array|CategoryInterface[]
	 */
	public function findChildren( $parentId, $depth = 1 );

	/**
	 * @param \Blog\Model\CategoryInterface $category
	 */
	public function save( CategoryInterface $category );

	/**
	 * @param $categoryId
	 */
	public function delete( $categoryId );
}