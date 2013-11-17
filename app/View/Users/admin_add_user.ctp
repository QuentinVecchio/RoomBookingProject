<?php 
	echo $this->Element('side_bar_gestion_utilisateur');
 ?>

<?php echo $this->Form->create('User'); ?>
<fieldset>
<legend>Ajouter un utilisateur</legend>
<?php 
	echo $this->Form->input('username', array('label' =>'Le login', 'div' => array('class' => 'medium')));

	echo $this->Form->input('lastname', array('label' =>'Le nom', 'div' => array('class' => 'medium')));

	echo $this->Form->input('firstname', array('label' =>'Le prénom', 'div' => array('class' => 'medium')));

	echo $this->Form->input('email', array('label' =>'Email', 'div' => array('class' => 'medium')));

	echo $this->Form->input('password', array('label' =>'Mot de passe', 'div' => array('class' => 'medium')));

	?>
	<div class="medium">
		<?php 
			echo $this->Form->label('department_id','Le département');
			echo $this->Form->select('department_id', $list, array('style' =>'width:150px;'));

		 ?>
	</div>
	<div class="medium">
	<?php 
			echo $this->Form->label('role_id', 'Son statut');	
			echo $this->Form->select('role_id', $listRole, array('style' =>'width:150px;'));

	?>
	</div>
	<ul class="button-group options">
		<li><?php echo $this->Form->button('Ajouter', array('class' =>'tiny icon-ok success')); ?></li>
		<li><?php echo $this->Form->button('Réinitialiser', array('class' =>'tiny icon-trash alert', 'type' =>'reset')); ?></li>
	</ul>
</fieldset>

<?php echo $this->Form->end(); ?>