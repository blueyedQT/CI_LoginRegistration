<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$this->load->view('login_register');
	}

	public function login_user() {
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "required|valid_emails");
		$this->form_validation->set_rules("password", "Password", "required");
		if($this->form_validation->run() === FALSE) {
			$this->view_data['errors'] = validation_errors();
			$this->session->set_flashdata('login_error', $this->view_data['errors']);
			redirect('');
		} else {
			$this->load->model('LoginModel');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->LoginModel->login_db($email);
			if($user != NULL) {
				if(crypt($password, $user['password']) == $user['password']) {
					$user_data = array('id' => $user['id'], 'first_name' => $user['first_name'], 
										'last_name' => $user['last_name'], 'email' => $user['email']);
					$this->session->set_userdata('user', $user_data);
					$this->session->set_userdata('loggedin', TRUE);
					redirect('welcome');
				} else {
					$error = 'That is not a vaild username and password combination';
					$this->session->set_flashdata('login_error', $error);
				}
			}
		}
		redirect('');
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
			$pass = $this->input->post('password');
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$hash = crypt($pass, $salt);
			$display['password'] = $hash;
			$add_user = $this->LoginModel->add_user($display);
			if($add_user == FALSE) {
				echo 'There was an error, please try again';
			} else {
			$user_data = array('id' => $add_user, 'first_name' => $display['first_name'], 
								'last_name' => $display['last_name'], 'email' => $display['email']);
			$this->session->set_userdata('user', $user_data);
			$this->session->set_userdata('loggedin', TRUE);
			redirect('welcome');
			}
		}
	}

	public function loggedin() {
		if($this->session->userdata('loggedin') == TRUE) {
			$display['user'] = $this->session->userdata['user'];
			$this->load->view('welcome', $display);
		} else {
			redirect('');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->session->set_flashdata('login_error', 'You have logged out');
		redirect('');
	}
}