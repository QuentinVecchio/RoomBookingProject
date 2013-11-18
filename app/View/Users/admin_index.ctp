 <h1>Gestion des utilisateurs:</h1>
<?php 
	echo $this->Element('side_bar_gestion_utilisateur');
 ?>

<section id="gestion">
	
</section>
<?php 
$this->start('script');
	echo $this->Html->script('charge');
$this->end(); 
 ?>
 
<?php 
$this->start('css');
	echo $this->Html->css('table');
$this->end();
?>	