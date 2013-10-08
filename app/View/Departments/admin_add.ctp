<?php 
	echo $this->Form->create('Department');
		echo $this->Form->input('name', array('label' => 'Nom'));
	echo $this->Form->end('Ajouter');

 ?>