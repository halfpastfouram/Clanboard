<?php

namespace Blog\Service;

use Blog\Model\PostInterface;

/**
 * Interface PostServiceInterface
 * @package Blog\Service
 */
interface PostServiceInterface
{
	/**
	 * Should return a set of all blog posts that we can iterate over. Single entries of the array are supposed to be
	 * implementing \Blog\Model\PostInterface
	 *
	 * @return array|PostInterface[]
	 */
	public function findAllPosts();

	/**
	 * @param int|string $categoryId
	 *
	 * @return mixed
	 *
	 * @throws \InvalidArgumentException
	 */
	public function findByCategory( $categoryId );

	/**
	 * Should return a single blog post
	 *
	 * @param  int $id Identifier of the Post that should be returned
	 * @return PostInterface
	 */
	public function findPost( $id );
}