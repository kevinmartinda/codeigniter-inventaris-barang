<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('crud');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function editUsers($data)
	{
		$this->load->database();
		$res = $this->db->get_where('tb_user', $data)->result_array();
		$this->load->view('template/header.php');
		$this->load->view('template/sidebar.php');
		$this->load->view('v_user.php', $res);
		$this->load->view('template/footer.php');
	}

	public function updateUser($id)
	{
		$data = array(
			'user' => $this->input->post('user')
		);
		$con = array(
			'id' => $id
		);
		$check = $this->crud->updateData('tb_user', $data, $con);
		if ($check) {
			redirect("index.php/home/renderPage/user/");
		}
	}
}