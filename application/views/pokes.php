<html>
<head>
	<title>Pokes</title>
	<style type="text/css">

		#logout {
			margin-left: 600px;
		}
		#counter {
			border: 1px solid black;
			padding: 10px;
			width: 40%;
		}
		#user_table {
			border: 1px solid black;
			padding: 10px;
			width: 60%;		
		}
			#user_table tr, th, td {
				border: 1px solid black;
				padding: 5px;
			}
	</style>
</head>
<body>
	<a id="logout" href="/users/log_out">Logout</a>
	<h1>Welcome, <?=$this->session->userdata('alias')?>!</h1>
	<h3><?=$total_users['total_users']?> people poked you!</h3>
	<div id="counter">
<?php 	foreach ($current_users_poke_count as $user) {
?>			<p><?=$user['poker']?> poked you <?=$user['total_pokes_by_user']?> times.</p>
<?php
		}
?>	</div>
	<h4>People you may want to poke:</h4>
	<div id = "user_table">
		<table>
			<thead>
				<th>Name</th>
				<th>Alias</th>
				<th>Email Address</th>
				<th>Poke History</th>
				<th>Action</th>
			</thead>
			<tbody>
<?php 		foreach ($all_users_info_minus_current_user as $user) {
?>				<tr>
					<td><?=$user['name']?></td>
					<td><?=$user['alias']?></td>
					<td><?=$user['email']?></td>
					<td><?=$user['total_been_poked']?></td>
					<td><a href="/pokes/poke_user/<?=$user['user_id']?>"><button>Poke</button></a></td>
				</tr>		
<?php					
				} 
?>			</tbody>
		</table>
	</div>
</body>
</html>