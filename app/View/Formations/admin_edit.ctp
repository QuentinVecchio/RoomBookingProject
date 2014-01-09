<?php $this->extend('admin_index'); ?>

	<table class="grille-gestion" ng-init="formations=<?php echo htmlentities(json_encode($listFormations)); ?>">
			<thead ng-init="urlUpdate='<?php echo $this->Html->url(array('controller' => 'formations', 'action' => 'update')) ?>';
							urlDelete='<?php echo $this->Html->url(array('controller' => 'formations', 'action' => 'delete')) ?>';
							urlAdd='<?php echo $this->Html->url(array('controller' => 'formations', 'action' => 'add')) ?>';
							departmentId=<?php echo $department_id ?>;
							managers=<?php echo htmlentities(json_encode($listManager)) ?>">
				<tr>
					<th style="width:200px;">Nom</th>
					<th style="width:200px;">Responsable</th>
					<th class="colonne-options"><span class="icon-cog"></span></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="i in formations">
					<td>
						<span ng-show="!i.Formation.editMode">{{i.Formation.name}}</span>
						<input type="text" ng-show='i.Formation.editMode' ng-model='i.Formation.name'>
					</td>
					<td>
						<span ng-show="!i.Formation.editMode">{{i.User.firstname}} {{i.User.lastname}}</span>
						<select ng-model="i.Formation.editRes" ng-show='i.Formation.editMode' ng-options="value.User.lastname for value in managers track by value.User.id"></select>
					</td>
					<td>
						<ul class="button-group options" ng-show="!i.Formation.editMode">
							<li><span ng-click="removeLine($index)" class="button tiny alert">Supprimer</span></li>
							<li><span ng-click="edit($index)" class="button tiny">Editer</span></li>
						</ul>
						<ul class="button-group options" ng-show="i.Formation.editMode">
							<li><span ng-click="valid($index)" class="button tiny success">Valider</span></li>
							<li><span ng-click="cancel($index)" class="button tiny">Annuler</span></li>
						</ul>

					</td>
				</tr>
				<tr>
					<td>
						<form ng-submit="add()" class="center">
							<input type="text" ng-model="nouvelleFormation">
						</form>
					</td>
					<td>
						<select ng-model="responsable"  ng-options="value.User.lastname for value in managers track by value.User.id"></select>
					</td>
					<td>
						<ul class="button-group options">
							<li><span ng-click="add()" class="button tiny">Ajouter</span></li>
						</ul>
					</td>
				</tr>

			</tbody>

	</table>

<?php 
$this->start('script');
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.2/angular.min.js');	
	echo $this->Html->script('gestionFormation');
$this->end();
 ?>
 <?php 
$this->start('css');
	echo $this->Html->css('table');
$this->end();
 ?>