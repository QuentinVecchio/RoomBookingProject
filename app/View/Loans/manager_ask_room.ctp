<?php 
	$projecteur = ($room['Room']['projector'] == 1)? 'Elle possède un projecteur': 'Elle ne possède pas de projecteur';
	$pc = ($room['Room']['has_PC'] == 1)? 'Elle a des PCs': 'Elle n\'a pas de PCs ';
 ?>

<section>
	<h1>Demande de réservation:</h1>
	<p>Vous avez choisi la salle <strong><?php echo $room['Room']['name']; ?></strong> du département <strong><?php echo $room['Department']['name']; ?></strong></p>
	<p>
		<ul>
			<li><?php echo $projecteur ?></li>
			<li><?php echo $pc ?></li>
		</ul>	
	</p>


	<?php 
		echo $this->Form->create('loan');
			echo $this->Form->label('date','La date: ');		
			echo $this->Form->date('loan.0.date');

			echo $this->Form->input('loan.0.start_time',array('label' => 'Heure début', 'type' => 'text', 'class' => 'datepair'));	
			echo $this->Form->input('loan.0.end_time',array('label' => 'Heure de fin', 'type' => 'text', 'class' => 'datepair'));
			echo $this->Form->label('remark','Votre remarque: ');
			echo $this->Form->textarea('loan.0.remark');
		echo $this->Form->end('Soumettre');

	 ?>
</section>

<?php 
$this->start('script');
	echo $this->Html->script('jquery_timepicker_min');
	echo $this->Html->script('gestion_demande_salle');
$this->end(); 
$this->start('css');
	echo $this->Html->css('jquery_timepicker');
$this->end(); 
 ?>