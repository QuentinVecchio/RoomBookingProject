<div id="formLog">
<?php 
	echo $this->Form->create('User'); 
?>
	<fieldset>
		<legend>Connexion</legend>
		<?php 
			echo $this->Form->input('username', array('label'=> 'Identifiant:', 'between'=>'<span class="icon-user"></span>'));
			echo $this->Form->input('password', array('label'=> 'Mot de passe:', 'between' =>'<span class="icon-lock"></span>'));
		 ?>
		 <ul class="button-group">
		 	<Li><?php echo $this->Form->button('Se connecter', array('class'=> 'button small')); ?></Li>
		 </ul>

	</fieldset>
	<?php 
		echo $this->Form->end();
	 ?>
</div>
