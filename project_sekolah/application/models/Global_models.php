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
		$query = $this->db->get_where('user',array('username' => $username, 'password' => $password));
		$query = $query->result_array();
		return $query;
	}

	function check_admin($username="", $password)
	{
		$query = $this->db->get_where('user',array('username' => $username, 'password' => $password));
		$query = $query->result_array();
		return $query;
	}

	function take_user($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        $query = $query->result_array();
        if($query){
            return $query[0];
        }
    }

    /*============================================================================================================================*/
    /* Model User */
    /*============================================================================================================================*/

    public function user_get_by_id($id)
	{
		$this->db->from('user');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

    /*============================================================================================================================*/
    /* Model User */
    /*============================================================================================================================*/

}

/* End of file Global_models.php */
/* Location: ./application/models/Global_models.php */