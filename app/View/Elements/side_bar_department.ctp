<?php  $departments = $this->requestAction(array('controller' =>'departments', 'action' =>'getDepartments', 'admin'=>false));
?>

<aside class="side-bar">
	<nav>
		<ul>
			<li><?php echo $this->Html->Link('Gestion département', array('controller' =>'departments', 'action' =>'management', 'admin' => true)); ?></li>
			<li class="titre">Les départements:</li>
			<?php 
				foreach ($departments as $k => $dpt): ?>
				<li><?php echo $this->Html->Link($dpt['Department']['name'],array('controller' =>'departments', 'action' =>'view', $dpt['Department']['id'])); ?></li>

			<?php
			endforeach; ?>

		</ul>
	</nav>
</aside>