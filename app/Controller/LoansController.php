<?php 
class LoansController extends AppController{

	public $components = array('Paginator');

	public $paginate = array(
	    'limit' => 10
	);

	public function manager_answer() {
		$this->set('title_for_layout', 'Les demandes');
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
		$this->set('title_for_layout', 'Demander une salle');
		$this->layout = 'manager';
		$this->Paginator->settings = $this->paginate;

		// Retransmettre les variables dans le formulaire
		$this->request->data['Room']= $this->request->query;

		// Conversion de min_capacity et max_capacity vers equivalent pour postConditions
		$cond = $this->request->data;
		if(isset($cond['Room']['min_capacity']) && !empty($cond['Room']['min_capacity'])){
			$cond['Room']['capacity >='] =$cond['Room']['min_capacity']; 
		}
			unset($cond['Room']['min_capacity']);


		if(isset($cond['Room']['max_capacity']) && !empty($cond['Room']['max_capacity'])){
			$cond['Room']['capacity <='] = $cond['Room']['max_capacity'];
		}
			unset($cond['Room']['max_capacity']);

		$conditions = $this->postConditions($cond);

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