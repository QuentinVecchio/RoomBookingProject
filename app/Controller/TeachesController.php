<?php 
class TeachesController  extends AppController{

	public function index(){
 		/*$this->Teach->unbindModel(
        		array('belongsTo' => array('User'))
    		);
		$this->set('tmp', $this->Teach->find('all', array('conditions' => array('user_id' => $this->Auth->User('id')))));


 		$this->Teach->Formation->Department->unbindModel(
        		array('hasMany' => array('Room'))
    		);
		$this->set('listFormation', $this->Teach->Formation->Department->find('all'));*/
 		$this->Teach->Formation->Department->unbindModel(
        		array('hasMany' => array('Room'))
    		);
		$this->set('formation', $this->Teach->Formation->find('all',array('recursive' => 2,
				 'contain' => array('Teach' => array('conditions' => array('Teach.user_id' => $this->Auth->User('id')))) )));

		$this->set('listDpt', $this->Teach->Formation->Department->find('all',array('recursive' => -1)));
		//die();
	}

	public function add($idFormation){
		$this->autoRender = false;
		if(!$this->Teach->find('count', array('conditions' => array('formation_id' => $idFormation, 'Teach.user_id' => $this->Auth->User('id'))))){
			if($this->Teach->save(array('formation_id' => $idFormation, 'user_id' => $this->Auth->User('id')))){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	}

	public function delete($idFormation){
		$this->autoRender = false;
		if($this->Teach->deleteAll(array('formation_id' => $idFormation, 'Teach.user_id' => $this->Auth->User('id')), false)){
			echo 1;
		}else{
			echo 0;
		}
	}

}
?>