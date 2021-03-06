<section class="centre">
<h1>Rechercher une salle:</h1>
		<?php 
			echo $this->Form->create('Room', array('type'=>'get', 'url' =>array('controller' => 'loans', 'action' => 'ask')));
			?>
	<fieldset>
		<legend>Filtre</legend>
			<div class="row">
				<div class="columns large-6">
					<?php  echo $this->Form->checkbox('projector', array('hiddenField' => false)).  $this->Form->label('projector','Projecteur');?>
				</div>
				<div class="columns large-6">
					<?php  echo $this->Form->checkbox('has_PC', array('hiddenField' => false)).  $this->Form->label('has_PC','PC');?>
				</div>
			</div>
			<div class="row">
				<div class="columns large-6">
					<?php  echo $this->Form->label('department_id', 'Departement');?>
				</div>
				<div class="columns large-6">
					<?php  echo $this->Form->select('department_id', $listDepartment, array('hiddenField' => false)); ?>
				</div>
			</div>					
			<div class="row">
					<?php  
						echo $this->Form->input('min_capacity', array('label' => 'Minimum', 'type'=> 'number',
																		 'min' => 0, 'max' =>200, 'step' => 5 ,
																		 'div' =>array('class' =>'columns large-6')));

						echo $this->Form->input('max_capacity', array('label' => 'Maximum', 'type'=> 'number',
																		 'min' => 0, 'max' =>200, 'step' => 5 ,
																		 'div' =>array('class' =>'columns large-6')));
					?>
			</div>	
			<ul class="button-group">
				<li>
					<?php echo $this->Form->Button('Rechercher', array('class'=> 'tiny')); ?>
				</li>
			</ul>
	</fieldset>
	<?php echo $this->Form->end(); ?>


	<table class="grille-gestion large">
	<thead>
		<tr>
			<th>Département</th>
			<th>Salle</th>			
			<th>Projecteur</th>
			<th>PC</th>
			<th>Capacité</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($res as $k => $v) {
				echo $this->Room->getViewManagerAsk($v['Room'], $v['Department']['name']);
			}
		 ?>


	</tbody>
</table>
<div class="pagination">
	<?php echo $this->Paginator->numbers(); ?>
</div>
</section>

<?php 
$this->start('css');
	echo $this->Html->css('table');
	echo $this->Html->css('manager_ask');
$this->end();
 ?>