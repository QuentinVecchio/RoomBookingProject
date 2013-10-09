<?php 
	echo $this->Form->create('Department');
?>
	<fieldset>
		<legend>Modifition:</legend>
<?php
		echo $this->Form->input('name', array('label' => 'Nom', 'div' => array('class' => 'small')));

		?>

	<ul class="button-group options">
		<li><?php echo $this->Html->Link('Supprimer', array('controller' => 'departments', 'action' => 'delete', $id),
													  array('class' => 'button tiny icon-cancel-circled')); ?>
		</li>

		<li><?php echo $this->Form->button('Mettre à jour', array('class' => 'button tiny icon-ok')); ?>
		</li>

	</ul>
	</fieldset>
<?php 
	echo $this->Form->end();
 ?>