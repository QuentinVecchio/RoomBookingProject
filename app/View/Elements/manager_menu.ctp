<nav id="menu-principal">
	<ul>
		<li><?php echo $this->Html->Link('Départements', array('controller'=> 'departments','action' => 'index')) ?></li>
		<li><?php echo $this->Html->Link('Les demandes', array('controller'=> 'rooms','action' => 'answer')) ?></li>		
		<li><?php echo $this->Html->Link('Deconnexion', array('controller' => 'users', 'action' => 'logout', 'manager' => false)); ?></li>
		<li><a href="#">Menu 3</a></li>
	</ul>
</nav>