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
		echo $this->Html->css('default');
		echo $this->Html->css('style');
		echo $this->Html->css('menu');
		echo $this->Html->css('admin');
		echo $this->Html->css('tableau');
		echo $this->Html->css('fontello');

		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<header>
		<?php echo $this->element('manager_menu'); ?>
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
