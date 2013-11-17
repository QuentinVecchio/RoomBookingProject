<tr>
		<?php echo $this->Form->create('Room', array('style'=>'display:none;', 'name'=>'form')); ?>
	<td>
		<?php echo $user['User']["username"]; ?></td>
	<td><?php echo $user['User']["firstname"]; ?></td>
	<td><?php echo $user['User']["lastname"]; ?></td>
	<td><?php echo $this->Form->select('department_id', $list, array('value' => $user['User']['department_id'])); ?></td>
	<td><?php echo $this->Form->select('role_id', $listRole, array('value' => $user['User']['role_id'])); ?></td>
	<td>
		<ul class="button-group">
			<li><?php echo $this->Html->Link('', array('controller'=>'', 'action'=>'', $user['User']['id']),array('class'=>'button icon-ok tiny', 'onclick'=>'form.submit(); return false;')); ?>
			</li>

			<li><?php echo $this->Html->Link('',array('controller' =>'users', 'action' => 'view'),
												 array('class'=>'button icon-cancel tiny', 
													   'confirm' => 'Etes vous sûr de vouloir abandonner les modifications?')); ?>
			</li>
		</ul>							
	</td>

	<?php 
		echo $this->Form->end();
	?>	
</tr>