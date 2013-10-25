<section id="calendrier">
	<?php 
			App::import('Vendor', 'Calendrier');
			$calendrier = new Calendrier(true,'test');
			$test = $calendrier->getCalendrier($res,null);
			echo $test;
	 ?>
</section>
<section id="gestion">

</section>

<?php 
$this->start('script');
	echo $this->Html->script('scriptCalendrier');
		echo $this->Html->script('charge');
$this->end(); 
$this->start('css');
	echo $this->Html->css('styleCalendrier');
$this->end();
 ?>