<?php 
class Room extends AppModel{

	public $belongsTo = array('Department');

	public $validate = array(
			'name' => array(
				'rule' =>'isUnique',
				'message' => 'Nom de salle déjà pris !',
				'required' => true,
				'allowEmpty' => false
				),
			'capacity' => array(
				array(
					'rule' => 'notEmpty',
					'required' => true,
					'message' => 'Qté requise !'
					),
				array(
					'rule' => array('naturalNumber'),
					'message' => 'Nombre positif !',
					'required' => true
					)
				)
		);

}
 ?>