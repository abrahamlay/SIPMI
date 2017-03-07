<?php
class EntityDokumentasiPendonor extends CI_Model {
	private $table_name1= 'pendaftaranpendonor';
	private $status=0;

	function __construct(){
		parent::__construct();
		//session_start();
	}

	public function GetDokumentasiPendonor(){
		$this->db->select("(SELECT count(Tanggal_donor) FROM pendaftaranpendonor WHERE Status='Sudah Donor' and month(Tanggal_donor)='01')as total" , FALSE); 
		$hasil=$this->db->get($this->table_name1);
		return $hasil;

	}
	
}
?>