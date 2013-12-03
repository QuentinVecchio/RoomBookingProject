<?php 
	echo $this->Element('side_bar_department',
						array($side_department));
 ?>
<section>
	<table class="grille-gestion">
	<thead>
		<tr>
			<th>Département</th>
			<th>Salle</th>			
			<th>Projecteur</th>
			<th>PC</th>
			<th>Capacité</th>
			<th><span class="icon-cog"></span></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($rooms[0]['Room'] as $k => $v) {
				echo $this->Room->getView($v, $rooms[0]['Department']);
			}

			echo $this->Room->getEdit($departments);
		 ?>


	</tbody>
</table>
</section>