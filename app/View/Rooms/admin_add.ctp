<?php $this->extend('admin_view'); ?>
<tr>
	<?php echo $this->Form->create('Room',array('style' => 'display:none;')); ?>
	<td><?php echo $this->Form->select('department_id', $list, array('empty' => false)); ?></td>
	<td><?php echo $this->Form->input('name', array('label'=>'', 'type'=>'text')) ?></td>
	<td><?php echo $this->Form->checkbox('projector').  $this->Form->label('projector',''); ?></td>
	<td><?php echo $this->Form->checkbox('has_PC'). $this->Form->label('has_PC',''); ?></td>
	<td><?php echo $this->Form->input('capacity', array('label'=>'', 'type'=>'number')) ?></td>
	<td>
		<?php 
			echo $this->Form->button('', array('class'=>'icon-ok tiny'));
			echo $this->Form->button('', array('class'=>'icon-cancel tiny'));

			echo $this->Form->end();
		?>
	</td>
</tr>	