<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'html'));
	}

	public function index()
	{
		$data['modules'] = 'index';
		$data['content'] = 'user/menu/home';
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		// $data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$this->load->view('user/index', $data);
	}

	public function home()
	{
		$data['modules'] = 'home';
		$data['content'] = 'user/menu/home';
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$this->load->view('user/index',$data);
	}

	public function latest_news_data()
	{
		$query = $this->db->query('SELECT * FROM konten WHERE id_kategori_konten = "2" ORDER BY created DESC');
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

	public function profil()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function profil_lengkap()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function struktur_organisasi()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function sejarah()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function visi_misi()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function fasilitas()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function direktori_guru()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function direktori_staf()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function direktori_siswa()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function direktori_alumni()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function prestasi_sekolah()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function prestasi_guru()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function prestasi_siswa()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function osis()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function ekstra_kurikuler()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function berita()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function forum_diskusi()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function daftar_online()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}



	public function galeri()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/galeri';
		$this->load->view('user/index',$data);
	}

	public function galeri_detail()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/galeri_detail';
		$this->load->view('user/index',$data);
	}

	public function vidio()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/vidio';
		$this->load->view('user/index',$data);
	}
	// Admin //

	public function Dashboard()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'vw_admin/content';
		$this->load->view('vw_admin/index',$data);
	}

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */
