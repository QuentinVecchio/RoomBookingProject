<section>
	<table>
		<thead>
			<tr>
				<td>Département</td>
				<td>Salle</td>
				<td>Heure Début</td>
				<td>Heure Fin</td>
				<td>Commentaire</td>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($res as $i => $value) 
			{
			?>
				<tr>
					<td><?php echo $value["Department"]["name"]; ?></td>
					<td><?php echo $value["Room"]["name"]; ?></td>
					<td><?php echo $value["Loan"]["start_time"]; ?></td>
					<td><?php echo $value["Loan"]["end_time"]; ?></td>
					<td><?php echo $value["Loan"]["remark"]; ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</section>
