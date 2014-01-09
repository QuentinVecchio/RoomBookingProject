<table>
	<thead>
		<tr>
			<th>Salle</th>
			<th>Heure Début</th>
			<th>Heure Fin</th>
			<th>Statut</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($dispo as $i => $demande) 
		{
		?>
			<tr>
				<td><?php echo $demande["Room"]["name"]; ?></td>
				<td><?php echo $demande["Loan"]["start_time"]; ?></td>
				<td><?php echo $demande["Loan"]["end_time"]; ?></td>
				<td><div class="status"><?php echo $demande["Status"]["name"]; ?></div></td>						
			</tr>
		<?php
		}
		?>
	</tbody>
</table>