<?php echo $this->Element('side_bar_user'); ?>
<section id="gestion">

	<?php echo $this->Form->create('User'); ?>
	<fieldset>
	<legend>Modifier vos informations personnelles</legend>
	<?php 
		echo $this->Form->input('lastname', array('label' =>'Votre nom', 'div' => array('class' => 'small')));

		echo $this->Form->input('firstname', array('label' =>'Votre prénom', 'div' => array('class' => 'small')));

		echo $this->Form->input('email', array('label' =>'Votre email', 'div' => array('class' => 'small')));

		?>
		<ul class="button-group options">
			<li><?php echo $this->Form->button('Mettre à jour', array('class' =>'tiny icon-ok success')); ?>
			</li>
		</ul>
	</fieldset>

	<?php echo $this->Form->end(); ?>

</section>