<?php

namespace Blog\Mapper;

use Blog\Model\PostInterface;

/**
 * Interface PostMapperInterface
 * @package Blog\Mapper
 */
interface PostMapperInterface
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
	 * @param int|string $categoryId
	 *
	 * @return mixed
	 *
	 * @throws \InvalidArgumentException
	 */
	public function findByCategory( $categoryId );

	/**
	 * @return array|PostInterface[]
	 */
	public function findAll();
}