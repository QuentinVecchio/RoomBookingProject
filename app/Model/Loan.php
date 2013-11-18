<?php 
class Loan extends AppModel{

	public $belongsTo = array('Department', 'Room', 'Status');



	public $validate = array(
		'department_id' => array(
			'rule' =>'alphaNumeric',
			'required' => true
		),
		'start_time' => array(
			'rule' =>'alphaNumeric',
			'required' => true
		),
		'end_time' => array(
			'rule' =>'alphaNumeric',
			'required' => true
		),
		'date' => array(
			'rule' =>'alphaNumeric',
			'required' => true
		));


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