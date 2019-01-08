<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
include 'Home.php';
class Barang extends CI_Controller
{ 
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_inven');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function pinjam()
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

		$insert = $this->crud->add('tb_pinjam', $data);
		redirect(base_url('index.php/pinjam'));
	}

	public function update_pinjam($id)
	{
		$this->load->model('crud');
		$this->crud->updateData('tb_pinjam', array('edited_at' => date("h:i:s")), array('id' => $id));
		redirect(base_url('index.php/pinjam'));
	}

	public function list_barang($id)
	{
		$this->load->model('m_barang');
		$barang = $this->m_barang->getAllBarang($id)->result_array();
		$wkwk = $this->m_inven->_getPage('tb_tempat', $id)->row_array();
		$data['page'] = $wkwk;
		$data['konten'] = $barang;
		$this->renderPage("dashboard.php", $data);
		// redirect("page/{$data}");
	}

	public function getHeader()
	{
		$lab = $this->m_inven->_getAllPlace(1)->result_array();
		$k_7 = $this->m_inven->_getAllPlace(2)->result_array();
		$k_8 = $this->m_inven->_getAllPlace(3)->result_array();
		$k_9 = $this->m_inven->_getAllPlace(4)->result_array();
		$data = array(
			'lab' => $lab, 
			'k_7' => $k_7,
			'k_8' => $k_8,
			'k_9' => $k_9
		);
		$this->load->view('template/header.php');
		$this->load->view('template/sidebar.php', $data);
	}

	public function renderPage($page, $data = null)      //meload halaman tanpa data
	{
		$this->getHeader();
		$this->load->view($page, $data);
		$this->load->view('template/footer.php');
	}

	public function tambah_barang()
	{
		$data['pilih'] = $this->m_inven->_getListTempat()->result_array();
		$this->renderPage('transaksi_tambah.php', $data);
	}

	public function keluar_barang()
	{
		$data['tempat'] = $this->m_inven->_getAll('tb_tempat')->result_array();
		$data['barang'] = $this->m_barang->getItem('tb_stok')->result_array();
		$this->renderPage('transaksi_keluar.php', $data);
	}

	public function get_selected($id)
	{
		$data['barang'] = $this->m_barang->getItem('tb_stok', array('id_tempat' => $id))->result_array();
		echo json_encode($data['barang']);
	}

	public function get_selected_jumlah($id)
	{
		$jumlah = $this->m_barang->_get_jumlah($id)->row_array();
		echo json_encode($jumlah);
	}

	public function add_transaction()
	{
		$this->load->model('crud');
		$data = array(
			'nama_barang' => $this->input->post('nama'),
			'id_user' => $this->session->userId,
			'merk' => $this->input->post('merk'),
			'warna' => $this->input->post('warna'),
			'tahun'	=> $this->input->post('tahun'),
			'jumlah' => $this->input->post('jumlah'),
			'jenis'	=> 'masuk',
			'id_tempat'	=> $this->input->post('id_tempat'),
			'tgl_masuk'	=> date("Y-m-d h:i:s")
		);
		$reData = array(
			'nama_barang' => $this->input->post('nama'),
			'id_user' => $this->session->userId,
			'merk' => $this->input->post('merk'),
			'warna' => $this->input->post('warna'),
			'tahun'	=> $this->input->post('tahun'),
			'jumlah' => $this->input->post('jumlah'),
			'id_tempat'	=> $this->input->post('id_tempat'),
			'tgl_masuk'	=> date("Y-m-d h:i:s")
		);
		$insert = $this->crud->add('tb_transaksi', $data);
		$where = array('nama_barang' => $data['nama_barang'], 'id_tempat' => $data['id_tempat']);
		$check = $this->m_barang->checkItem($where)->row_array();

		if ($insert) {
			if ($check) {
				$set = array('jumlah' => $check['jumlah'] + $data['jumlah'], 'tgl_edit' => date("Y-m-d h:i:s"));
				$update = $this->crud->updateData('tb_stok', $set, $where);	
			} else {
				$update = $this->crud->add('tb_stok', $reData);
			}
			if ($update) {
				redirect(base_url('index.php/barang/tambah-barang?status=suksesAll'));
			} else {
				redirect(base_url('index.php/barang/tambah-barang?status=sukses&up=gal'));
			}
		} else {
			redirect(base_url('index.php/barang/tambah-barang?status=gagal'));
		}
	}

	public function remove_transaction()
	{
		$this->load->model('crud');
		$jumlah = $this->input->post('keluar');
		$mData = $this->m_barang->_getPage('v_stok', array('id_barang' => $this->input->post('id_barang')))->row_array();
		$set['jumlah'] = $mData['jumlah'] - $jumlah; 
		$where['nama_barang'] = $mData['nama_barang'];
		$where['id_tempat'] = $mData['id_tempat'];

		echo $this->input->post('keluar')."\n";
		echo $this->input->post('id_tempat')."\n";
		echo $this->input->post('id_barang')."\n";
		var_dump($mData);

		$update = $this->crud->updateData('tb_stok', $set, $where);
		$iData = array(
			'nama_barang' => $mData['nama_barang'],
			'id_user' => $this->session->userId,
			'merk' => $mData['merk'],
			'warna' => $mData['warna'],
			'tahun'	=> $mData['tahun'],
			'jumlah' => $jumlah,
			'jenis'	=> 'keluar',
			'id_tempat'	=> $mData['id_tempat'],
			'tgl_masuk'	=> date("Y-m-d h:i:s")
		);
		$insert = $this->crud->add('tb_transaksi', $iData);
		if ($insert && $update) {
			redirect(base_url('index.php/barang/keluar-barang?status=sukses'));
		} else {
			redirect(base_url('index.php/barang/keluar-barang?status=gagal'));
		}
	}

	public function get_barang($id)
	{
		$data['konten'] = $this->m_inven->_getTempat('tb_transaksi', $id)->result_array();
		$this->load->view('wkwk.php', $data);
	}

	public function get_item($id)
	{
		$item = $this->m_inven->_getItem($id)->result_array();
		echo json_encode($item);
	}

	public function barang_keluar()
	{
		$id = $this->input->post('id_tempat');
		$data['konten'] = $this->m_inven->_getTempat('v_transaksi', $id)->result_array();
		$this->renderPage('keluar.php', $data);
	}

	public function keluar($id)
	{
		
	}

	public function autonumber($id)
	{
		$last = $this->m_barang->getLastItem('tb_stok', array('id_tempat' => $id))->row_array();
	}
}