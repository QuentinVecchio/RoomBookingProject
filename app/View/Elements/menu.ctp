<?php 
	if(empty($_SESSION['Auth']['User'])){
		$co = $this->Html->Link('Connexion', array('controller' => 'users', 'action' => 'login', 'admin' => false));
	}else{
		$co = $this->Html->Link('Déconnexion', array('controller' => 'users', 'action' => 'logout', 'admin' => false));
	}


	$profil = $this->Html->Link('Profils', 
		array('controller' => 'users',
				'action' => 'index',
				'admin' =>false));
?>

<nav id="menu-principal">
	<ul>
		<li><?php echo $profil; ?></li>
		<li><?php echo $co; ?></li>
	</ul>
</nav>