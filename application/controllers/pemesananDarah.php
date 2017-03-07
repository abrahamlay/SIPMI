<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pemesananDarah extends CI_Controller {

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
		$this->load->model('EntityMember','',TRUE);
		
		//session_start();
		}
		
	function index(){
			$data['title']=$_SESSION['level']."| Pemesanan Darah";
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
			if (empty($order_column)) $order_column = 'ID_pemesanan';
			if (empty($order_type)) $order_type = 'asc';
			//TODO: check for valid column
	 
			// load data
			$PesanDarah = $this->EntityPemesananDarah->GetListData($this->limit, $offset, $order_column, $order_type)->result();
			
			
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
				anchor('pemesananDarah/'.$offset.'/Golongan_Darah/'.$new_order, 'Golongan Darah'),
				anchor('pemesananDarah/'.$offset.'/Jumlah/'.$new_order, 'Jumlah'),
				anchor('pemesananDarah/'.$offset.'/Total_pembayaran/'.$new_order, 'Tagihan'),
				anchor('pemesananDarah/'.$offset.'/Status/'.$new_order, 'Status'),
				'Actions'
			);
			$i = 0 + $offset;
			foreach ($PesanDarah as $PesanDarahdata){
				$this->table->add_row($PesanDarahdata->ID_pemesanan, 
									$PesanDarahdata->nama,
									$PesanDarahdata->Golongan_Darah,
									$PesanDarahdata->Jumlah.' paket' ,
									'Rp. '.$PesanDarahdata->Total_pembayaran,
									$PesanDarahdata->Status,									
					anchor('pemesananDarah/EditPemesananDarah_admin/'.$PesanDarahdata->ID_pemesanan,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('pemesananDarah/HapusPemesananDarah/'.$PesanDarahdata->ID_pemesanan.'/'.$_SESSION['level'].'/'.$PesanDarahdata->ID_member,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data PesanDarah?')"))
				);
			}
			$data['table'] = $this->table->generate();
				
			
			$this->load->view('Header.php',$data);
			$this->load->view('left-side-admin.php',$data);
			$this->load->view('PemesananDarah.php',$data);
			$this->load->view('Footer.php',$data);
		}
		

		public function LihatPemesananDarah_member($id,$offset = 0, $order_column = '', $order_type = 'asc'){
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
				anchor('pemesananDarah/'.$offset.'/Golongan_Darah/'.$new_order, 'Golongan Darah'),
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
					anchor('pemesananDarah/EditPemesananDarah_member/'.$PesanDarahdata->ID_member.'/'.$PesanDarahdata->ID_pemesanan,"<button class='btn btn-flat bg-blue btn-sm'>Edit</button>",array('class'=>'update')).' '.
					anchor('pemesananDarah/HapusPemesananDarah/'.$PesanDarahdata->ID_pemesanan.'/'.$_SESSION['level'].'/'.$PesanDarahdata->ID_member,"<button class='btn btn-flat bg-red btn-sm '>Hapus</button>",array('class'=>'delete','onclick'=>"return confirm('Apakah anda yakin ingin menghapus data PesanDarah?')"))
				);
			}
			$data['table'] = $this->table->generate();
				
			$data['link_back'] = anchor('member/list_member','Ke Halaman Utama',array('class'=>'back'));
				$this->load->view('Header.php',$data);
				$this->load->view('left-side-member.php',$data);
				$this->load->view('LihatPemesananDarah.php',$data);
				$this->load->view('Footer.php',$data);
		}

		public function inputPemesananDarah_admin($id)
		{	
			//$this->load->library('form_validation');
			$data['title']="Admin | Input Pemesanan Darah";
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
			
			$data['action']=base_url()."index.php/pemesananDarah/inputPemesananDarah_admin/".$id;
			$data['error']="";
			$data['pesan']="<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <b>Kesalahan di temukan!!</b> ".validation_errors()."
                                    </div>";
			
							
			$this->validasi();
		 
				 if ($this->form_validation->run()===false)
				 {			$data['error']=true;
							$data['PesanDarah']['nama']=$data['member']->nama;
							$data['PesanDarah']['no.telp']=$data['member']->NoTelp;
							$data['PesanDarah']['alamat']=$data['member']->Alamat;
							$data['PesanDarah']['jumlah']='';
							$data['PesanDarah']['goldar']='';
							$data['PesanDarah']['status']='';	
								
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-admin.php',$data);
						$this->load->view('inputPemesananDarah.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{
						
						$gol=$this->input->post('goldar');
						$jumlah=$this->input->post('jumlah');
						$tagihan=$this->input->post('jumlah')*200000;
						$status=$this->input->post('status');
							$pesan= array(
										'ID_member'=>$id,
										'Golongan_Darah_Pesan' => $gol,
										'Jumlah' => $jumlah,
										'Total_pembayaran' => $tagihan,
										'Status' => $status

										);

									$id_pesan = $this->EntityPemesananDarah->InsertData($pesan);
									//$this->validation->id = $id_pesan;
									redirect('member/LihatDetailMember_admin/'.$data['member']->ID_member);
											
					}
				//}
			
			
		}
		

	public function EditPemesananDarah_admin($id,$ID_pemesanan)
		{	
			//$this->load->library('form_validation');
			$data['title']="Admin | Edit Pemesanan Darah";
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['member']= $this->EntityMember->GetDetail($id)->row();
			$data['pemesan']=$this->EntityPemesananDarah->GetDetail_by_member($ID_pemesanan,$id)->row();
			//$data['Pesan']=$this->EntityPemesananDarah->GetListDataDetail($id,$this->limit, $offset, $order_column, $order_type)->result();
			
			

			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$data['action']=base_url()."index.php/pemesananDarah/EditPemesananDarah_admin/".$id.'/'.$ID_pemesanan;
			$data['error']="";
			$data['pesan']="<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <b>Kesalahan di temukan!!</b> ".validation_errors()."
                                    </div>";
			
							
			$this->validasi();
		 
				 if ($this->form_validation->run()===false)
				 {			$data['error']=true;
							$data['PesanDarah']['nama']=$data['pemesan']->nama;
							$data['PesanDarah']['no.telp']=$data['pemesan']->NoTelp;
							$data['PesanDarah']['alamat']=$data['pemesan']->Alamat;
							$data['PesanDarah']['jumlah']=$data['pemesan']->Jumlah;
							$data['PesanDarah']['goldar']=" <div class='alert alert-info alert-dismissabl' id='goldar'>
																Golongan Darah = ".$data['pemesan']->Golongan_Darah_Pesan."</div>";
							$data['PesanDarah']['status']=" <div class='alert alert-info alert-dismissabl' id='status'>
																Status = ".$data['pemesan']->Status."</div>";
							
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-admin.php',$data);
						$this->load->view('inputPemesananDarah.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{
						
						$gol=$this->input->post('goldar');
						$jumlah=$this->input->post('jumlah');
						$tagihan=$this->input->post('jumlah')*200000;
						$status=$this->input->post('status');
							$pesan= array(
										'ID_member'=>$id,
										'Golongan_Darah_Pesan' => $gol,
										'Jumlah' => $jumlah,
										'Total_pembayaran' => $tagihan,
										'Status' => $status

										);
							
									$id_pesan = $this->EntityPemesananDarah->updateData($ID_pemesanan,$pesan);
									//$this->validation->id = $id_pesan;
									redirect('member/LihatDetailMember_admin/'.$data['member']->ID_member);
											
					}
				//}
			
			
		}

		public function EditPemesananDarah_member($id,$ID_pemesanan)
		{	
			//$this->load->library('form_validation');
			$data['title']="Admin | Edit Pemesanan Darah";
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['member']= $this->EntityMember->GetDetail($id)->row();
			$data['pemesan']=$this->EntityPemesananDarah->GetDetail_by_member($ID_pemesanan,$id)->row();
			//$data['Pesan']=$this->EntityPemesananDarah->GetListDataDetail($id,$this->limit, $offset, $order_column, $order_type)->result();
			
			

			$data['title']=$_SESSION['level'];
			$data['selectedMenu1']="";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="class=\"active\"";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$data['action']=base_url()."index.php/pemesananDarah/EditPemesananDarah_member/".$id.'/'.$ID_pemesanan;
			$data['error']="";
			$data['pesan']="<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <b>Kesalahan di temukan!!</b> ".validation_errors()."
                                    </div>";
			
							
			$this->validasi();
		 
				 if ($this->form_validation->run()===false)
				 {			$data['error']=true;
							$data['PesanDarah']['nama']=$data['pemesan']->nama;
							$data['PesanDarah']['no.telp']=$data['pemesan']->NoTelp;
							$data['PesanDarah']['alamat']=$data['pemesan']->Alamat;
							$data['PesanDarah']['jumlah']=$data['pemesan']->Jumlah;
							$data['PesanDarah']['goldar']=" <div class='alert alert-info alert-dismissabl' id='goldar'>
																Golongan Darah = ".$data['pemesan']->Golongan_Darah_Pesan."</div>";
							$data['PesanDarah']['status']=" <div class='alert alert-info alert-dismissabl' id='status'>
																Status = ".$data['pemesan']->Status."</div>";
							
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-member.php',$data);
						$this->load->view('inputPemesananDarah.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{
						
						$gol=$this->input->post('goldar');
						$jumlah=$this->input->post('jumlah');
						$tagihan=$this->input->post('jumlah')*200000;
						$status=$this->input->post('status');
							$pesan= array(
										'ID_member'=>$id,
										'Golongan_Darah_Pesan' => $gol,
										'Jumlah' => $jumlah,
										'Total_pembayaran' => $tagihan,
										'Status' => $status

										);
							
									$id_pesan = $this->EntityPemesananDarah->updateData($ID_pemesanan,$pesan);
									//$this->validation->id = $id_pesan;
									redirect('pemesananDarah/LihatPemesananDarah_member/'.$id);
											
					}
				//}
			
			
		}
		public function inputPemesananDarah_member($id)
		{	
			//$this->load->library('form_validation');
			$data['title']="Admin | Input Pemesanan Darah";
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
			
			$data['action']=base_url()."index.php/pemesananDarah/inputPemesananDarah_admin/".$id;
			$data['error']="";
			$data['pesan']="<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <b>Kesalahan di temukan!!</b> ".validation_errors()."
                                    </div>";
			
							
			$this->validasi();
		 
				 if ($this->form_validation->run()===false)
				 {			$data['error']=true;
							$data['PesanDarah']['nama']=$data['member']->nama;
							$data['PesanDarah']['no.telp']=$data['member']->NoTelp;
							$data['PesanDarah']['alamat']=$data['member']->Alamat;
							$data['PesanDarah']['jumlah']='';
							$data['PesanDarah']['goldar']='';
							$data['PesanDarah']['status']='';	
								
						$this->load->view('Header.php',$data);
						$this->load->view('left-side-member.php',$data);
						$this->load->view('inputPemesananDarah.php',$data);
						$this->load->view('Footer.php',$data);
						
				} 
				else	{
						
						$gol=$this->input->post('goldar');
						$jumlah=$this->input->post('jumlah');
						$tagihan=$this->input->post('jumlah')*200000;
						$status=$this->input->post('status');
							$pesan= array(
										'ID_member'=>$id,
										'Golongan_Darah_Pesan' => $gol,
										'Jumlah' => $jumlah,
										'Total_pembayaran' => $tagihan,
										'Status' => $status

										);

									$id_pesan = $this->EntityPemesananDarah->InsertData($pesan);
									//$this->validation->id = $id_pesan;
									redirect('pendaftaranPendonor/LihatpendaftaranPendonor_member/'.$id);
											
					}
				//}
			
			
		}
		
	public	function validasi()
		{
		//$config='';
		// $this->form_validation->set_rules('nama', 'Nama', 'required');
		// $this->form_validation->set_rules('telp', 'NoTelp', 'required');
		// $this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah_paket', 'required|trim');
		$this->form_validation->set_rules('goldar', 'Golongan_Darah', 'required|trim');
		//$this->form_validation->set_rules('tagihan', 'Total_pembayaran', 'required|trim');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>
                                        <i class='fa fa-ban'></i>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        ", '</div>');

		}

	public function HapusPemesananDarah($id,$user,$ID_member)
		{$data['member']= $this->EntityMember->GetDetail($ID_member)->row();
			if($user=='admin')
			{
				$this->EntityPemesananDarah->HapusData($id);
				redirect('member/LihatDetailMember_admin/'.$ID_member);
			}
			if($user=='member')
			{
				$this->EntityPemesananDarah->HapusData($id);
				redirect('pemesananDarah/LihatPemesananDarah_member/'.$ID_member);
			}
		}
	}
	?>	