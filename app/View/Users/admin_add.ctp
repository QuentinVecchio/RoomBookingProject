	<?php 
	 echo $this->Form->create('User', array('type' => 'file'));

	 ?>
<fieldset>
	<legend>Importer le fichier:</legend>
<?php 
		echo $this->Form->file('fichier', array('style' => 'display:none'));
		echo $this->Form->label('fichier','Ouvrir l\'explorateur' , array('class'=>'button tiny'));
?>
	<ul class="button-group options">

		<li><?php echo $this->Form->button('Importer', array('class' => 'button tiny icon-ok success')); ?>
		</li>

	</ul>

</fieldset>

<?php 
	echo $this->Form->end();

 ?>