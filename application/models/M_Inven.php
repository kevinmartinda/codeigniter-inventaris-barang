<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class M_Inven extends CI_Model
	{	
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		public function checkLogin($data)
		{
			$log = $this->db->get_where('tb_user', array('username' => $data['user'], 'password' => $data['pass']));
			$check = $log->num_rows();
				if ($check == 1) {
					$data = $log->row_array();
					return array('id' => $data['id'], 'status' => 'sukses');
				} else {
					return 0;
				}
		}

		public function _getPage($table, $param = null)
		{
			return $this->db->get_where($table, array('id' => $param));
		}

		public function _getTempat($table, $param)
		{
			return $this->db->get_where($table, array('id_tempat' => $param));
		}

		public function _getPinjam($table, $param)
		{
			return $this->db->get_where($table, array('tanggal' => $param));
		}

		public function _getAll($table)
		{
			return $this->db->get($table);
		}

		public function _getAllPlace($data)
		{
			return $this->db->get_where('tb_tempat', array('jenis' => $data));	
		}

		public function _getListTempat()
		{
			return $this->db->get('tb_jenis_tempat');
		}

		public function _getItem($id)
		{	
			$this->db->select('id, nama');
			return $this->db->get_where('tb_tempat', array('jenis' => $id));
		}

		public function getUser($data)
		{
			return $this->db->get_where('tb_user', array('id' => $data));
		}
	}