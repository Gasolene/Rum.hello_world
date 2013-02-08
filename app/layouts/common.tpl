<!DOCTYPE html>
<html lang="<?=Rum::app()->lang?>" >
<head>
<meta charset="<?=Rum::app()->charset?>" />
<title><?=$title?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>
<body>

<div id="page">
	<div id="header">
		<a id="logo"><img src="<?=  Rum::config()->uri?>/resources/images/logo.png"/></a>
		<ul id="nav">
			<li><a href="/">Home</a></li>
		</ul>
		<a href="/logout/" class="login">Logout</a>
	</div>

	<div id="body">
		<div id="content" class="wide">
			<?=Rum::messages() ?>
			<?php $this->content() ?>
		</div>
		<div style="clear:both"></div>
	</div>

	<div id="footer">
		<span><strong>Framework Version:</strong> <?php echo \System\Base\FRAMEWORK_VERSION_STRING ?></span>
	</div>

</div>

</body>
</html>
