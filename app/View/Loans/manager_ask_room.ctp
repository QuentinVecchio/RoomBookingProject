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

	<section ng-controller="tableauController"  ng-app="gestionTableau">
		<h1>Demande de réservation:</h1>
		<p>Vous avez choisi la salle <strong><?php echo $room['Room']['name']; ?></strong> du département <strong><?php echo $room['Department']['name']; ?></strong></p>
		<ul class="liste-p">
			<li><?php echo $projecteur ?></li>
			<li><?php echo $pc ?></li>
		</ul>	

	<?php 	echo $this->Form->create('loan', array('name' =>"form")); ?>
	<table class="gestion-demande-salle  grille-gestion" ng-init="loans=<?php echo htmlentities(json_encode($this->data)); ?>">
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
				<tr ng-repeat="i in loans.loan" class="ng-scope">
					<td>
						<input type="text" ng-model="loans.loan[$index].room_id"  name="loan[{{$index}}][room_id]" required style="display:none;">
						<input type="text" ng-model="loans.loan[$index].status_id"  name="loan[{{$index}}][status_id]" required style="display:none;">
						<input type="text" ng-model="loans.loan[$index].department_id"  name="loan[{{$index}}][department_id]" required style="display:none;">

						<input type="text" ng-model="loans.loan[$index].date"  name="loan[{{$index}}][date]" required ng-pattern="/^((0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])-(20[0-9][0-9]))$/" placeholder="jj-mm-aaaa">
					</td>
					<td><input type="text" ng-model="loans.loan[$index].start_time" placeholder="hh:mm" name="loan[{{$index}}][start_time]"required ng-pattern="/^(0[7-9]|1[0-9]):([03]0|[14]5)$/"></td>
					<td><input type="text" ng-model="loans.loan[$index].end_time" placeholder="hh:mm" name="loan[{{$index}}][end_time]"required ng-pattern="/^(0[7-9]|1[0-9]):([03]0|[14]5)$/" date-after="loans.loan[$index].start_time"></td>
					<td><textarea type="text" name="loan[{{$index}}][remark]" ng-model="loans.loan[$index].remark"></textarea></td>
					<td>
						<p class="error-message">{{loans.loan[$index].error}}</p>
						
						<ul class="button-group options">
							<li><span ng-click="removeLine($index)" class="button tiny alert">Supprimer</span></li>
							<li><span ng-click="duplicateLine($index)" class="button tiny">Duppliquer</span></li>
						</ul>

					</td>
				</tr>

			</tbody>

		</table>
			<ul class="button-group">
				<li><input type="submit" value="Soumettre" ng-disabled="form.$invalid" class="button tiny">	</li>
			</ul>
			<?php echo $this->Form->end(); ?>
	</section>

	<?php 
	$this->start('script');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.2/angular.min.js');
		echo $this->Html->script('gestion_demande_salle');
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