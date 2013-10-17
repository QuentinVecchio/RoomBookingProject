<?php 
class RoomsController extends AppController{

	public $belongsTo = array(
		'Departments' => array(
			'foreignKey' => 'id_dept',
			'fields' => array('name')
			)
		);

	public function admin_index(){
		$this->layout = 'admin';
	}

	public function admin_view($index = null){	
		$this->layout = 'admin';		
		if(!isset($index) || empty($index) || !is_numeric($index)){
			$this->redirect(array('controller' =>'departments', 'action' =>'index','admin' => true));
		}
		$departments = $this->Room->Department->find('all', array(
		'order' =>'Department.name',
		'recursive' => '-1'));

		$rooms = $this->Room->find('all', array(
		'conditions' => array('department_id' => $index)));

		$name_department = $this->Room->Department->find('first',array(
			'fields' => array('name'),
			'conditions' => array('id' => $index)
			));
		$name_department = $name_department['Department']['name'];

		$this->set('departments', $departments);
		$this->set('rooms', $rooms);
		$this->set('name_department', $name_department);
		$this->set('id', $index);
	}

	public function admin_edit($index = null){
		if($this->request->is('Ajax')){
			echo 'oui';
			$this->set('index', $index);
			$room = $this->Room->findById($index);
			$this->request->data = $room;
			$this->layout = null;
			$list = $this->Room->Department->find('list', array('recursive' => -1));
			$this->set('list', $list);		
		}else{
			if(isset($this->request->data)){
				$this->Room->id = $index;
				$this->Room->save($this->request->data);
				$this->redirect(array('controller' =>'rooms', 'action' => 'view', $this->request->data['Room']['department_id'], 'admin' => true));
			}
		}




	}


	public function admin_add(){
		if(!empty($this->request->data)){
			debug($this->request->data);
			die();
		}

		if($this->request->is('Ajax')){
			$this->layout = null;
		}else{
			$this->layout = 'admin';
			$this->set('title_for_layout', 'Modification:');
		}

		$list = $this->Room->Department->find('list', array('recursive' => -1));
		$this->set('list', $list);
	}
}

 ?>