<?php
class EntityPemesananDarah extends CI_Model {
	private $table_name1= 'pemesanandarah';
	private $table_name2= 'member';
	private $primary_key1= 'ID_pemesanan';
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
			$this->db->order_by($order_column, $order_type)->join($this->table_name2,'member.ID_member=pemesanandarah.ID_member');
			
		return $this->db->get($this->table_name1, $limit, $offset);
	}
	
	function GetListDataDetail($id,$limit = 10, $offset = 0, $order_column = '', $order_type = 'asc'){
		if (empty($order_column) || empty($order_type))
			$this->db->order_by($this->primary_key1,'asc');
		else
			$this->db->order_by($order_column, $order_type)->join($this->table_name2,'member.ID_member=pemesanandarah.ID_member and member.ID_member='.$id)
			;
			
		return $this->db->get($this->table_name1, $limit, $offset);
	}
	function hitung(){
		return $this->db->count_all($this->table_name1);
	}
	
	function GetDetail($id_pemesanan){
	$this->db->where($this->primary_key1, $id_pemesanan);
	$hasil=$this->db->get($this->table_name1);
		return $hasil;
	}
	function GetDetail_by_member($id_pemesanan,$id){
	$this->db->join($this->table_name2,'member.ID_member=pemesanandarah.ID_member and ID_pemesanan='.$id_pemesanan.' and member.ID_member='.$id)
			;
	$hasil=$this->db->get($this->table_name1);
		return $hasil;
	}
	function InsertData($pemesanan){
		$this->db->insert($this->table_name1, $pemesanan);
		return $this->db->insert_id();
	}
	
	function UpdateData($id_pemesanan, $pemesanan){
		$this->db->where($this->primary_key1, $id_pemesanan);
		$this->db->update($this->table_name1, $pemesanan);
	}
	
	function HapusData($id_pemesanan){
		$this->db->where($this->primary_key1, $id_pemesanan);
		$this->db->delete($this->table_name1);
	}
}
?>