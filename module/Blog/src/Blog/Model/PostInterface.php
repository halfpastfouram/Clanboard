<?php

namespace Blog\Model;

/**
 * Interface PostInterface
 * @package Blog\Model
 */
interface PostInterface
{
	/**
	 * Will return the ID of the blog post
	 *
	 * @return int
	 */
	public function getId();

	/**
	 * Will return the ID of the blog category this post is linked to
	 *
	 * @return mixed
	 */
	public function getCategoryId();

	/**
	 * Will return the TITLE of the blog post
	 *
	 * @return string
	 */
	public function getTitle();

	/**
	 * Will return the TEXT of the blog post
	 *
	 * @return string
	 */
	public function getText();
}