<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_Barang extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getAllBarang($id)
	{
		$data = $this->db->get_where('v_stok', array('id_tempat' => $id, 'jumlah >' => 0));
		return $data;
	}

	public function getBarangFrom($id)
	{
		return $this->get_where('tb_transaksi', array('id_tempat' => $id));
	}

	public function getLastItem($table, $where)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get_where($table, $where);
	}

	public function _getPage($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	public function getItem($table, $where = null)
	{
		return $this->db->get_where($table, $where);
	}

	public function _get_jumlah($id)
	{
		$this->db->select('jumlah');
		return $this->db->get_where('tb_stok', array('id' => $id));
	}

	public function checkItem($param)
	{
		return $this->db->get_where('tb_stok', $param);
	}
}