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
		
		echo $this->fetch('css');

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
		<p class="copyright">Créateurs: 
				<a href="mailto:vecchioquentin@gmail.com">Quentin Vecchio</a> et 
				<a href="mailto:matthieu.clin@wanadoo.fr">Matthieu Clin</a>
		</p>
	</footer>
	<?php 
		echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
		echo $this->Html->script('charge');
		echo $this->fetch('script');
	 ?>
</body>
</html>
