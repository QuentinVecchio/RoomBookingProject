<aside class="side-bar">
	<nav>
		<ul>
			<li class="titre">Les départements:</li>
			<?php 
				foreach ($side_department as $k => $dpt): ?>
				<li><?php echo $this->Html->Link($dpt['Department']['name'],array('controller' =>'rooms', 'action' =>'view', $dpt['Department']['id'])); ?></li>

			<?php
			endforeach; ?>

		</ul>
	</nav>
</aside>