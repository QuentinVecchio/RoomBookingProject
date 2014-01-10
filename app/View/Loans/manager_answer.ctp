 <h1>Demandes des autres départements:</h1>
<section id="calendrier">
	<?php 
			App::import('Vendor', 'Calendrier/Calendrier');

			$calendrier = new Calendrier(true,'test',2014);
			echo $calendrier->getCalendrier($res,null,'view');
	 ?>
</section>
<section id="gestion">

</section>
<?php 
$this->start('script');
	echo $this->Html->script('scriptCalendrier');
	echo $this->Html->script('charge');
	echo $this->Html->script('modifDemandeSalle');
$this->end(); 
$this->start('css');
	echo $this->Html->css('styleCalendrier');
	echo $this->Html->css('gestionListe');	
$this->end();
 ?>