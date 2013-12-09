 <h1>Gestion des départements:</h1>
<aside class="side-bar">
	<nav>
		<ul>
			<li class="titre">Les départements:</li>
			<?php 
				foreach ($departments as $k => $dpt): ?>
				<li><?php echo $this->Html->Link($dpt['Department']['name'],
												 $dpt['Department']['link_edit'],
												 array('class' =>'ajax')); ?></li>
			<?php
			endforeach; ?>

			<li><?php echo $this->Html->Link('Ajouter', array('controller' => 'departments', 'action' => 'add'), array('class' => 'ajax')); ?></li>
		</ul>
	</nav>
</aside>
<section id="gestion">
	<?php echo $this->fetch('content'); ?>

</section>
   <!-- <script src="http://code.angularjs.org/1.2.4/angular.min.js"></script>
    <script src="http://code.angularjs.org/1.2.4/angular-animate.min.js"></script>
	<script>
			var gestionDemande = angular.module('gestionDemande', []);
			 
			gestionDemande.controller('FormCtrl', function FormCtrl($scope, $http) {
				$http.get('http://localhost/CakePHP/projet-web/index.php/admin/departments/index.json').success(function(response) {
				      	$scope.valeurs = response;
				    });			
			});

	</script>
	<div ng-app="gestionDemande">
		<div ng-controller="FormCtrl">
			<strong>Test {{valeurs[0].nom}}</strong>
				   <ul>
				 	  	<li ng-repeat="t in valeurs">{{t.Department.name}}</li>
				   </ul>
		</div>
	</div>
-->