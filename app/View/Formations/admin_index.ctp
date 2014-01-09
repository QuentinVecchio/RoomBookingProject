<h1>Gestion des filières:</h1>
<aside class="side-bar">
	<nav>
		<ul>
			<li class="titre">Les départements:</li>
			<?php 
				foreach ($listDept as $k => $dpt): ?>
				<li><?php echo $this->Html->Link($dpt['Department']['name'],
												 array('controller'=> 'formations', 'action' => 'edit',$dpt['Department']['id'])); ?></li>
			<?php
			endforeach; ?>
		</ul>
	</nav>
</aside>
<section ng-app="gestionFormation" ng-controller="gestionCtrl">
	<?php echo $this->fetch('content'); ?>
</section>
