<?php 
class Formation extends AppModel{
	public $belongsTo = array('Department');

	public $validate= array(
			'name' => array(
				'rule' => array('isUniqueBy','department_id'),
				'message' => 'Nom déjà utilisé')
		);
}
 ?>