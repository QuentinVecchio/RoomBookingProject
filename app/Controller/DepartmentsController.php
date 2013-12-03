<?php 
class DepartmentsController  extends AppController{
	
	public $helper = array('Room');

	/**
	*	Affiche un menu listant les départements
	*/
	public function admin_index(){
		$this->set('title_for_layout', 'Gestion des départements:');

		$departments = $this->Department->find('all',array(
			'recursive' => -1));

		foreach ($departments as $k => $v) {
			$departments[$k]['Department']['link_edit'] = array('controller' => 'departments',
										   'action' => 'edit', $v['Department']['id']);
		}


		$this->set(compact($departments));
	}

	/**
	*	Permet la mise à jour du nom d'un département
	*/
	public function admin_edit($index = null){

		if(!isset($index) || !is_numeric($index)){
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}

		if(!empty($this->request->data)){
			$this->Department->id = $index;
			$this->Department->save($this->request->data);
			$this->Session->setFlash('Mise à jour du département <strong>'.$this->request->data['Department']['name'].'</strong>', 'flash_message', array('type'=>'success'));
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}

		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Modification:');
		}

		$this->Department->recursive = -1;
		$department = $this->Department->findById($index);
		$this->request->data = $department;

		$this->set('id', $index);

	}

	/**
	*	Permet d'ajouter un département dans la BdD
	*/
	public function admin_add(){
		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Ajout d\' département:');
		}
		
		if(!empty($this->request->data)){
			$this->Department->create();
			$this->Department->save($this->request->data);
			$this->Session->setFlash('Département <strong>'.$this->request->data['Department']['name'].'</strong> ajouté avec succès !', 'flash_message', array('type'=>'success'));

			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}
	}

	/**
	*	Permet la suppression d'un département
	*/
	public function admin_delete($index = null){
		if(!isset($index) || !is_numeric($index)){
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}

		$this->Department->delete($index);
		$this->Session->setFlash('Département supprimé de la liste', 'flash_message', array('type'=>'secondary'));
			
		$this->redirect(array('controller' => 'departments', 'action' => 'index'));

	}

	/**
	*	Permet à un manager de voir les salles de son département
	*/
	public function manager_index(){
		$this->set('title_for_layout', 'Les salles');

		$rooms = $this->Department->find('all',array(
			'conditions' => array('id' => $this->Auth->user('department_id')),
			'limit' => 10
			));

		$this->set('rooms', $rooms);		
	}

	/**
	*	Permet de gérer les salles d'un département précis.
	*/
	public function admin_view($index = null){			
		if(!isset($index) || empty($index) || !is_numeric($index)){
			$this->redirect(array('controller' =>'departments', 'action' =>'index','admin' => true));
		}
		$departments = $this->Department->find('list', array(
		'order' =>'Department.name',
		'recursive' => '-1'));

		$rooms = $this->Department->find('all', array(
		'conditions' => array('id' => $index)));
		$this->set('departments', $departments);
		$this->set('rooms', $rooms);

		$this->set('side_department',$this->Department->find('all', array(
				'order' =>'Department.name',
				'recursive' => '-1')));

	}
}
?>