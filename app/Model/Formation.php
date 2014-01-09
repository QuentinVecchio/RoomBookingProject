<?php 
class Formation extends AppModel{
	public $actsAs = array('Containable');
	public $belongsTo = array('Department', 'User');

	public $hasMany = array('Teach');

	public $validate= array(
			'name' => array(
				'rule' => array('isUniqueBy','department_id'),
				'message' => 'Nom déjà utilisé')
		);
}
 ?>