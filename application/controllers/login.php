<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('login_register');
	}

	public function login_user() {
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "required");
		if($this->form_validation->run() === FALSE) {
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('errors', $this->view_data['errors']);
			$this->load->view('login_register');
		}
		$this->load->model('LoginModel');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$display = array('email' => $email, 'password' => $password);
		$this->LoginModel->login_db($display);
	}

	public function register_user() {
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "required|alpha|min_length[2]");
		$this->form_validation->set_rules("last_name", "Last Name", "required|alpha|min_length[2]");
		$this->form_validation->set_rules("email", "Email", "required|valid_emails|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "required|min_length[8]");
		$this->form_validation->set_rules("password2", "Confirm Password", "required|matches[password]");
		if($this->form_validation->run() === FALSE) {
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('errors', $this->view_data['errors']);
			redirect('');
		} else {
			$this->load->model('LoginModel');
			$display['first_name'] = $this->input->post('first_name');
			$display['last_name'] = $this->input->post('last_name');
			$display['email'] = $this->input->post('email');
			$display['password'] = $this->input->post('password');
			$add_user = $this->LoginModel->add_user($display);
			if($add_user == FALSE) {
				echo 'There was an error, please try again';
			} else {
			$this->session->set_userdata('id', $add_user);
			$this->session->set_userdata('user', $this->input->post('first_name'));
			$this->session->set_userdata('loggedin', TRUE);
			redirect('/welcome', $display);
			}
		}
	}

	public function loggedin() {
		if($this->session->userdata('loggedin') == TRUE) {
			$display['user'] = $this->session->userdata['user'];
			$this->load->view('welcome', $display);
		}
	}

	public function get_info() {
		$this->load->model('LoginModel');
		$id = $this->session->userdata('id');
		$display['user'] = $this->LoginModel->get_user_info($id);
		$this->load->view('welcome', $display);
	}
}