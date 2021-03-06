<section >
	<h1>Gestion de vos enseignements:</h1>
	<?php //debug($listDpt); ?>
	<?php //debug($formation); ?>

	<section style="margin: auto;" ng-app="gestionFormation" ng-Controller="gestionCtrl" ng-init="listDpt=<?php echo htmlentities(json_encode($listDpt))?>;
																			formation=<?php echo htmlentities(json_encode($formation)) ?>;
																			urlAdd='<?php echo $this->Html->url(array('controller' => 'teaches', 'action' => 'add')) ?>';
																			urlDelete='<?php echo $this->Html->url(array('controller' => 'teaches', 'action' => 'delete')) ?>'">
		<ul class="listeDepartement" ng-repeat="i in listDpt">
			<li class="titreDepartement">{{i['Department']['name']}}</li>
			<ul class="listeFormation">
				<li ng-repeat="j in formation | filter:{Formation.department_id: i.Department.id}">
					<input id="element{{$parent.$index*10+$index}}" style="vertical-align:middle;" ng-model="valeur" type="checkbox" ng-change="changement(j['Formation']['id'],valeur)" value="{{j['Formation']['name']}}" ng-checked="j['Teach'].length != 0">
					<label for="element{{$parent.$index*10+$index}}">{{j['Formation']['name']}}</label>
				</li>
			</ul>
		<ul>
	</section>
	<?php 
	$this->start('script');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0-rc.2/angular.min.js');	
		echo $this->Html->script('gestionEnseignement');
	$this->end();
	 ?>
</section>
<?php
$this->start('css');
	echo $this->Html->css('table');
$this->end();
?>