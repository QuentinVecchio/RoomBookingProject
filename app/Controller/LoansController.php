<?php 
class LoansController extends AppController{

	public $components = array('Paginator');

	public $paginate = array(
	    'limit' => 10
	);

	/**
	*	Calendrier des demandes d'une salle du département
	*/
	public function manager_answer() {
		$this->set('title_for_layout', 'Les demandes');

		$res = $this->Loan->find('all', array('fields'=>array('date'),'conditions' => array('Room.department_id' =>$this->Auth->User('department_id'),
																							 'Status.name NOT LIKE' => 'Oui')));
		$this->set('res', $res);

	}

	/**
	*	Les demandes d'emprunt d'une salle
	*/
	public function manager_view($date) {
		if($this->request->is('Ajax')){
			$this->layout = null;
		}
		$res = $this->Loan->find('all', array('conditions' => array('Room.department_id' =>$this->Auth->User('department_id'),
																	'Loan.date' => $date,
																	'Status.name NOT LIKE' => 'Oui')));
		$this->set('res', $res);
		$list = $this->Loan->Status->find('list');
		$this->set('list', $list);
	}

	public function manager_viewAll() {
		$this->set('title_for_layout', 'Visionner');
		$res = $this->Loan->find('all', array('fields'=>array('date'),'conditions' => array('OR' => array('Room.department_id' =>$this->Auth->User('department_id'),
																							'Loan.department_id' => $this->Auth->User('department_id')))));
		$this->set('res', $res);

	}

	/**
	*	Permet de voir nos demandes et les demandes des autres départements pour une salle
	*/
	public function manager_viewAllByDay($date) {
		if($this->request->is('Ajax')){
			$this->layout = null;
		}
		$demande = $this->Loan->find('all', array('conditions' => array('Loan.department_id' =>$this->Auth->User('department_id'),
																		'Loan.date' => $date)));

		$emprunt = $this->Loan->find('all', array('conditions' => array('Room.department_id' => $this->Auth->User('department_id'),
																		'Loan.date' => $date)));

		$this->set('demande', $demande);
		$this->set('emprunt', $emprunt);

	}



	/**
	*	Recherche d'une salle avec des fonctions de filtre
	*/
	public function manager_ask(){
		$this->set('title_for_layout', 'Demander une salle');
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

	/**
	*	Pour annuler une demande
	*/
	public function manager_delete($id = null){
		$this->Loan->delete($id);
		$this->Session->setFlash('Demande supprimée', 'flash_message', array('type'=>'secondary'));
		$this->redirect(array('controller' => 'loans', 'action' => 'viewAll','manager' => true));
	}



	/**
	*	Demander une salle sur un ensemble de plage horaire et de date
	*/
	public function manager_askRoom($id = null){
		$this->set('title_for_layout', 'Demander une salle');
		if(!empty($this->request->data)){

			$this->Loan->saveMany(current($this->request->data));
			$this->Session->setFlash('Vos demandes sont bien prises en compte', 'flash_message', array('type'=>'success'));
			$this->redirect(array('controller' => 'loans', 'action' => 'askRoom',$id, 'manager' => true));

		}

		$idEnAttente = current($this->Loan->Status->findByName('En attente'))['id'];
		$this->set('idEnAttente', $idEnAttente);

		$room = $this->Loan->Room->findById($id);
		$this->set('room', $room);
		$this->set('department_id', $this->Auth->User('department_id'));
	}

	/**
	*	Répondre à une demande d'emprunt (mise à jour du statut)
	*/
	public function manager_answerRoom($id = null) {
		$this->layout= null;
		$res =$this->Loan->id =$id;
		$this->Loan->saveField('status_id',$this->request->query['status_id']);
		$this->Session->setFlash('Mise a jour de votre réponse !', 'flash_message', array('type'=>'success'));

	}

} ?>