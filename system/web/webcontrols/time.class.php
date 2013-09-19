<?php
	/**
	 * @license			see /docs/license.txt
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 * @copyright		Copyright (c) 2013
	 */
	namespace System\Web\WebControls;


	/**
	 * Represents a Time Control
	 *
	 * @package			PHPRum
	 * @subpackage		Web
	 *
	 */
	class Time extends InputBase
	{
		/**
		 * type
		 * @ignore
		 */
		const type = 'time';

		/**
		 * getDomObject
		 *
		 * returns a DomObject representing control
		 *
		 * @return DomObject
		 */
		public function getDomObject()
		{
			$input = $this->getInputDomObject();
			$input->setAttribute( 'value', $this->value );
			$input->appendAttribute( 'class', ' '.self::type );
			$input->setAttribute( 'type', self::type );

			return $input;
		}
	}
?>