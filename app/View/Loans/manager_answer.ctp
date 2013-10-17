<section>
	<?php 
			App::import('Vendor', 'Calendrier');
			$calendrier = new Calendrier(true,'test');
			$test = $calendrier->getCalendrier(null);
			echo $test;
	 ?>
</section>
<section>
	<?php 
		echo '<pre>';
		var_dump($res);
		echo '</pre>';
	 ?>

</section>

<?php 
$this->start('script');
	echo $this->Html->script('scriptCalendrier');
$this->end(); 
$this->start('css');
	echo $this->Html->css('styleCalendrier');
$this->end();
 ?>