<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tesauto extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->helper('url');

    // Load model
    $this->load->model('M_tes');

  }

  public function index(){
    // load view
    $this->load->view('tesauto');
  }

       function get_autocomplete_surveior(){
        if (isset($_GET['term'])) {
            $result = $this->M_tes->getsurveior($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'nama'          =>"$row->nama",
                    'label'        =>"$row->nama",
                );
                echo json_encode($arr_result);
            }
        }
    }

}