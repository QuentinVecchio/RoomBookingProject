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
			),
		'passwordOld' => array(
				'rule' => 'checkCurrentPassWord',
				'message' => 'Mot de passe incorrecte'
			),
		'password2' => array(
				'rule' => 'checkEqualPassWord',
				'message' => 'Les deux mots de passe sont différents'
			)		
		);
	
	public function checkEqualPassWord($check) {
        return $this->data['User']['password'] == $this->data['User']['password2'];
    }


	public function checkCurrentPassWord($check) {
		$this->id = AuthComponent::user('id');
  		$password = $this->field('password');
        return AuthComponent::password(current($check)) == $password;
    }


	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}

	public function afterValidate(){
		unset($this->data[$this->alias]['passwordOld']);
		unset($this->data[$this->alias]['password2']);
	}

} ?>