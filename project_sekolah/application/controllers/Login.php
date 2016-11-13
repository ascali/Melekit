<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * administrator to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Global_models'));
        $this->load->helper(array('form','html','url'));
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $session = $this->session->userdata('isLogin'); //take session what is already login or not ye
        if($session == FALSE) //if session false then show page login
        {
            //$config['content'] = 'login';
            // $this->lang->load('id','indonesia');
            $this->load->view('login');
        }else //if session true then redirect to page dashboard
        {
            redirect('administrator/dashboard');
        }
    }

    public function do_login()
    {    	
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $check = $this->Global_models->check_user($username, $password); //melakukan persamaan data dengan database

        // echo "<script> alert(test = ". count($check) .")</script>";
        if (count($check) == '1') {
            foreach ($check as $check) {
                    $id         = $check['id'];      //mengambil data user id dari database
                    $level      = $check['level'];   //mengambil data(level/hak akses) dari database
                    $username   = $check['username'];    //mengambil data nama user dari database
                }

            $dataSession = array(
                                    'isLogin'   => TRUE, //set data telah login
                                    'id'        => $id,
                                    'level'     => $level, //set session hak akses
                                    'username'  => $username
                                );
            $this->session->set_userdata($dataSession);

            if ($_SESSION['level'] == 'Administrator') {
            	// echo "<script> alert(Success Login as Administrator); </script>";
            	redirect('administrator/dashboard','refresh');
            } elseif ($_SESSION['level'] == 'Guest') {
            	// echo "<script> alert(Success Login as Guest); </script>";
            	redirect('administrator/dashboard','refresh');
            } else {
            	echo "<script> alert('error'); </script>";
            	redirect(base_url(),'refresh');
            }
        } elseif (count($check) == '0') {
            echo "<script> alert('User tidak ada dalam daftar')</script>";
            redirect(base_url(),'refresh');
        } else {
            echo "<script> alert('error'); </script>";
            redirect(base_url(),'refresh');
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        echo "<script> alert(Success Logout); </script>";
        redirect(base_url(),'refresh');
    }

}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */