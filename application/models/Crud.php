<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Crud extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function getAll($table){
        $res=$this->db->get($table); 
        return $res->result_array(); 
    }
 
    public function insertData($table,$data){
        $res = $this->db->insert($table, $data); 
        return $res; 
    }
 
    public function updateData($table, $data, $where){
        $res = $this->db->update($table, $data, $where);  
        return $res;
    }
 
    public function deleteData($table, $where){
        $res = $this->db->delete($table, $where); 
        return $res;
    }

    function add($table, $data)
        {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
}