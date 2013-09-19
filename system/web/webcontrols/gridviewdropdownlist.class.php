<?php
	/**
	 * @license			see /docs/license.txt
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 * @copyright		Copyright (c) 2013
	 */
	namespace System\Web\WebControls;


	/**
	 * Represents a GridView DropDownList
	 * 
	 * @property ListItemCollection $items Collection of list items
	 * 
	 * @package			PHPRum
	 * @subpackage		Web
	 * @author			Darnell Shinbine
	 */
	class GridViewDropDownList extends GridViewControlBase
	{
		/**
		 * collection of list items
		 * @var ListItemCollection
		 */
		protected $items;


		/**
		 * @param  string		$dataField			field name
		 * @param  string		$pkey				primary key
		 * @param  array		$values				list values
		 * @param  string		$value				value of Control
		 * @param  string		$parameter			parameter
		 * @param  string		$headerText			header text
		 * @param  string		$footerText			footer text
		 * @param  string		$className			css class name
		 * @return void
		 */
		public function __construct( $dataField, $pkey, array $values, $parameter='', $headerText='', $footerText='', $className='' )
		{
			parent::__construct( $dataField, $pkey, $parameter, $headerText, $footerText, $className );

			$this->items = new ListItemCollection($values);
		}


		/**
		 * gets object property
		 *
		 * @param  string	$field		name of field
		 * @return string				string of variables
		 * @ignore
		 */
		public function __get( $field ) {
			if( $field === 'items' ) {
				return $this->items;
			}
			else {
				return parent::__get($field);
			}
		}


		/**
		 * get item text
		 *
		 * @param string $dataField datafield of the current row
		 * @param string $parameter parameter to send
		 * @return string
		 */
		protected function getItemText($dataField, $parameter)
		{
			if($this->ajaxPostBack)
			{
				$uri = \System\Web\WebApplicationBase::getInstance()->config->uri;
				$params = $this->getRequestData() . "&".$this->formatParameter($this->pkey)."='.\\rawurlencode(%{$this->pkey}%).'&{$parameter}=\'+this.value+\'";

				$html = "'<select name=\"{$parameter}_'.%{$this->pkey}%.'\" class=\"listbox\" onchange=\"Rum.evalAsync(\'{$uri}/\',\'".$this->escape($params)."\',\'POST\');\">";
				foreach($this->items as $key=>$value)
				{
					$value = \Rum::escape($value, ENT_QUOTES);
					$key = \Rum::escape($key, ENT_QUOTES);

					$html .= "<option value=\"{$value}\" '.(%{$dataField}%=='{$value}'?'selected=\"selected\"':'').'>{$key}</option>";
				}
				$html .= '</select>\'';

				return $html;
			}
			else
			{
				$html = "'<select name=\"{$parameter}_'.%{$this->pkey}%.'\" class=\"listbox\">";
				foreach($this->items as $key=>$value)
				{
					$value = \Rum::escape($value, ENT_QUOTES);
					$key = \Rum::escape($key, ENT_QUOTES);

					$html .= "<option value=\"{$value}\" '.(%{$dataField}%=='{$value}'?'selected=\"selected\"':'').'>{$key}</option>";
				}
				$html .= '</select>\'';

				return $html;
			}
		}

		/**
		 * get footer text
		 *
		 * @param string $dataField datafield of the current row
		 * @param string $parameter parameter to send
		 * @return string
		 */
		protected function getFooterText($dataField, $parameter)
		{
			if( !$this->footerText )
			{
				/*
				if($this->ajaxPostBack)
				{
					$uri = \System\Web\WebApplicationBase::getInstance()->config->uri;
					$params = $this->getRequestData() . "&{$parameter}=\'+this.value+\'";

					$html = "'<select name=\"{$parameter}_null\" class=\"listbox\" onchange=\"Rum.evalAsync(\'{$uri}/\',\'".$this->escape($params)."\',\'POST\');\">";
					foreach($this->items as $key=>$value)
					{
						$value = \Rum::escape($value, ENT_QUOTES);
						$key = \Rum::escape($key, ENT_QUOTES);

						$html .= "<option value=\"{$value}\">{$key}</option>";
					}
					$html .= '</select>\'';

					return $html;
				}
				*/
				$html = "'<select name=\"{$parameter}_null\" class=\"listbox\">";
				foreach($this->items as $key=>$value)
				{
					$value = \Rum::escape($value, ENT_QUOTES);
					$key = \Rum::escape($key, ENT_QUOTES);

					$html .= "<option value=\"{$value}\">{$key}</option>";
				}
				$html .= '</select>\'';

				return $html;
			}
			else
			{
				return $this->footerText;
			}
		}
	}
?>