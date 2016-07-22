<?php 

class User extends CI_Model {

	public function register_new_user($user)
	{
		$query = "INSERT INTO users (name, alias, email, password, date_of_birth, created_at, updated_at) VALUES (?,?,?,?,?,NOW(),NOW())";
		$values = array($user['name'], $user['alias'], $user['email'], $user['password'], $user['date_of_birth']);
		$this->db->query($query, $values);
		return $this->db->insert_id();
	}

	public function get_user_by_email($email)
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
	}

}
?>