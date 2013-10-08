<?php 
	echo $this->Form->create('Department');
		echo $this->Form->input('name', array('label' => 'Nom'));

	echo $this->Html->Link('Supprimer', array('controller' => 'departments', 'action' => 'delete', $id),array('class' => 'button tiny icon-cancel-circled'));

	echo $this->Form->button('Mettre à jour', array('class' => 'tiny icon-ok'));
	echo $this->Form->end();

 ?>