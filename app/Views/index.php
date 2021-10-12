<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title><?php echo $title ?></title>
</head>

<body>

	<?php
	$validation = \Config\Services::validation();
	helper('form');
	?>

	<!-- Body -->
	<div class="row" style="padding-top:25vh">
		<div class="col l2 push-l5">
			<div class="row">
				<!-- Logo -->
				<div class="row">
					<div class="col s12 m12 l12 center">
						<img src="<?php echo base_url('logo.svg') ?>" alt="" class="responsive-img" style="height: 15vh">
					</div>
				</div>
				<?php echo form_open('login') ?>
				<?php echo csrf_field() ?>
				<!-- Login -->
				<div class="row">
					<div class="input-field col l12">
						<i class="material-icons prefix">account_circle</i>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="validate
							<?php echo $validation->getError('username') ? 'invalid' : '' ?>" value="<?php echo isset($dataUser['username']) ? $dataUser['username'] : set_value('username') ?>">
							<span class="helper-text" data-error="The field is required."></span>
					</div>
				</div>
				<!-- Password -->
				<div class="row">
					<div class="input-field col l12">
						<i class="material-icons prefix">lock</i>
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="validate 
							<?php echo $validation->getError('password') ? 'invalid' : '' ?>" value="<?php echo isset($dataUser['password']) ? $dataUser['password'] : set_value('password') ?>">
							<span class="helper-text" data-error="The field is required."></span>
					</div>
				</div>
				<!-- Btn send -->
				<div class="row center">
					<button type="submit" class="btn waves-effect-waves-light green">Login</button>
					<a href="<?php echo base_url('/new-user') ?>" class="btn waves-effect-waves-light blue">Sign In</a>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</body>

</html>