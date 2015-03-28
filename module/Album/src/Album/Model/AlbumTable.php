<?php

namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Class AlbumTable
 * @package AlbumTable\Model\DbTable
 */
class AlbumTable
{
	/**
	 * @var \Zend\Db\TableGateway\TableGateway
	 */
	protected $_tableGateway;

	/**
	 * @param \Zend\Db\TableGateway\TableGateway $tableGateway
	 */
	public function __construct( TableGateway $tableGateway )
	{
		$this->_tableGateway	= $tableGateway;
	}

	/**
	 * @return \Zend\Db\ResultSet\ResultSet
	 */
	public function fetchAll()
	{
		$resultSet	= $this->_tableGateway->select();
		return $resultSet;
	}

	/**
	 *
	 * @param int $albumId
	 *
	 * @return \Album\Model\Album
	 * @throws \Exception
	 */
	public function getAlbum( $albumId )
	{
		$rowset	= $this->_tableGateway->select( array( 'id' => intval( $albumId ) ) );
		$row	= $rowset->current();

		if( !$row ) {
			throw new \Exception( 'Could not find row with id ' . intval( $albumId ) );
		}

		return $row;
	}

	/**
	 *
	 * @param \Album\Model\Album $album
	 *
	 * @throws \Exception
	 */
	public function saveAlbum( Album $album )
	{
		$data	= array(
			'artist'	=> $album->artist,
			'title'		=> $album->title,
		);

		$id		= intval( $album->id );
		if( $id == 0 ) {
			$this->_tableGateway->insert( $data );
		} else {
			if( $this->getAlbum( $id ) ) {
				$this->_tableGateway->update( $data, array( 'id' => $id ) );
			} else {
				throw new \Exception( 'AlbumTable id does not exist' );
			}
		}
	}

	/**
	 * @param $albumId
	 */
	public function deleteAlbum( $albumId )
	{
		$this->_tableGateway->delete( array( 'id' => intval( $albumId ) ) );
	}
}