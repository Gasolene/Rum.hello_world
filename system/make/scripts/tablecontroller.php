<?php
	/**
	 * @license			see /docs/license.txt
	 * @package			PHPRum
	 * @author			Darnell Shinbine
	 * @copyright		Copyright (c) 2013
	 */
    namespace System\Make;


	/**
	 * Provides functionality to generate controller/view files
	 *
	 * @package			PHPRum
	 * @subpackage		Make
	 */
	class TableController extends MakeBase
	{
		/**
		 * Default namespace
		 * @var string
		 */
		const ControllerNamespace       = '\\Controllers';
		/**
		 * Default namespace
		 * @var string
		 */
		const ModelNamespace    		= '\\Models';

		/**
		 * DefaultBaseController
		 * @var string
		 */
		const DefaultBaseController 	= '\\ApplicationController';


		/**
		 * make
		 *
		 * @param string $target target
		 * @param array $options options
		 * @return void
		 */
		public function make($target, array $options = array())
		{
			if(isset($options[3]))
			{
				$path = substr($target, 0, strrpos($target, '/'));

				$className = ucwords(substr(strrchr('/'.$target, '/'), 1));
				$baseNamespace = Make::$namespace;
				$namespace = str_replace('/', '\\', $baseNamespace . self::ControllerNamespace . ($path?'\\'.ucwords($path):''));
				$baseClassName = '\\'.$baseNamespace.self::DefaultBaseController;
				$pageURI = $target;
				$objectName = '\\'.$baseNamespace.self::ModelNamespace.'\\'.$options[3];
				$controlName = strtolower($options[3]);
				$controlTitle = ucwords($options[3]);

				// object properties
				if(class_exists($objectName))
				{
					$object = $objectName::create();
					$ds = $objectName::all();
					$fieldMeta = $ds->fieldMeta;
					$pkey = $object->pkey;
					$activeEvents = '';

					$columns = '';
					foreach($fieldMeta as $field)
					{
						if(!$field->primaryKey)
						{
							$colHeader = ucwords(str_replace('_', ' ', $field->name));
							if($field->boolean)
							{
								$activeEvents .= "


		/**
		 * Event called when {$field->name} checkbox is clicked
		 *
		 * @param  object \$sender Sender object
		 * @param  EventArgs \$args Event args
		 * @return void
		 */
		public function on".ucwords($field->name)."AjaxPost(\$sender, \$args)
		{
			\${$controlName}Record = {$objectName}::findById(\$args[\"{$pkey}\"]);

			if(\${$controlName}Record)
			{
				\${$controlName}Record[\"{$field->name}\"] = \$args[\"{$field->name}\"]==false?false:true;
				\${$controlName}Record->save();

				\Rum::flash(\"s:{$controlTitle} {$field->name} field has been \".(\$args[\"{$field->name}\"]==false?\"unset\":\"set\"));
			}
		}";
								$columns .= "\t\t\t\$this->page->gridview->columns->add(new \System\Web\WebControls\GridViewCheckBox('{$field->name}', '{$pkey}', '{$field->name}', '{$colHeader}'));" . PHP_EOL;
							}
							else
							{
								$columns .= "\t\t\t\$this->page->gridview->columns->add(new \System\Web\WebControls\GridViewColumn('{$field->name}', '{$colHeader}'));" . PHP_EOL;
							}
						}
					}

					$controllerPath = \System\Base\ApplicationBase::getInstance()->config->controllers . '/' . strtolower($target) . __CONTROLLER_EXTENSION__;
					$viewPath = \System\Base\ApplicationBase::getInstance()->config->views . '/' . strtolower($target) . __TEMPLATE_EXTENSION__;
					$testCasePath = __FUNCTIONAL_TESTS_PATH__ . '/' . strtolower($target) . strtolower(__CONTROLLER_TESTCASE_SUFFIX__) . __CLASS_EXTENSION__;

					$controllerTemplate = file_get_contents(\System\Base\ApplicationBase::getInstance()->config->root . "/system/make/templates/tablecontroller.tpl");
					$controllerTemplate = str_replace("<Namespace>", $namespace, $controllerTemplate);
					$controllerTemplate = str_replace("<BaseNamespace>", $baseNamespace, $controllerTemplate);
					$controllerTemplate = str_replace("<ClassName>", $className, $controllerTemplate);
					$controllerTemplate = str_replace("<BaseClassName>", $baseClassName, $controllerTemplate);
					$controllerTemplate = str_replace("<PageURI>", $pageURI, $controllerTemplate);
					$controllerTemplate = str_replace("<TemplateExtension>", __TEMPLATE_EXTENSION__, $controllerTemplate);
					$controllerTemplate = str_replace("<ObjectName>", $objectName, $controllerTemplate);
					$controllerTemplate = str_replace("<ControlTitle>", $controlTitle, $controllerTemplate);
					$controllerTemplate = str_replace("<PrimaryKey>", $pkey, $controllerTemplate);
					$controllerTemplate = str_replace("<Columns>", $columns, $controllerTemplate);
					$controllerTemplate = str_replace("<ActiveEvents>", $activeEvents, $controllerTemplate);

					$viewTemplate = $template = file_get_contents(\System\Base\ApplicationBase::getInstance()->config->root . "/system/make/templates/tableview.tpl");
					$viewTemplate = str_replace("<Namespace>", $namespace, $viewTemplate);
					$viewTemplate = str_replace("<BaseNamespace>", $baseNamespace, $viewTemplate);
					$viewTemplate = str_replace("<ClassName>", $className, $viewTemplate);
					$viewTemplate = str_replace("<BaseClassName>", $baseClassName, $viewTemplate);
					$viewTemplate = str_replace("<PageURI>", $pageURI, $viewTemplate);
					$viewTemplate = str_replace("<TemplateExtension>", __TEMPLATE_EXTENSION__, $viewTemplate);
					$viewTemplate = str_replace("<ControlName>", $controlName, $viewTemplate);

					$testCaseTemplate = $template = file_get_contents(\System\Base\ApplicationBase::getInstance()->config->root . "/system/make/templates/controllertestcase.tpl");
					$testCaseTemplate = str_replace("<Namespace>", $namespace, $testCaseTemplate);
					$testCaseTemplate = str_replace("<BaseNamespace>", $baseNamespace, $testCaseTemplate);
					$testCaseTemplate = str_replace("<ClassName>", $className, $testCaseTemplate);
					$testCaseTemplate = str_replace("<BaseClassName>", $baseClassName, $testCaseTemplate);
					$testCaseTemplate = str_replace("<PageURI>", $pageURI, $testCaseTemplate);
					$testCaseTemplate = str_replace("<TemplateExtension>", __TEMPLATE_EXTENSION__, $testCaseTemplate);
					$testCaseTemplate = str_replace("<Fixture>", strtolower($className).'.sql', $testCaseTemplate);

					$this->export($controllerPath, $controllerTemplate);
					$this->export($viewPath, $viewTemplate);
					$this->export($testCasePath, $testCaseTemplate);
				}
				else
				{
					print("{$objectName} does not exist".PHP_EOL);
				}
			}
			else
			{
				throw new \System\Base\MissingArgumentException("formcontroller expects one argument `objectName`");
			}
		}
	}
?>