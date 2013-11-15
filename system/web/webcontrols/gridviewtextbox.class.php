<?php
	/**
	 * @license			see /docs/license.txt
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 * @copyright		Copyright (c) 2013
	 */
	namespace System\Web\WebControls;


	/**
	 * Represents a GridView TextBox
	 * 
	 * @package			PHPRum
	 * @subpackage		Web
	 * @author			Darnell Shinbine
	 */
	class GridViewTextBox extends GridViewControlBase
	{
		/**
		 * get item text
		 *
		 * @param string $dataField datafield of the current row
		 * @param string $parameter parameter to send
		 * @return string
		 */
		public function fetchUpdateControl()
		{
			trigger_error("GridViewTextBox is deprecated, use GridViewText instead", E_USER_DEPRECATED);

			if($this->ajaxPostBack)
			{
				$uri = \Rum::config()->uri;
				$params = $this->getRequestData() . "&{$this->pkey}='.\\rawurlencode(%{$this->pkey}%).'&{$this->parameter}=\'+this.value+\'";
				return "'<input name=\"{$this->parameter}\" type=\"text\" value=\"'.%{$this->dataField}%.'\" class=\"textbox\" onchange=\"Rum.evalAsync(\'{$uri}/\',\'".$this->escape($params)."\',\'POST\');\" />'";
			}
			else
			{
				return "'<input name=\"{$this->parameter}\" type=\"text\" value=\"'.%{$this->dataField}%.'\" class=\"textbox\" />'";
			}
		}

		/**
		 * get footer text
		 *
		 * @param string $dataField datafield of the current row
		 * @param string $parameter parameter to send
		 * @return string
		 */
		public function fetchInsertControl()
		{
			if( !$this->footerText )
			{
				/*
				if($this->ajaxPostBack)
				{
					$uri = \Rum::config()->uri;
					$params = $this->getRequestData() . "&{$this->parameter}=\'+this.value+\'";
					return "'<input name=\"{$this->parameter}\" type=\"text\" class=\"textbox\" onchange=\"Rum.evalAsync(\'{$uri}/\',\'".$this->escape($params)."\',\'POST\');\" />'";
				}
				*/
				return "'<input name=\"{$this->parameter}\" type=\"text\" class=\"textbox\" />'";			}
			else
			{
				return $this->footerText;
			}
		}
	}
?>