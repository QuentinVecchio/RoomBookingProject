<section>
	<table>
		<thead>
			<tr>
				<th>Département</th>
				<th>Salle</th>
				<th>Heure Début</th>
				<th>Heure Fin</th>
				<th>Commentaire</th>
				<th>Statut</th>
				<th><span class="icon-cog"></span></th>
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
					<td><div class="status"><?php echo $value["Status"]["name"]; ?></div><div class="formStatus" style="display : none;">
						<?php echo $this->Form->select('Loan.status_id', $list, array('value' => $value["Loan"]["status_id"]));  ?>
					</div></td>
					<td><?php echo $this->Html->Link('', array('controller'=>'loans', 'action' => 'answerRoom'),array('class'=>'button tiny icon-pencil btnModif', 'onClick' => 'return modifSalle(this);')); ?>
						<ul class="button-group options" style="display : none">
							<li><a><?php echo $this->Html->Link('', array('controller'=>'loans', 'action' => 'answerRoom',$value['Loan']['id']), array('class' => 'button tiny icon-ok success','onClick' => 'return valideModifSalle(this);')); ?></a></li>
							<li><?php echo $this->Html->Link('', array('controller'=>'loans', 'action' => 'answerRoom'),  array('class' => 'button tiny icon-cancel-circled alert','onClick' => 'return annuleModifSalle(this);')); ?></li>
						</ul>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</section>
