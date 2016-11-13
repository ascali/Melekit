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
		$data = array(
			'username'	=> $take_akun,
			);
		$stat = $this->session->userdata('level');

		$data['modules'] = '';
		$data['modals']	 = 'admin/modules/kategori_konten/kategori_konten_modal';
		$data['content'] = 'admin/modules/dashboard/content';

		if ($stat=='Administrator') {
			$this->load->view('admin/index', $data);
		} else if ($stat=='Guest') {
			$this->load->view('admin/index', $data);
		} else {
			// $this->session->sess_destroy();
			echo "<script> alert('Check your username and password!'); </script>";
			// redirect(base_url('maps/guest'),'refresh');
		}
	}

/*============================================================================================================================*/
/* Mulai Model User */
/* Work by Asca */
/*============================================================================================================================*/

	public function users()
	{
		$data['modules'] = 'user';
		$data['modals']	 = 'admin/modules/user/user_modal';
		$data['content'] = 'admin/modules/user/user';
		$this->load->view('admin/index', $data);
	}

	public function users_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('user');
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

    public function user_edit_data($id)
    {
    	$this->db->from('user');
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

	public function user_add()
	{
		$this->_validate_user();

		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status'),
				'created' => $this->input->post('created'),
				'updated' => $this->input->post('updated'),
			);

		if(!empty($_FILES['photo_user']['name']))
		{
			$upload = $this->user_do_upload();
			$data['photo_user'] = $upload;
		}

		$dbInsert = $this->db->insert('user', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function user_update()
	{
		$this->_validate_user();
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status'),
				'updated' => $this->input->post('updated'),
			);

		if($this->input->post('remove_photo_user')) // if remove photo_user checked
		{
			if(file_exists('public/admin/img/user/'.$this->input->post('remove_photo_user')) && $this->input->post('remove_photo_user'))
				unlink('public/admin/img/user/'.$this->input->post('remove_photo_user'));
			$data['photo_user'] = '';
		}

		if(!empty($_FILES['photo_user']['name']))
		{
			$upload = $this->user_do_upload();

			//delete file
			$user = $this->Global_models->user_get_by_id($this->input->post('id'));
			if(file_exists('public/admin/img/user/'.$user->photo_user) && $user->photo_user)
				unlink('public/admin/img/user/'.$user->photo_user);

			$data['photo_user'] = $upload;
		}

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('user', $data);
		echo json_encode(array('status' => TRUE));
	}

	public function user_delete($id)
	{
		//delete file
		$user = $this->Global_models->user_get_by_id($id);
		if(file_exists('public/admin/img/user/'.$user->photo_user) && $user->photo_user)
			unlink('public/admin/img/user/'.$user->photo_user);

		$this->db->where('id', $id);
    	$this->db->delete('user');
    	echo json_encode(array("status" => TRUE));
	}

	private function user_do_upload()
	{
		$config['upload_path']          = 'public/admin/img/user/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo_user')) //upload and validate
        {
            $data['inputerror'][] = 'photo_user';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

    // Untuk Validasi
    private function _validate_user()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Username is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password is required ';
			$data['status'] = FALSE;
		}

		if($this->input->post('level') == '')
		{
			$data['inputerror'][] = 'level';
			$data['error_string'][] = 'Level is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('status') == '')
		{
			$data['inputerror'][] = 'status';
			$data['error_string'][] = 'Status is required';
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
		$data['modules'] = 'kategori_konten';
		$data['modals']	 = 'admin/modules/kategori_konten/kategori_konten_modal';
		$data['content'] = 'admin/modules/kategori_konten/kategori_konten';
		$this->load->view('admin/index', $data);
	}

	public function kategori_konten_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('kategori_konten');
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
// Mulai Bagian Profil
/* Work by Ibnu */
//====================================================================================//

	public function profil()
	{
		$data['modules'] = 'profil';
		$data['modals']	 = 'admin/modules/profil/profil_modal';
		$data['content'] = 'admin/modules/profil/profil';
		$this->load->view('admin/index', $data);
	}

	public function profil_data()
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

    //Aksi Insert
    public function profil_insert_data()
    {
    	$this->_validate_profil();
    	$data = array(
				'nama' => $this->input->post('nama'),
				'kepala_sekolah' => $this->input->post('kepala_sekolah'),
				'visi' => $this->input->post('visi'),
				'misi' => $this->input->post('misi'),
				'sejarah' => $this->input->post('sejarah'),
				'alamat' => $this->input->post('alamat'),
				'logo' => $this->input->post('logo'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('profil', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function profil_update_data()
    {
		$this->_validate_profil();
		$data = array(
				'nama' => $this->input->post('nama'),
				'kepala_sekolah' => $this->input->post('kepala_sekolah'),
				'visi' => $this->input->post('visi'),
				'misi' => $this->input->post('misi'),
				'sejarah' => $this->input->post('sejarah'),
				'alamat' => $this->input->post('alamat'),
				'logo' => $this->input->post('logo'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('profil', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function profil_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('profil');
    	echo json_encode(array("status" => TRUE));
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
			$data['error_string'][] = 'Kepala Sekolah is required';
			$data['status'] = FALSE;
		}
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
		if($this->input->post('sejarah') == '')
		{
			$data['inputerror'][] = 'sejarah';
			$data['error_string'][] = 'Sejarah is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('logo') == '')
		{
			$data['inputerror'][] = 'logo';
			$data['error_string'][] = 'Logo is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}

	}
//====================================================================================//
// Akhir Bagian Profil
//====================================================================================//



//====================================================================================//
// Mulai Bagian Visi Misi
/* Work by Ibnu */
//====================================================================================//

	public function visi_misi()
	{
		$data['modules'] = 'visi_misi';
		$data['modals']	 = 'admin/modules/visi_misi/visi_misi_modal';
		$data['content'] = 'admin/modules/visi_misi/visi_misi';
		$this->load->view('admin/index', $data);
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
		$data['modules'] = 'kelas';
		$data['modals']	 = 'admin/modules/kelas/kelas_modal';
		$data['content'] = 'admin/modules/kelas/kelas';
		$this->load->view('admin/index', $data);
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
		$data['modules'] = 'konten';
		$data['modals']	 = 'admin/modules/konten/konten_modal';
		$data['content'] = 'admin/modules/konten/konten';
		$this->load->view('admin/index', $data);
	}

	public function konten_data()
	{
    	$this->db->order_by('id', 'desc');
    	// $query = $this->db->get('konten');
    	$query = $this->db->query('SELECT a.*, b.nama as nama_kategori_konten FROM konten a
    								LEFT JOIN kategori_konten b on(a.id_kategori_konten=b.id) ORDER BY id DESC');
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

    //Aksi Insert
    public function konten_insert_data()
    {
    	$this->_validate_konten();
    	$data = array(
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'id_kategori_konten' => $this->input->post('kategori_konten'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s'),
				'create_by' => $this->input->post('create_by')
			);

		$dbInsert = $this->db->insert('konten', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function konten_update_data()
    {
		$this->_validate_konten();
		$data = array(
				'judul' => $this->input->post('judul'),
				'isi' => $this->input->post('isi'),
				'id_kategori_konten' => $this->input->post('kategori_konten'),
				'updated' => date('Y-m-d H:i:s'),
				'create_by' => $this->input->post('create_by')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('konten', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function konten_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('konten');
    	echo json_encode(array("status" => TRUE));
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
		if($this->input->post('kategori_konten') == '')
		{
			$data['inputerror'][] = 'kategori_konten';
			$data['error_string'][] = 'Kategori Konten is required';
			$data['status'] = FALSE;
		}
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
		$data['modules'] = 'menu';
		$data['modals']	 = 'admin/modules/menu/menu_modal';
		$data['content'] = 'admin/modules/menu/menu';
		$this->load->view('admin/index', $data);
	}

	public function menu_data()
	{
    	$this->db->order_by('id', 'desc');
    	// $query = $this->db->get('menu');
    	$query = $this->db->query('SELECT a.*, b.nama as nama_submenu FROM menu a
    								LEFT JOIN submenu b ON(a.id_submenu=b.id) ORDER BY a.id DESC');
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

	public function select_menu()
	{
    	$query = $this->db->query('SELECT id,nama FROM submenu ORDER BY id ASC');
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
				'id_submenu' => $this->input->post('id_submenu'),
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
				'id_submenu' => $this->input->post('id_submenu'),
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
		$data['modules'] = 'submenu';
		$data['modals']	 = 'admin/modules/submenu/submenu_modal';
		$data['content'] = 'admin/modules/submenu/submenu';
		$this->load->view('admin/index', $data);
	}

	public function submenu_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('submenu');
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
				'href' => $this->input->post('link'),
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
		if($this->input->post('link') == '')
		{
			$data['inputerror'][] = 'link';
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
		$data['modules'] = 'vidio';
		$data['modals']	 = 'admin/modules/vidio/vidio_modal';
		$data['content'] = 'admin/modules/vidio/vidio';
		$this->load->view('admin/index', $data);
	}

	public function vidio_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('vidio');
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

    public function vidio_edit_data($id)
    {
    	$this->db->from('vidio');
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
				'link' => $this->input->post('path'),
				'id_kategori' => $this->input->post('id_kategori_vidio'),
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			);

		$dbInsert = $this->db->insert('vidio', $data);
		echo json_encode(array('status' => TRUE));
    }
    // Aksi update
    public function vidio_update_data()
    {
		$this->_validate_vidio();
		$data = array(
				'nama' => $this->input->post('nama'),
				'link' => $this->input->post('path'),
				'id_kategori' => $this->input->post('id_kategori_vidio'),
				'updated' => date('Y-m-d H:i:s')
			);

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('vidio', $data);
		echo json_encode(array('status' => TRUE));
    }

    public function vidio_delete_data($id)
    {
    	$this->db->where('id', $id);
    	$this->db->delete('vidio');
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
		if($this->input->post('id_kategori') == '')
		{
			$data['inputerror'][] = 'id_kategori';
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
		$data['modules'] = 'siswa';
		$data['modals']	 = 'admin/modules/siswa/siswa_modal';
		$data['content'] = 'admin/modules/siswa/siswa';
		$this->load->view('admin/index', $data);
	}

	public function siswa_data()
	{
    	$this->db->order_by('id', 'desc');
    	// $query = $this->db->get('siswa');
    	$query = $this->db->query('SELECT a.*, b.nama as nama_kelas, b.wali_kelas FROM siswa a
    								LEFT JOIN kelas b ON(a.id_kelas=b.id) ORDER BY a.id DESC');
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
				'id_kelas' => $this->input->post('id_kelas'),
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
				'id_kelas' => $this->input->post('id_kelas'),
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
		if($this->input->post('id_kelas') == '')
		{
			$data['inputerror'][] = 'id_kelas';
			$data['error_string'][] = 'Kelas is required';
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
		$data['modules'] = 'komen';
		$data['modals']	 = 'admin/modules/komen/komen_modal';
		$data['content'] = 'admin/modules/komen/komen';
		$this->load->view('admin/index', $data);
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
				'date' => $this->input->post('date'),
				'isi' => $this->input->post('isi'),
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
				'date' => $this->input->post('date'),
				'isi' => $this->input->post('isi'),
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
			$data['error_string'][] = 'Isi Knmentar is required';
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
/* End of file Administrator.php */
/* Location: ./application/controllers/Administrator.php */

}
