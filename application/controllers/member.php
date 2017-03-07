<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {

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
		$this->load->model('EntityMember','',TRUE);
		//session_start();
		}
		
	function index(){
			$data['title']="Member";
			$data['member'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			//$data['member'] = $this->EntityMember->GetListData($this->limit, $offset, $order_column, $order_type)->result();
			$data['selectedMenu1']="class=\"active\"";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$this->load->view('Header.php',$data);
			$this->load->view('left-side-member.php',$data);
			$this->load->view('DashboardMember.php',$data);
			$this->load->view('Footer.php',$data);
		}
		
		
		public function ListMember($offset = 0, $order_column = '', $order_type = 'asc'){
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
			if (empty($order_column)) $order_column = 'ID_member';
			if (empty($order_type)) $order_type = 'asc';
			//TODO: check for valid column
	 
			// load data
			$member = $this->EntityMember->GetListData($this->limit, $offset, $order_column, $order_type)->result();
			
			
			// generate paginationq
			$this->load->library('pagination');
			$config['base_url'] = site_url('User/index/');
			$config['total_rows'] = $this->EntityMember->hitung();
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
				anchor('member/list_member/'.$offset.'/nama/'.$new_order, 'Nama'),
				anchor('member/list_member/'.$offset.'/username/'.$new_order, 'Username'),
				anchor('member/list_member/'.$offset.'/Alamat/'.$new_order, 'Alamat'),
				anchor('member/list_member/'.$offset.'/email/'.$new_order, 'Email'),
				anchor('member/list_member/'.$offset.'/NoTelp/'.$new_order, 'NoTelp'),
				anchor('member/list_member/'.$offset.'/Golongan_Darah/'.$new_order, 'Golongan Darah'),
				//'Lihat',
				'Action'
			);
			$i = 0 + $offset;
			foreach ($member as $memberdata){
				$this->table->add_row(++$i, 
									$memberdata->nama,
									$memberdata->username ,
									$memberdata->Alamat,
									$memberdata->email,
									$memberdata->NoTelp ,
									$memberdata->Golongan_Darah,
									
					anchor('member/LihatDetailMember_admin/'.$memberdata->ID_member,"<button class='btn btn-flat bg-orange btn-sm'>Lihat</button>",array('class'=>'view')).' '.
					//anchor('member/LihatDetailMember/'.$memberdata->ID_member,"<button class='btn btn-flat bg-orange btn-sm'>Dokumentasi Pendonoran</button>",array('class'=>'view')),
					anchor('member/update_member/'.$memberdata->ID_member,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('member/delete_member/'.$memberdata->ID_member,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data member?')"))
				);
			}
			$data['table'] = $this->table->generate();
				
				
				$this->load->view('Header.php',$data);
				$this->load->view('left-side-admin.php',$data);
				$this->load->view('LihatMember.php',$data);
				$this->load->view('Footer.php',$data);
		}
		
		function LihatDetailMember_admin($id,$offset = 0, $order_column = '',$order_column2 = '', $order_type = 'asc'){
		$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['member']= $this->EntityMember->GetDetail($id)->row();
			$data['id']=$id;
			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			if (empty($offset)) $offset = 0;
			if (empty($order_column)) $order_column = 'ID_pemesanan';
			if (empty($order_type)) $order_type = 'asc';
			//TODO: check for valid column
	 
			// load data
			$PesanDarah = $this->EntityPemesananDarah->GetListDataDetail($id,$this->limit, $offset, $order_column, $order_type)->result();
			$data['Pesan']=$this->EntityPemesananDarah->GetListDataDetail($id,$this->limit, $offset, $order_column, $order_type)->result();
				
			// generate paginationq
			$this->load->library('pagination');
			$config['base_url'] = site_url('pemesananDarah/index/');
			$config['total_rows'] = $this->EntityPemesananDarah->hitung();
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
				anchor('pemesananDarah/'.$offset.'/ID_pemesanan/'.$new_order, 'No. Pemesanan'),
				anchor('pemesananDarah/'.$offset.'/nama/'.$new_order, 'Nama'),
				anchor('pemesananDarah/'.$offset.'/Golongan_Darah_Pesan/'.$new_order, 'Golongan Darah'),
				anchor('pemesananDarah/'.$offset.'/Jumlah/'.$new_order, 'Jumlah'),
				anchor('pemesananDarah/'.$offset.'/Tagihan/'.$new_order, 'Tagihan'),
				anchor('pemesananDarah/'.$offset.'/Status/'.$new_order, 'Status'),
				'Actions'
			);
			$i = 0 + $offset;
			foreach ($PesanDarah as $PesanDarahdata){
				$this->table->add_row($PesanDarahdata->ID_pemesanan, 
									$PesanDarahdata->nama,
									$PesanDarahdata->Golongan_Darah_Pesan,
									$PesanDarahdata->Jumlah.' paket' ,
									'Rp. '.$PesanDarahdata->Total_pembayaran,
									$PesanDarahdata->Status,									
					anchor('pemesananDarah/EditPemesananDarah_admin/'.$PesanDarahdata->ID_member.'/'.$PesanDarahdata->ID_pemesanan,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('pemesananDarah/HapusPemesananDarah/'.$PesanDarahdata->ID_pemesanan.'/'.$_SESSION['level'].'/'.$PesanDarahdata->ID_member,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data PesanDarah?')"))
				);
			}
			$data['table'] = $this->table->generate();
				
			if (empty($offset)) $offset = 0;
			if (empty($order_column2)) $order_column2 = 'ID_donor';
			if (empty($order_type)) $order_type = 'asc';
			//TODO: check for valid column
	 
			// load data
			$DaftarDonor = $this->EntityPendaftaranPendonor->GetListDataDetail($id,$this->limit, $offset, $order_column2, $order_type)->result();
			
			
			// generate paginationq
			$this->load->library('pagination');
			$config['base_url'] = site_url('pendaftaranPendonor/index/');
			$config['total_rows'] = $this->EntityPendaftaranPendonor->hitung();
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['pagination2'] = $this->pagination->create_links();
	 
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
				anchor('pendaftaranPendonor/'.$offset.'/ID_donor/'.$new_order, 'No. Pendaftaran'),
				anchor('pendaftaranPendonor/'.$offset.'/nama/'.$new_order, 'Nama'),
				anchor('pendaftaranPendonor/'.$offset.'/Golongan_Darah/'.$new_order, 'Golongan Darah'),
				anchor('pendaftaranPendonor/'.$offset.'/Tanggal_daftar/'.$new_order, 'Tanggal_daftar'),
			//	anchor('pendaftaranPendonor/'.$offset.'/Tagihan/'.$new_order, 'Tagihan'),
				anchor('pendaftaranPendonor/'.$offset.'/Tanggal_donor/'.$new_order, 'Tanggal_Donor'),
				'Actions'
			);
			$i = 0 + $offset;
			foreach ($DaftarDonor as $DaftarDonordata){
				$this->table->add_row($DaftarDonordata->ID_donor, 
									$DaftarDonordata->nama,
									$DaftarDonordata->Golongan_Darah,
									$DaftarDonordata->Tanggal_daftar ,
									$DaftarDonordata->Tanggal_donor,
								//	$DaftarDonordata->Status,									
					anchor('pendaftaranPendonor/EditPendaftaranPendonor_admin/'.$DaftarDonordata->ID_member.'/'.$DaftarDonordata->ID_donor,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('pendaftaranPendonor/HapusPendaftaranPendonor/'.$DaftarDonordata->ID_donor.'/'.$_SESSION['level'].'/'.$DaftarDonordata->ID_member,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data DaftarDonor?')"))
				);
			}
			$data['table2'] = $this->table->generate();
			
		
			$data['link_back'] = anchor('member/list_member','Ke Halaman Utama',array('class'=>'back'));
				$this->load->view('Header.php',$data);
				$this->load->view('left-side-admin.php',$data);
				$this->load->view('LihatDetailMember.php',$data);
				$this->load->view('Footer.php',$data);
		}
		

		function logout(){
		session_destroy();
		redirect(base_url());
		}
	}
		
		
	?>	