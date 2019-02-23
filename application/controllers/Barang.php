<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */

// Load library phpspreadsheet
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// End load library phpspreadsheet

class Barang extends CI_Controller
{ 
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->model('m_inven');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function get_barang_from($type, $times, $interval)
	{
		$data = $this->m_barang->get_barang_from($type, $times, $interval)->result_array();
		echo json_encode($data);
	}

	public function get_tata($id)
	{
		$data = $this->m_inven->_getPage('tb_barang', $id)->row_array();
		echo json_encode($data);
	}

	public function add_tata()
	{
		$this->load->model('crud');
		$data = array(
			'nama' => $this->input->post('nama_barang'),
			'tahun' => $this->input->post('tahun'),
			'merk' => $this->input->post('merk'),
			'kondisi' => $this->input->post('kondisi')
		);

		$insert = $this->crud->add('tb_barang', $data);
		redirect(base_url('index.php/tata-usaha'));
	}

	public function hapus_tata($id)
	{
		$this->load->model('crud');
		$this->crud->deleteData('tb_barang', array('id' => $id));
	}

	public function edit_tata($id)
	{
		$this->load->model('crud');
		
		$this->crud->updateData('tb_barang', $data, array('id' => $id));
	}

	public function pinjam()
	{
		$this->load->model('crud');
		$id_barang = $this->input->post('id_barang');
		$id_siswa = $this->input->post('id_siswa');
		$id_kelas = $this->input->post('id_tempat');
		$nama = $this->input->post('nama_siswa');
		$waktu = date("h:i:s");
		$tgl = date("Y-m-d");
		$data = array(
			'id_barang' => $id_barang,
			'id_siswa' => $id_siswa,
			'nama' => $nama,
			'id_kelas' => $id_kelas,
			'created_at' => $waktu,
			'tgl'	=> $tgl
		);

		$insert = $this->crud->add('tb_pinjam_alter', $data);
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


	public function search_lab($id, $keyword = null)		
	{
		if ($keyword != null) {
			$data = $this->m_barang->get_selected_item('v_stok', $id, $keyword)->result_array();
			if ($data != null) {
				echo json_encode($data);
			} else {
				$err = array("error" => "hasil tidak ditemukan");
				echo json_encode($err);
			}
		} else {
			$data = $this->m_barang->getAllBarang($id)->result_array();
			echo json_encode($data);
		}
	}

	public function export_excel($table, $id)
	{
		$q = $this->m_barang->_getPage('tb_tempat', array('id' => $id))->row_array();
		$tempat = preg_replace('~[ .]~', '', strtolower($q['nama']));
		$dt = date('d_M_Y_His');
		$data = $this->m_barang->getStok($table, $id)->result();
		// Create new Spreadsheet object
		$spreadsheet = new Spreadsheet();

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
		->setLastModifiedBy('Andoyo - Java Web Medi')
		->setTitle('Office 2007 XLSX Test Document')
		->setSubject('Office 2007 XLSX Test Document')
		->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
		->setKeywords('office 2007 openxml php')
		->setCategory('Test result file');

		// Add some data
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No')
		->setCellValue('B1', 'Nama Barang')
		->setCellValue('C1', 'Merk')
		->setCellValue('D1', 'Penginput')
		->setCellValue('E1', 'Warna')
		->setCellValue('F1', 'Tahun')
		->setCellValue('G1', 'Jumlah')
		->setCellValue('H1', 'Terakhir diubah')
		;

		// Miscellaneous glyphs, UTF-8
		$i=2; 
		$no = 1;
		foreach($data as $data) {
		$tgl = $data->tgl_edit == null ? $data->tgl_masuk : $data->tgl_edit;
		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A'.$i, $no)
		->setCellValue('B'.$i, $data->nama_barang)
		->setCellValue('C'.$i, $data->merk)
		->setCellValue('D'.$i, $data->nama_user)
		->setCellValue('E'.$i, $data->warna)
		->setCellValue('F'.$i, $data->tahun)
		->setCellValue('G'.$i, $data->jumlah)
		->setCellValue('H'.$i, $tgl)
		;
		$i++;
		$no++;
		}

		// Rename worksheet
		$spreadsheet->getActiveSheet()->setTitle('Laporan_');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$spreadsheet->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="laporan_'. $tempat . '_' . $dt . '.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
		exit;
	}
}