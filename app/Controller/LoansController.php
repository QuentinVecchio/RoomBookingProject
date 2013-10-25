<?php 
class LoansController extends AppController{


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


} ?>