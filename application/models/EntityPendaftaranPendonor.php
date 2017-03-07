<?php
class EntityPendaftaranPendonor extends CI_Model {
	private $table_name1= 'pendaftaranpendonor';
	private $table_name2= 'member';
	private $primary_key1= 'ID_donor';
	private $primary_key2= 'ID_member';
	private $status=0;
	function __construct(){
		parent::__construct();
		//session_start();
	}
	function GetListData($limit = 10, $offset = 0, $order_column = '', $order_type = 'asc'){
		if (empty($order_column) || empty($order_type))
			$this->db->order_by($this->primary_key1,'asc');
		else
			$this->db->order_by($order_column, $order_type)->join($this->table_name2,'member.ID_member=pendaftaranpendonor.ID_member');
			
		return $this->db->get($this->table_name1, $limit, $offset);
	}
	
	
	function GetListDataDetail($id,$limit = 10, $offset = 0, $order_column = '', $order_type = 'asc'){
		if (empty($order_column) || empty($order_type))
			$this->db->order_by($this->primary_key1,'asc');
		else
			$this->db->order_by($order_column, $order_type)->join($this->table_name2,'member.ID_member=pendaftaranpendonor.ID_member and member.ID_member='.$id)
			;
			
		return $this->db->get($this->table_name1, $limit, $offset);
	}

	function GetDetail_by_member($id_pendaftaran,$id){
	$this->db->join($this->table_name2,'member.ID_member=pendaftaranpendonor.ID_member and ID_donor='.$id_pendaftaran.' and member.ID_member='.$id);
	$hasil=$this->db->get($this->table_name1);
		return $hasil;
	}
	
	function hitung(){
		return $this->db->count_all($this->table_name1);
	}

	function InsertData($pendaftaran){
		$this->db->insert($this->table_name1, $pendaftaran);
		return $this->db->insert_id();
	}
	
	function UpdateData($id_pendaftaran, $pendaftaran){
		$this->db->where($this->primary_key1, $id_pendaftaran);
		$this->db->update($this->table_name1, $pendaftaran);
	}
	
	function HapusData($id_pendaftaran){
		$this->db->where($this->primary_key1, $id_pendaftaran);
		$this->db->delete($this->table_name1);
	}
}
?>