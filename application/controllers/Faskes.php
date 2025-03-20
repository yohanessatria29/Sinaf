<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faskes extends CI_Controller {
	function __construct(){
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Model_sina');
		$this->load->model('Model_viewdata');
		define('MB', 1048576);
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		
		// $data = array('content' =>'view_pengajuan_usulan_survei',
        //         'data' => $this->Model_viewdata->get_data_pengajuan()->result_array()
        //               );
		//$this->load->view('view_pengajuan_usulan_survei',$data);
		$this->load->view('pengajuan_usulan_faskes');
	}

// 	public function detail()
// 	{
// 		$id = $this->uri->segment(3);
// 		$data = array('content' =>'pengajuan_usulan_survei',
// 				'data' => $this->Model_sina->select_pengajuan($id),
// 				'id' => $id
//                       );
// 		$this->load->view('pengajuan_usulan_survei', $data);
// 	}

// 	public function hapus()
// 	{
// 		$id = $this->uri->segment(3);
// 		$this->Model_sina->delete_pengajuan($id);
// 		redirect('index.php/pengajuan');
// 	}
// public function ep()
// {
// $this->load->view('elemen_penilaian');
// }
}
