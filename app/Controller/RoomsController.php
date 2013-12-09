<?php 
class RoomsController extends AppController{

	public $belongsTo = array(
		'Departments' => array(
			'foreignKey' => 'id_dept',
			'fields' => array('name')
			)
		);

	/**
	*	Liste des départments pour la gestion des salles
	*/
	public function admin_index(){
		$this->set('title_for_layout', 'Gestion des salles');

		$this->getElt();
	}

	/**
	*	Gestions des salles d'un départmement
	*/
	public function admin_view($index = null){		
		if(!isset($index) || empty($index) || !is_numeric($index)){
			$this->redirect(array('controller' =>'departments', 'action' =>'index','admin' => true));
		}
		$this->set('title_for_layout', 'Gestion:');

		$this->getNameDepartment($index);
		$this->getListDepartment();

		$this->set('rooms', $this->Room->find('all', array('conditions' => array('department_id' => $index))));
		$this->set('id', $index);
		$this->getElt();
	}

	/**
	*	Modification d'une salle particulière
	*/
	public function admin_edit($index = null){
			$this->set('title_for_layout', 'Gestion:');
			$room = $this->Room->findById($index);
			$list = $this->Room->Department->find('list', array('recursive' => -1));
			$this->set('list', $list);		
			$this->set('id_dept',$room['Room']['department_id']);
		if($this->request->is('Ajax')){
			$this->set('index', $index);
			$this->request->data = $room;
			$this->layout = null;
		}else{
			if(!empty($this->request->data)){
				$this->Room->id = $index;
				if($this->Room->save($this->request->data)){
					$this->Session->setFlash('Mise à jour des informations de la salle <strong>'.$this->request->data['Room']['name'].'</strong>', 'flash_message', array('type'=>'success'));
					$this->redirect(array('controller' =>'rooms', 'action' => 'view', $this->request->data['Room']['department_id'], 'admin' => true));
				}else{

					$this->getNameDepartment($this->request->data['Room']['department_id']);
					$this->getElt();
					$this->getListDepartment();

					$this->set('rooms', $this->Room->find('all', array('conditions' => array('department_id' => $this->request->data['Room']['department_id'],
																					'Room.id <>' => $room['Room']['id']))));
					$this->set('id', $this->request->data['Room']['department_id']);
				}
			}
		}
	}

	/**
	*	Permet d'ajouter une salle
	*/
	public function admin_add(){
		$this->set('title_for_layout', 'Ajout:');
		if(!empty($this->request->data)){
			if($this->Room->save($this->request->data)){
				$this->Session->setFlash('Ajout de la salle <strong>'.$this->request->data['Room']['name'].'</strong>', 'flash_message', array('type'=>'success'));
				$this->redirect(array('controller' =>'rooms', 'action' => 'view', $this->request->data['Room']['department_id'], 'admin' => true));
			}else{

				$this->getNameDepartment($this->request->data['Room']['department_id']);
				$this->getListDepartment();
				$this->getElt();

				$this->set('rooms', $this->Room->find('all',
										 array('conditions' => array('department_id' => $this->request->data['Room']['department_id']))));

				$this->set('id', $this->request->data['Room']['department_id']);
			}
		}

		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->set('title_for_layout', 'Modification:');
		}

		$list = $this->Room->Department->find('list', array('recursive' => -1));
		$this->set('list', $list);
	}

	/**
	*	Permet la suppression d'une salle
	*/
	public function admin_delete($index = null){
		if(!isset($index) || !is_numeric($index)){
			$this->redirect(array('controller' => 'departments', 'action' => 'index'));
		}

		if($this->Room->delete($index)){
			$this->Session->setFlash('Salle supprimée de la liste', 'flash_message', array('type'=>'secondary'));
			$this->redirect(array('controller' => 'rooms', 'action' => 'index'));
		}
	}	

	/**
	*	Requetes communes a différentes vues
	*/
	private function getElt(){
		$this->set('side_department',$this->Room->Department->find('all', array(
				'fields' => array('Department.id','Department.name'),
				'order' =>'Department.name',
				'recursive' => '-1')));
	}

	private function getNameDepartment($idDepartment){
		$this->Room->Department->recursive = -1;
		$name_department = $this->Room->Department->findById($idDepartment,array('name'));

		$name_department = $name_department['Department']['name'];
		$this->set('name_department', $name_department);

	}

	private function getListDepartment(){
		$departments = $this->Room->Department->find('list', array('order' =>'Department.name','recursive' => '-1'));
		$this->set('departments', $departments);		
	}
}

 ?>