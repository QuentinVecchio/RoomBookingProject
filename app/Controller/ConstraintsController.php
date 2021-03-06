<?php
class ConstraintsController extends AppController {

	public function manager_index($date, $formation_id) {
		$this->set('title_for_layout', 'Gestionnaire');
		$this->set('date', $date);
		$this->set('formation_id', $formation_id);

		$this->Cookie->write('date_for_gestionnaire', $date);


		if(!empty($this->data)){
			if($this->Constraint->saveMany(current($this->request->data))){
				$this->Session->setFlash('Ajout des contraintes avec succès !', 'flash_message', array('type'=>'success'));
			}else{
				$this->Session->setFlash('Echec de l\'ajout', 'flash_message', array('type'=>'alert'));
			}
		}

		$listFormation= $this->Constraint->Formation->find('all', array('fields' => array('id', 'name'), 'recursive' => -1));

		$this->set('listFormation', $listFormation);
		$this->Constraint->User->bindModel(array('hasMany' => array('Teach')));
		$this->Constraint->User->Behaviors->attach('Containable');
		$listUser= $this->Constraint->User->find('all', array('contain' => array(
												'Teach' => array('conditions' => array('formation_id' => $formation_id)))));
		foreach ($listUser as $key => $value) {
			if(!empty($value['Teach'])){
				$listUser[$key]['User']['name'] = $value['User']['firstname'] .' '. $value['User']['lastname'];
			}else{
				unset($listUser[$key]);
			}
		}
		$this->set('listUser', $listUser);

		$this->Constraint->User->bindModel(array('hasMany' => array('Constraint')),false);
		$this->Constraint->User->unbindModel(array('belongsTo' => array('Role')), false);

		$constraints = $this->Constraint->find('all', array('fields' => array('DATE_FORMAT(start_time, \'%H:%i\') as start_time',
																			  'DATE_FORMAT(end_time, \'%H:%i\') as end_time',
																			  'Constraint.id', 'date', 'user_id','formation_id',
																			  'User.id', 'User.firstname', 'User.lastname'),
															'conditions' => array('date BETWEEN ? AND ?' => array($date, date('Y-m-d', strtotime($date . ' + 5 day'))),
																					'formation_id' => $formation_id
																					)));
		$listid = array();
		$jour = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
		for($i=0; $i < 6; $i++){
			$tmp = date('Y-m-d', strtotime($date . ' + '.$i.' day'));
			$j = date('w', strtotime($date . ' + '.$i.' day'));
			$listid[]= array('date' =>$tmp,
							 'jour' => $jour[$j],
							 'id' => $this->Constraint->find('all', array('fields' => array('user_id', 'deal'), 'group' => array('user_id'), 'conditions'=> array('date' => $tmp,'formation_id' => $formation_id))));
		}

		$this->set('listId', $listid);
		$this->set('constraints', $constraints);

	}

	public function manager_check($user_id, $date, $etat){
		$this->autoRender = false;
		if($this->Constraint->updateAll(array('deal' => $etat), array('date' => $date, 'Constraint.user_id' => $user_id))){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function manager_delete($id){
		$this->autoRender = false;
		if($this->Constraint->delete($id)){
			echo 1;
		}else{
			echo 0;
		}
	}

}
?>