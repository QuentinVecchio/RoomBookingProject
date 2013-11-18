 <h1>Gestion des utilisateurs:</h1>
<?php 
	echo $this->Element('side_bar_gestion_utilisateur');
 ?>

<section id="gestion">
	<table class="grille-gestion">
	<thead>
		<tr>
			<th>Login</th>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Département</th>
			<th>Fonction</th>
			<th><span class="icon-cog"></span></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($listUtil as $i => $util):	?>
			<tr>
				<td><?php echo $util['User']["username"]; ?></td>
				<td><?php echo $util['User']["firstname"]; ?></td>
				<td><?php echo $util['User']["lastname"]; ?></td>
				<td><?php echo $util['Department']["name"]; ?></td>
				<td><?php echo $util['Role']["name"]; ?></td>
				<td>
					<ul class="button-group">
						<li><a><?php echo $this->Html->Link('', array('controller'=>'users', 'action' => 'edit',$util['User']['id']), array('class' => 'button tiny icon-pencil grille-edit')); ?></a></li>
						<li><a><?php echo $this->Html->Link('', array('controller'=>'users', 'action' => 'delete',$util['User']['id']), array('class' => 'button tiny icon-trash', 'confirm' => 'Etes-vous sûr de vouloir supprimer cet utilisateur ?')); ?></a></li>
					</ul>					
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</section>
 <?php 
$this->start('css');
	echo $this->Html->css('table');
$this->end();

$this->start('script');
	echo $this->Html->script('gestion_salle');
$this->end();
 ?>