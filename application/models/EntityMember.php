<?php
class EntityMember extends CI_Model {
	private $table_name1= 'member';
	
	//private $primary_key1= 'ID_pemesanan';
	private $primary_key1= 'ID_member';
	private $status=0;

	function __construct(){
		parent::__construct();
		//session_start();
	}
	function GetListData($limit = 10, $offset = 0, $order_column = '', $order_type = 'asc'){
		if (empty($order_column) || empty($order_type))
			$this->db->order_by($this->primary_key1,'asc');
		else
			$this->db->order_by($order_column, $order_type);
			//->where('username='.$_SESSION['username']);//->join($this->table_name2,'member.ID_member=pemesanandarah.ID_member');
			
		return $this->db->get($this->table_name1, $limit, $offset);
	}
	
	function hitung(){
		return $this->db->count_all($this->table_name1);
	}
	
	function GetDetail($id_member){
		$this->db->where($this->primary_key1, $id_member);
		$hasil=$this->db->get($this->table_name1);
		return $hasil;
	}
	function InsertData($member){
		$this->db->insert($this->table_name1, $member);
		return $this->db->insert_id();
	}
	
	function UpdateData($id_member, $person){
		$this->db->where($this->primary_key1, $id_member);
		$this->db->update($this->table_name1, $person);
	}
	
	function HapusData($id_member){
		$this->db->where($this->primary_key1, $id_member);
		$this->db->delete($this->table_name1);
	}
}
?>