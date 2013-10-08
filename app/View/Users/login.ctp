<div id="formLog">
<?php 
	echo $this->Form->create('User'); 
		echo $this->Form->input('username', array('label'=> 'Identifiant:', 'between'=>'<span class="icon-user"></span>'));
		echo $this->Form->input('password', array('label'=> 'Mot de passe:', 'between' =>'<span class="icon-lock"></span>'));
	echo $this->Form->end(array('label'=>'Se connecter',  'class' => 'button small'));

?>
</div>
