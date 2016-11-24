<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Global_models');
		$this->load->helper(array('url', 'html', 'file'));
		$this->load->library('Auth');
		$this->auth->cek_auth(); //ngambil auth dari library
		date_default_timezone_set('Asia/Jakarta');
	}

	public function dashboard()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = '';
			$data['modals']	 = 'admin/modules/kategori_konten/kategori_konten_modal';
			$data['content'] = 'admin/modules/dashboard/content';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

/*============================================================================================================================*/
/* Mulai Model User */
/* Work by Asca */
/*============================================================================================================================*/

	public function admin()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'admin';
			$data['modals']	 = 'admin/modules/admin/admin_modal';
			$data['content'] = 'admin/modules/admin/admin';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function admin_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('admin');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function admin_edit_data($id)
    {
    	$this->db->from('admin');
			$this->db->where('id',$id);
			$query = $this->db->get();
			if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

	public function admin_add()
	{
		$this->_validate_admin();

		$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'create' => date('Y-m-d H:i:s'),
				'update' => date('Y-m-d H:i:s'),
			);

		if(!empty($_FILES['foto']['name']))
		{
			$upload = $this->admin_do_upload();
			$data['foto'] = $upload;
		}

		$dbInsert = $this->db->insert('admin', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function admin_update()
	{
		$this->_validate_admin();
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'update' => date('Y-m-d H:i:s'),
			);

		if($this->input->post('remove_foto')) // if remove photo_user checked
		{
			if(file_exists('public/admin/img/admin/'.$this->input->post('remove_foto')) && $this->input->post('remove_foto'))
				unlink('public/admin/img/admin/'.$this->input->post('remove_foto'));
			$data['foto'] = '';
		}

		if(!empty($_FILES['foto']['name']))
		{
			$upload = $this->admin_do_upload();

			//delete file
			$admin = $this->Global_models->admin_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/admin/'.$admin->foto) && $admin->foto)
				unlink('public/admin/img/admin/'.$admin->foto);

			$data['foto'] = $upload;
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('admin', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function admin_delete($id)
	{
		//delete file
		$admin = $this->Global_models->admin_get_by_id($id);
		if(file_exists('public/admin/img/admin/'.$admin->foto) && $admin->foto)
			unlink('public/admin/img/admin/'.$admin->foto);

		$this->db->where('id', $id);
    	$this->db->delete('admin');
    	echo json_encode(array("status" => TRUE));
	}

	private function admin_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/admin/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('foto')) //upload and validate
        {
            $data['inputerror'][] = 'foto';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

    // Untuk Validasi
    private function _validate_admin()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Admin is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password is required ';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}

/*============================================================================================================================*/
/* Akhir Model User */
/*============================================================================================================================*/


//====================================================================================//
// Mulai Bagian Kategori Konten
/* Work by Ibnu */
//====================================================================================//

	public function kategori_konten()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'kategori_konten';
			$data['modals']	 = 'admin/modules/kategori_konten/kategori_konten_modal';
			$data['content'] = 'admin/modules/kategori_konten/kategori_konten';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function kategori_konten_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('kategori_konten');
    	// $query = $this->db->query('SELECT a.*, b.nama as nama_menu, c.nama as nama_submenu FROM kategori_konten a
    								// LEFT JOIN menu b ON(a.id_menu=b.id AND a.status_kategori_konten="menu")
    								// LEFT JOIN submenu c ON(a.id_menu=c.id AND a.status_kategori_konten="submenu") ORDER BY a.id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function kategori_konten_edit_data($id)
    {
    	$this->db->from('kategori_konten');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function kategori_konten_insert_data()
    {
    	$this->_validate_kategori_konten();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('kategori_konten', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function kategori_konten_update_data()
    {
		$this->_validate_kategori_konten();
		$data = array(
				'nama' => $this->input->post('nama'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('kategori_konten', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function kategori_konten_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('kategori_konten');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_kategori_konten()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}

//====================================================================================//
// Akhir Bagian Kategori Konten
//====================================================================================//

//====================================================================================//
// Mulai Bagian Visi Misi
/* Work by Ibnu */
//====================================================================================//

	public function visi_misi()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'visi_misi';
			$data['modals']	 = 'admin/modules/visi_misi/visi_misi_modal';
			$data['content'] = 'admin/modules/visi_misi/visi_misi';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function visi_misi_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('profil');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function visi_misi_edit_data($id)
    {
    	$this->db->from('profil');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function visi_misi_insert_data()
    {
    	$this->_validate_visi_misi();
    	$data = array(
				'visi' => $this->input->post('visi'),
				'misi' => $this->input->post('misi'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('profil', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function visi_misi_update_data()
    {
		$this->_validate_visi_misi();
		$data = array(
				'visi' => $this->input->post('visi'),
				'misi' => $this->input->post('misi'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('profil', $data);
		echo json_encode(array('status' => TRUE));
    }

    // Untuk Validasi
    private function _validate_visi_misi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('visi') == '')
		{
			$data['inputerror'][] = 'visi';
			$data['error_string'][] = 'Visi is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('misi') == '')
		{
			$data['inputerror'][] = 'misi';
			$data['error_string'][] = 'Misi is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Visi Misi
//====================================================================================//

//====================================================================================//
// Mulai Bagian Kelas
/* Work by Ibnu */
//====================================================================================//

	public function kelas()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'kelas';
			$data['modals']	 = 'admin/modules/kelas/kelas_modal';
			$data['content'] = 'admin/modules/kelas/kelas';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function kelas_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('kelas');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function kelas_edit_data($id)
    {
    	$this->db->from('kelas');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function kelas_insert_data()
    {
    	$this->_validate_kelas();
    	$data = array(
				'nama' => $this->input->post('kelas'),
				'tingkat_kelas' => $this->input->post('tingkat_kelas'),
				'wali_kelas' => $this->input->post('wali_kelas'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('kelas', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function kelas_update_data()
    {
		$this->_validate_kelas();
		$data = array(
				'nama' => $this->input->post('kelas'),
				'tingkat_kelas' => $this->input->post('tingkat_kelas'),
				'wali_kelas' => $this->input->post('wali_kelas'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('kelas', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function kelas_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('kelas');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_kelas()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kelas') == '')
		{
			$data['inputerror'][] = 'kelas';
			$data['error_string'][] = 'Nama Kelas is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('tingkat_kelas') == '')
		{
			$data['inputerror'][] = 'tingkat_kelas';
			$data['error_string'][] = 'Tingkat Kelas is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('wali_kelas') == '')
		{
			$data['inputerror'][] = 'wali_kelas';
			$data['error_string'][] = 'Wali Kelas is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Kelas
//====================================================================================//

//====================================================================================//
// Mulai Bagian Konten
/* Work by Ibnu */
//====================================================================================//

	public function konten()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'konten';
			$data['modals']	 = 'admin/modules/konten/konten_modal';
			$data['content'] = 'admin/modules/konten/konten';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function konten_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('konten');
    	// $query = $this->db->query('SELECT * FROM kontens ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function konten_edit_data($id)
    {
    	$this->db->from('konten');
			$this->db->where('id',$id);
			$query = $this->db->get();
			if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

	public function konten_add()
	{
		$this->_validate_konten();

		$data = array(
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'id_kategori_konten' => $this->input->post('id_kategori_konten'),
				'create_by' => $this->input->post('create_by'),
				'created' => $this->input->post('created'),
				'updated' => $this->input->post('updated'),
			);

		if(!empty($_FILES['gambar']['name']))
		{
			$upload = $this->konten_do_upload();
			$data['gambar'] = $upload;
		}

		$dbInsert = $this->db->insert('konten', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function konten_update()
	{
		$this->_validate_konten();
		$data = array(
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'id_kategori_konten' => $this->input->post('id_kategori_konten'),
				'create_by' => $this->input->post('create_by'),
				'updated' => $this->input->post('updated'),
			);

		if($this->input->post('remove_gambar')) // if remove gambar checked
		{
			if(file_exists('public/admin/img/konten/'.$this->input->post('remove_gambar')) && $this->input->post('remove_gambar'))
				unlink('public/admin/img/konten/'.$this->input->post('remove_gambar'));
			$data['gambar'] = '';
		}

		if(!empty($_FILES['gambar']['name']))
		{
			$upload = $this->konten_do_upload();

			//delete file
			$konten = $this->Global_models->konten_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/konten/'.$konten->gambar) && $konten->gambar)
				unlink('public/admin/img/konten/'.$konten->gambar);

			$data['gambar'] = $upload;
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('konten', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function konten_delete($id)
	{
		//delete file
		$konten = $this->Global_models->konten_get_by_id($id);
		if(file_exists('public/admin/img/konten/'.$konten->gambar) && $konten->gambar)
			unlink('public/admin/img/konten/'.$konten->gambar);

		$this->db->where('id', $id);
    	$this->db->delete('konten');
    	echo json_encode(array("status" => TRUE));
	}

	private function konten_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/konten/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
            $data['inputerror'][] = 'gambar';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

    // Untuk Validasi
    private function _validate_konten()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('judul') == '')
		{
			$data['inputerror'][] = 'judul';
			$data['error_string'][] = 'Judul is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('isi') == '')
		{
			$data['inputerror'][] = 'isi';
			$data['error_string'][] = 'Isi is required';
			$data['status'] = FALSE;
		}
		// if($this->input->post('id_kategori_konten') == '')
		// {
		// 	$data['inputerror'][] = 'kategori_konten';
		// 	$data['error_string'][] = 'Kategori Konten is required';
		// 	$data['status'] = FALSE;
		// }
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Konten
//====================================================================================//

//====================================================================================//
// Mulai Bagian Menu
/* Work by Ibnu */
//====================================================================================//

	public function menu()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'menu';
			$data['modals']	 = 'admin/modules/menu/menu_modal';
			$data['content'] = 'admin/modules/menu/menu';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function menu_data()
	{
    	$this->db->order_by('id', 'desc');
    	// $query = $this->db->get('menu');
    	$query = $this->db->query('SELECT * FROM menu ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function menu_edit_data($id)
    {
    	$this->db->from('menu');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function menu_insert_data()
    {
    	$this->_validate_menu();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'href' => $this->input->post('href'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

			$dbInsert = $this->db->insert('menu', $data);
			echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function menu_update_data()
    {
			$this->_validate_menu();
			$data = array(
					'nama' => $this->input->post('nama'),
					'href' => $this->input->post('href'),
					'updated' => date('Y-m-d H:i:s')
				);

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('menu', $data);
			echo json_encode(array('status' => TRUE));
    }

    public function menu_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('menu');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_menu()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('href') == '')
		{
			$data['inputerror'][] = 'href';
			$data['error_string'][] = 'Link href is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Menu
//====================================================================================//

//====================================================================================//
// Mulai Bagian Submenu
/* Work by Ibnu */
//====================================================================================//

	public function submenu()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'submenu';
			$data['modals']	 = 'admin/modules/submenu/submenu_modal';
			$data['content'] = 'admin/modules/submenu/submenu';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function submenu_data()
	{
    	// $this->db->order_by('id', 'desc');
    	// $query = $this->db->get('submenu');
    	$query = $this->db->query('SELECT a.*, b.nama as nama_menu FROM submenu AS a 
    								JOIN menu AS b ON a.id_menu = b.id ORDER BY a.id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function submenu_edit_data($id)
    {
    	$this->db->from('submenu');
			$this->db->where('id',$id);
			$query = $this->db->get();
			if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function submenu_insert_data()
    {
    	$this->_validate_submenu();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'href' => $this->input->post('href'),
				'id_menu' => $this->input->post('id_menu'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('submenu', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function submenu_update_data()
    {
		$this->_validate_submenu();
		$data = array(
				'nama' => $this->input->post('nama'),
				'href' => $this->input->post('href'),
				'id_menu' => $this->input->post('id_menu'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('submenu', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function submenu_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('submenu');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_submenu()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('href') == '')
		{
			$data['inputerror'][] = 'href';
			$data['error_string'][] = 'Link href is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Submenu
//====================================================================================//

//====================================================================================//
// Mulai Bagian Vidio
/* Work by Ibnu */
//====================================================================================//

	public function vidio()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'vidio';
			$data['modals']	 = 'admin/modules/vidio/vidio_modal';
			$data['content'] = 'admin/modules/vidio/vidio';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function vidio_data()
	{
    	// $this->db->order_by('id', 'desc');
    	// $query = $this->db->get('video');
    	$query = $this->db->query('SELECT a.*,b.nama as nama_galeri FROM video a
    							   LEFT JOIN galeri b ON(a.id_galeri=b.id) ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function vidio_edit_data($id)
    {
    	$this->db->from('video');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function vidio_insert_data()
    {
    	$this->_validate_vidio();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'path' => $this->input->post('link'),
				'id_galeri' => $this->input->post('id_galeri'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('video', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function vidio_update_data()
    {
		$this->_validate_vidio();
		$data = array(
				'nama' => $this->input->post('nama'),
				'path' => $this->input->post('link'),
				'id_galeri' => $this->input->post('id_galeri'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('video', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function vidio_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('video');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_vidio()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('link') == '')
		{
			$data['inputerror'][] = 'link';
			$data['error_string'][] = 'Link vidio is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_galeri') == '')
		{
			$data['inputerror'][] = 'id_galeri';
			$data['error_string'][] = 'Kategori vidio is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Vidio
//====================================================================================//

//====================================================================================//
// Mulai Bagian Siswa
/* Work by Ibnu */
//====================================================================================//

	public function siswa()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'siswa';
			$data['modals']	 = 'admin/modules/siswa/siswa_modal';
			$data['content'] = 'admin/modules/siswa/siswa';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function siswa_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('siswa');
    	// $query = $this->db->query('SELECT a.*, b.nama as nama_kelas, b.wali_kelas FROM siswa a
    								// LEFT JOIN kelas b ON(a.id_kelas=b.id) ORDER BY a.id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function siswa_edit_data($id)
    {
    	$this->db->from('siswa');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function siswa_insert_data()
    {
    	$this->_validate_siswa();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'id_jurusan' => $this->input->post('id_jurusan'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('siswa', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function siswa_update_data()
    {
		$this->_validate_siswa();
		$data = array(
				'nama' => $this->input->post('nama'),
				'nis' => $this->input->post('nis'),
				'kelas' => $this->input->post('kelas'),
				'id_jurusan' => $this->input->post('id_jurusan'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('siswa', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function siswa_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('siswa');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_siswa()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('kelas') == '')
		{
			$data['inputerror'][] = 'kelas';
			$data['error_string'][] = 'Kelas is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('nis') == '')
		{
			$data['inputerror'][] = 'nis';
			$data['error_string'][] = 'NIS is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_jurusan') == '')
		{
			$data['inputerror'][] = 'id_jurusan';
			$data['error_string'][] = 'Jurusan is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Kategori Siswa
//====================================================================================//

//====================================================================================//
// Mulai Bagian Komen
/* Work by Ibnu */
//====================================================================================//

	public function komentar()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'komen';
			$data['modals']	 = 'admin/modules/komen/komen_modal';
			$data['content'] = 'admin/modules/komen/komen';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function komen_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('komen');
    	// $query = $this->db->query('SELECT a.*, b.nama as nama_kelas, b.wali_kelas FROM komen a
    	// 							LEFT JOIN kelas b ON(a.id_kelas=b.id) ORDER BY a.id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function komen_edit_data($id)
    {
    	$this->db->from('komen');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function komen_insert_data()
    {
    	$this->_validate_komen();
    	$data = array(
				'oleh' => $this->input->post('oleh'),
				'email' => $this->input->post('email'),
				'date' => date('Y-m-d'),
				'isi' => $this->input->post('isi'),
				'status_publish' => $this->input->post('status'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('komen', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function komen_update_data()
    {
		$this->_validate_komen();
		$data = array(
				'oleh' => $this->input->post('oleh'),
				'email' => $this->input->post('email'),
				'date' => date('Y-m-d'),
				'isi' => $this->input->post('isi'),
				'status_publish' => $this->input->post('status'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('komen', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function komen_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('komen');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_komen()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('oleh') == '')
		{
			$data['inputerror'][] = 'oleh';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('isi') == '')
		{
			$data['inputerror'][] = 'isi';
			$data['error_string'][] = 'Isi Komentar is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('status') == '')
		{
			$data['inputerror'][] = 'status';
			$data['error_string'][] = 'Status Komentar is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Kategori komen
//====================================================================================//

//====================================================================================//
// Mulai Bagian Galeri
/* Work by Ibnu */
//====================================================================================//

	public function galeri()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'galeri';
			$data['modals']	 = 'admin/modules/galeri/galeri_modal';
			$data['content'] = 'admin/modules/galeri/galeri';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function galeri_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('galeri');
    	// $query = $this->db->query('SELECT a.*, b.nama as nama_kelas, b.wali_kelas FROM galeri a
    	// 							LEFT JOIN kelas b ON(a.id_kelas=b.id) ORDER BY a.id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function galeri_edit_data($id)
    {
    	$this->db->from('galeri');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function galeri_insert_data()
    {
    	$this->_validate_galeri();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'type' => $this->input->post('tipe'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('galeri', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function galeri_update_data()
    {
		$this->_validate_galeri();
		$data = array(
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'type' => $this->input->post('tipe'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('galeri', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function galeri_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('galeri');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_galeri()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('keterangan') == '')
		{
			$data['inputerror'][] = 'keterangan';
			$data['error_string'][] = 'Keterangan is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('tipe') == '')
		{
			$data['inputerror'][] = 'tipe';
			$data['error_string'][] = 'Tipe is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Kategori Galeri
//====================================================================================//

//====================================================================================//
// Mulai Bagian Gambar
// by Ascal
//====================================================================================//
	function gambar()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'gambar';
			$data['modals']	 = 'admin/modules/gambar/gambar_modal';
			$data['content'] = 'admin/modules/gambar/gambar';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	function gambar_data()
	{
			// $this->db->order_by('id', 'desc');
			// $query = $this->db->get('gambar');
			$query = $this->db->query('SELECT a.*,b.nama as nama_galeri, c.judul as nama_konten FROM gambar a
									   LEFT JOIN galeri b ON(a.id_galeri=b.id)
									   LEFT JOIN konten c ON(a.id_konten=c.id) ORDER BY id DESC');
			$query = $query->result();
			if (isset($query)) {
				$status = 'success';
				$query = $query;
			}else {
				$status = 'error';
				$query = 'error';
			}
			header('Content-Type: application/json');
			echo json_encode(array('status' => $status, 'data' => $query));
	}

	function gambar_edit_data($id)
	{
			$this->db->from('gambar');
			$this->db->where('id', $id);
			$query = $this->db->get();
			if (isset($query)) {
				$status = 'success';
				$query = $query;
			}else {
				$status = 'error';
				$query = 'error';
			}
			$query = $query->row();
			header('Content-Type: application/json');
			echo json_encode(array('status' => $status, 'data' => $query));
		}

	function gambar_add()
	{
		$this->_validate_gambar();
		$data = array(
				'nama' => $this->input->post('nama'),
				'id_konten' => $this->input->post('id_konten'),
				'id_galeri' => $this->input->post('id_galeri'),
				'keterangan' => $this->input->post('keterangan'),
				'status_slide' => $this->input->post('status_slide'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s'),
			);

		if(!empty($_FILES['file']['name']))
		{
			$upload = $this->gambar_do_upload();
			$data['file'] = $upload;
		}

		$dbInsert = $this->db->insert('gambar', $data);
		echo json_encode(array('status' => TRUE));
	}

	function gambar_update()
	{
		$this->_validate_gambar();
		$data = array(
			'nama' => $this->input->post('nama'),
			'id_konten' => $this->input->post('id_konten'),
			'id_galeri' => $this->input->post('id_galeri'),
			'keterangan' => $this->input->post('keterangan'),
				'status_slide' => $this->input->post('status_slide'),
			'updated' => date('Y-m-d H:i:s'),
			);

		if($this->input->post('remove_gambar')) // if remove photo_user checked
		{
			if(file_exists('public/admin/img/gambar/'.$this->input->post('remove_gambar')) && $this->input->post('remove_gambar'))
				unlink('public/admin/img/gambar/'.$this->input->post('remove_gambar'));
			$data['file'] = '';
		}

		if(!empty($_FILES['file']['name']))
		{
			$upload = $this->gambar_do_upload();

			//delete file
			$gambar = $this->Global_models->gambar_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/gambar/'.$gambar->file) && $gambar->file)
				unlink('public/admin/img/gambar/'.$gambar->file);

			$data['file'] = $upload;
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('gambar', $data);
		echo json_encode(array('status' => TRUE));
	}

	function gambar_delete($id)
	{
		//delete file
		$gambar = $this->Global_models->gambar_get_by_id($id);
		if(file_exists('public/admin/img/gambar/'.$gambar->file) && $gambar->file)
			unlink('public/admin/img/gambar/'.$gambar->file);

		$this->db->where('id', $id);
			$this->db->delete('gambar');
			echo json_encode(array("status" => TRUE));
	}

	private function gambar_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/gambar/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048; //set max size allowed in Kilobyte
		$config['max_width']            = 99999; // set max width image allowed
		$config['max_height']           = 99999; // set max height allowed
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

		$this->upload->initialize($config);
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('file')) //upload and validate
		{
			$data['inputerror'][] = 'file';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

		// Untuk Validasi
	private function _validate_gambar()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'nama is required';
			$data['status'] = FALSE;
		}

		// if($this->input->post('id_konten') == '')
		// {
		// 	$data['inputerror'][] = 'id_konten';
		// 	$data['error_string'][] = 'Konten is required ';
		// 	$data['status'] = FALSE;
		// }

		// if($this->input->post('id_galeri') == '')
		// {
		// 	$data['inputerror'][] = 'id_galeri';
		// 	$data['error_string'][] = 'Galeri is required';
		// 	$data['status'] = FALSE;
		// }

		if($this->input->post('status_slide') == '')
		{
			$data['inputerror'][] = 'status_slide';
			$data['error_string'][] = 'Status Slide is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}

//====================================================================================//
// Akhir Bagian Gambar
//====================================================================================//

/*============================================================================================================================*/
/* Mulai Model Pengaturan */
/* Work by Afiys */
/*============================================================================================================================*/

	public function pengaturan()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'pengaturan';
			$data['modals']	 = 'admin/modules/pengaturan/pengaturan_modal';
			$data['content'] = 'admin/modules/pengaturan/pengaturan';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function pengaturan_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('pengaturan');
    	//$query = $this->db->query('SELECT * FROM pengaturan WHERE id=1');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function pengaturan_edit_data($id)
    {
    	$this->db->from('pengaturan');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

	public function pengaturan_add()
	{
		$this->_validate_pengaturan();

		$data = array(
				'nama_judul' => $this->input->post('judul'),
				'copy_right' => $this->input->post('copy_right'),
				'keterangan' => $this->input->post('keterangan'),
				'created' => 'admin',
				'updated' => 'admin'
			);

		if(!empty($_FILES['favicon']['name']))
		{
			$upload = $this->pengaturan_do_upload();
			$data['favicon'] = $upload;
		}

		$dbInsert = $this->db->insert('pengaturan', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function pengaturan_update()
	{
		$this->_validate_pengaturan();
		$data = array(
				'nama_judul' => $this->input->post('judul'),
				'keterangan' => $this->input->post('keterangan'),
				'copy_right' => $this->input->post('copy_right'),
				'updated' => date('Y-m-d H:i:s')
			);

		if($this->input->post('remove_favicon')) // if remove photo_user checked
		{
			if(file_exists('public/admin/img/pengaturan/'.$this->input->post('remove_favicon')) && $this->input->post('remove_favicon'))
				unlink('public/admin/img/pengaturan/'.$this->input->post('remove_favicon'));
			$data['favicon'] = '';
		}

		if(!empty($_FILES['favicon']['name']))
		{
			$upload = $this->pengaturan_do_upload();

			//delete file
			$favicon = $this->Global_models->pengaturan_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/pengaturan/'.$favicon->favicon) && $favicon->favicon)
				unlink('public/admin/img/pengaturan/'.$favicon->favicon);

			$data['favicon'] = $upload;
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('pengaturan', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function pengaturan_delete($id)
	{
		//delete file
		$favicon = $this->Global_models->pengaturan_get_by_id($id);
		if(file_exists('public/admin/img/pengaturan/'.$favicon->favicon) && $favicon->favicon)
			unlink('public/admin/img/pengaturan/'.$favicon->favicon);

		$this->db->where('id', $id);
    	$this->db->delete('pengaturan');
    	echo json_encode(array("status" => TRUE));
	}

	private function pengaturan_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/pengaturan/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('favicon')) //upload and validate
        {
            $data['inputerror'][] = 'favicon';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

    // Untuk Validasi
    private function _validate_pengaturan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('judul') == '')
		{
			$data['inputerror'][] = 'judul';
			$data['error_string'][] = 'Judul is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('keterangan') == '')
		{
			$data['inputerror'][] = 'keterangan';
			$data['error_string'][] = 'Keterangan is required ';
			$data['status'] = FALSE;
		}

		if($this->input->post('copy_right') == '')
		{
			$data['inputerror'][] = 'copy_right';
			$data['error_string'][] = 'Copy Right is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}

/*============================================================================================================================*/
/* Akhir Model Pengaturan */
/*============================================================================================================================*/

/*============================================================================================================================*/
/* Mulai Model Profil */
/* Work by Afiys */
/*============================================================================================================================*/

	public function profil()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'profil';
			$data['modals']	 = 'admin/modules/profil/profil_modal';
			$data['content'] = 'admin/modules/profil/profil';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function profil_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('profil');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));	
	}

    public function profil_edit_data($id)
    {
    	$this->db->from('profil');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

	public function profil_add()
	{
		$this->_validate_profil();
		
		$data = array(
				'nama' => $this->input->post('nama'),
				'kepala_sekolah' => $this->input->post('kepala_sekolah'),
				'telp' => $this->input->post('telp'),
				'email' => $this->input->post('email'),
				'sejarah' => $this->input->post('sejarah'),
				'program_kerja' => $this->input->post('program_kerja'),
				'fasilitas' => $this->input->post('fasilitas'),
				'prestasi_sekolah' => $this->input->post('prestasi_sekolah'),
				'alamat' => $this->input->post('alamat'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		if(!empty($_FILES['struktur_organisasi']['name']))
		{
			$upload = $this->profilstruktur_do_upload();
			$data['struktur_organisasi'] = $upload;
		}

		if(!empty($_FILES['logo']['name']))
		{
			$upload = $this->profillogo_do_upload();
			$data['logo'] = $upload;
		}

		$dbInsert = $this->db->insert('profil', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function profil_update()
	{
		$this->_validate_profil();
		$data = array(
				'nama' => $this->input->post('nama'),
				'kepala_sekolah' => $this->input->post('kepala_sekolah'),
				'telp' => $this->input->post('telp'),
				'email' => $this->input->post('email'),
				'sejarah' => $this->input->post('sejarah'),
				'program_kerja' => $this->input->post('program_kerja'),
				'fasilitas' => $this->input->post('fasilitas'),
				'prestasi_sekolah' => $this->input->post('prestasi_sekolah'),
				'alamat' => $this->input->post('alamat'),
				'updated' => date('Y-m-d H:i:s')
			);

		if($this->input->post('remove_profil')) // if remove photo_user checked
		{
			if(file_exists('public/admin/img/profil/'.$this->input->post('remove_profil')) && $this->input->post('remove_profil') )
				unlink('public/admin/img/profil/'.$this->input->post('remove_profil'));
			$data['logo'] = '';
		}

		if($this->input->post('remove_struktur_organisasi')) // if remove photo_user checked
		{
			if(file_exists('public/admin/img/profil/'.$this->input->post('remove_struktur_organisasi')) && $this->input->post('remove_struktur_organisasi') )
				unlink('public/admin/img/profil/'.$this->input->post('remove_struktur_organisasi'));
			$data['struktur_organisasi'] = '';
		}

		if(!empty($_FILES['logo']['name']))
		{
			$upload = $this->profillogo_do_upload();
			
			//delete file
			$logo = $this->Global_models->profil_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/profil/'.$logo->logo) && $logo->logo)
				unlink('public/admin/img/profil/'.$logo->logo);

			$data['logo'] = $upload;
		}

		if(!empty($_FILES['struktur_organisasi']['name']))
		{
			$upload = $this->profilstruktur_do_upload();
			
			//delete file
			$str_org = $this->Global_models->str_org_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/profil/'.$str_org->struktur_organisasi) && $str_org->struktur_organisasi)
				unlink('public/admin/img/profil/'.$str_org->struktur_organisasi);

			$data['struktur_organisasi'] = $upload;
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('profil', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function profil_delete($id)
	{
		//delete file
		$logo = $this->Global_models->profil_get_by_id($id);
		if(file_exists('public/admin/img/profil/'.$logo->logo) && $logo->logo)
			unlink('public/admin/img/profil/'.$logo->logo);

				//delete file
		$struktur_organisasi = $this->Global_models->profil_get_by_id($id);
		if(file_exists('public/admin/img/profil/'.$struktur_organisasi->struktur_organisasi) && $struktur_organisasi->struktur_organisasi)
			unlink('public/admin/img/profil/'.$struktur_organisasi->struktur_organisasi);
		
		$this->db->where('id', $id);
    	$this->db->delete('profil');
    	echo json_encode(array("status" => TRUE));
	}

	private function profillogo_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/profil/';
        $config['allowed_types']        = 'png|jpg|gif';
        $config['max_size']             = 9999; //set max size allowed in Kilobyte
        $config['max_width']            = 9999; // set max width image allowed
        $config['max_height']           = 9999; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('logo')) //upload and validate
        {
            $data['inputerror'][] = 'logo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function profilstruktur_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/profil/';
        $config['allowed_types']        = 'png|jpg|gif';
        $config['max_size']             = 9999; //set max size allowed in Kilobyte
        $config['max_width']            = 9999; // set max width image allowed
        $config['max_height']           = 9999; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('struktur_organisasi')) //upload and validate
        {
            $data['inputerror'][] = 'struktur_organisasi';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

    // Untuk Validasi
    private function _validate_profil()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('kepala_sekolah') == '')
		{
			$data['inputerror'][] = 'kepala_sekolah';
			$data['error_string'][] = 'Kepala Sekolah is required ';
			$data['status'] = FALSE;
		}
		if($this->input->post('telp') == '')
		{
			$data['inputerror'][] = 'telp';
			$data['error_string'][] = 'No Telpon Sekolah is required ';
			$data['status'] = FALSE;
		}
		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email Sekolah is required ';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
/*============================================================================================================================*/
/* Akhir Model Pengaturan */
/*============================================================================================================================*/

//====================================================================================//
// Mulai Bagian Galeri
/* Work by Ibnu */
//====================================================================================//

	public function registrasi()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'registrasi';
			$data['modals']	 = 'admin/modules/registrasi/registrasi_modal';
			$data['content'] = 'admin/modules/registrasi/registrasi';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function registrasi_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('registrasi');
    	// $query = $this->db->query('SELECT a.*, b.nama as nama_kelas, b.wali_kelas FROM registrasi a
    	// 							LEFT JOIN kelas b ON(a.id_kelas=b.id) ORDER BY a.id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function registrasi_edit_data($id)
    {
    	$this->db->from('registrasi');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function registrasi_insert_data()
    {
    	$this->_validate_registrasi();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'type' => $this->input->post('tipe'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('registrasi', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function registrasi_update_data()
    {
		$this->_validate_registrasi();
		$data = array(
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'type' => $this->input->post('tipe'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('registrasi', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function registrasi_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('registrasi');
    	echo json_encode(array("status" => TRUE));
    }
    // Untuk Validasi
    private function _validate_registrasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('keterangan') == '')
		{
			$data['inputerror'][] = 'keterangan';
			$data['error_string'][] = 'Keterangan is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('tipe') == '')
		{
			$data['inputerror'][] = 'tipe';
			$data['error_string'][] = 'Tipe is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Kategori registrasi
//====================================================================================//
/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */

//====================================================================================//
// Mulai Bagian Agenda
/* Work by Ibnu */
//====================================================================================//

	public function agenda()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'agenda';
			$data['modals']	 = 'admin/modules/agenda/agenda_modal';
			$data['content'] = 'admin/modules/agenda/agenda';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function agenda_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('agenda');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function agenda_edit_data($id)
    {
    	$this->db->from('agenda');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function agenda_insert_data()
    {
    	$this->_validate_agenda();
    	$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'acara' => $this->input->post('acara'),
				'kegiatan' => $this->input->post('kegiatan'),
				'tempat' => $this->input->post('tempat'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('agenda', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function agenda_update_data()
    {
		$this->_validate_agenda();
		$data = array(
				'tanggal' => $this->input->post('tanggal'),
				'acara' => $this->input->post('acara'),
				'kegiatan' => $this->input->post('kegiatan'),
				'tempat' => $this->input->post('tempat'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('agenda', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function agenda_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('agenda');
    	echo json_encode(array("status" => TRUE));
    }

    // Untuk Validasi
    private function _validate_agenda()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('tanggal') == '')
		{
			$data['inputerror'][] = 'tanggal';
			$data['error_string'][] = 'Tanggal is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('acara') == '')
		{
			$data['inputerror'][] = 'acara';
			$data['error_string'][] = 'Acara is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('kegiatan') == '')
		{
			$data['inputerror'][] = 'kegiatan';
			$data['error_string'][] = 'Kegiatan is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('tempat') == '')
		{
			$data['inputerror'][] = 'tempat';
			$data['error_string'][] = 'Tempat is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Agenda
//====================================================================================//

//====================================================================================//
// Mulai Bagian Kemitraan
/* Work by Ibnu */
//====================================================================================//

	public function kemitraan()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'kemitraan';
			$data['modals']	 = 'admin/modules/kemitraan/kemitraan_modal';
			$data['content'] = 'admin/modules/kemitraan/kemitraan';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function kemitraan_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('kemitraan');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function kemitraan_edit_data($id)
    {
    	$this->db->from('kemitraan');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function kemitraan_insert_data()
    {
    	$this->_validate_kemitraan();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'id_jurusan' => $this->input->post('id_jurusan'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('kemitraan', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function kemitraan_update_data()
    {
		$this->_validate_kemitraan();
		$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'id_jurusan' => $this->input->post('id_jurusan'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('kemitraan', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function kemitraan_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('kemitraan');
    	echo json_encode(array("status" => TRUE));
    }

    // Untuk Validasi
    private function _validate_kemitraan()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_jurusan') == '')
		{
			$data['inputerror'][] = 'id_jurusan';
			$data['error_string'][] = 'Jurusan is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Kemitraan
//====================================================================================//

//====================================================================================//
// Mulai Bagian Detail kelas
/* Work by Ibnu */
//====================================================================================//

	public function detail_kelas()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'detail_kelas';
			$data['modals']	 = 'admin/modules/detail_kelas/detail_kelas_modal';
			$data['content'] = 'admin/modules/detail_kelas/detail_kelas';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function detail_kelas_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('detail_kelas');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function detail_kelas_edit_data($id)
    {
    	$this->db->from('detail_kelas');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function detail_kelas_insert_data()
    {
    	$this->_validate_detail_kelas();
    	$data = array(
				'kelas' => $this->input->post('kelas'),
				'id_jurusan' => $this->input->post('id_jurusan'),
				'jumlah_room' => $this->input->post('jumlah_room'),
				'rata_siswa' => $this->input->post('rata_siswa'),
				'jumlah' => $this->input->post('jumlah'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('detail_kelas', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function detail_kelas_update_data()
    {
		$this->_validate_detail_kelas();
		$data = array(
				'kelas' => $this->input->post('kelas'),
				'id_jurusan' => $this->input->post('id_jurusan'),
				'jumlah_room' => $this->input->post('jumlah_room'),
				'rata_siswa' => $this->input->post('rata_siswa'),
				'jumlah' => $this->input->post('jumlah'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('detail_kelas', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function detail_kelas_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('detail_kelas');
    	echo json_encode(array("status" => TRUE));
    }

    // Untuk Validasi
    private function _validate_detail_kelas()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kelas') == '')
		{
			$data['inputerror'][] = 'kelas';
			$data['error_string'][] = 'Kelas is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('id_jurusan') == '')
		{
			$data['inputerror'][] = 'id_jurusan';
			$data['error_string'][] = 'Jurusan is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('jumlah_room') == '')
		{
			$data['inputerror'][] = 'jumlah_room';
			$data['error_string'][] = 'Jumlah Ruangan is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('rata_siswa') == '')
		{
			$data['inputerror'][] = 'rata_siswa';
			$data['error_string'][] = 'Rata Rata Siswa is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('jumlah_room') == '')
		{
			$data['inputerror'][] = 'jumlah';
			$data['error_string'][] = 'Jumlah Siswa is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Detail Kelas
//====================================================================================//

//====================================================================================//
// Mulai Bagian Materi Ajar
/* Work by Ibnu */
//====================================================================================//

	public function materi_ajar()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'materi_ajar';
			$data['modals']	 = 'admin/modules/materi_ajar/materi_ajar_modal';
			$data['content'] = 'admin/modules/materi_ajar/materi_ajar';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function materi_ajar_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('materi_ajar');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function materi_ajar_edit_data($id)
    {
    	$this->db->from('materi_ajar');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function materi_ajar_insert_data()
    {
    	$this->_validate_materi_ajar();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('materi_ajar', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function materi_ajar_update_data()
    {
		$this->_validate_materi_ajar();
		$data = array(
				'nama' => $this->input->post('nama'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('materi_ajar', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function materi_ajar_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('materi_ajar');
    	echo json_encode(array("status" => TRUE));
    }

    // Untuk Validasi
    private function _validate_materi_ajar()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Materi Ajar
//====================================================================================//

//====================================================================================//
// Mulai Bagian Eskull
/* Work by Ibnu */
//====================================================================================//

	public function eskull()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'eskull';
			$data['modals']	 = 'admin/modules/eskull/eskull_modal';
			$data['content'] = 'admin/modules/eskull/eskull';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function eskull_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('eskull');
    	// $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function eskull_edit_data($id)
    {
    	$this->db->from('eskull');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

    //Aksi Insert
    public function eskull_insert_data()
    {
    	$this->_validate_eskull();
    	$data = array(
				'isi' => $this->input->post('isi'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('eskull', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function eskull_update_data()
    {
		$this->_validate_eskull();
		$data = array(
				'isi' => $this->input->post('isi'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('eskull', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function eskull_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('eskull');
    	echo json_encode(array("status" => TRUE));
    }

    // Untuk Validasi
    private function _validate_eskull()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('isi') == '')
		{
			$data['inputerror'][] = 'isi';
			$data['error_string'][] = 'Isi is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Eskull
//====================================================================================//

/*====================================================================================*/
/* Mulai Model Guru */
/* Work by Ibnu */
/*====================================================================================*/

	public function guru()
	{
		$take_akun = $this->Global_models->take_user($this->session->userdata('username'));
		$data = array('username' => $take_akun);
		$stat = $this->session->userdata('isLogin');

		if (isset($stat)) {
			$data['modules'] = 'guru';
			$data['modals']	 = 'admin/modules/guru/guru_modal';
			$data['content'] = 'admin/modules/guru/guru';
			$this->load->view('admin/index', $data);
		}else {
			echo "<script> alert('Check your username and password!'); </script>";
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');	
		}
	}

	public function gurus_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('guru');
    	// $query = $this->db->query('SELECT * FROM gurus ORDER BY id DESC');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
	}

    public function guru_edit_data($id)
    {
    	$this->db->from('guru');
			$this->db->where('id',$id);
			$query = $this->db->get();
			if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	$query = $query->row();
    	header('Content-Type: application/json');
    	echo json_encode(array('status' => $status, 'data' => $query));
    }

	public function guru_add()
	{
		$this->_validate_guru();

		$data = array(
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'nuptk' => $this->input->post('nuptk'),
				'kelamin' => $this->input->post('kelamin'),
				'ttl' => $this->input->post('ttl'),
				'pelajaran_jabatan' => $this->input->post('pelajaran_jabatan'),
				'status' => $this->input->post('status'),
				'alamat' => $this->input->post('alamat'),
				'blog' => $this->input->post('blog'),
				'prestasi' => $this->input->post('prestasi'),
				'created' => $this->input->post('created'),
				'updated' => $this->input->post('updated'),
			);

		if(!empty($_FILES['foto']['name']))
		{
			$upload = $this->guru_do_upload();
			$data['foto'] = $upload;
		}

		$dbInsert = $this->db->insert('guru', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function guru_update()
	{
		$this->_validate_guru();
		$data = array(
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'nuptk' => $this->input->post('nuptk'),
				'kelamin' => $this->input->post('kelamin'),
				'ttl' => $this->input->post('ttl'),
				'pelajaran_jabatan' => $this->input->post('pelajaran_jabatan'),
				'status' => $this->input->post('status'),
				'alamat' => $this->input->post('alamat'),
				'blog' => $this->input->post('blog'),
				'prestasi' => $this->input->post('prestasi'),
				'updated' => $this->input->post('updated'),
			);

		if($this->input->post('remove_foto')) // if remove photo_guru checked
		{
			if(file_exists('public/admin/img/guru/'.$this->input->post('remove_foto')) && $this->input->post('remove_foto'))
				unlink('public/admin/img/guru/'.$this->input->post('remove_foto'));
			$data['foto'] = '';
		}

		if(!empty($_FILES['foto']['name']))
		{
			$upload = $this->guru_do_upload();

			//delete file
			$guru = $this->Global_models->guru_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/guru/'.$guru->foto) && $guru->foto)
				unlink('public/admin/img/guru/'.$guru->foto);

			$data['foto'] = $upload;
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('guru', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function guru_delete($id)
	{
		//delete file
		$guru = $this->Global_models->guru_get_by_id($id);
		if(file_exists('public/admin/img/guru/'.$guru->foto) && $guru->foto)
			unlink('public/admin/img/guru/'.$guru->foto);

		$this->db->where('id', $id);
    	$this->db->delete('guru');
    	echo json_encode(array("status" => TRUE));
	}

	private function guru_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/guru/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('foto')) //upload and validate
        {
            $data['inputerror'][] = 'foto';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

    // Untuk Validasi
    private function _validate_guru()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('nip') == '')
		{
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP is required ';
			$data['status'] = FALSE;
		}

		if($this->input->post('nuptk') == '')
		{
			$data['inputerror'][] = 'nuptk';
			$data['error_string'][] = 'NUPTK is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('kelamin') == '')
		{
			$data['inputerror'][] = 'kelamin';
			$data['error_string'][] = 'Kelamin is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ttl') == '')
		{
			$data['inputerror'][] = 'ttl';
			$data['error_string'][] = 'Tempat,Tanggal Lahir is required ';
			$data['status'] = FALSE;
		}

		if($this->input->post('pelajaran_jabatan') == '')
		{
			$data['inputerror'][] = 'pelajaran_jabatan';
			$data['error_string'][] = 'pelajaran_jabatan is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('status') == '')
		{
			$data['inputerror'][] = 'status';
			$data['error_string'][] = 'Status is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}

/*===============================================================================================*/
/* Akhir Model User */
/*===============================================================================================*/
}
