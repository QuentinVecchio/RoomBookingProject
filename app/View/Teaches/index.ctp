<section >
	<h1>Gestion de vos enseignements:</h1>

	<p><span>Url d'ajout: </span><?php echo $this->Html->url(array('controller' => 'teaches', 'action' => 'add')) ?></p>
	<p><span>Url de suppression: </span><?php echo $this->Html->url(array('controller' => 'teaches', 'action' => 'delete')) ?></p>
	<?php debug($tmp); ?>
	<?php debug($listFormation); ?>

	<?php 
	$this->start('script');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.2/angular.min.js');	
		echo $this->Html->script('gestionEnseignement');
	$this->end();
	 ?>
	
</section>