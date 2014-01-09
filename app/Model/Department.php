<?php 
class Department extends AppModel{
	public $hasMany = array('Room' =>array('order'=>'name'),'Formation');

	public $validate = array(
			'name' => array(
				'rule' => 'isUnique',
				'message' => 'Nom déjà utilisé')
		);
}
 ?>