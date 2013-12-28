<?php echo $this->Element('side_bar_user'); ?>
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