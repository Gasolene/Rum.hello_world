<?php
	/**
	 * @license			see /docs/license.txt
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 * @copyright		Copyright (c) 2011
	 */
	namespace System\Web\Services;


	/**
	 * This class handles all requests for a specific page.
	 *
	 * @property string $controllerId Specifies the controller id
	 * @property int $outputCache Specifies how long to cache page output in seconds, 0 disables caching
	 *
	 * @package			PHPRum
	 * @subpackage		Web
	 * @author			Darnell Shinbine
	 */
	abstract class WebService extends \System\Web\ControllerBase
	{
		/**
		 * Specifies the controller id
		 * @var string
		 */
		protected $controllerId			= '';

		/**
		 * Specifies how long to cache page output in seconds, 0 disables caching
		 * @var int
		 */
		protected $outputCache			= 0;

		/**
		 * Specifies whether the controller requires an SSL connection
		 * @var bool
		 */
		protected $ssl					= false;


		/**
		 * gets object property
		 *
		 * @param  string	$field		name of field
		 * @return string				string of variables
		 * @ignore
		 */
		public function __get( $field )
		{
			if( $field === 'xxx' )
			{
				return $this->controllerId;
			}
			else
			{
				return parent::__get( $field );
			}
		}


		/**
		 * this method will process the request
		 *
		 * @param   HTTPRequest		&$request	HTTPRequest object
		 * @return  void
		 */
		final public function requestProcessor( \System\Web\HTTPRequest &$request )
		{
			$soap_client = new \SoapClient();
			
		}


		/**
		 * return view component for rendering
		 *
		 * @return  View			view control
		 */
		final public function getView()
		{
			$soap_server = new \SoapServer($url);
			//$soap_server->
		}
	}
?>