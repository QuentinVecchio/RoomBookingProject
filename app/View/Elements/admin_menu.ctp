<nav id="menu-principal">
	<ul>
		<li><?php echo $this->Html->Link('Salles', array('controller'=> 'rooms','action' => 'index')) ?></li>
		<li><?php echo $this->Html->Link('Départements', array('controller'=> 'departments','action' => 'index')) ?></li>
		<li><a href="#"><?php echo $this->Html->Link('Déconnexion', array('controller' => 'users', 'action' => 'logout', 'admin' => false)) ?></a></li>
		<li><a href="#">Menu 3</a></li>
	</ul>
</nav>