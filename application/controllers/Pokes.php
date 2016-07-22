<?php

class Pokes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Poke');
    }

    public function index() {
        $user_id = $this->session->userdata('id');
        //total pokes
        $total_users = $this->Poke->get_count_of_users_who_poked($user_id);
        if (empty($total_users)) {
            $total_users = 0;
        }
        //people who poked, how many times
        $current_users_poke_count = $this->Poke->get_users_and_poke_count_who_poked_current_user($user_id);
        if (empty($current_users_poke_count)) {
            $current_users_poke_count = array();
        }
        // all users info 
        $all_users_info_minus_current_user = $this->Poke->get_all_users_info_minus_current_user($user_id);
        $data = array(
            'total_users' => $total_users,
            'current_users_poke_count' => $current_users_poke_count,
            'all_users_info_minus_current_user' => $all_users_info_minus_current_user
            );
        $this->load->view('pokes', $data);
	}

    public function poke_user($poked_user_id)
    {
        $user_id = $this->session->userdata('id');
        $data = array(
            'user_id' => $user_id,
            'poked_user_id' => $poked_user_id
            );
        $this->Poke->poke_user($data);
        redirect('/pokes');
    }
}

?>