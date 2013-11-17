<?php 
class User extends AppModel{

	public $belongsTo = array('Department', 'Role');

	public $validate = array(
		'firstname' => array(
			'rule' => 'alphaNumeric',
			 'required' => true,
			 'message' => 'Le prénom doit être renseigné'
		),
		'lastname' =>array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'Le nom de famille doit être renseigné'
			),
		'email' =>array(
				'rule' => 'email',
				'required' => true,
				'message' => 'Renseigner une adresse mail valide'
				)
		);

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
	
} ?>