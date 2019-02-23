<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Report extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_inven');
		$this->load->model('m_report');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function masuk()
	{
		$data['konten'] = $this->m_report->getItem('masuk')->result_array();
		$data['tipe'] = 'Masuk';
		$this->renderPage('laporan.php', $data);
	}

	public function keluar()
	{
		$data['konten'] = $this->m_report->getItem('keluar')->result_array();
		$data['tipe'] = 'Keluar';
		$this->renderPage('laporan.php', $data);
	}

	public function getHeader()
	{
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
}