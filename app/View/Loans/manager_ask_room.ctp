<?php 
	$projecteur = ($room['Room']['projector'] == 1)? 'Elle possède un projecteur': 'Elle ne possède pas de projecteur';
	$pc = ($room['Room']['has_PC'] == 1)? 'Elle a des PCs': 'Elle n\'a pas de PCs ';
 ?>
<section class="centre">
	
	<h1>Les disponibilités de la salle:</h1>
	<section id="calendrier">
		<?php 
				App::import('Vendor', 'Calendrier/Calendrier');

				$calendrier = new Calendrier(true,'test');
				echo $calendrier->getCalendrier($occupationSalle,null,'../../loans/viewAvailable/'.$room['Room']['id']);
		 ?>
	</section>
	<section id="gestion">

	</section>

	<section ng-controller="FormCtrl"  ng-app="gestionDemande">
		<h1>Demande de réservation:</h1>
		<p>Vous avez choisi la salle <strong><?php echo $room['Room']['name']; ?></strong> du département <strong><?php echo $room['Department']['name']; ?></strong></p>
		<ul class="liste-p">
			<li><?php echo $projecteur ?></li>
			<li><?php echo $pc ?></li>
		</ul>	

	<?php 	echo $this->Form->create('loan', array('name' =>"form")); ?>

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
						<td><?php 
									echo $this->Form->input('loan.0.room_id', array('label' => array('style' => 'display:none;'),
																					'style'=> array('display:none;'), 'type' => 'text',
																					'value' => $room['Room']['id']));

									echo $this->Form->input('loan.0.status_id', array('label' => array('style' => 'display:none;'),
																					'style'=> array('display:none;'), 'type' => 'text',
																					'value' => $idEnAttente));

									echo $this->Form->input('loan.0.department_id', array('label' => array('style' => 'display:none;'),
																					'style'=> array('display:none;'), 'type' => 'text',
																					'value' => $department_id));

									echo $this->Form->input('loan.0.date',array('label' => array('style'=>'display:none;'),
																			  'ng-model'=>"date",'type' => 'text',
																			  'ng-pattern' => '/^([0-9]{2}-){2}[0-9]{4}$/')); ?></td>

						<td><?php 	echo $this->Form->input('loan.0.start_time',array('label' => array('style'=>'display:none;'),
																				'ng-model' => 'startTime', 'type' => 'text',
																			 	'ng-pattern' => '/^([0-9]{2}:[0-9]{2}$/')); ?></td>

						<td><?php 	echo $this->Form->input('loan.0.end_time',array('label'  => array('style'=>'display:none;'),
																				'ng-model' => 'endTime', 'type' => 'text',
																			 	'ng-pattern' => '/^([0-9]{2}:[0-9]{2}$/')); ?></td>

						<td><?php 	echo $this->Form->textarea('loan.0.remark', array('ng-model' => 'remark')); ?></td>
						<td>
							<ul class="button-group">
								<li><a href="#" class="button tiny icon-cancel" onClick="";></a></li>
							</ul>

						</td>
					</tr>
					<tr  ng-repeat="id in getNumber(number)">

						<td><?php	echo $this->Form->input('loan.{{id}}.room_id', array('label' => array('style' => 'display:none;'),
																					'style'=> array('display:none;'), 'type' => 'text',
																					 'value' => $room['Room']['id']));

									echo $this->Form->input('loan.{{id}}.status_id', array('label' => array('style' => 'display:none;'),
																					'style'=> array('display:none;'), 'type' => 'text',
																					'value' => $idEnAttente));

									echo $this->Form->input('loan.{{id}}.department_id', array('label' => array('style' => 'display:none;'),
																					'style'=> array('display:none;'), 'type' => 'text',
																					'value' => $department_id));
									echo $this->Form->input('loan.{{id}}.date',array('label' => array('style'=>'display:none;'),
																				'value'=>"{{getDate(id,date)}}",'type' => 'text',
																			 	'ng-pattern' => '/^([0-9]{2}-){2}[0-9]{4}$/')); ?></td>

						<td><?php 	echo $this->Form->input('loan.{{id}}.start_time',array('label' => array('style'=>'display:none;'),
																				'value' => '{{startTime}}', 'type' => 'text',
																			 	'ng-pattern' => '/^([0-9]{2}:[0-9]{2}$/')); ?></td>

						<td><?php 	echo $this->Form->input('loan.{{id}}.end_time',array('label'  => array('style'=>'display:none;'),
																				'value' => '{{endTime}}', 'type' => 'text',
																			 	'ng-pattern' => '/^([0-9]{2}:[0-9]{2}$/')); ?></td>

						<td><?php 	echo $this->Form->textarea('loan.{{id}}.remark', array('value' => '{{remark}}')); ?></td>
						<td>
							<ul class="button-group">
								<li><a href="#" class="button tiny icon-cancel" onClick="removeLine(this)";></a></li>
							</ul>

						</td>
					</tr>


			</tbody>
		</table>
		<ul class="button-group">
			<li><?php  echo $this->Form->button('Soumettre',array('ng-disabled' => 'form.$invalid')); ?></li>
		</ul>

		<?php 
			echo $this->Form->end();
		 ?>
	</section>

	<?php 
	$this->start('script');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.2/angular.min.js');
		echo $this->Html->script('gestion_demande_salle');
		echo $this->Html->script('controllers');
		echo $this->Html->script('scriptCalendrier');
	$this->end(); 
	$this->start('css');
		echo $this->Html->css('table');
		echo $this->Html->css('gestion_demande_salle');
		echo $this->Html->css('styleCalendrier');
		echo $this->Html->css('gestionListe');
	$this->end(); 
	 ?>
</section>