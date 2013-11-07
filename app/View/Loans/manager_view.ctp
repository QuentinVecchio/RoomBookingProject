<section>
	<table>
		<thead>
			<tr>
				<td>Dpt</td>
				<td>Salle</td>
				<td>Heure Début</td>
				<td>Heure Fin</td>
				<td>Commentaire</td>
				<td>Statut</td>
				<td><span class="icon-cog"></span></td>
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
					<td><?php echo $this->Html->Link('', array('controller'=>'loans', 'action' => 'answerRoom','?' =>array('idRoom' => $value["Room"]["id"], 'idDepartement' =>$value["Department"]["id"], 'date' =>$value["Loan"]["date"], 'startTime'=>$value["Loan"]["start_time"])),array('class'=>'button tiny icon-pencil btnModif', 'onClick' => 'return modifSalle(this);')); ?>
						<ul class="button-group options" style="display : none">
							<li><?php echo $this->Html->Link('', array('controller'=>'loans', 'action' => 'answerRoom'), array('class' => 'button tiny icon-ok success'), array('onClick' => 'return valideModifSalle(this);')); ?></li>
							<li><?php echo $this->Html->Link('', array('controller'=>'loans', 'action' => 'answerRoom'),  array('class' => 'button tiny icon-cancel-circled alert'), array('onClick' => 'return annuleModifSalle(this);')); ?></li>
						</ul>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</section>
