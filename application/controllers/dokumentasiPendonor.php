<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dokumentasiPendonor extends CI_Controller {

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
		$this->load->model('EntityDokumentasiPendonor','',TRUE);
		//session_start();
		}
		function index(){
			$data['title']="Lihat Laporan Keungan";
			$data['profil'] = $this->EntityUser->get_profile($_SESSION['username'],$_SESSION['password'])->row();
			$data['DokumentasiPendonor']['januari']=$this->EntityDokumentasiPendonor->GetDokumentasiPendonor()->row();
			$data['selectedMenu1']="class=\"active\"";
			$data['selectedMenu2']="";
			$data['selectedMenu3']="";
			$data['selectedMenu4']="";
			$data['selectedMenu5']="";
			$data['selectedMenu6']="";
			$data['selectedMenu7']="";
			
			$this->load->view('Header.php',$data);
			$this->load->view('left-side-admin.php',$data);
			$this->load->view('LihatDokumentasiPendonor.php',$data);
			$this->load->view('Footer.php',$data);
		}

		function logout(){
		session_destroy();
		redirect(base_url());
		}
}
?>