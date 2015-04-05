<?php

namespace Blog\Controller;

use Blog\Service\CategoryServiceInterface;
use Blog\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
	/**
	 * @var \Blog\Service\PostServiceInterface
	 */
	protected $_postService;

	/**
	 * @var \Blog\Service\CategoryServiceInterface
	 */
	protected $_categoryService;

	/**
	 * @param \Blog\Service\PostServiceInterface     $postService
	 * @param \Blog\Service\CategoryServiceInterface $categoryService
	 */
	public function __construct(
		PostServiceInterface $postService,
		CategoryServiceInterface $categoryService
	) {
		$this->_postService		= $postService;
		$this->_categoryService	= $categoryService;
	}

	/**
	 * @return \Zend\View\Model\ViewModel
	 */
	public function indexAction()
	{
		$postId		= $this->params()->fromRoute( 'id' );
		$post		= $this->_postService->findPost( $postId );
		$category	= $this->_categoryService->findCategory( $post->getCategoryId() );

		return new ViewModel( array(
			'category'	=> $category,
			'post'		=> $post,
		) );
	}
}