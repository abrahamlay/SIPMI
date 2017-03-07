<?php
class EntityLaporanKeuangan extends CI_Model {
	private $table_name= 'admin';
	private $table_name1= 'pemesanandarah';
	private $status=0;

	function __construct(){
		parent::__construct();
	//	session_start();
	}

	public function GetLaporanKeuangan(){
		$this->db->select("(SELECT SUM(Total_pembayaran) FROM pemesanandarah WHERE Status='Lunas')as total" , FALSE); 
		$hasil=$this->db->get($this->table_name1);
		return $hasil;

	}
	
}
?>