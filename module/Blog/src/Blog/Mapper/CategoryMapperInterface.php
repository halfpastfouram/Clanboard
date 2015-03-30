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
}