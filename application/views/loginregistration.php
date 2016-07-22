<html>
<head>
	<title>Welcome</title>
	<style type="text/css">
		div {
			border: 1px black solid;
			display: inline-block;
			padding: 20px;
			vertical-align: top;
		}
		label {
			display: block;
		}
		#datepicker {
 			font-size:12px;
		}
	</style>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<script>
		$(document).ready(function(){
			$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd', minDate: "-50Y", maxDate: 0, changeMonth: true, changeYear: true });
		});
	</script>
</head>
<body>
	<h1>Welcome!</h1>
	<div>
		<h3>Register</h3>
		<?php if ($this->session->flashdata('registration_error')) {
			echo $this->session->flashdata('registration_error');
		} ?>
		<form method="post" action="/users/register_user">
			<label>Name: <input type="text" name="name"></label>
			<label>Alias: <input type="text" name="alias"></label>
			<label>Email: <input type="text" name="email"></label>
			<label>Password: <input type="password" name="password"></label>
			<label>Confirm Password: <input type="password" name="confirm password"></label>
			<label id="DOB">Date of Birth: <input  name="DOB" id="datepicker" type="text"></label>
			<input type="submit" value="Register">
		</form>
	</div>
	<div>
		<h3>Login</h3>
		<?php if ($this->session->flashdata('login_error')) {
			echo $this->session->flashdata('login_error');
		} ?>
		<form method="post" action="/users/login_user">
			<label>Email: <input type="text" name="email"></label>
			<label>Password: <input type="password" name="password"></label>
			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>