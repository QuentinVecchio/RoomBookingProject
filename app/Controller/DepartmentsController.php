<?php 
class DepartmentsController  extends AppController{
	
	public $helper = array('Room');

	/**
	*	fonction à adapter et à mettre dans AppController par la suite (gestion d'accès selon prefix)
	*/
	public function isAuthorized($user = null){
		parent::isAuthorized();
		$res = true;
		if(isset($this->request->params['prefix'])){
			if($this->request->params['prefix'] == 'admin'){
		  		$res = $user['Role']['name'] == 'administrators';
			}else if($this->request->params['prefix'] == 'manager'){
				$res = $user['Role']['name'] == 'managers' ||
					   $user['Role']['name'] == 'administrators';
			}else{
				$res = false;
			}
		}

		return $res;
	}

	/**
	*	Affiche un menu listant les départents
	*/
	public function admin_index(){
		$this->layout = 'admin';
		$this->set('title_for_layout', 'Gestion des salles:');

		$departments = $this->Department->find('all',array(
			'recursive' => -1));

		foreach ($departments as $k => $v) {
			$departments[$k]['Department']['link_edit'] = array('controller' => 'departments',
										   'action' => 'edit', $v['Department']['id']);
		}


		$this->set(compact($departments));
	}

	public function admin_edit($index = null){

		if(!isset($index) || !is_numeric($index)){
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}

		if(!empty($this->request->data)){
			$this->Department->id = $index;
			$this->Department->save($this->request->data);
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}


		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->layout = 'admin';
			$this->set('title_for_layout', 'Modification:');
		}

		$this->Department->recursive = -1;
		$department = $this->Department->findById($index);
		$this->request->data = $department;

		$this->set('id', $index);

	}

	public function admin_add(){
		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->layout = 'admin';
			$this->set('title_for_layout', 'Ajout d\' département:');
		}
		
		if(!empty($this->request->data)){
			$this->Department->create();
			$this->Department->save($this->request->data);
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}
	}

	public function admin_delete($index = null){
		if(!isset($index) || !is_numeric($index)){
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}

		$this->Department->delete($index);

		$this->redirect(array('controller' => 'departments', 'action' => 'index'));

	}

	/**
	*	Permet à un manager de voir les salles de son département
	*/
	public function manager_index(){
		$this->layout = 'manager';
		$rooms = $this->Department->find('all',array(
			'conditions' => array('id' => $this->Auth->user('department_id')),
			'limit' => 10
			));

		$this->set('rooms', $rooms);		
	}


	public function admin_management(){
		$this->layout = 'admin';
	}


	/**
	*	Permet de gérer les salles d'un département précis.
	*/
	public function admin_view($index = null){	
			$this->layout = 'admin';		
		if(!isset($index) || empty($index) || !is_numeric($index)){
			$this->redirect(array('controller' =>'departments', 'action' =>'index','admin' => true));
		}
		$departments = $this->Department->find('all', array(
		'order' =>'department.name',
		'recursive' => '-1'));

		$rooms = $this->Department->find('all', array(
		'conditions' => array('id' => $index)));
		$this->set('departments', $departments);
		$this->set('rooms', $rooms);
	}

	/**
	*	Fonction appelé par la vue pour générer la liste des départements.
	*
	*/
	public function getDepartments(){
		$departments = $this->Department->find('all', array(
				'order' =>'department.name',
				'recursive' => '-1'));
		return $departments;
	}
}
?>