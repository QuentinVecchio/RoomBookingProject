 <?php if(!empty($demande)): ?>
 <section>
 	<h3>Vos demandes</h3> 	
	<table>
		<thead>
			<tr>
				<td>Département</td>
				<td>Salle</td>
				<td>Heure Début</td>
				<td>Heure Fin</td>
				<td>Commentaire</td>
				<td>Statut</td>
				<th class="colonne-options"><span class="icon-cog"></span></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($demande as $i => $courant) 
			{
			?>
				<tr>
					<td><?php echo $courant["Department"]["name"]; ?></td>
					<td><?php echo $courant["Room"]["name"]; ?></td>
					<td><?php echo $courant["Loan"]["start_time"]; ?></td>
					<td><?php echo $courant["Loan"]["end_time"]; ?></td>
					<td><?php echo $courant["Loan"]["remark"]; ?></td>
					<td><div class="status"><?php echo $courant["Status"]["name"]; ?></div></td>
					<td>
						<ul class="button-group">
							<li><a><?php echo $this->Html->Link('', array('controller'=>'loans', 'action' => 'delete',$courant['Loan']['id']), array('class' => 'button tiny icon-trash', 'confirm' => 'Etes-vous sûr de vouloir supprimer cet utilisateur ?')); ?></a></li>
						</ul>					
					</td>						
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</section>
<?php endif; ?>
<?php if(!empty($emprunt)): ?>
 <section>
 	<h3>Les demandes des autres départements</h3>
	<table>
		<thead>
			<tr>
				<td>Département</td>
				<td>Salle</td>
				<td>Heure Début</td>
				<td>Heure Fin</td>
				<td>Commentaire</td>
				<td>Statut</td>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($emprunt as $i => $courant) 
			{
			?>
				<tr>
					<td><?php echo $courant["Department"]["name"]; ?></td>
					<td><?php echo $courant["Room"]["name"]; ?></td>
					<td><?php echo $courant["Loan"]["start_time"]; ?></td>
					<td><?php echo $courant["Loan"]["end_time"]; ?></td>
					<td><?php echo $courant["Loan"]["remark"]; ?></td>
					<td><div class="status"><?php echo $courant["Status"]["name"]; ?></div></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</section>
<?php endif; ?>
