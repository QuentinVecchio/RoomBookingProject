<nav id="menu-principal">
	<ul>
		<li><?php echo $this->Html->Link('Salles', array('controller'=> 'rooms','action' => 'index')) ?></li>
		<li><?php echo $this->Html->Link('Départements', array('controller'=> 'departments','action' => 'index')) ?></li>
		<li><?php echo $this->Html->Link('Panneau manager', array('controller' => 'departments', 'action' => 'index', 'manager' => true)) ?></li>
		<li><?php echo $this->Html->Link('Profil', array('controller'=> 'users','action' => 'index', 'manager' => false, 'admin' => false)) ?></li>	
		<li><?php echo $this->Html->Link('Déconnexion', array('controller' => 'users', 'action' => 'logout', 'admin' => false)) ?></li>
	</ul>
</nav>