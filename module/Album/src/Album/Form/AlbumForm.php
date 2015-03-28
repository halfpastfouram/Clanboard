<?php

namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
	public function __construct( $name = null )
	{
		// Ignore the form name that might have been passed as parameter
		parent::__construct( 'album' );

		$this->add( array( 'name' => 'id', 'type' => 'Hidden' ) );
		$this->add( array( 'name' => 'title', 'type' => 'Text', 'options' => array( 'label' => 'Title' ) ) );
		$this->add( array( 'name' => 'artist', 'type' => 'Text', 'options' => array( 'label' => 'Artist' ) ) );
		$this->add( array( 'name' => 'submit', 'type' => 'submit', 'attributes' => array(
			'value'	=> 'Save',
			'id'	=> 'submitbutton',
		) ) );
	}
}