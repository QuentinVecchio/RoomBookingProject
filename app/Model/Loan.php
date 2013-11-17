<?php 
class Loan extends AppModel{

	public $belongsTo = array('Department', 'Room', 'Status');


	public function beforeSave($options = array()) {

	    if (!empty($this->data['Loan']['date'])){
	        $this->data['Loan']['date'] = $this->dateFormatBeforeSave($this->data['Loan']['date']);
	        $this->data['Loan']['start_time'] = $this->data['Loan']['start_time'].':00';
	        $this->data['Loan']['end_time'] = $this->data['Loan']['end_time'].':00';

	    }
	    return true;
	}

	public function dateFormatBeforeSave($dateString) {
	   return date('Y-m-d', strtotime($dateString));
	}
}
 ?>