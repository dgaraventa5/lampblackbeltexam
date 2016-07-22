<?php 

class Poke extends CI_Model {

	public function get_count_of_users_who_poked($user_id)
	{
		$query = "SELECT COUNT(DISTINCT pokes.user_id) 'total_users' FROM pokes WHERE poked_user_id = ?";
		$values = $user_id;
		return $this->db->query($query, $values)->row_array();
	}

	public function get_users_and_poke_count_who_poked_current_user($user_id)
	{
		$query = "SELECT users.alias 'poker', COUNT(pokes.poked_user_id) 'total_pokes_by_user'
		FROM users
		JOIN pokes ON users.id = pokes.user_id
		JOIN users AS users2 on users2.id = pokes.poked_user_id
		WHERE pokes.poked_user_id = ? 
		GROUP BY users.id ORDER BY COUNT(pokes.poked_user_id) DESC";
		$values = $user_id;
		return $this->db->query($query, $values)->result_array();
	}

	public function get_all_users_info_minus_current_user($user_id)
	{
		$query = "SELECT users.id 'user_id', users.name 'name', users.alias 'alias', 
		users.email 'email', COUNT(pokes.poked_user_id) 'total_been_poked'
		FROM users
		LEFT JOIN pokes ON users.id = pokes.poked_user_id
		WHERE users.id <> ?
		GROUP BY pokes.poked_user_id
		ORDER BY pokes.user_id";
		$values = $user_id;
		return $this->db->query($query, $values)->result_array();
	}

	public function poke_user($data)
	{
		$query = "INSERT INTO pokes (user_id, poked_user_id, created_at, updated_at) VALUES (?,?,NOW(),NOW())";
		$values = array($data['user_id'], $data['poked_user_id']);
		$this->db->query($query, $values);
	}
}
?>