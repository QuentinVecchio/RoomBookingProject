<aside class="side-bar">
	<nav>
		<ul>
			<li class="titre">Votre profil:</li>
			<li><?php echo $this->Html->Link('Voir', array('controller' => 'users')); ?></li>
			<li><?php echo $this->Html->Link('Changer informations', array('controller' => 'users', 'action' => 'edit'), array('class'=>'ajax')); ?></li>
			<li><?php echo $this->Html->Link('Changer le mot de passe', array('controller' => 'users', 'action' => 'password'), array('class'=>'ajax')); ?></li>

		</ul>
	</nav>
</aside>
<section id="gestion">
	<div class="profils">
		<h1>Votre profils</h1>
		<ul class="list-info">
			<li class="icon-user"><?php echo $user['User']['firstname']. ' '. $user['User']['lastname']; ?></li>
			<li class="icon-mail"><?php echo $user['User']['email']; ?></li>
			<li class="icon-info-circled"><?php echo 'Département '.$user['Department']['name']; ?></li>
		</ul>		
	</div>

</section>