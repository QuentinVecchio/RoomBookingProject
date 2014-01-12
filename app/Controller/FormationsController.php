<?php 
class FormationsController extends AppController{

	/**
	*	Affiche l'ensemble des départements enregistré dans la BdD
	*/
	public function admin_index(){
		$listDept = $this->Formation->Department->find('all', array('recursive' => -1));
		$this->set('listDept', $listDept);
	}

	/**
	*	Visualisation de l'interface de gestion des filières pour une formation donnée
	*/
	public function admin_edit($id){
		$listDept = $this->Formation->Department->find('all', array('recursive' => -1));
		$this->set('listDept', $listDept);

		$this->Formation->unbindModel(array('belongsTo' => array('Department'), 'hasMany' => array('Teach')));
		$listFormations = $this->Formation->find('all', array('conditions' => array('Formation.department_id' => $id)));

		$this->set('listFormations', $listFormations);
		$this->set('department_id', $id);
		$this->set('listManager', $this->Formation->User->find('all', array('recursive' => -1, 'conditions' => array('role_id >'=> 1))));
	}

	public function admin_delete($id){
		$this->autoRender = false;
		$errors = array();
		if(!$this->Formation->delete($id)){
			$errors[] = array('type' => 'Supression',
							  'message' => 'Une erreur est survenu lors de la suppression');
		}

		$res = array('errors' => $errors);
		echo json_encode($res);
	}

	public function admin_add(){
		$this->autoRender = false;

		$value = array();
		$errors = array();
		if(!empty($this->data)){
			if($this->Formation->save($this->data)){
				$this->Formation->unbindModel(array('belongsTo' => array('Department'), 'hasMany' => array('Teach')));
				$value = current($this->Formation->find('all', array('conditions' => array('Formation.id' => $this->Formation->id))));
			}else{
				$errors[] = array('type' => 'Erreur lors de l\'ajout en base de donnée',
								  'message' => 'Le nom de formation est déjà utilisé pour ce département');
			}
		}else{
			$errors[] = array('type' => 'Formulaire vide',
							  'message' => 'Pas de valeur');
		}

		$res = array('value' => $value, 'errors' => $errors);
		echo json_encode($res);

	}

	public function admin_update(){
		$this->autoRender = false;
		$value = array();
		$errors = array();	

		if(!empty($this->data)){
			if($this->Formation->save($this->data)){
				$this->Formation->unbindModel(array('belongsTo' => array('Department'), 'hasMany' => array('Teach')));
				$value = current($this->Formation->find('all', array('conditions' => array('Formation.id' => $this->Formation->id))));
			}else{
				$errors[] = array('type' => 'Erreur lors de l\'ajout en base de donnée',
								  'message' => 'Le nom de formation est déjà utilisé pour ce département');
			}
			$res = array('value' => $value, 'errors' => $errors);
		}else{
			$errors[] = array('type' => 'Formulaire vide',
							  'message' => 'Pas de valeur');
		}

		echo json_encode($res);		
	}


}
 ?>