<?php
class EntityAdmin extends CI_Model {
	private $table_name= 'admin';
	private $status=0;

	function __construct(){
		parent::__construct();
		session_start();
	}
	
}
?>