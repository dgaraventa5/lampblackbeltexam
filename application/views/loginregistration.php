<html>
<head>
	<title>Welcome</title>
	<style type="text/css">
		div {
			border: 1px black solid;
			display: inline-block;
			padding: 10px;
			vertical-align: top;
		}
	</style>
</head>
<body>
	<h1>Welcome!</h1>
	<div>
		<h3>Register</h3>
		<?php if ($this->session->flashdata('registration_error')) {
			echo $this->session->flashdata('registration_error');
		} ?>
		<form method="post" action="/users/register_user">
			Name: <input type="text" name="name"><br>
			Alias: <input type="text" name="alias"><br>
			Email: <input type="text" name="email"><br>
			Password: <input type="password" name="password"><br>
			Confirm Password: <input type="password" name="confirm password"><br>
			<input type="submit" value="Register">
		</form>
	</div>
	<div>
		<h3>Login</h3>
		<?php if ($this->session->flashdata('login_error')) {
			echo $this->session->flashdata('login_error');
		} ?>
		<form method="post" action="/users/login_user">
			Email: <input type="text" name="email"><br>
			Password: <input type="password" name="password"><br>
			<input type="submit" value="Login">
		</form>
	</div>

</body>
</html>