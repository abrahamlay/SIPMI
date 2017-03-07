<?php
class EntityUser extends CI_Model {
	
	private $table_name= 'admin';
	private $table_name2= 'pendonoran';
	private $table_name3= 'member';
	private $primary_key= 'ID_petugas';
	private $primary_key2= 'ID_donor';
	private $primary_key3= 'ID_member';
	private $status=0;

	function __construct(){
		parent::__construct();
		session_start();
	}

	function get_paged_list_member($limit = 10, $offset = 0, $order_column = '', $order_type = 'asc'){
		if (empty($order_column) || empty($order_type))
			$this->db->order_by($this->primary_key3,'asc');
		else
			$this->db->order_by($order_column, $order_type);
			
		return $this->db->get($this->table_name3, $limit, $offset);
	}
	
	
	function get_profile($username,$password){
		$this->db->where('username', $username)->where('password',$password);
		return $this->db->get($_SESSION['level']);
	}
	function GetLevelUser($username, $password) 
         {
			/* $this->db->select('username','password','level'); // <-- There is never any reason to write this line!
			$this->db->from('admin');
			$this->db->join('comments', 'comments.id = blogs.id'); */
			//$this->db->
			$ketemu=$this->status;
			while($ketemu!=1)
			{
				$query = $this->db->where('username', $username)->where('password', ($password))->from('admin')->get();
				$query2 = $this->db->where('username', $username)->where('password', ($password))->from('member')->get();
				$query3 = $this->db->where('username', $username)->where('password', ($password))->from('petugas')->get();
				//$query4 = $this->db->where('username', $username)->where('password', ($password))->from('bos')->get();
				if ($query->result()==TRUE)
				{
					$ketemu=1;
					$_SESSION['level']='admin';
					//$_SESSION['nama']=
					$_SESSION['username'] = $username; 
					$_SESSION['password'] = $password; 
					redirect($_SESSION['level']); 
				}
				
				if ($query2->result()==TRUE)
				{
					$ketemu=1;
					$_SESSION['level']='member';
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password; 
					redirect($_SESSION['level']); 
				}
				
				if ($query3->result()==TRUE)
				{
					$ketemu=1;
					$_SESSION['level']='petugas';
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password; 					
					redirect($_SESSION['level']); 
				}
				else {
					$ketemu=1;
                    $_SESSION['gagal']='salah';
					redirect(base_url().'index.php/User/validasi');
				}
				/* 
					if ($query4->result()==TRUE)
				{
					$ketemu=1;
					$_SESSION['level']='bos';
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password; 					
					redirect('User/'.$_SESSION['level']); 
				} */
				
			}
			
		}
		
}
?>