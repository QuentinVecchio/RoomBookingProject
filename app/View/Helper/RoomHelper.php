<?php 
class RoomHelper extends AppHelper{

	public $helpers = array('Form', 'Html');


    public function __construct(View $view, $settings = array()) {
    	parent::__construct($view, $settings);
   }

   public function getViewManager($value = array(), $department){
   		ob_start(); ?>
		<tr>
			<td><?php echo $department; ?></td>
			<td><?php echo $value['name']; ?></td>
			<td><input type="checkbox" id="projecteur-1" <?php echo ($value['projector']==1)?'checked':''; ?> disabled></input><label for="projecteur-1"></label></td>
			<td><input type="checkbox" id="pc-1" <?php echo ($value['has_PC']==1)?'checked':''; ?> disabled></input><label for="pc-1"></label></td>
			<td><?php echo $value['capacity']; ?></td>
		</tr>	

		<?php 
		return ob_get_clean();
   }

   public function getViewManagerAsk($value = array(), $department){
   		ob_start(); ?>
		<tr>
			<td><?php echo $department; ?></td>
			<td><?php echo $value['name']; ?></td>
			<td><input type="checkbox" id="projecteur-1" <?php echo ($value['projector']==1)?'checked':''; ?> disabled></input><label for="projecteur-1"></label></td>
			<td><input type="checkbox" id="pc-1" <?php echo ($value['has_PC']==1)?'checked':''; ?> disabled></input><label for="pc-1"></label></td>
			<td><?php echo $value['capacity']; ?></td>
			<td><?php echo $this->Html->Link('Réserver', array('controller'=>'loans', 'action' => 'askRoom', $value['id']),array('class'=>'button tiny')); ?></td>
		</tr>	

		<?php 
		return ob_get_clean();
   }




   	public function getView($value = array(), $department = array()){


   		ob_start(); ?>
		<tr roomId="<?php echo $value['id'] ?>">
			<td><?php echo $department['name']; ?></td>
			<td><?php echo $value['name']; ?></td>
			<td><input type="checkbox" id="projecteur-1" <?php echo ($value['projector']==1)?'checked':''; ?> disabled></input><label for="projecteur-1"></label></td>
			<td><input type="checkbox" id="pc-1" <?php echo ($value['has_PC']==1)?'checked':''; ?> disabled></input><label for="pc-1"></label></td>
			<td><?php echo $value['capacity']; ?></td>
			<td>
				<?php 
					echo $this->Form->button('', array('class'=>'icon-pencil tiny grille-edit'));
					echo $this->Form->button('', array('class'=>'icon-trash tiny'));
				 ?>
			</td>
		</tr>	

		<?php 
		return ob_get_clean();
   	}

   	public function getEdit($value = array(), $department_id){
   		$list = $this->getListOptions($value);

   		ob_start(); ?>
		<tr>
			<?php echo $this->Form->create('Room', array('controller' => 'rooms', 'action' => 'add', 'style'=>'display:none;'));  ?>
			<td><?php   
						echo $this->Form->select('department_id', $list, array('value' => $department_id)); ?></td>
			<td><?php echo $this->Form->input('name', array('label'=>'', 'type'=>'text')) ?></td>
			<td><?php echo $this->Form->checkbox('projector').  $this->Form->label('projector',''); ?></td>
			<td><?php echo $this->Form->checkbox('has_PC'). $this->Form->label('has_PC',''); ?></td>
			<td><?php echo $this->Form->input('capacity', array('label'=>'', 'type'=>'number')) ?></td>
			<td>
				<?php 
					echo $this->Form->button('', array('class'=>'icon-ok tiny', 'type'=>'submit'));
					echo $this->Form->button('', array('class'=>'icon-cancel tiny ', 'type'=>'reset'));

					echo $this->Form->end();
				?>
			</td>
		</tr>	

		<?php 
		return ob_get_clean();
   	}


   	private function getListOptions($valeur){
   		$res = array();
   		foreach ($valeur as $k => $v) {
   			$v = current($v);
   			$res[$v['id']] = $v['name'];
   		}

   		return $res;
   	}

}
 ?>