<nav id="menu-principal">
	<ul>
		<li><?php echo $this->Html->Link('Départements', array('controller'=> 'departments','action' => 'index')) ?></li>
		<li><?php echo $this->Html->Link('Se déconnecter', array('controller' => 'users', 'action' => 'logout', 'manager' => false)); ?></li>
		<li><a href="#">Menu 3</a></li>
	</ul>
</nav>