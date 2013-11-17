<?php 
	$projecteur = ($room['Room']['projector'] == 1)? 'Elle possède un projecteur': 'Elle ne possède pas de projecteur';
	$pc = ($room['Room']['has_PC'] == 1)? 'Elle a des PCs': 'Elle n\'a pas de PCs ';
 ?>

<section ng-controller="FormCtrl"  ng-app="gestionDemande">
	<h1>Demande de réservation:</h1>
	<p>Vous avez choisi la salle <strong><?php echo $room['Room']['name']; ?></strong> du département <strong><?php echo $room['Department']['name']; ?></strong></p>
	<p>
		<ul>
			<li><?php echo $projecteur ?></li>
			<li><?php echo $pc ?></li>
		</ul>	
	</p>
<?php 	echo $this->Form->create('loan'); ?>

<p>Le nombre de semaine:<input type="number" ng-model="number"></p>
<table class="gestion-demande-salle  grille-gestion">
		<thead>
			<tr>
				<th>Date</th>
				<th>Heure début</th>
				<th>Heure Fin</th>
				<th>Commentaire</th>
				<th class="colonne-options"><span class="icon-cog"></span></th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td><?php echo $this->Form->input('loan.0.date',array('label' => array('style'=>'display:none;'),
																		  'ng-model'=>"date",'type' => 'text')); ?></td>

					<td><?php echo $this->Form->input('loan.0.start_time',array('label' => array('style'=>'display:none;'),
																			'ng-model' => 'startTime', 'type' => 'text')); ?></td>

					<td><?php echo $this->Form->input('loan.0.end_time',array('label'  => array('style'=>'display:none;'),
																			'ng-model' => 'endTime', 'type' => 'text')); ?></td>

					<td><?php echo $this->Form->textarea('loan.0.remark', array('ng-model' => 'remark')); ?></td>
					<td>
						<ul class="button-group">
							<li><a href="#" class="button tiny icon-cancel" onClick="";></a></li>
						</ul>

					</td>
				</tr>
				<tr  ng-repeat="id in getNumber(number)">

					<td><?php echo $this->Form->input('loan.{{id}}.date',array('label' => array('style'=>'display:none;'),'value'=>"{{getDate(id,date)}}",'type' => 'text','div' => array('class' => ''))); ?></td>
					<td><?php echo $this->Form->input('loan.{{id}}.start_time',array('label' => array('style'=>'display:none;'),
																			'value' => '{{startTime}}', 'type' => 'text')); ?></td>

					<td><?php echo $this->Form->input('loan.{{id}}.end_time',array('label'  => array('style'=>'display:none;'),
																			'value' => '{{endTime}}', 'type' => 'text')); ?></td>

					<td><?php echo $this->Form->textarea('loan.{{id}}.remark', array('value' => '{{remark}}')); ?></td>
					<td>
						<ul class="button-group">
							<li><a href="#" class="button tiny icon-cancel" onClick="removeLine(this)";></a></li>
						</ul>

					</td>
				</tr>


		</tbody>
	</table>

	<?php 
		echo $this->Form->end('Soumettre');

	 ?>
</section>

<?php 
$this->start('script');
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.2/angular.min.js');
	echo $this->Html->script('gestion_demande_salle');
	echo $this->Html->script('controllers');
$this->end(); 
$this->start('css');
	echo $this->Html->css('table');
	echo $this->Html->css('gestion_demande_salle');
$this->end(); 
 ?>