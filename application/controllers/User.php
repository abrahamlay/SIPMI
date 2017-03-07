<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('EntityMember','',TRUE);
		//session_start();
		}

	public function index()
		{
		if ( isset($_SESSION['username']) )
			 {
                redirect($_SESSION['level']); //redirect controller c_home
					}else{


		$data['action']="/User/login_proses";
		 $data['title']="Home";
			$this->load->view('Header.php',$data);
			$this->load->view('Home.php',$data);
			$this->load->view('Footer.php',$data);
				}
		}


		public function DaftarMember()
		{	$data['action']="index.php/User/DaftarMember";
			$data['title']="Daftar Member";
			$data['pesan']="";
			$data['error']=false;

				$this->_set_rules_register();

				 if ($this->form_validation->run()===FALSE)
				 {			$data['member']['name']='';
							$data['member']['username']='';
							$data['member']['password']='';
							$data['member']['password2']='';


						$this->load->view('Header.php',$data);
						$this->load->view('DaftarMember.php',$data);
						$this->load->view('Footer.php',$data);

				}
				else	{
						$nama=$this->input->post('name');
						$user=$this->input->post('username');
						$pass=$this->input->post('password');
						$pass2=$this->input->post('password2');
						$email=$this->input->post('email');
						$alamat=$this->input->post('alamat');
						$telp=$this->input->post('telp');
						$goldar=$this->input->post('goldar');



											$_SESSION['username']=$user;
											$_SESSION['password']=$pass2;
											$_SESSION['level']='member';
											$member = array(
														'nama' => $nama,
														'username' => $user,
														'password' => $pass2,
														'Alamat' => $alamat,
														'email' => $email,
														'NoTelp' => $telp,
														'Golongan_Darah' => $goldar
													);
									$id = $this->EntityMember->InsertData($member);
									//$this->validation->id = $id;
									redirect('member');

					}
				//}

		}


		function authentifikasiUser(){

		$this->_set_rules_login();


			if ( $this->form_validation->run() == TRUE )
				{
                 //jika proses validasi bernilai TRUE (benar semua), maka akan dilakukan sesi selanjutnya,
                 //yaitu proses penyimpanan data.
                   $user=$this->input->post('username');
				   $pass=$this->input->post('password');

				//$this->load->model('login_model'); // memanggil model login_model
                 $result = $this->EntityUser->GetLevelUser( $user,$pass) ;
                   }
				   else {$_SESSION['gagal']='kosong';
				   redirect('User/validasi');
				   }

		}

		function validasi(){

			if ($_SESSION['gagal']=='kosong'){
					$data['pesan']="Username or Password Empty";
					}
			if ($_SESSION['gagal']=='salah'){
				$data['pesan']="Username or Password wrong";
				}
				$data['action']="authentifikasiUser";
				$data['title']='Login';
				$this->load->view('Header.php',$data);
				$this->load->view('login.php',$data);
				$this->load->view('Footer.php',$data);
		}


		function _set_rules_register()
		{

			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password2]');
			$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required');
		/* 	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); */
			$this->form_validation->set_rules('name', 'Name', 'trim|required');

		}

		function _set_rules_login()
		{

			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
		}


	}


/* End of file User.php */
