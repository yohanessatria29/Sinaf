<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_tes extends CI_Model {

  function getsurveior($title){
        $this->db->like('lpa_id','2');
        $this->db->like('nama', $title , 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
       return $this->db->get('user_surveior')->result();
      // echo $this->db->last_query();
    }

}