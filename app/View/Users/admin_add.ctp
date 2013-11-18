 <h1>Importer des utilisateurs:</h1>
<?php 	echo $this->Element('side_bar_gestion_utilisateur'); ?>
 <section id="gestion">
	<?php if(!isset($list)): ?>
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

	 <?php else: ?>
 
		<table class="grille-gestion">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Email</th>
					<th>Mot de Passe</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list as $i => $l):	?>
					<tr>
						<td><?php echo $l["firstname"]; ?></td>
						<td><?php echo $l["lastname"]; ?></td>
						<td><?php echo $l["email"]; ?></td>
						<td><?php echo $l["password"]; ?></td>
				<?php endforeach; ?>
			</tbody>
		</table>

	 <?php endif; ?>
 	
 </section>

 <?php 
$this->start('css');
	echo $this->Html->css('table');
$this->end();
 ?>