<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

    public function cek_auth()
	{
		$this->ci =& get_instance();
		$this->sesi  = $this->ci->session->userdata('isLogin');
		$this->hak = $this->ci->session->userdata('stat');
		if($this->sesi != TRUE){
			echo "<script>alert('Please, login before!');</script>";
			redirect(base_url(),'refresh');
			exit();
		}

	}

	// public function hak_akses($kecuali="")
	// {
 //    	if($this->hak==$kecuali){
 //    		echo "<script>alert('Anda tidak berhak mengakses halaman ini!');</script>";
 //    		redirect('dashboard');
 //    	}elseif ($this->hak=="") {
 //    		echo "<script>alert('Anda belum login!');</script>";
 //    		redirect('login');
 //    	}else{

 //    	}
	// }


}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */
