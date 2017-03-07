<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class petugas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 private $limit = 10;
	
	 function __construct()
		{
		parent::__construct();
		
		$this->load->library(array('table','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->model('EntityUser','',TRUE);	
		$this->load->model('EntityPemesananDarah','',TRUE);
		$this->load->model('EntityPendaftaranPendonor','',TRUE);
		$this->load->model('EntityPetugas','',TRUE);
		//session_start();
		}
		
	function index(){
			$data['title']="Petugas";
			$data['petugas'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			//$data['petugas'] = $this->Entitypetugas->GetListData($this->limit, $offset, $order_column, $order_type)->result();
			$data['selectedMenu1']="class=\"active\"";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$this->load->view('Header.php',$data);
			$this->load->view('left-side-petugas.php',$data);
			$this->load->view('DashboardPetugas.php',$data);
			$this->load->view('Footer.php',$data);
		}

		public function ListPetugas($offset = 0, $order_column = '', $order_type = 'asc'){
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			if (empty($offset)) $offset = 0;
			if (empty($order_column)) $order_column = 'ID_petugas';
			if (empty($order_type)) $order_type = 'asc';
			//TODO: check for valid column
	 
			// load data
			$petugas = $this->EntityPetugas->GetListData($this->limit, $offset, $order_column, $order_type)->result();
			
			
			// generate paginationq
			$this->load->library('pagination');
			$config['base_url'] = site_url('User/index/');
			$config['total_rows'] = $this->EntityPetugas->hitung();
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
	 
			// generate table data
			$tmpl = array (
                    'table_open'          => '<table border="1" cellpadding="4" cellspacing="0">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

			$this->table->set_template($tmpl);
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$new_order = ($order_type == 'asc' ? 'desc' : 'asc');
			$this->table->set_heading(
				'No',
				anchor('petugas/ListPetugas/'.$offset.'/nama/'.$new_order, 'Nama'),
				anchor('petugas/ListPetugas/'.$offset.'/username/'.$new_order, 'Username'),
				//anchor('petugas/ListPetugas/'.$offset.'/Alamat/'.$new_order, 'Alamat'),
				
				//'Lihat',
				'Action'
			);
			$i = 0 + $offset;
			foreach ($petugas as $petugasdata){
				$this->table->add_row(++$i, 
									$petugasdata->nama,
									$petugasdata->username ,
									//$petugasdata->Alamat,
									
									
					//anchor('petugas/LihatDetailpetugas/'.$petugasdata->ID_petugas,"<button class='btn btn-flat bg-orange btn-sm'>Lihat</button>",array('class'=>'view')).' '.
					//anchor('petugas/LihatDetailpetugas/'.$petugasdata->ID_petugas,"<button class='btn btn-flat bg-orange btn-sm'>Dokumentasi Pendonoran</button>",array('class'=>'view')),
					anchor('petugas/update_petugas/'.$petugasdata->ID_petugas,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('petugas/delete_petugas/'.$petugasdata->ID_petugas,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data petugas?')"))
				);
			}
			$data['table'] = $this->table->generate();
				
				
				$this->load->view('Header.php',$data);
				$this->load->view('left-side-admin.php',$data);
				$this->load->view('LihatPetugas.php',$data);
				$this->load->view('Footer.php',$data);
		}

	}
		