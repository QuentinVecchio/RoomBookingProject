<h1>Consulter la liste de vos salles:</h1>
<section>
	<table class="grille-gestion">
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