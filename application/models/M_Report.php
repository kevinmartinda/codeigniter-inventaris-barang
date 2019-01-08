<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_Report extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getItem($param)
	{
		$this->db->order_by('tgl_masuk', 'DESC');
		$this->db->order_by('nama_barang', 'ASC');
		return $this->db->get_where('v_transaksi', array('jenis' => $param));
	}

}