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
<?php 	echo $this->Form->create('loan'); ?>


<table class="gestion-demande-salle">
		<thead>
			<tr>
				<td>Date</td>
				<td>Heure début</td>
				<td>Heure Fin</td>
				<td>Commentaire</td>
				<td><span class="icon-cog"></span></td>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td><?php echo $this->Form->input('loan.0.date',array('label' => array('style'=>'display:none;'), 'type' => 'text', 'class' => 'date start ', 'div' => array('class' => ''))); ?></td>
					<td><?php echo $this->Form->input('loan.0.start_time',array('label' => array('style'=>'display:none;'), 'type' => 'text', 'class' => 'time start', 'div' => array('class' => 'datepair'))); ?></td>
					<td><?php echo $this->Form->input('loan.0.end_time',array('label'  => array('style'=>'display:none;'), 'type' => 'text', 'class' => 'time end', 'div' => array('class' => 'datepair'))); ?></td>
					<td><?php echo $this->Form->textarea('loan.0.remark'); ?></td>
					<td></td>
				</tr>
		</tbody>
	</table>

	<?php 
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
	echo $this->Html->css('gestion_demande_salle');
$this->end(); 
 ?>