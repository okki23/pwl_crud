<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	
	public function __construct(){

		parent::__construct();
		 
		if(!$this->session->userdata('username')){
			echo "<script language=javascript>
					alert('Anda tidak berhak mengakses halaman ini!');
					window.location='" . base_url('login') . "';
					</script>";
		}
	} 
	public function index()
	{
		$data['listing'] = $this->db->get('buku')->result();
		$this->load->view('buku_view',$data);
	}

	public function simpan(){
		$data = array('nama_buku'=>'Media Informasi 2010','penerbit'=>'Gautama');
		$this->db->insert('buku', $data);
	}

	public function store(){
		$this->load->view('buku_store');
	}

	public function save(){
		$data = array("nama_buku"=>$this->input->post('nama_buku'),"penerbit"=>$this->input->post('penerbit'));
		$store = $this->db->insert('buku', $data);
		if($store){
			redirect ('buku');
		}

	}

	public function hapus(){
		$id = $this->uri->segment(3);
		$del = $this->db->delete('buku', array('id' => $id));  
		if($del){
			redirect ('buku');
		}
	}

	public function ubah(){
		$id = $this->uri->segment(3);
		$data['fetch'] = $this->db->get_where('buku', array('id' => $id))->row();	
		$this->load->view('buku_edit',$data);
	}

	public function saveubah(){
		$id = $this->input->post('id');
		$data = array("nama_buku"=>$this->input->post('nama_buku'),"penerbit"=>$this->input->post('penerbit'));
		$ubah = $this->db->where('id', $id)->update('buku', $data);
		if($ubah){
			redirect ('buku');
		}
	}
}
