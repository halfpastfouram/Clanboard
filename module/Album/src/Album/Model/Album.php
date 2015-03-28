<?php

namespace Album\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class Album
 * @package Album\model
 */
class Album implements InputFilterAwareInterface
{
	/**
	 * @var
	 */
	public $id;

	/**
	 * @var
	 */
	public $artist;

	/**
	 * @var
	 */
	public $title;

	/**
	 * @var
	 */
	protected $_inputFilter;

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	public function exchangeArray( $data )
	{
		$storage	= $this->getArrayCopy();

		$this->id		= !empty( $data['id'] )		? $data['id']		: null;
		$this->artist	= !empty( $data['artist'] )	? $data['artist']	: null;
		$this->title	= !empty( $data['title'] )	? $data['title']	: null;

		return $storage;
	}

	/**
	 * @return array
	 */
	public function getArrayCopy()
	{
		return get_object_vars( $this );
	}

	/**
	 * @param \Zend\InputFilter\InputFilterInterface $inputFiler
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function setInputFilter( InputFilterInterface $inputFiler )
	{
		throw new \Exception( "Method not implemented" );
	}

	/**
	 * @return \Zend\InputFilter\InputFilter
	 */
	public function getInputFilter()
	{
		if( !$this->_inputFilter ) {
			$inputFilter	= new InputFilter();

			$inputFilter->add( array(
				'name'		=> 'id',
				'required'	=> true,
				'filters'	=> array(
					array( 'name' => 'Int' ),
				)
			) );

			$inputFilter->add( array(
				'name'		=> 'artist',
				'required'	=> true,
				'filters'	=> array(
					array( 'name' => 'StripTags' ),
					array( 'name' => 'StringTrim' ),
				), 'validators'	=> array(
					array(
						'name'		=> 'StringLength',
						'options'	=> array(
							'encoding'	=> 'UTF-8',
							'min'		=> 1,
							'max'		=> 100
						),
					)
				)
			) );

			$inputFilter->add( array(
				'name'		=> 'title',
				'required'	=> true,
				'filters'	=> array(
					array( 'name' => 'StripTags' ),
					array( 'name' => 'StringTrim' ),
				), 'validators'	=> array(
					array(
						'name'		=> 'StringLength',
						'options'	=> array(
							'encoding'	=> 'UTF-8',
							'min'		=> 1,
							'max'		=> 100
						),
					)
				)
			) );

			$this->_inputFilter	= $inputFilter;
		}

		return $this->_inputFilter;
	}
}