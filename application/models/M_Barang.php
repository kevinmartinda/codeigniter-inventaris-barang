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

	public function get_barang_from($type, $times, $interval)
	{
		$this->db->where("tgl_masuk between date_sub(curdate(), interval ".$times." ".$interval.") and curdate()+1");
		$this->db->or_where("tgl_edit between date_sub(curdate(), interval ".$times." ".$interval.") and curdate()+1");
		$this->db->having('jenis', $type);
		$this->db->order_by('id', 'DESC');
		return $this->db->get('v_transaksi');
	}

	public function getAllBarang($id)
	{
		$data = $this->db->get_where('v_stok', array('id_tempat' => $id, 'jumlah >' => 0));
		return $data;
	}

	public function getStok($table, $id)
	{
		$data = $this->db->get_where($table, array('id_tempat' => $id, 'jumlah >' => 0));
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

	public function get_selected_item($table, $id, $keyword)
	{
		$this->db->like('nama_user', $keyword); 
		$this->db->or_like('nama_barang', $keyword);
		$this->db->having("id_tempat", $id);
		return $this->db->get("v_stok");
	}
}