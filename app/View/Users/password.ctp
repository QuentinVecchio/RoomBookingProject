<?php 
	echo $this->Form->create('User');
		echo $this->Form->input('passwordOld', array('label' =>'Ancien mot de passe:', 'type' => 'password', 'class' => 'high'));
			echo $this->Form->input('password', array('label' =>'Nouveau mot de passe', 'class' => 'high'));
			echo $this->Form->input('password2', array('label' => 'Encore:', 'type' => 'password', 'class' => 'high'));
		echo $this->Form->end('Modifier');
 ?>