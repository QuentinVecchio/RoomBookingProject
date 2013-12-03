<aside class="side-bar">
	<nav>
		<ul>
			<li class="titre">Votre profil:</li>
			<li><?php echo $this->Html->Link('Voir', array('controller' => 'users')); ?></li>
			<li><?php echo $this->Html->Link('Changer informations', array('controller' => 'users', 'action' => 'edit')); ?></li>
			<li><?php echo $this->Html->Link('Changer le mot de passe', array('controller' => 'users', 'action' => 'password')); ?></li>

		</ul>
	</nav>
</aside>