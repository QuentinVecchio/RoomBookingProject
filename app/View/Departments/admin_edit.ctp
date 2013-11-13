<?php 
	echo $this->Form->create('Department');
?>
	<fieldset>
		<legend>Modification:</legend>
<?php
		echo $this->Form->input('name', array('label' => 'Nom', 'div' => array('class' => 'small')));

		?>

	<ul class="button-group options">
		<li><?php echo $this->Html->Link('Supprimer', array('controller' => 'departments', 'action' => 'delete', $id),
													  array('class' => 'button tiny icon-cancel-circled alert', 
													  		'confirm' => 'Etes vous sûr de vouloir supprimer ce département ?')); ?>
		</li>

		<li><?php echo $this->Form->button('Mettre à jour', array('class' => 'button tiny icon-ok success')); ?>
		</li>

	</ul>
	</fieldset>
<?php 
	echo $this->Form->end();
 ?>