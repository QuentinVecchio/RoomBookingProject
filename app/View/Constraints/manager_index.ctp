<h1>Outils de gestion des contraintes:</h1>
<ul class="button-group">
	<li><?php echo $this->Html->link('<< Semaine précédente', array('controller' => 'constraints', 'action' => 'index',
													 date('Y-m-d', strtotime($date . ' - 7 day'))), array('class' => 'button')) ?></li>
	<li><?php echo $this->Html->link('< Jour précédent', array('controller' => 'constraints', 'action' => 'index',
													 date('Y-m-d', strtotime($date . ' - 1 day'))), array('class' => 'button')) ?></li>
	<li><?php echo $this->Html->link('Jour suivant >', array('controller' => 'constraints', 'action' => 'index',
													 date('Y-m-d', strtotime($date . ' + 1 day'))), array('class' => 'button')) ?></li>
	<li><?php echo $this->Html->link('Semaine suivante >>', array('controller' => 'constraints', 'action' => 'index',
													 date('Y-m-d', strtotime($date . ' + 7 day'))), array('class' => 'button')) ?>	</li>

</ul>


<section ng-app="gestionContrainte" ng-controller="gestionCtrl">
	<input ng-model="filtreTraite" value="tous" type="radio">Tous
	<input ng-model="filtreTraite" ng-value="true" type="radio">traité
	<input ng-model="filtreTraite" ng-value="false" type="radio">Non traité



<div  ng-init="constraints=<?php echo htmlentities(json_encode($constraints));?>;
				listId=<?php echo htmlentities(json_encode($listId));?>;
				listUser=<?php echo htmlentities(json_encode($listUser));?>;
				listFormation=<?php echo htmlentities(json_encode($listFormation));?>;
				urlChangeC='<?php echo $this->Html->url(array('controller' => 'constraints', 'action' => 'check', 'manager' => true)) ?>';
				urlDeleteC='<?php echo $this->Html->url(array('controller' => 'constraints', 'action' => 'delete', 'manager' => true)) ?>';"
				 class="clear tableau">
	<div class="colonne" ng-repeat="i in listId">
		<h4 class="titre">{{i.jour}}</h4>
			<div ng-repeat="d in i.id" class="bloc-contraintes" ng-show="filtreTraite == d.Constraint.deal || filtreTraite == 'tous'">
				<div class="align"><input type="checkBox" ng-model="d.Constraint.deal" ng-init="d.Constraint.deal =initCheck(d.Constraint.deal)" ng-change="changeC(d.Constraint.user_id, i.date, d.Constraint.deal)"></div>
				<div class="align">
				<ul>
					<li ng-repeat="c in constraints| filter:{ Constraint.date: i.date, User.id: d.Constraint.user_id}" ng-switch on="$first">
							<span ng-switch-when="true" class="bloc-titre">{{c.User.firstname}} {{c.User.lastname}}</span>
							<span class="icon-cancel" ng-click="deleteC(this,c.Constraint.date, $parent.$parent.$index)">{{c[0].start_time}} à {{c[0].end_time}}</span>
					</li>
				</ul>
				</div>
			</div>
	</div>	

</div>
<div>
</div>
	<?php echo $this->Form->create('Constraint', array('name' => 'form', 'class' => 'bloc')) ?>
		<select ng-model="choixUser" ng-options="value.User.name for value in listUser track by value.User.id" style="width:200px;"></select>
		<select ng-model="choixForma" ng-options="value.Formation.name for value in listFormation track by value.Formation.id" style="width:200px;"></select>
	<div>
<div class="clear tableau">
		
			<div class="colonne" ng-repeat="i in [0,1,2,3,4,5]">
				<input type="checkBox" class="center" ng-model="allDay" ng-init="allDay=false">
				<div ng-switch on="allDay">
					<div ng-switch-when="false">
						<a href="" ng-click="duplicateLine(i, $index)">+</a>
						<ul class="horaires">
							<li ng-repeat="courant in semaine[i]">
									<input type="text" name="constraint[{{i*100+$index}}][date]" 
														value="{{listId[i].date}}"
														class="invisible" required>

									<input type="text" name="constraint[{{i*100+$index}}][formation_id]" 
														ng-model="choixForma.Formation.id"
														class="invisible" required>

									<input type="text" ng-model="choixUser.User.id" 
													   name="constraint[{{i*100+$index}}][user_id]" 
													   class="invisible" required>

									<input name="constraint[{{i*100+$index}}][start_time]" type="text" 
											required ng-model="courant.Contraintes.start_time">

									<label>à</label>

									<input name="constraint[{{i*100+$index}}][end_time]" type="text"
										  	required ng-model="courant.Contraintes.end_time" 
										  	date-after="courant.Contraintes.start_time">

							<a href="" ng-click="removeLine(i, $index)">-</a>
							</li>
						</ul>
					</div>
					<div ng-switch-when="true">
						<ul class="horaires invisible">
							<li>
									<input type="text" name="constraint[{{i*100+$index}}][date]" 
														value="{{listId[i].date}}"
														 required>
														
									<input type="text" name="constraint[{{i*100+$index}}][formation_id]" 
														ng-model="choixForma.Formation.id"
														 required>

									<input type="text" ng-model="choixUser.User.id" 
													   name="constraint[{{i*100+$index}}][user_id]" 
													    required>


								<input name="constraint[{{i*100+$index}}][start_time]" type="text" 
													required ng-model="courant.Contraintes.start_time"
												    ng-init="courant.Contraintes.start_time='07:00'" >

								<input name="constraint[{{i*100+$index}}][end_time]" type="text" 
										ng-model="courant.Contraintes.end_time" ng-init="courant.Contraintes.end_time='19:00'" >
								<p>Absent toute la journée</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
	</div>
	<?php echo $this->Form->button('Ajouter', array('class' => 'btn btn-success center',
													'ng-disabled' => 'form.$invalid')); ?>
	<?php echo $this->Form->end() ?>
</div>
</section>
<?php 
$this->start('script');
	echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.2/angular.min.js');	
	echo $this->Html->script('gestionContrainte');
$this->end();

$this->start('css');
	echo $this->Html->css('gestionContraintes');
$this->end();
 ?>