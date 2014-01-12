<?php 
class FormationsController extends AppController{
	public function admin_index(){
		$listDept = $this->Formation->Department->find('all', array('recursive' => -1));
		$this->set('listDept', $listDept);
	}

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

	public function admin_add($id, $name, $responsable){
		$this->autoRender = false;
		$tmp = array('Formation' => array('name' => $name, 'department_id' => $id, 'user_id' => $responsable));
		$value = array();
		$errors = array();
		if($this->Formation->save($tmp)){
			$this->Formation->unbindModel(array('belongsTo' => array('Department'), 'hasMany' => array('Teach')));
			$value = current($this->Formation->find('all', array('conditions' => array('Formation.id' => $this->Formation->id))));
		}else{
			$errors[] = array('type' => 'Erreur lors de l\'ajout en base de donnée',
							  'message' => 'Le nom de formation est déjà utilisé pour ce département');
		}

		$res = array('value' => $value, 'errors' => $errors);
		echo json_encode($res);

	}

	public function admin_update($id, $name, $department_id, $user_id){
		$this->autoRender = false;
		$this->Formation->id = $id;
		$tmp = array('Formation' => array('name' => $name, 'department_id' => $department_id, 'user_id' => $user_id));

		$value = array();
		$errors = array();		
		if($this->Formation->save($tmp)){
			$this->Formation->unbindModel(array('belongsTo' => array('Department'), 'hasMany' => array('Teach')));
			$value = current($this->Formation->find('all', array('conditions' => array('Formation.id' => $this->Formation->id))));
		}else{
			$errors[] = array('type' => 'Erreur lors de l\'ajout en base de donnée',
							  'message' => 'Le nom de formation est déjà utilisé pour ce département');
		}
		$res = array('value' => $value, 'errors' => $errors);
		echo json_encode($res);		
	}


}
 ?>