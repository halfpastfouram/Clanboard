<?php

namespace Album\Controller;

use Album\Form\AlbumForm;
use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class AlbumController
 * @package Album\Controller
 */
class AlbumController extends AbstractActionController
{
	/**
	 * @var AlbumTable
	 */
	protected $_albumTable;

	public function getAlbumTable()
	{
		if( !$this->_albumTable ) {
			$serviceManager		= $this->getServiceLocator();
			$this->_albumTable	= $serviceManager->get( 'Album\Model\AlbumTable' );
		}
		return $this->_albumTable;
	}

	/**
	 *
	 */
	public function indexAction()
	{
		return new ViewModel( array(
			'albums'	=> $this->getAlbumTable()->fetchAll(),
		) );
	}

	/**
	 *
	 */
	public function addAction()
	{
		$form	= new AlbumForm;
		$form->get( 'submit' )->setValue( 'Add' );

		if( $this->getRequest()->getPost( 'submit' ) ) {
			$album	= new Album;
			$form->setInputFilter( $album->getInputFilter() );
			$form->setData( $this->getRequest()->getPost() );

			if( $form->isValid() ) {
				$album->exchangeArray( $form->getData() );
				$this->getAlbumTable()->saveAlbum( $album );

				// Redirect to album list
				return $this->redirect()->toRoute( 'album' );
			}
		}

		return array( 'form' => $form );
	}

	/**
	 *
	 */
	public function editAction()
	{
		$albumId	= $this->params()->fromRoute( 'id', 0 );
		if( !$albumId ) {
			return $this->redirect()->toRoute( 'album', array( 'action' => 'add' ) );
		}

		try {
			$album	= $this->getAlbumTable()->getAlbum( $albumId );
		} catch( \Exception $exception ) {
			return $this->redirect()->toRoute( 'album', array( 'action' => 'index' ) );
		}

		$form	= new AlbumForm;
		$form->bind( $album );
		$form->get( 'submit' )->setAttribute( 'value', 'Edit' );

		if( $this->getRequest()->getPost( 'submit' ) ) {
			$form->setInputFilter( $album->getInputFilter() );
			$form->setData( $this->getRequest()->getPost() );

			if( $form->isValid() ) {
				$this->getAlbumTable()->saveAlbum( $album );

				// Redirect to album list
				return $this->redirect()->toRoute( 'album' );
			}
		}
		return array( 'form' => $form, 'id' => $albumId );
	}

	/**
	 *
	 */
	public function deleteAction()
	{
		$albumId	= intval( $this->params()->fromRoute( 'id', 0 ) );
		if( !$albumId ) {
			return $this->redirect()->toRoute( 'album' );
		}

		$request	= $this->getRequest();
		if( $request->isPost() ) {
			$delete	= $request->getPost( 'delete', 'No' );

			if( $delete == 'Yes' ) {
				$albumId	= intval( $request->getPost( 'id' ) );
				$this->getAlbumTable()->deleteAlbum( $albumId );
			}

			// Redirect to album list
			return $this->redirect()->toRoute( 'album' );
		}

		return array(
			'id'	=> $albumId,
			'album'	=> $this->getAlbumTable()->getAlbum( $albumId )
		);
	}
}