<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_models extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

    /*============================================================================================================================*/
    /* Model User */
    /*============================================================================================================================*/

	function check_user($username="",$password="")
	{
		$query = $this->db->get_where('admin',array('username' => $username, 'password' => $password));
		$query = $query->result_array();
		return $query;
	}

	function check_admin($username="", $password)
	{
		$query = $this->db->get_where('admin',array('username' => $username, 'password' => $password));
		$query = $query->result_array();
		return $query;
	}

	function take_user($username)
    {
        $query = $this->db->get_where('admin', array('username' => $username));
        $query = $query->result_array();
        if($query){
            return $query[0];
        }
    }

    /*==============================================================================================*/
    /* Model User */
    /*==============================================================================================*/

    public function user_get_by_id($id)
	{
		$this->db->from('admin');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

    /*==============================================================================================*/
    /* Model User */
    /*==============================================================================================*/

    /*==============================================================================================*/
    /* Model jurusan */
    /*==============================================================================================*/

    public function jurusan_get_by_id($id)
	{
		$this->db->from('jurusan');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

    /*==============================================================================================*/
    /* Model jurusan */
    /*==============================================================================================*/

    /*==============================================================================================*/
    /* Model Gambar  by ibnu*/
    /*==============================================================================================*/
	public function galeri_get_by_id($id)
	{
		$this->db->from('galeri');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}		
	/*==============================================================================================*/
    /* Model Gambar  by ibnu*/
    /*==============================================================================================*/

    /*==============================================================================================*/
    /* Model pengaturan */
    /*==============================================================================================*/

    public function pengaturan_get_by_id($id)
	{
		$this->db->from('pengaturan');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	/*==============================================================================================*/
    /* Model pengaturan */
    /*==============================================================================================*/
	/*==============================================================================================*/
    /* Model profil */
    /*==============================================================================================*/

	public function profil_get_by_id($id)
	{
		$this->db->from('profil');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function str_org_get_by_id($id)
	{
		$this->db->from('profil');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

    /*==============================================================================================*/
    /* Model Profil */
    /*==============================================================================================*/
    /*==============================================================================================*/
    /* Model Guru */
    /*==============================================================================================*/

	public function guru_get_by_id($id)
	{
		$this->db->from('guru');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

    /*==============================================================================================*/
    /* Model Guru */
    /*==============================================================================================*/
    /*==============================================================================================*/
    /* Model Guru */
    /*==============================================================================================*/

	public function konten_get_by_id($id)
	{
		$this->db->from('konten');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

    /*==============================================================================================*/
    /* Model Profil */
    /*==============================================================================================*/

}

/* End of file Global_models.php */
/* Location: ./application/models/Global_models.php */