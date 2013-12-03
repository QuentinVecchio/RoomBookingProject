<section class="centre">
<h1>Consulter la liste de vos salles:</h1>
	<table class="grille-gestion large">
	<thead>
		<tr>
			<th>Département</th>
			<th>Salle</th>			
			<th>Projecteur</th>
			<th>PC</th>
			<th>Capacité</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($rooms[0]['Room'] as $k => $v) {
				echo $this->Room->getViewManager($v, $rooms[0]['Department']['name']);
			}
		 ?>


	</tbody>
</table>
</section>

<?php 
$this->start('css');
	echo $this->Html->css('table');
$this->end();
 ?>