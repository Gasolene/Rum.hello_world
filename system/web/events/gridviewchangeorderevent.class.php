<?php
	/**
	 * @license			see /docs/license.txt
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 * @copyright		Copyright (c) 2011
	 */
	namespace System\Web\Events;
	use \System\Base\EventBase;


	/**
	 * Provides event handling
	 *
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 */
	final class GridViewChangeOrderEvent extends EventBase
	{
		/**
		 * Constructor
		 *
		 * @return void
		 */
		public function __construct()
		{
			parent::__construct("onGridViewChangeOrder");
		}
	}
?>