<?php 
		$admin = ($this->Session->Read('Auth.User.Role.name')==="administrators");
		$manager = ($this->Session->Read('Auth.User.Role.name')==="managers");
		$connecte = $this->Session->Read('Auth.User.Role.name');
		if(!$connecte){
			$co = $this->Html->Link('Connexion', array('controller' => 'users', 'action' => 'login', 'admin' => false, 'manager'=>true));
		}else{
			$co = $this->Html->Link('Déconnexion', array('controller' => 'users', 'action' => 'logout', 'admin' => false, 'manager'=>true));
		}
 ?>

<nav id="menu-principal">
	<ul>
		<?php if($admin):?>
			<li class="sous-menu"><a href="#">Administration</a>
				<ul>
					<li><?php echo $this->Html->Link('Gestion des salles', array('controller'=> 'rooms','action' => 'index', 'admin'=>true)) ?></li>
					<li><?php echo $this->Html->Link('Gestion des départements', array('controller'=> 'departments','action' => 'index', 'admin'=>true)) ?></li>
				</ul>
			</li>
		<?php endif; ?>
		<?php if($admin || $manager): ?>
		<li class="sous-menu"><a href="#">Prêts de salle</a>
			<ul>
				<li><?php echo $this->Html->Link('Vos salles', array('controller'=> 'departments','action' => 'index', 'manager'=>true)) ?></li>
				<li><?php echo $this->Html->Link('Gestion des demandes', array('controller'=> 'loans','action' => 'answer', 'manager'=>true)) ?></li>		
				<li><?php echo $this->Html->Link('Demander une salle', array('controller'=> 'loans','action' => 'ask', 'manager'=>true)) ?></li>		
			</ul>
		</li>
		<?php endif; ?>
		<?php if($connecte): ?>
			<li><?php echo $this->Html->Link('Profil', array('controller'=> 'users','action' => 'index', 'manager' => false, 'admin' => false)) ?></li>	
		<?php endif; ?>
		<li><?php echo $co ?></li>
	</ul>
</nav>
