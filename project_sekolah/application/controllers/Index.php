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
		$data['modules'] = 'home';
		$data['content'] = 'user/menu/home';
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['berita']  = $this->db->query('SELECT * FROM konten WHERE id_kategori_konten=3')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM galeri WHERE banner="Iya"')->result_object();
		$this->load->view('user/index', $data);
	}

	public function detail_berita($detail_berita)
	{
		$data['modules'] = 'mod_detail_berita';
		$data['content'] = 'user/menu/detail_berita';
		// var_dump($detail_berita);
		//$data['detail_berita']  = $this->db->query("SELECT * FROM konten WHERE id_kategori_konten=3 and id='$id'")->result_object();
		$this->load->view('user/index', $data);
	}

	public function detail_berita_data($id){
	
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

	public function latest_news_data()
	{
		$query = $this->db->query('SELECT * FROM konten WHERE id_kategori_konten = "3" ORDER BY created DESC');
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

	public function program_sekolah()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/program_sekolah';
		$this->load->view('user/index',$data);
	}

	public function profil_sekolah()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/profil_sekolah';
		$this->load->view('user/index',$data);
	}

	public function profil_lengkap_data()
	{
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

	public function struktur_organisasi()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/struktur_organisasi';
		$this->load->view('user/index',$data);
	}


	public function sejarah()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/sejarah';
		$this->load->view('user/index',$data);
	}


	public function visi_misi()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/visi_misi';
		$this->load->view('user/index',$data);
	}

	public function fasilitas()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/fasilitas';
		$this->load->view('user/index',$data);
	}


	public function direktori_guru()
	{
		$data['modules'] = 'direktori';
		$data['content'] = 'user/menu/direktori_guru';
		$this->load->view('user/index',$data);
	}

	public function guru_view_data($id)
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

    public function kurikulum()
	{
		$data['modules'] = 'direktori';
		$data['content'] = 'user/menu/kurikulum';
		$this->load->view('user/index',$data);
	}

	public function kurikulum_data()
	{
    	$query = $this->db->get('materi_ajar');
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

	public function direktori_staff()
	{
		$data['modules'] = 'direktori';
		$data['content'] = 'user/menu/direktori_staff';
		$this->load->view('user/index',$data);
	}

	public function staff_data()
	{
    	//$this->db->order_by('id', 'desc');
    	//$query = $this->db->get('guru');
    	$query = $this->db->query('SELECT * FROM guru where status_karyawan="staff" ORDER BY id DESC');
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


	public function direktori_siswa()
	{
		$data['modules'] = 'direktori';
		$data['content'] = 'user/menu/direktori_siswa';
		$this->load->view('user/index',$data);
	}

	public function siswa_data()
	{
    	$query = $this->db->query('SELECT a.*, b.nama as nama_jurusan FROM siswa a
    								JOIN jurusan b ON (a.id_jurusan=b.id) ORDER BY a.id DESC');
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

	public function siswa_view_data($id)
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


	public function direktori_alumni()
	{
		$data['datas']   = $this->db->query('SELECT * FROM profil WHERE id=1')->result_object();
		$data['data']    = $this->db->query('SELECT * FROM gambar WHERE status_slide=1')->result_object();
		$data['content'] = 'user/menu/konten_umum';
		$this->load->view('user/index',$data);
	}


	public function prestasi_sekolah()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/prestasi_sekolah';
		$this->load->view('user/index',$data);
	}

	public function gurus_data()
	{
    	//$this->db->order_by('id', 'desc');
    	//$query = $this->db->get('guru');
    	$query = $this->db->query('SELECT * FROM guru where status_karyawan="guru" ORDER BY id DESC');
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

	public function prestasi_guru()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/prestasi_guru';
		$this->load->view('user/index',$data);
	}

	public function prestasi_siswa()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/prestasi_siswa';
		$this->load->view('user/index',$data);
	}

	public function kemitraan()
	{
		$data['modules'] = 'profil';
		$data['content'] = 'user/menu/kemitraan';
		$this->load->view('user/index',$data);
	}

	public function kemitraan_data()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('kemitraan');
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
		$data['modules'] = 'berita';
		$data['content'] = 'user/menu/berita';
		$this->load->view('user/index',$data);
	}

	public function berita_data()
	{
		$this->db->order_by('id', 'desc');
    	$query = $this->db->get('video');
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

	public function event_data_user()
	{
    	$this->db->order_by('id', 'desc');
    	$query = $this->db->get('event');
    	$query = $query->result();
    	if (isset($query)) {
    		$status = 'success';
    		$query = $query;
    	}else {
    		$status = 'error';
    		$query = 'error';
    	}
    	header('Content-Type: application/json');
    	echo json_encode($query);
	}

	// MUH

	// --------------- Galeri ----------------- //
	public function galeri()
	{
		$data['modules'] = 'galeri';
		$data['content'] = 'user/menu/galeri';
		$this->load->view('user/index',$data);
	}

	public function galeri_data()
	{
		$this->db->order_by('id', 'desc');
    	$query = $this->db->get('galeri');
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

	public function vidio()
	{
		$data['modules'] = 'vidio';
		$data['content'] = 'user/menu/vidio';
		$this->load->view('user/index',$data);
	}

	public function vidio_data()
	{
		$this->db->order_by('id', 'desc');
    	$query = $this->db->get('video');
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

	// --------------- Info ----------------- //

	/* Artikel */
	public function artikel()
	{
		$data['modules'] = 'artikel';
		$data['content'] = 'user/menu/artikel';
		$this->load->view('user/index',$data);
	}

	public function artikel_data()
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

	public function detail_artikel_data($id)
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

	public function detail_artikel($detail_artikel)
	{
		$data['modules'] = 'mod_detail_artikel';
		$data['content'] = 'user/menu/detail_artikel';
		$this->load->view('user/index', $data);
	}

	/* Loker */
	public function loker()
	{
		$data['modules'] = 'loker';
		$data['content'] = 'user/menu/loker';
		$this->load->view('user/index',$data);
	}

	public function loker_data()
	{
		$query = $this->db->query('SELECT * FROM konten WHERE id_kategori_konten = "4" ORDER BY created DESC');
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

	public function detail_loker_data($id)
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

	public function detail_loker($detail_loker)
	{
		$data['modules'] = 'mod_detail_loker';
		$data['content'] = 'user/menu/detail_loker';
		$this->load->view('user/index', $data);
	}

	/* Agenda */
	public function agenda()
	{
		$data['modules'] = 'agenda';
		$data['content'] = 'user/menu/agenda';
		$this->load->view('user/index',$data);
	}

	public function agenda_data()
	{
		$query = $this->db->query('SELECT * FROM event');
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

	public function kontak()
	{
		$data['modules'] = 'kontak';
		$data['content'] = 'user/menu/kontak';
		$this->load->view('user/index',$data);
	}

	public function kontak_data()
	{
		$query = $this->db->query('SELECT * FROM kontak');
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


}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */
