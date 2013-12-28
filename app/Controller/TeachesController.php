<?php 
class TeachesController  extends AppController{

	public function index(){
 		$this->Teach->unbindModel(
        		array('belongsTo' => array('User'))
    		);

		$this->set('tmp', $this->Teach->find('all', array('conditions' => array('user_id' => $this->Auth->User('id')))));


 		$this->Teach->Formation->Department->unbindModel(
        		array('hasMany' => array('Room'))
    		);
		$this->set('listFormation', $this->Teach->Formation->Department->find('all'));
	}

	public function add($idFormation){
		$this->autoRender = false;
		if(!$this->Teach->find('count', array('conditions' => array('formation_id' => $idFormation, 'user_id' => $this->Auth->User('id'))))){
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
		if($this->Teach->deleteAll(array('formation_id' => $idFormation, 'user_id' => $this->Auth->User('id')), false)){
			echo 1;
		}else{
			echo 0;
		}
	}

}
?>