<?php 
  /**
   * 
   */
  class M_User extends CI_Model
  {
    
    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function getRows($where = array())
    {
      if (! empty($where))
      {
         $this->db->where($where);
         $query = $this->db->get('tb_user');
         if ($query->num_rows() > 0)
         {
            return $query->row_array();
         } 
       }
       else
       {
           $query = $this->db->get('tb_user');
           if ($query->num_rows() > 0)
           {
              return $query->result_array();
           } 
       }
    }

  }