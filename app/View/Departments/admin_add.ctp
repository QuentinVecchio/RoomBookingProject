<?php 
	echo $this->Form->create('Department');
?>
	<fieldset>
		<legend>Ajouter un département</legend>
		<?php 
			echo $this->Form->input('name', array('label' => 'Nom', 'div' => array('class' => 'small')));
		?>
			<ul class="button-group options">
				<li><?php echo $this->Form->button('Ajouter', array('class' => 'tiny icon-ok')); ?>
				</li>

			</ul>
	</fieldset>
<?php
	echo $this->Form->end();

 ?>