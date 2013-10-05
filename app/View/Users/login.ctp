<div id="formLog">
<?php 
	echo $this->Form->create('User'); 
		echo $this->Form->input('username', array('label'=> 'Identifiant:', 'class'));
		echo $this->Form->input('password', array('label'=> 'Mot de passe:'));
	echo $this->Form->end(array('label'=>'Se connecter',  'class' => 'button small'));

?>
</div>
