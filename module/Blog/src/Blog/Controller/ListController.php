<?php

namespace Blog\Controller;

use Blog\Service\CategoryServiceInterface;
use Blog\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class ListController
 * @package Blog\Controller
 */
class ListController extends AbstractActionController
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
		return new ViewModel( array(
			'posts'			=> $this->_postService->findAllPosts(),
			'categories'	=> $this->_categoryService->findCategoryTree()
		) );
	}

	/**
	 * @return \Zend\View\Model\ViewModel
	 */
	public function categoriesAction()
	{
		return new ViewModel( array(
			'categories'	=> $this->_categoryService->findCategoryTree()
		) );
	}

	/**
	 * @return \Zend\View\Model\ViewModel
	 */
	public function categoryAction()
	{
		$categoryId	= $this->params()->fromRoute( 'id', 0 );
		$category	= $this->_categoryService->findCategory( $categoryId );
		$posts		= $this->_postService->findByCategory( $categoryId );

		return new ViewModel( array(
			'categories'	=> $this->_categoryService->findCategoryTree(),
			'category'		=> $category,
			'posts'			=> $posts
		) );
	}
}