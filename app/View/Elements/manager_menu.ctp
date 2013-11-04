<?php 
	if($this->Session->Read('Auth.User.Role.name')==="administrators"){
		$lien = $this->Html->Link('Administration', array('controller'=>'departments', 'action'=>'index', 'admin' => true));
	}
 ?>

<nav id="menu-principal">
	<ul>
		<li><?php echo $this->Html->Link('Départements', array('controller'=> 'departments','action' => 'index')) ?></li>
		<li><?php echo $this->Html->Link('Les demandes', array('controller'=> 'loans','action' => 'answer')) ?></li>		
		<li><?php echo $this->Html->Link('Demander une salle', array('controller'=> 'loans','action' => 'ask')) ?></li>		
		<li><?php if(isset($lien)) echo $lien; ?></li>
		<li><?php echo $this->Html->Link('Profil', array('controller'=> 'users','action' => 'index', 'manager' => false, 'manager' => false)) ?></li>		
		<li><?php echo $this->Html->Link('Deconnexion', array('controller' => 'users', 'action' => 'logout', 'manager' => false)); ?></li>
	</ul>
</nav>