<?php 
class DepartmentsController  extends AppController{
	
	public $helper = array('Room');

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

	public function index(){

	}

	public function admin_index(){
		$this->layout = 'admin';
	}

	public function manager_index(){
		$this->layout = 'manager';
	}


	public function admin_management(){
		$this->layout = 'admin';
	}


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


	public function getDepartments(){
		$departments = $this->Department->find('all', array(
				'order' =>'department.name',
				'recursive' => '-1'));
		return $departments;
	}
}
?>