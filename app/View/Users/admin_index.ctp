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