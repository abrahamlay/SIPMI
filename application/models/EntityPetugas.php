<?php
class EntityPetugas extends CI_Model {
	private $table_name= 'petugas';
	private $primary_key='ID_petugas';
	private $status=0;

	function __construct(){
		parent::__construct();
		//session_start();
	}
	function GetListData($limit = 10, $offset = 0, $order_column = '', $order_type = 'asc'){
		if (empty($order_column) || empty($order_type))
			$this->db->order_by($this->primary_key,'asc');
		else
			$this->db->order_by($order_column, $order_type);
			//->where('username='.$_SESSION['username']);//->join($this->table_name2,'member.ID_member=pemesanandarah.ID_member');
			
		return $this->db->get($this->table_name, $limit, $offset);
	}
	
	function hitung(){
		return $this->db->count_all($this->table_name);
	}
	
	function GetDetail($id_petugas){
		$this->db->where($this->primary_key, $id_petugas);
		$hasil=$this->db->get($this->table_name);
		return $hasil;
	}
	function InsertData($id_petugas){
		$this->db->insert($this->table_name, $id_petugas);
		return $this->db->insert_id();
	}
	
	function UpdateData($id_petugas, $person){
		$this->db->where($this->primary_key, $id_petugas);
		$this->db->update($this->table_name, $person);
	}
	
	function HapusData($id_member){
		$this->db->where($this->primary_key, $id_member);
		$this->db->delete($this->table_name1);
	}
}

?>