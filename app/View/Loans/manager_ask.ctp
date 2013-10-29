
<section>
	<?php 
		echo $this->Form->create('Room', array('type'=>'get', 'url' =>array('controller' => 'loans', 'action' => 'ask')));
			echo $this->Form->checkbox('projector', array('hiddenField' => false)).  $this->Form->label('projector','Projecteur');
			echo $this->Form->checkbox('has_PC', array('hiddenField' => false)).  $this->Form->label('has_PC','PC');
			echo $this->Form->select('department_id', $listDepartment, array('hiddenField' => false)); 
		echo $this->Form->end('Rechercher');
	 ?>
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
			foreach ($res as $k => $v) {
				echo $this->Room->getViewManager($v['Room'], $v['Department']['name']);
			}
		 ?>


	</tbody>
</table>
<?php echo $this->Paginator->numbers(array('first' => 'Première page')); ?>
</section>