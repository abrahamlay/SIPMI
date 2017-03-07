<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pendaftaranPendonor extends CI_Controller {

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
		$this->load->model('EntityPendaftaranPendonor','',TRUE);
		$this->load->model('EntityMember','',TRUE);
		
		//session_start();
		}
		
	function index(){
			$data['title']=$_SESSION['level']."| Pendaftaran Pendonor";
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
			if (empty($order_column2)) $order_column2 = 'ID_donor';
			if (empty($order_type)) $order_type = 'asc';
			//TODO: check for valid column
	 
			// load data
			$DaftarDonor = $this->EntityPendaftaranPendonor->GetListData($this->limit, $offset, $order_column2, $order_type)->result();
			
			
			// generate paginationq
			$this->load->library('pagination');
			$config['base_url'] = site_url('pendaftaranPendonor/index/');
			$config['total_rows'] = $this->EntityPendaftaranPendonor->hitung();
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
				anchor('pendaftaranPendonor/'.$offset.'/ID_donor/'.$new_order, 'No. Pendaftaran'),
				anchor('pendaftaranPendonor/'.$offset.'/nama/'.$new_order, 'Nama'),
				anchor('pendaftaranPendonor/'.$offset.'/Golongan_Darah/'.$new_order, 'Golongan Darah'),
				anchor('pendaftaranPendonor/'.$offset.'/Tanggal_daftar/'.$new_order, 'Tanggal Daftar'),
			//	anchor('pendaftaranPendonor/'.$offset.'/Tagihan/'.$new_order, 'Tagihan'),
				anchor('pendaftaranPendonor/'.$offset.'/Tanggal_donor/'.$new_order, 'Tanggal Donor'),
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
					anchor('pendaftaranPendonor/EditPendaftaranPendonor/'.$DaftarDonordata->ID_donor,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('pendaftaranPendonor/HapusPendaftaranPendonor/'.$DaftarDonordata->ID_donor,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data DaftarDonor?')"))
				);
			}
			$data['table'] = $this->table->generate();
			
			
			$this->load->view('Header.php',$data);
			$this->load->view('left-side-admin.php',$data);
			$this->load->view('PendaftaranPendonor.php',$data);
			$this->load->view('Footer.php',$data);
		}
		

		public function LihatpendaftaranPendonor_member($id,$offset = 0, $order_column = '', $order_type = 'asc'){
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
			if (empty($order_column)) $order_column = 'ID_donor';
			if (empty($order_type)) $order_type = 'asc';
			//TODO: check for valid column
	 
			// load data
			$DaftarDonor = $this->EntityPendaftaranPendonor->GetListDataDetail($id,$this->limit, $offset, $order_column, $order_type)->result();
						
			// generate paginationq
			$this->load->library('pagination');
			$config['base_url'] = site_url('pendaftaranPendonor/index/');
			$config['total_rows'] = $this->EntityPendaftaranPendonor->hitung();
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
				anchor('pendaftaranPendonor/'.$offset.'/ID_donor/'.$new_order, 'No.'),
				anchor('pendaftaranPendonor/'.$offset.'/nama/'.$new_order, 'Nama'),
				anchor('pendaftaranPendonor/'.$offset.'/Golongan_Darah/'.$new_order, 'Golongan Darah'),
				anchor('pendaftaranPendonor/'.$offset.'/Tanggal_daftar/'.$new_order, 'Tanggal_daftar'),
				anchor('pendaftaranPendonor/'.$offset.'/Status/'.$new_order, 'Status'),
				anchor('pendaftaranPendonor/'.$offset.'/Tanggal_donor/'.$new_order, 'Tanggal_Donor'),
				'Actions'
			);
			$i = 0 + $offset;
			foreach ($DaftarDonor as $DaftarDonordata){
				$this->table->add_row($DaftarDonordata->ID_donor, 
									$DaftarDonordata->nama,
									$DaftarDonordata->Golongan_Darah,
									$DaftarDonordata->Tanggal_daftar ,
									$DaftarDonordata->Status,
									$DaftarDonordata->Tanggal_donor,
																		
					anchor('pendaftaranPendonor/EditPendaftaranPendonor_member/'.$DaftarDonordata->ID_member.'/'.$DaftarDonordata->ID_donor,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('pendaftaranPendonor/HapusPendaftaranPendonor/'.$DaftarDonordata->ID_donor.'/'.$_SESSION['level'].'/'.$DaftarDonordata->ID_member,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data DaftarDonor?')"))
				);
			}

			$data['table'] = $this->table->generate();
				
			$data['link_back'] = anchor('member/list_member','Ke Halaman Utama',array('class'=>'back'));
				$this->load->view('Header.php',$data);
				$this->load->view('left-side-member.php',$data);
				$this->load->view('LihatPendaftaranPendonor.php',$data);
				$this->load->view('Footer.php',$data);
		}

		public function inputPendaftaranPendonor_admin($id)
		{	
			$data['title']="Admin | Input Pendaftaran Pendonor";
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['member']= $this->EntityMember->GetDetail($id)->row();
			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$data['action']=base_url()."index.php/pendaftaranPendonor/inputPendaftaranPendonor_admin/".$id;
			$data['pesan']="";
			$data['error']=false;
							
			$this->validasi();
		 
				 if ($this->form_validation->run()==False)
				 {			$data['DaftarDonor']['nama']=$data['member']->nama;
							$data['DaftarDonor']['no.telp']=$data['member']->NoTelp;
							$data['DaftarDonor']['alamat']=$data['member']->Alamat;
							$data['DaftarDonor']['beratbadan']='';
							$data['DaftarDonor']['status']='';	
							$data['DaftarDonor']['Tanggal_daftar']='';	

							$data['DaftarDonor']['form01']='0';
							$data['DaftarDonor']['form02']='0';
							$data['DaftarDonor']['form3a']='0';
							$data['DaftarDonor']['form3b']='0';
							$data['DaftarDonor']['form3c']='0';
							$data['DaftarDonor']['form3d']='0';
							$data['DaftarDonor']['form3e']='0';
							$data['DaftarDonor']['form04']='0';
							$data['DaftarDonor']['form5a']='0';
							$data['DaftarDonor']['form5b']='0';
							$data['DaftarDonor']['form5c']='0';
							$data['DaftarDonor']['form5d']='0';
							$data['DaftarDonor']['form5e']='0';
							$data['DaftarDonor']['form5f']='0';
							$data['DaftarDonor']['form6a']='0';
							$data['DaftarDonor']['form6b']='0';
							$data['DaftarDonor']['form7a']='0';
							$data['DaftarDonor']['form7b']='0';
							$data['DaftarDonor']['form7c']='0';
							$data['DaftarDonor']['form7d']='0';
							$data['DaftarDonor']['form08']='0';
							$data['DaftarDonor']['form09']='0';
							$data['DaftarDonor']['form10']='0';
							$data['DaftarDonor']['form11']='0';

							//$data['error']=true;	
							$data['tanggal_sekarang']=gmdate("d-m-Y H:i:s", time()+60*60*7);
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-admin.php',$data);
						$this->load->view('inputPendaftaranPendonor.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{
						date_default_timezone_set('Asia/Jakarta');
						$tanggal_sekarang=gmdate("Y-m-d H:i:s", time()+60*60*7);
						$beratbadan=$this->input->post('beratbadan');
						//$Tanggal_donor=$this->input->post('jumlah');
						$form01=$this->input->post('form01');
						$form02=$this->input->post('form02');
						$form03=$this->input->post('form03');
						$status=$this->input->post('status');

						if ($status=='Sudah Donor') {$Tanggal_donor=$tanggal_sekarang;} 
							else {$Tanggal_donor='';}
							$pesan= array(
										'ID_member'=>$id,
										'Berat_Badan' => $beratbadan,
										'Tanggal_donor' => $Tanggal_donor,
										'Tanggal_daftar' => $tanggal_sekarang,
										'Status' => $status,
										'form01' => $form01,
										'form02' => $this->input->post('form02'),
										'form03a' => $this->input->post('form3a'),
										'form03b' => $this->input->post('form3b'),
										'form03c' => $this->input->post('form3c'),
										'form03d' => $this->input->post('form3d'),
										'form03e' => $this->input->post('form3e'),
										'form04' => $this->input->post('form04'),
										'form05a' => $this->input->post('form5a'),
										'form05b' => $this->input->post('form5b'),
										'form05c' => $this->input->post('form5c'),
										'form05d' => $this->input->post('form5d'),
										'form05e' => $this->input->post('form5e'),
										'form05f' => $this->input->post('form5f'),
										'form06a' => $this->input->post('form6a'),
										'form06b' => $this->input->post('form6b'),
										'form07a' => $this->input->post('form7a'),
										'form07b' => $this->input->post('form7b'),
										'form07c' => $this->input->post('form7c'),
										'form07d' => $this->input->post('form7d'),
										'form08' => $this->input->post('form08'),
										'form09' => $this->input->post('form09'),
										'form10' => $this->input->post('form10'),
										'form11' => $this->input->post('form11')
									
										);
									$id_pesan = $this->EntityPendaftaranPendonor->InsertData($pesan);
									//$this->validation->id = $id_pesan;
									redirect('member/LihatDetailMember_admin/'.$id);
						}
						}
											
	
			
		public function EditPendaftaranPendonor_member($id,$ID_pendaftaran)
		{	
			// Edit pendaftaran pendonor dari sisi Admin
			//Mengambil data dari database
			$data['title']="Admin | Edit Pendaftaran Pendonor";
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['member']= $this->EntityMember->GetDetail($id)->row();
			$data['pendaftar']=$this->EntityPendaftaranPendonor->GetDetail_by_member($ID_pendaftaran,$id)->row();
			

			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$data['action']=base_url()."index.php/pendaftaranPendonor/EditPendaftaranPendonor_member/".$id.'/'.$ID_pendaftaran;
			$data['error']="";
			$data['pesan']="<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <b>Kesalahan di temukan!!</b> ".validation_errors()."
                                    </div>";
			
							
			$this->validasi();
		 
				 if ($this->form_validation->run()===false)
				 {			$data['error']=true;
							$data['DaftarDonor']['nama']=$data['pendaftar']->nama;
							$data['DaftarDonor']['no.telp']=$data['pendaftar']->NoTelp;
							$data['DaftarDonor']['alamat']=$data['pendaftar']->Alamat;
							$data['DaftarDonor']['beratbadan']=$data['pendaftar']->Berat_Badan;
							$data['DaftarDonor']['Tanggal_daftar']=" <div class='alert alert-info alert-dismissabl' id='status'>
																Tanggal Daftar = ".$data['pendaftar']->Tanggal_daftar."</div>";
							$data['tanggal_sekarang']=gmdate("d-m-Y H:i:s", time()+60*60*7);
							$data['DaftarDonor']['form01']=" <div class='alert alert-info alert-dismissabl' id='status'>
																Tanggal Daftar = ".$data['pendaftar']->form01."</div>";
							$data['DaftarDonor']['form02']=$data['pendaftar']->form02;
							$data['DaftarDonor']['form3a']=$data['pendaftar']->form03a;
							$data['DaftarDonor']['form3b']=$data['pendaftar']->form03b;
							$data['DaftarDonor']['form3c']=$data['pendaftar']->form03c;
							$data['DaftarDonor']['form3d']=$data['pendaftar']->form03d;
							$data['DaftarDonor']['form3e']=$data['pendaftar']->form03e;
							$data['DaftarDonor']['form04']=$data['pendaftar']->form04;
							$data['DaftarDonor']['form5a']=$data['pendaftar']->form05a;
							$data['DaftarDonor']['form5b']=$data['pendaftar']->form05b;
							$data['DaftarDonor']['form5c']=$data['pendaftar']->form05c;
							$data['DaftarDonor']['form5d']=$data['pendaftar']->form05d;
							$data['DaftarDonor']['form5e']=$data['pendaftar']->form05e;
							$data['DaftarDonor']['form5f']=$data['pendaftar']->form05f;
							$data['DaftarDonor']['form6a']=$data['pendaftar']->form06a;
							$data['DaftarDonor']['form6b']=$data['pendaftar']->form06b;
							$data['DaftarDonor']['form7a']=$data['pendaftar']->form07a;
							$data['DaftarDonor']['form7b']=$data['pendaftar']->form07b;
							$data['DaftarDonor']['form7c']=$data['pendaftar']->form07c;
							$data['DaftarDonor']['form7d']=$data['pendaftar']->form07d;
							$data['DaftarDonor']['form08']=$data['pendaftar']->form08;
							$data['DaftarDonor']['form09']=$data['pendaftar']->form09;
							$data['DaftarDonor']['form10']=$data['pendaftar']->form10;
							$data['DaftarDonor']['form11']=$data['pendaftar']->form11;


							$data['DaftarDonor']['status']=" <div class='alert alert-info alert-dismissabl' id='status'>
																Status = ".$data['pendaftar']->Status."</div>";
							
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-member.php',$data);
						$this->load->view('inputPendaftaranPendonor.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{

						date_default_timezone_set('Asia/Jakarta');
						$tanggal_sekarang=gmdate("Y-m-d H:i:s", time()+60*60*7);
						$beratbadan=$this->input->post('beratbadan');
						//$Tanggal_donor=$this->input->post('jumlah');
						$form01=$this->input->post('form01');
						if ($status=='Sudah Donor') {$Tanggal_donor=$tanggal_sekarang;} else {$Tanggal_donor='';}
						$status=$this->input->post('status');
							$pesan= array(
										'ID_member'=>$id,
										'Berat_Badan' => $beratbadan,
										'Tanggal_donor' => $Tanggal_donor,
										'Tanggal_daftar' => $tanggal_sekarang,
										'Status' => $status,
										'form01' => $form01,
										'form02' => $this->input->post('form02'),
										'form03a' => $this->input->post('form3a'),
										'form03b' => $this->input->post('form3b'),
										'form03c' => $this->input->post('form3c'),
										'form03d' => $this->input->post('form3d'),
										'form03e' => $this->input->post('form3e'),
										'form04' => $this->input->post('form04'),
										'form05a' => $this->input->post('form5a'),
										'form05b' => $this->input->post('form5b'),
										'form05c' => $this->input->post('form5c'),
										'form05d' => $this->input->post('form5d'),
										'form05e' => $this->input->post('form5e'),
										'form05f' => $this->input->post('form5f'),
										'form06a' => $this->input->post('form6a'),
										'form06b' => $this->input->post('form6b'),
										'form07a' => $this->input->post('form7a'),
										'form07b' => $this->input->post('form7b'),
										'form07c' => $this->input->post('form7c'),
										'form07d' => $this->input->post('form7d'),
										'form08' => $this->input->post('form08'),
										'form09' => $this->input->post('form09'),
										'form10' => $this->input->post('form10'),
										'form11' => $this->input->post('form11')
									
										);
									$id_pesan = $this->EntityPendaftaranPendonor->UpdateData($ID_pendaftaran,$pesan);
									//$this->validation->id = $id_pesan;
									redirect('pendaftaranPendonor/LihatpendaftaranPendonor_member/'.$id);
											
					}
				}
		
		public function EditPendaftaranPendonor_admin($id,$ID_pendaftaran)
		{	
			// Edit pendaftaran pendonor dari sisi Admin
			//Mengambil data dari database
			$data['title']="Admin | Edit Pendaftaran Pendonor";
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['member']= $this->EntityMember->GetDetail($id)->row();
			$data['pendaftar']=$this->EntityPendaftaranPendonor->GetDetail_by_member($ID_pendaftaran,$id)->row();
			

			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$data['action']=base_url()."index.php/pendaftaranPendonor/EditPendaftaranPendonor_admin/".$id.'/'.$ID_pendaftaran;
			$data['error']="";
			$data['pesan']="<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <b>Kesalahan di temukan!!</b> ".validation_errors()."
                                    </div>";
			
							
			$this->validasi();
		 
				 if ($this->form_validation->run()===false)
				 {			$data['error']=true;
							$data['DaftarDonor']['nama']=$data['pendaftar']->nama;
							$data['DaftarDonor']['no.telp']=$data['pendaftar']->NoTelp;
							$data['DaftarDonor']['alamat']=$data['pendaftar']->Alamat;
							$data['DaftarDonor']['beratbadan']=$data['pendaftar']->Berat_Badan;
							$data['DaftarDonor']['Tanggal_daftar']=" <div class='alert alert-info alert-dismissabl' id='status'>
																Tanggal Daftar = ".$data['pendaftar']->Tanggal_daftar."</div>";
							$data['tanggal_sekarang']=gmdate("d-m-Y H:i:s", time()+60*60*7);
							$data['DaftarDonor']['form01']=$data['pendaftar']->form01;
							$data['DaftarDonor']['form02']=$data['pendaftar']->form02;
							$data['DaftarDonor']['form3a']=$data['pendaftar']->form03a;
							$data['DaftarDonor']['form3b']=$data['pendaftar']->form03b;
							$data['DaftarDonor']['form3c']=$data['pendaftar']->form03c;
							$data['DaftarDonor']['form3d']=$data['pendaftar']->form03d;
							$data['DaftarDonor']['form3e']=$data['pendaftar']->form03e;
							$data['DaftarDonor']['form04']=$data['pendaftar']->form04;
							$data['DaftarDonor']['form5a']=$data['pendaftar']->form05a;
							$data['DaftarDonor']['form5b']=$data['pendaftar']->form05b;
							$data['DaftarDonor']['form5c']=$data['pendaftar']->form05c;
							$data['DaftarDonor']['form5d']=$data['pendaftar']->form05d;
							$data['DaftarDonor']['form5e']=$data['pendaftar']->form05e;
							$data['DaftarDonor']['form5f']=$data['pendaftar']->form05f;
							$data['DaftarDonor']['form6a']=$data['pendaftar']->form06a;
							$data['DaftarDonor']['form6b']=$data['pendaftar']->form06b;
							$data['DaftarDonor']['form7a']=$data['pendaftar']->form07a;
							$data['DaftarDonor']['form7b']=$data['pendaftar']->form07b;
							$data['DaftarDonor']['form7c']=$data['pendaftar']->form07c;
							$data['DaftarDonor']['form7d']=$data['pendaftar']->form07d;
							$data['DaftarDonor']['form08']=$data['pendaftar']->form08;
							$data['DaftarDonor']['form09']=$data['pendaftar']->form09;
							$data['DaftarDonor']['form10']=$data['pendaftar']->form10;
							$data['DaftarDonor']['form11']=$data['pendaftar']->form11;


							$data['DaftarDonor']['status']=" <div class='alert alert-info alert-dismissabl' id='status'>
																Status = ".$data['pendaftar']->Status."</div>";
							
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-admin.php',$data);
						$this->load->view('inputPendaftaranPendonor.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{

						date_default_timezone_set('Asia/Jakarta');
						$tanggal_sekarang=gmdate("Y-m-d H:i:s", time()+60*60*7);
						$beratbadan=$this->input->post('beratbadan');
						//$Tanggal_donor=$this->input->post('jumlah');
						$form01=$this->input->post('form01');
						if ($status=='Sudah Donor') {$Tanggal_donor=$tanggal_sekarang;} else {$Tanggal_donor='';}
						$status=$this->input->post('status');
							$pesan= array(
										'ID_member'=>$id,
										'Berat_Badan' => $beratbadan,
										'Tanggal_donor' => $Tanggal_donor,
										'Tanggal_daftar' => $tanggal_sekarang,
										'Status' => $status,
										'form01' => $form01,
										'form02' => $this->input->post('form02'),
										'form03a' => $this->input->post('form3a'),
										'form03b' => $this->input->post('form3b'),
										'form03c' => $this->input->post('form3c'),
										'form03d' => $this->input->post('form3d'),
										'form03e' => $this->input->post('form3e'),
										'form04' => $this->input->post('form04'),
										'form05a' => $this->input->post('form5a'),
										'form05b' => $this->input->post('form5b'),
										'form05c' => $this->input->post('form5c'),
										'form05d' => $this->input->post('form5d'),
										'form05e' => $this->input->post('form5e'),
										'form05f' => $this->input->post('form5f'),
										'form06a' => $this->input->post('form6a'),
										'form06b' => $this->input->post('form6b'),
										'form07a' => $this->input->post('form7a'),
										'form07b' => $this->input->post('form7b'),
										'form07c' => $this->input->post('form7c'),
										'form07d' => $this->input->post('form7d'),
										'form08' => $this->input->post('form08'),
										'form09' => $this->input->post('form09'),
										'form10' => $this->input->post('form10'),
										'form11' => $this->input->post('form11')
									
										);
									$id_pesan = $this->EntityPendaftaranPendonor->UpdateData($ID_pendaftaran,$pesan);
									//$this->validation->id = $id_pesan;
									redirect('member/LihatDetailMember_admin/'.$id);
											
					}
				//}
			
			
		}
		public function inputPendaftaranPendonor_member($id)
		{	
			$data['title']="Admin | Input Pendaftaran Pendonor";
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['member']= $this->EntityMember->GetDetail($id)->row();
			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$data['action']=base_url()."index.php/pendaftaranPendonor/inputPendaftaranPendonor_member/".$id;
			$data['pesan']="";
			$data['error']=false;
							
			$this->validasi();
		 
				 if ($this->form_validation->run()==False)
				 {			$data['DaftarDonor']['nama']=$data['member']->nama;
							$data['DaftarDonor']['no.telp']=$data['member']->NoTelp;
							$data['DaftarDonor']['alamat']=$data['member']->Alamat;
							$data['DaftarDonor']['beratbadan']='';
							$data['DaftarDonor']['status']='';	
							$data['DaftarDonor']['Tanggal_daftar']='';	
							//$data['error']=true;	
							$data['tanggal_sekarang']=gmdate("d-m-Y H:i:s", time()+60*60*7);
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-member.php',$data);
						$this->load->view('inputPendaftaranPendonor.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{
						date_default_timezone_set('Asia/Jakarta');
						$tanggal_sekarang=gmdate("Y-m-d H:i:s", time()+60*60*7);
						$beratbadan=$this->input->post('beratbadan');
						//$Tanggal_donor=$this->input->post('jumlah');
						$form01=$this->input->post('form01');
						$form02=$this->input->post('form02');
						$form03=$this->input->post('form03');
						$status='Belum Donor';
							$pesan= array(
										'ID_member'=>$id,
										'Berat_Badan' => $beratbadan,
										'Tanggal_donor' => '',
										'Tanggal_daftar' => $tanggal_sekarang,
										'Status' => $status,
										'form01' => $form01,
										'form02' => $this->input->post('form02'),
										'form03a' => $this->input->post('form3a'),
										'form03b' => $this->input->post('form3b'),
										'form03c' => $this->input->post('form3c'),
										'form03d' => $this->input->post('form3d'),
										'form03e' => $this->input->post('form3e'),
										'form04' => $this->input->post('form04'),
										'form05a' => $this->input->post('form5a'),
										'form05b' => $this->input->post('form5b'),
										'form05c' => $this->input->post('form5c'),
										'form05d' => $this->input->post('form5d'),
										'form05e' => $this->input->post('form5e'),
										'form05f' => $this->input->post('form5f'),
										'form06a' => $this->input->post('form6a'),
										'form06b' => $this->input->post('form6b'),
										'form07a' => $this->input->post('form7a'),
										'form07b' => $this->input->post('form7b'),
										'form07c' => $this->input->post('form7c'),
										'form07d' => $this->input->post('form7d'),
										'form08' => $this->input->post('form08'),
										'form09' => $this->input->post('form09'),
										'form10' => $this->input->post('form10'),
										'form11' => $this->input->post('form11')
									
										);
									$id_pesan = $this->EntityPendaftaranPendonor->InsertData($pesan);
									//$this->validation->id = $id_pesan;
									redirect('pendaftaranPendonor/LihatpendaftaranPendonor_member/'.$id);
											
					}
				//}
			
			
		}
		function validasi()
		{
		//$config='';
		$this->form_validation->set_rules('beratbadan', 'Berat_Badan', 'required|trim|greater_than[50]');
		$this->form_validation->set_rules('form01', 'Form_riwayat_pendonor_01', 'required');
		$this->form_validation->set_rules('form02', 'Form_riwayat_pendonor_02', 'required');
		$this->form_validation->set_rules('form3a', 'Form_riwayat_pendonor_03a', 'required');
		$this->form_validation->set_rules('form3b', 'Form_riwayat_pendonor_03b', 'required');
		$this->form_validation->set_rules('form3c', 'Form_riwayat_pendonor_03c', 'required');
		$this->form_validation->set_rules('form3d', 'Form_riwayat_pendonor_03d', 'required');
		$this->form_validation->set_rules('form3e', 'Form_riwayat_pendonor_03e', 'required');
		$this->form_validation->set_rules('form04', 'Form_riwayat_pendonor_04', 'required');
		$this->form_validation->set_rules('form5a', 'Form_riwayat_pendonor_05a', 'required');
		$this->form_validation->set_rules('form5b', 'Form_riwayat_pendonor_05b', 'required');
		$this->form_validation->set_rules('form5c', 'Form_riwayat_pendonor_05c', 'required');
		$this->form_validation->set_rules('form5d', 'Form_riwayat_pendonor_05d', 'required');
		$this->form_validation->set_rules('form5e', 'Form_riwayat_pendonor_05e', 'required');
		$this->form_validation->set_rules('form5f', 'Form_riwayat_pendonor_05f', 'required');
		$this->form_validation->set_rules('form6a', 'Form_riwayat_pendonor_06a', 'required');
		$this->form_validation->set_rules('form6b', 'Form_riwayat_pendonor_06b', 'required');
		$this->form_validation->set_rules('form7a', 'Form_riwayat_pendonor_07a', 'required');
		$this->form_validation->set_rules('form7b', 'Form_riwayat_pendonor_07b', 'required');
		$this->form_validation->set_rules('form7c', 'Form_riwayat_pendonor_07c', 'required');
		$this->form_validation->set_rules('form7d', 'Form_riwayat_pendonor_07d', 'required');
		$this->form_validation->set_rules('form08', 'Form_riwayat_pendonor_08', 'required');
		$this->form_validation->set_rules('form09', 'Form_riwayat_pendonor_09', 'required');
		$this->form_validation->set_rules('form10', 'Form_riwayat_pendonor_10', 'required');
		$this->form_validation->set_rules('form11', 'Form_riwayat_pendonor_11', 'required');

		$this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        ", '</div>');


		}

	public function HapuspendaftaranPendonor($id,$user,$ID_member)
		{$data['member']= $this->EntityMember->GetDetail($ID_member)->row();
			if($user=='admin')
			{
				$this->EntityPendaftaranPendonor->HapusData($id);
				redirect('member/LihatDetailMember_admin/'.$ID_member);
			}
			if($user=='member')
			{
				$this->EntityPendaftaranPendonor->HapusData($id);
				redirect('pendaftaranPendonor/LihatpendaftaranPendonor_member/'.$ID_member);
			}
		}
	}
	?>	