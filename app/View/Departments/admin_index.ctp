 <h1>Gestion des salles:</h1>
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
<section id="gestion"></section>