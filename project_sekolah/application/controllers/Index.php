<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'html'));
	}

	// User //

	public function index()
	{
		$data['content'] = 'user/content';
		$this->load->view('user/index',$data);		
	}

	public function profil()
	{
		$data['content'] = 'user/profil';
		$this->load->view('user/index',$data);		
	}

	public function galeri()
	{
		$data['content'] = 'user/galeri';
		$this->load->view('user/index',$data);		
	}
	public function galeri_detail()
	{
		$data['content'] = 'user/galeri_detail';
		$this->load->view('user/index',$data);		
	}
	public function vidio()
	{
		$data['content'] = 'user/vidio';
		$this->load->view('user/index',$data);		
	}
	// Admin //

	public function Dashboard()
	{
		$data['content'] = 'vw_admin/content';
		$this->load->view('vw_admin/index',$data);		
	}

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */