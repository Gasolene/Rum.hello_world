<?php
	/**
	 * @license			see /docs/license.txt
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 * @copyright		Copyright (c) 2013
	 */
	namespace System\Web\WebControls;


	/**
	 * Represents a DateTime Control
	 *
	 * @package			PHPRum
	 * @subpackage		Web
	 *
	 */
	class DateTime extends InputBase
	{
		/**
		 * type
		 * @ignore
		 */
		const type = 'datetime';

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
//			$input->setAttribute( 'class', ' '.self::type );
			$input->setAttribute( 'type', self::type );

			return $input;
		}
	}
?>