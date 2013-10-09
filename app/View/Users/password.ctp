<?php 
	echo $this->Form->create('User');
	?>
	<fieldset>
		<legend>Modification du mot de passe</legend>
	<?php 
		echo $this->Form->input('passwordOld', array('label' =>'Ancien mot de passe:', 'type' => 'password',
													 'class' => 'high', 'div' => array('class' => 'high')));
		echo $this->Form->input('password', array('label' =>'Nouveau mot de passe:', 'class' => 'high', 'div' => array('class' => 'high')));
		echo $this->Form->input('password2', array('label' => 'Confirmer:', 'type' => 'password',
												   'class' => 'high', 'div' => array('class' => 'high')));
		?>
		<ul class="button-group options">
			<li><?php echo $this->Form->button('Mettre à jour', array('class' => 'tiny icon-ok')); ?></li>
		</ul>
	</fieldset>
<?php
		echo $this->Form->end();
 ?>