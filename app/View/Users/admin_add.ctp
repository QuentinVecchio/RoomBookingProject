 <h1>Importer des utilisateurs:</h1>
<?php 	echo $this->Element('side_bar_gestion_utilisateur'); ?>
 <section id="gestion">
	<?php if(!isset($list)): ?>
	<?php 
	 echo $this->Form->create('User', array('type' => 'file'));

	 ?>
	<fieldset>
		<legend>Importer le fichier:</legend>
		<p>Ci-dessous l'ordre des colonnes ainsi que les recommandations</p>
		<ol class="liste-p">
			<li>Colonne 1: le nom</li>
			<li>Colonne 2: le prénom</li>
			<li>Colonne 3: l'email</li>
			<li>Colonne 4: le département</li>
		</ol>
		<p>Attention: le champs département doit être identique au nom du département dans la BdD.</p>
		<p>Attention: l'extension du fichier doit être xls.</p>
		<p>Attention: Il ne doit pas y avoir d'espace avant et après les noms et prénoms.</p>
		<p>Les utilisateurs seront ajouté en tant qu'utilisateur simple.</p>
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
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>


		<?php ob_start(); ?>
		<style>
			.grille-gestion{
				font-size: 20px;
				width: 100%;
				border-collapse: collapse;
			}

			.grille-gestion thead th,
			.grille-gestion tbody tr td{
				border: 1px solid black;
				padding: 10px;

			}
		</style>
		<table class="grille-gestion">
			<thead>
				<tr>
					<th>Login</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Email</th>
					<th>Mot de Passe</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($list as $i => $l):	?>
					<tr>
						<td><?php echo $l["username"]; ?></td>
						<td><?php echo $l["firstname"]; ?></td>
						<td><?php echo $l["lastname"]; ?></td>
						<td><?php echo $l["email"]; ?></td>
						<td><?php echo $l["password"]; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php $content = ob_get_clean(); ?>



 	<?php  
		App::import("Vendor", "html2pdf/html2pdf");
	    $pdf = new HTML2PDF('P','A4','fr');
	    $pdf->pdf->SetDisplayMode('fullpage');
	    $pdf->writeHTML($content);
		$pdf->Output(WWW_ROOT.'files'.DS.'listeUtilisateur.pdf', 'F');

 	?>
		<a href="/CakePHP/projet-web/app/webroot/files/listeUtilisateur.pdf" target="_blank" class="button">Télécharger</a>

	 <?php endif; ?>
 	
 </section>

 <?php 
$this->start('css');
	echo $this->Html->css('table');
$this->end();
 ?>