<?php 
class LoansController extends AppController{

	public $components = array('Paginator');

	public $paginate = array(
	    'limit' => 10
	);

	public function manager_answer() {
		$this->layout = 'manager';

		$res = $this->Loan->find('all', array('fields'=>array('date'),'conditions' => array('Room.department_id' =>$this->Auth->User('department_id'))));
		$this->set('res', $res);

	}

	public function manager_view($date) {
		if($this->request->is('Ajax')){
			$this->layout = null;
		}
		$res = $this->Loan->find('all', array('conditions' => array('Room.department_id' =>$this->Auth->User('department_id'),'Loan.date' => $date)));
		$this->set('res', $res);
	}


	public function manager_ask(){
		$this->layout = 'manager';
		$this->Paginator->settings = $this->paginate;

		// Retransmettre les variables dans le formulaire
		$this->request->data['Room']= $this->request->query;

		$conditions = $this->postConditions($this->request->data);

		// Enleve le département de l'utilisateur des choix
		if(empty($conditions) || !isset($conditions['Room.department_id'])
							  || empty($conditions['Room.department_id'])){
			unset($conditions['Room.department_id']);
			$conditions['Room.department_id <>'] = $this->Auth->User('department_id');
		}

		$res = $this->Paginator->paginate('Room', $conditions);
		$this->set('res', $res);
		
		// Pour le menu déroulant du formulaire
		$listDepartment = $this->Loan->Department->find('list', array('conditions' => array('id <>' => $this->Auth->User('department_id'))));
		$this->set('listDepartment', $listDepartment);

	}


} ?>