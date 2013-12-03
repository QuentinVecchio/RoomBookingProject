
<tr>
	<?php echo $this->Form->create('Room', array('style'=>'display:none;', 'name'=>'form')); ?>
	<td><?php echo $this->Form->select('department_id', $list, array('value' => $id_dept)); ?></td>

	<td><?php echo $this->Form->input('name', array('label'=>'', 'type'=>'text')) ?></td>
	<td><?php echo $this->Form->checkbox('projector').  $this->Form->label('projector',''); ?></td>
	<td><?php echo $this->Form->checkbox('has_PC'). $this->Form->label('has_PC',''); ?></td>
	<td><?php echo $this->Form->input('capacity', array('label'=>'', 'type'=>'number')) ?></td>
	<td>
			<ul class="button-group">
				<li><?php echo $this->Html->Link('', array('controller'=>'', 'action'=>''),array('class'=>'button icon-ok tiny', 'onclick'=>'form.submit(); return false;')); ?>
				</li>

				<li><?php echo $this->Html->Link('',array('controller' =>'rooms', 'action' => 'view', $id_dept),
													 array('class'=>'button icon-cancel tiny', 
														   'confirm' => 'Etes vous sûr de vouloir abandonner les modifications?')); ?>
				</li>
			</ul>
	</td>

	<?php 
		echo $this->Form->end();
	?>
</tr>	