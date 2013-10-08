<?php 
	echo $this->Form->create('User');
		echo $this->Form->input('lastname', array('label' =>'Votre nom'));
		echo $this->Form->input('firstname', array('label' =>'Votre prénom'));
		echo $this->Form->input('email', array('label' =>'Votre email'));
	echo $this->Form->end('Mettre à jour');
 ?>