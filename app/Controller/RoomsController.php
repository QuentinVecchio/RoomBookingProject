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
		'order' =>'department.name',
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
	}
}

 ?>