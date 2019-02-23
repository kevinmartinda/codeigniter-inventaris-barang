<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('m_inven');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index() {
		if (!$this->session->has_userdata('logged')){
			$this->load->view('login.php');
		} else {
			$data['user'] = $this->m_inven->_getPage('tb_user', $this->session->userId)->row_array();
			$this->renderPage('welcome.php', $data);
		}
	}

	public function getHeader()
	{
		// $lab = $this->m_inven->_getAllPlace(1)->result_array();
		// $k_7 = $this->m_inven->_getAllPlace(2)->result_array();
		// $k_8 = $this->m_inven->_getAllPlace(3)->result_array();
		// $k_9 = $this->m_inven->_getAllPlace(4)->result_array();
		$wkwk = $this->m_inven->_getAll('tb_jenis_tempat')->result_array();
		$wkwkw = $this->m_inven->_getAll('tb_tempat')->result_array();
		$data['aitem'] = $wkwkw;
		$data['tempat'] = $wkwk;
		$this->load->view('template/header.php');
		$this->load->view('template/sidebar.php', $data);
	}

	public function renderPage($page, $data = null)      //meload halaman tanpa data
	{
		$this->getHeader();
		$this->load->view($page, $data);
		$this->load->view('template/footer.php');
	}

	public function getTata()
	{
		if (!$this->session->has_userdata('logged')){
			$this->load->view('login.php');
		} else {
			$data['barang'] = $this->m_inven->_getAll('tb_barang')->result_array();
			
			$this->renderPage('tata.php', $data);
		}
	}

	public function getPinjam() 
	{
		if (!$this->session->has_userdata('logged')){
			$this->load->view('login.php');
		} else {
			
				$data['konten'] = $this->m_inven->_getPinjam('v_pinjam', date("Y-m-d"))->result_array();
				$data['bangsat'] = $this->m_inven->_getAll('tb_barang')->result_array();
				$data['pilih'] = $this->m_inven->_getListTempat()->result_array();
			
			$this->renderPage('pinjam.php', $data);
		}
	}

	public function list_kelas($table, $param)			//meload halaman berisi data
	{
		if (!$this->session->has_userdata('logged')){
			$this->load->view('login.php');
		} else {
			$pinjam = $this->m_inven->_getPage($table, $param)->row_array();
			$data['kelas'] = $pinjam;
			renderPage('dashboard.php', $data);
		}
	}

	public function list_lab($table, $param)			//meload halaman berisi data
	{
		if (!$this->session->has_userdata('logged')){
			$this->load->view('login.php');
		} else {
			$pinjam = $this->m_inven->_getPage($table, $param)->row_array();
			$data['lab'] = $pinjam;
			renderPage('dashboard.php', $data);
		}
	}

	public function setPinjam()
	{
		$this->load->model('crud');
		$id_barang = $this->input->post('id_barang');
		$id_siswa = $this->input->post('id_siswa');
		$waktu = date("h:i:s");
		$tgl = date("Y-m-d");
		$data = array(
			'id_barang' => $id_barang,
			'id_siswa' => $id_siswa,
			'created_at' => $waktu,
			'tgl'	=> $tgl
		);

		$insert = $this->crud->add($data);
		redirect(base_url('index.php/home/getPinjam'));

	}

	public function getTempat()
	{
		if (!$this->session->has_userdata('logged')){
			$this->load->view('login.php');
		} else {
				$data['kategori'] = $this->m_inven->_getAll('tb_jenis_tempat')->result_array();
			
			$this->renderPage('tambah_tempat.php', $data);
		}
	}

	public function getKategory(){
		$data = $this->m_inven->_getAll('tb_jenis_tempat')->result_array();
		echo json_encode($data);
	}

	public function tambah_tempat()
	{
		$this->load->model('crud');
		$data = array(
			'jenis' => $this->input->post('jenis'),
			'nama' => $this->input->post('nama')
		);

		$insert = $this->crud->insertData('tb_tempat', $data);
		if ($insert) {
			redirect(base_url('index.php/tempat?status=success'));
		}
	}

	public function reg()
		{
			$check = 'boing';
			$pass = password_hash($check, PASSWORD_DEFAULT);
			echo $pass;
		}	

	public function register()
	{
		$this->load->model('crud');
		$data = array(
			'username' => $this->input->post('user'),
			'password' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
			'level' => 'petugas'
		);
		$insert = $this->crud->insertData('tb_user', $data);
		if ($insert) {
			echo "sukses";
		}
	}

	public function add_category()
	{
		$this->load->model('crud');
		
		$data = array('nama' => $this->input->post('nama'));
		$insert = $this->crud->insertData('tb_jenis_tempat', $data);
			if ($insert) {
				$report = array('status' => 'sukses');
			} else {
				$report = array('status' => 'gagal');
			}
		echo json_encode($report);
	}

	public function login()
	{
		$this->load->model('m_user', 'user');
		$con['username'] = $this->input->post('user');
		$password = $this->input->post('pass');
		$checkLogin = $this->user->getRows($con);
			if($checkLogin)
			{
			    if (password_verify($password,$checkLogin['password']))
			    {
			        $this->session->set_userdata('logged',TRUE);
			        $this->session->set_userdata('userId',$checkLogin['id']);
			        redirect(base_url());
			    }

			}
			else
			{
			     $data['error_msg'] = 'Wrong email or password, please try again.';
			     redirect(base_url(), $data);
			}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged');
		redirect(base_url());
	}

	
}
?>