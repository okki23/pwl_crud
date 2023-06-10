<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
 
	public function index()
	{ 
		$this->load->view('login_view');
	}

	public function auth(){
		$parsing = array(
			'username'=>$this->input->post('username'),
			'password'=>base64_encode($this->input->post('password'))
		);
 
		$sql = $this->db->where($parsing)->get('m_user')->num_rows();
		if($sql > 0){ 
			 
			$this->session->set_userdata(array('username'=>$parsing['username']));
			echo "<script language=javascript>
				alert('Anda berhasil masuk!');
				window.location='" . base_url('buku') . "';
				</script>";
		}else{
			echo "<script language=javascript>
				alert('Akun yang anda masukkan tidak tersedia, Periksa kembali!');
				window.location='" . base_url('login') . "';
				</script>";
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
