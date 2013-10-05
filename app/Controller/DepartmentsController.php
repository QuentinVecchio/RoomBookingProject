<?php 
class DepartmentsController  extends AppController{
	
	public $helper = array('Room');

	public function admin_index(){

	}

	public function admin_management(){

	}


	public function admin_view($index = null){	
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

	public function index(){

	}

	public function getDepartments(){
		$departments = $this->Department->find('all', array(
				'order' =>'department.name',
				'recursive' => '-1'));
		return $departments;
	}
}
?>