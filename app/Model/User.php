<?php 
class User extends AppModel{

	public $belongsTo = array('Department', 'Role');

} ?>