<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('foundation');
		echo $this->Html->css('global');
		echo $this->Html->css('menu_top');
		echo $this->Html->css('form');
		echo $this->Html->css('fontello');
		echo $this->Html->css('manager');
		echo $this->Html->css('table');
	
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
		echo $this->Html->script('charge');			

		echo $this->fetch('css');
		echo $this->fetch('script');		
	?>
</head>
<body>
	<header>
		<?php echo $this->element('menu'); ?>
	</header>
	<div id="container">

		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</div>

	<footer>
		<?php echo $this->element('sql_dump'); ?>
	</footer>
</body>
</html>
