<?php

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function index() {
        // if ($this->session->userdata('is_logged_in')) {
        //     redirect('/books');
        // }
        
        // $data['registration_error'] = $this->session->userdata('registration_error');

        $this->load->view('loginregistration');
	}

	public function register_user() 
	{
		//validation testing
		$this->load->library('form_validation');
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("alias", "Alias", "trim|required");
        $this->form_validation->set_rules("email", "Email", "valid_email|required|trim|is_unique[users.email]");
        $this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "trim|required|matches[password]");
        $this->form_validation->set_rules("DOB", "Date of Birth", "required");
        //if fails send back to homepage
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('registration_error', validation_errors());
            redirect('/');
        }
        //else register them into database
        else {
        	$user = array(
        		'name' => $this->input->post('name'),
        		'alias' => $this->input->post('alias'),
        		'email' => $this->input->post('email'),
        		'password' => md5($this->input->post('password')),
                'date_of_birth' => date($this->input->post('DOB'))
        		);
            // var_dump($user['date_of_birth']); die();
        	$user['id'] = $this->user->register_new_user($user);
        	//set to logged in, set session data, and send to home view. CAN I MOVE THIS TO DIFFERENT FUNCTION (repeats w/ login)
        	$user['is_logged_in'] = true;
        	$this->session->set_userdata($user);
        	redirect('/pokes');
        }
	}

	public function login_user()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("email", "Email", "valid_email|required|trim");
        $this->form_validation->set_rules("password", "Password", "trim|required");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('login_error', validation_errors());
            redirect('/');
        }
        else {
        	//set login variables
        	$email = $this->input->post('email');
        	$password = md5($this->input->post('password'));
        	$user = $this->user->get_user_by_email($email);
        	//log in
        	if ($user && $user['password'] == $password) {
        		$user = array(
        			'id' => $user['id'],
        			'name' => $user['name'],
        			'alias' => $user['alias'],
        			'email' => $user['email'],
        			'password' => $user['password'],
        			'is_logged_in' => true
        			);
        		$this->session->set_userdata($user);
                redirect('/pokes');
        	}
        	else {
        		$this->session->set_flashdata("login_error", "Invalid email or password!");
        		redirect('/');
        	}
        }
	}


    public function log_out()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}

?>