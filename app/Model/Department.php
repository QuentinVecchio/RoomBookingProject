<?php 
class Department extends AppModel{
	public $hasMany = array('Room' =>array('order'=>'name'));
}
 ?>