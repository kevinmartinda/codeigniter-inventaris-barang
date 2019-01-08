<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function getHeader()
	{
		$lab = $this->m_inven->_getAllPlace('lab')->result_array();
		$k_7 = $this->m_inven->_getAllPlace('k_7')->result_array();
		$k_8 = $this->m_inven->_getAllPlace('k_8')->result_array();
		$k_9 = $this->m_inven->_getAllPlace('k_9')->result_array();
		$data = array(
			'lab' => $lab, 
			'k_7' => $k_7,
			'k_8' => $k_8,
			'k_9' => $k_9
		);
		$this->load->view('template/header.php');
		$this->load->view('template/sidebar.php', $data);
	}

function renderPage($page, $data = null)      //meload halaman tanpa data
	{
		getHeader();
		$this->load->view($page, $data);
		$this->load->view('template/footer.php');
	}