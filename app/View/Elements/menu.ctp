<?php 
	if(empty($_SESSION['Auth']['User'])){
		$co = $this->Html->Link('Connexion', array('controller' => 'users', 'action' => 'login', 'admin' => false));
	}else{
		$co = $this->Html->Link('Déconnexion', array('controller' => 'users', 'action' => 'logout', 'admin' => false));
	}

	if($this->Session->Read('Auth.User.Role.name')==="administrators"){
		$lienAdmin = $this->Html->Link('Administration', array('controller'=>'departments', 'action'=>'index', 'admin' => true));
		$lienManag = $this->Html->Link('Manager', array('controller'=>'departments', 'action'=>'index', 'manager' => true));
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
		<li><?php if(isset($lienAdmin)) echo $lienAdmin ?></li>
		<li><?php if(isset($lienManag)) echo $lienManag ?></li>
		<li><?php echo $co; ?></li>
	</ul>
</nav>